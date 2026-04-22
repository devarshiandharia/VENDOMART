<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;



class AdminController extends Controller
{

    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->email != 'admin@gmail.com') {
            abort(403);
        }
    }

    public function login()
    {
        return view('admin/login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            // allow only admin email
            if (Auth::user()->email == 'admin@gmail.com') {
                return redirect('admin/');
            }

            // not admin
            Auth::logout();
            return back()->with('error', 'You are not admin');
        }

        return back()->with('error', 'Invalid login details');
    }

    public function addproduct()
    {
        $categories = Category::all();
        return view('admin/add-product', compact('categories'));
    }


    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image',
            'category_id' => 'required'
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('products'), $imageName);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'category_id' => $request->category_id
        ]);

        return back()->with('success', 'Product Added Successfully');
    }

    public function viewproduct()
    {
        $products = Product::latest()->get();
        return view('admin/view-product', compact('products'));
    }

    public function deleteproduct($id)
    {
        $product = Product::findOrFail($id);

        if (file_exists(public_path('products/' . $product->image))) {
            unlink(public_path('products/' . $product->image));
        }

        $product->delete();

        return back()->with('success', 'Product Deleted');
    }


    public function editproduct($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin/edit-product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);

        $product = Product::findOrFail($id);
        
        $imageName = $product->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if (file_exists(public_path('products/' . $product->image))) {
                unlink(public_path('products/' . $product->image));
            }
            // Upload new image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('products'), $imageName);
        }

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imageName,
            'category_id' => $request->category_id
        ]);

        return redirect('admin/view-product')->with('success', 'Product Updated Successfully');
    }

    public function index()
    {
        $totalOrders = Order::count();
        $totalSales = Order::sum('total_amount');
        $totalUsers = User::where('email', '!=', 'admin@gmail.com')->count();
        $recentOrders = Order::latest()->take(5)->get();

        return view('admin/index', compact('totalOrders', 'totalSales', 'totalUsers', 'recentOrders'));
    }

    public function addcategory()
    {
        return view('admin/add-category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
            'icon' => 'nullable'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon' => $request->icon
        ]);

        return back()->with('success', 'Category Added Successfully');
    }

    public function viewcategory()
    {
        $categories = Category::latest()->get();
        return view('admin/view-category', compact('categories'));
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Category Deleted Successfully');
    }

    public function users()
    {
        $users = User::where('email', '!=', 'admin@gmail.com')->get();
        return view('admin/users', compact('users'));
    }

    public function blockUser($id)
    {
        User::where('id', $id)->update(['status' => 0]);
        return back()->with('success', 'User Blocked Successfully');
    }

    public function unblockUser($id)
    {
        User::where('id', $id)->update(['status' => 1]);
        return back()->with('success', 'User Unblocked Successfully');
    }

    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User Deleted Successfully');
    }

    public function vendors()
    {
        return view('admin/vendors');
    }

    public function orders()
    {
        $orders = Order::latest()->get();
        return view('admin/orders', compact('orders'));
    }

    public function orderdetail($id)
    {
        $order = Order::with('items.product', 'user')->findOrFail($id);
        return view('admin/order-detail', compact('order'));
    }

    public function updateOrderStatus($id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);
        
        $stages = ['Pending', 'Processing', 'On the Way', 'Delivered'];
        $currentPos = array_search($order->status, $stages);

        if ($currentPos !== false && $currentPos < count($stages) - 1) {
            $newStatus = $stages[$currentPos + 1];
            $order->update(['status' => $newStatus]);

            // Send invoice if delivered and COD
            if ($newStatus == 'Delivered' && $order->payment_method == 'cod') {
                $this->sendInvoiceEmail($order);
            }

            return back()->with('success', 'Order status updated to ' . $order->status);
        }

        return back()->with('error', 'Order is already delivered!');
    }

    private function sendInvoiceEmail($order)
    {
        try {
            $pdf = Pdf::loadView('admin.pdf.single-order', compact('order'));
            
            Mail::send('emails.invoice', ['order' => $order], function($message) use ($order, $pdf) {
                $message->to($order->user->email)
                        ->subject('TRANSACTION_COMPLETED: Your Vendomart Invoice #' . $order->id)
                        ->attachData($pdf->output(), "invoice_order_" . $order->id . ".pdf");
            });
        } catch (\Exception $e) {
            // Log error if needed, but don't break the flow
        }
    }




    public function exportOrdersExcel()
    {
        $orders = Order::with('user')->get();
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=orders_report_" . date('Y-m-d') . ".csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Order ID', 'Customer', 'Email', 'Phone', 'Address', 'City', 'State', 'Zip', 'Status', 'Total', 'Created At'];

        $callback = function() use($orders, $columns) {
            $file = fopen('php://output', 'w');
            // Add BOM for UTF-8 to fix symbol display in Excel
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, $columns);

            foreach ($orders as $order) {
                $row['Order ID']  = $order->id;
                $row['Customer']  = $order->user->name;
                $row['Email']     = $order->user->email;
                $row['Phone']     = $order->phone;
                $row['Address']   = $order->address;
                $row['City']      = $order->city;
                $row['State']     = $order->state;
                $row['Zip']       = $order->zip_code;
                $row['Status']    = $order->status;
                $row['Total']     = '₹ ' . $order->total_amount;
                $row['Created At'] = $order->created_at->format('Y-m-d H:i:s');

                fputcsv($file, [$row['Order ID'], $row['Customer'], $row['Email'], $row['Phone'], $row['Address'], $row['City'], $row['State'], $row['Zip'], $row['Status'], $row['Total'], $row['Created At']]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportOrdersPDF()
    {
        $orders = Order::with('user', 'items.product')->get();
        $pdf = Pdf::loadView('admin.pdf.orders', compact('orders'));
        return $pdf->download('orders_report_' . date('Y-m-d') . '.pdf');
    }

    public function exportSingleOrderPDF($id)
    {
        $order = Order::with('user', 'items.product')->findOrFail($id);
        $pdf = Pdf::loadView('admin.pdf.single-order', compact('order'));
        return $pdf->download('order_' . $order->id . '_details.pdf');
    }
}
