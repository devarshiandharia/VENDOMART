<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductdetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index']);
Route::get('/search', [HomeController::class, 'search']);
Route::get('/category/{slug}', [CategoryController::class, 'detail']);
Route::get('product/{slug}', [ProductdetailController::class, 'detail']);
Route::post('add-to-cart/{id}', [CartController::class, 'add'])->middleware('auth');



Route::get('/category/electronics/{slug}', [SubcategoryController::class, 'detail']);

Route::get('/category/electronics/tv/{slug}', [ProductdetailController::class, 'detail']);

Route::get('/cart-list/{slug}', [CartController::class, 'list']);
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('place.order')->middleware('auth');
Route::get('/verify-order-otp', [OrderController::class, 'showVerifyOrderOtp'])->name('order.verify.otp')->middleware('auth');
Route::post('/verify-order-otp', [OrderController::class, 'verifyOrderOtp'])->name('order.verify.otp.post')->middleware('auth');

Route::get('/checkout/{slug}', [CheckoutController::class, 'checkout']);

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register', [UserController::class, 'store']);

Route::get('verify-otp', [UserController::class, 'showVerifyOtp'])->name('otp.verify');
Route::post('verify-otp', [UserController::class, 'verifyOtp'])->name('otp.verify.post');

Route::get('register1', [UserController::class, 'register1']);
Route::post('register1', [UserController::class, 'store']);

Route::get('login', [UserController::class, 'login'])->name('login');
Route::post('login', [UserController::class, 'authenticate']);


Route::get('login1', [UserController::class, 'login1']);
Route::get('login1', [UserController::class, 'authenticate']);

// Logout Routes
Route::get('logout', [UserController::class, 'showLogout']);
Route::post('logout', [UserController::class, 'logout'])->name('logout');

// Forgot Password Flow
Route::get('forgot-password', [UserController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('forgot-password', [UserController::class, 'sendResetOtp'])->name('forgot.password.post');
Route::get('verify-reset-otp', [UserController::class, 'showVerifyResetOtp'])->name('password.verify.otp');
Route::post('verify-reset-otp', [UserController::class, 'verifyResetOtp'])->name('password.verify.otp.post');
Route::get('reset-password', [UserController::class, 'showResetPassword'])->name('password.reset.form');
Route::post('reset-password', [UserController::class, 'resetPassword'])->name('password.reset.post');


Route::middleware('auth')->group(function () {

    // User Dashboard Routes Start Here:
    Route::get('user/', [UserController::class, 'index']);

    Route::get('user/order-history/', [OrderController::class, 'history']);

    Route::get('user/detail/', [UserController::class, 'detail']);

    Route::get('user/settings/', [UserController::class, 'settings']);
    Route::post('user/settings/', [UserController::class, 'updateSettings'])->name('user.settings.update');

    // Account Deletion Flow
    Route::post('user/delete-request', [UserController::class, 'requestAccountDeletion'])->name('user.delete.request');
    Route::get('user/delete-verify', [UserController::class, 'showVerifyDeletion'])->name('user.delete.verify');
    Route::post('user/delete-confirm', [UserController::class, 'confirmAccountDeletion'])->name('user.delete.confirm');
});


// Vendor Dashboard Route Srart Here:

Route::get('vendor/signup', [VendorController::class, 'signup']);

Route::get('vendor/login', [VendorController::class, 'login']);

Route::get('vendor/forget', [VendorController::class, 'forget']);

Route::get('vendor/', [VendorController::class, 'index']);

Route::get('vendor/add-product', [VendorController::class, 'addproduct']);

Route::get('vendor/view-product', [VendorController::class, 'viewproduct']);

Route::get('vendor/edit-product', [VendorController::class, 'editproduct']);

Route::get('vendor/orders', [VendorController::class, 'orders']);

Route::get('vendor/order-detail', [VendorController::class, 'orderdetail']);

Route::get('vendor/users', [VendorController::class, 'users']);

Route::get('vendor/profile', [VendorController::class, 'profile']);

// Admin Dashboard Start Here

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'authenticate']);

Route::get('admin/', [AdminController::class, 'index']);
Route::post('admin/add-product', [AdminController::class, 'storeProduct']);

Route::get('admin/add-product', [AdminController::class, 'addproduct']);
Route::post('admin/add-product', [AdminController::class, 'storeProduct']);

Route::get('admin/view-product', [AdminController::class, 'viewproduct']);
Route::get('admin/edit-product/{id}', [AdminController::class, 'editproduct']);
Route::post('admin/update-product/{id}', [AdminController::class, 'updateProduct']);
Route::get('admin/delete-product/{id}', [AdminController::class, 'deleteproduct']);



Route::get('admin/order-detail/{id}', [AdminController::class, 'orderdetail']);
Route::post('admin/order-update-status/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.order.updateStatus');

Route::get('admin/add-category', [AdminController::class, 'addcategory']);
Route::post('admin/add-category', [AdminController::class, 'storeCategory']);
Route::get('admin/view-category', [AdminController::class, 'viewcategory']);
Route::get('admin/delete-category/{id}', [AdminController::class, 'deleteCategory']);

Route::get('admin/users', [AdminController::class, 'users']);
Route::get('admin/block-user/{id}', [AdminController::class, 'blockUser']);
Route::get('admin/unblock-user/{id}', [AdminController::class, 'unblockUser']);
Route::get('admin/delete-user/{id}', [AdminController::class, 'deleteUser']);

Route::get('admin/vendors', [AdminController::class, 'vendors']);

Route::get('admin/orders', [AdminController::class, 'orders']);
Route::get('admin/export/orders/excel', [AdminController::class, 'exportOrdersExcel']);
Route::get('admin/export/orders/pdf', [AdminController::class, 'exportOrdersPDF']);
Route::get('admin/export/order/{id}/pdf', [AdminController::class, 'exportSingleOrderPDF'])->name('admin.export.order.pdf');

// Route::get('admin/products',[AdminController::class,'products']);

// Contact Routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
