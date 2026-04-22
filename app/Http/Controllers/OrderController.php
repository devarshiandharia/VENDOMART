<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'payment_method' => 'required|in:cod,card',
            'card_number' => 'required_if:payment_method,card',
            'expiry' => 'required_if:payment_method,card',
            'cvv' => 'required_if:payment_method,card',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
        ]);

        $addressData = $request->only(['phone', 'address', 'city', 'state', 'zip_code']);

        if ($request->payment_method === 'cod') {
            // Place order immediately for COD
            DB::beginTransaction();
            try {
                $totalAmount = 0;
                foreach ($cart as $item) {
                    $totalAmount += $item['price'] * $item['quantity'];
                }

                $order = Order::create(array_merge([
                    'user_id' => Auth::id(),
                    'total_amount' => $totalAmount,
                    'payment_method' => 'cod',
                    'status' => 'Pending'
                ], $addressData));

                foreach ($cart as $id => $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    ]);
                }

                DB::commit();
                session()->forget('cart');

                return redirect('user/order-history')->with('success', 'Order placed successfully!');
            } catch (\Exception $e) {
                DB::rollback();
                return back()->with('error', 'Something went wrong: ' . $e->getMessage());
            }
        }

        // For Card payment, generate OTP
        $otp = rand(100000, 999999);

        // Store order data in session temporarily
        session()->put('pending_order', array_merge([
            'user_id' => Auth::id(),
            'cart' => $cart,
            'payment_method' => $request->payment_method,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ], $addressData));

        // Send OTP via Email
        $user = Auth::user();
        \Illuminate\Support\Facades\Mail::send('emails.otp', ['otp' => $otp, 'name' => $user->name], function($message) use ($user) {
            $message->to($user->email)
                    ->subject('TRANSACTION_VERIFICATION: Order Auth Code');
        });

        return redirect()->route('order.verify.otp')->with('success', 'Verification code sent to your email.');
    }

    public function showVerifyOrderOtp()
    {
        if (!session()->has('pending_order')) {
            return redirect('cart-list/cart');
        }
        return view('verify-order-otp');
    }

    public function verifyOrderOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $data = session()->get('pending_order');

        if (!$data || $request->otp != $data['otp'] || now()->gt($data['expires_at'])) {
            return back()->with('error', 'Invalid or expired verification code.');
        }

        DB::beginTransaction();

        try {
            $totalAmount = 0;
            foreach ($data['cart'] as $item) {
                $totalAmount += $item['price'] * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => $data['user_id'],
                'total_amount' => $totalAmount,
                'payment_method' => $data['payment_method'],
                'status' => 'Pending',
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'zip_code' => $data['zip_code'],
                'phone' => $data['phone'],
            ]);

            foreach ($data['cart'] as $id => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();
            session()->forget(['cart', 'pending_order']);

            // Send invoice immediately for card payment
            $this->sendInvoiceEmail($order);

            return redirect('user/order-history')->with('success', 'Order placed successfully after verification!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('cart-list/cart')->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('user/order-history', compact('orders'));
    }

    private function sendInvoiceEmail($order)
    {
        try {
            // Reload order with relations for PDF
            $order->load('user', 'items.product');
            $pdf = Pdf::loadView('admin.pdf.single-order', compact('order'));
            
            Mail::send('emails.invoice', ['order' => $order], function($message) use ($order, $pdf) {
                $message->to($order->user->email)
                        ->subject('TRANSACTION_COMPLETED: Your Vendomart Invoice #' . $order->id)
                        ->attachData($pdf->output(), "invoice_order_" . $order->id . ".pdf");
            });
        } catch (\Exception $e) {
            // Silent fail or log
        }
    }
}
