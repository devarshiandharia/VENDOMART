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
            'card_number' => 'required_if:payment_method,card|nullable|string|size:19',
            'expiry' => 'required_if:payment_method,card|nullable|string|size:5',
            'cvv' => 'required_if:payment_method,card|nullable|string|size:3',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string',
        ]);

        $addressData = $request->only(['phone', 'address', 'city', 'state', 'zip_code']);

        if (strtolower($request->payment_method) === 'cod') {
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

                // Send unified thanking email for COD
                $this->sendInvoiceEmail($order);

                return redirect('user/order-history')->with('success', 'Order placed successfully! A confirmation email has been sent.');
            } catch (\Throwable $e) {
                DB::rollback();
                return back()->with('error', 'ORDER_ERROR: ' . $e->getMessage() . ' (Line: ' . $e->getLine() . ')');
            }
        }

        // For Card payment, generate OTP
        $otp = rand(100000, 999999);

        $cardLastFour = substr(str_replace('-', '', $request->card_number), -4);
        $cardType = collect(['VISA', 'MASTERCARD'])->random();

        // Store order data in session temporarily
        session()->put('pending_order', array_merge([
            'user_id' => Auth::id(),
            'cart' => $cart,
            'payment_method' => $request->payment_method,
            'otp' => $otp,
            'card_last_four' => $cardLastFour,
            'card_type' => $cardType,
            'expires_at' => now()->addMinutes(10),
        ], $addressData));

        // Send OTP via Email
        try {
            $user = Auth::user();
            \Illuminate\Support\Facades\Mail::send('emails.otp', ['otp' => $otp, 'name' => $user->name], function($message) use ($user) {
                $message->to($user->email)
                        ->subject('TRANSACTION_VERIFICATION: Order Auth Code');
            });
        } catch (\Exception $e) {
            // Log error or ignore if mail is not critical for dev
            // In a real app, you'd want to handle this better, maybe by showing the OTP on screen in dev mode.
        }

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
                'card_last_four' => $data['card_last_four'] ?? null,
                'card_type' => $data['card_type'] ?? null,
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
