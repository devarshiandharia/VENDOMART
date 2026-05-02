<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function register1()
    {
        return view('register1');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Store registration data in session
        Session::put('registration_data', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP via Email
        try {
            Mail::send('emails.otp', ['otp' => $otp, 'name' => $request->name], function($message) use ($request) {
                $message->to($request->email)
                        ->subject('SECURE_LINK: Verification Code for Vendomart');
            });
        } catch (\Exception $e) {
            // Log the error for the developer
            \Log::error('Registration Mail Error: ' . $e->getMessage());
            
            // For development, we might want to show the OTP if mail fails, 
            // but for now, let's just show a friendly error message.
            return back()->with('error', 'Unable to send verification code. Please check your internet connection or mail configuration. (Error: ' . $e->getMessage() . ')');
        }

        return redirect()->route('otp.verify')->with('success', 'Verification code sent to your email.');
    }

    public function showVerifyOtp()
    {
        if (!Session::has('registration_data')) {
            return redirect('register');
        }
        return view('verify-otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $data = Session::get('registration_data');

        if (!$data || $request->otp != $data['otp']) {
            return back()->with('error', 'Invalid or expired verification code.');
        }

        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        // Clear session after successful registration
        Session::forget('registration_data');

        // Automatically log the user in
        Auth::login($user);

        return redirect('/')->with('success', 'Email verified successfully! You are now logged in.');
    }


    public function login()
    {
        return view('login');
    }

    public function login1()
    {
        return view('login1');
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check if user is blocked
            if (Auth::user()->status == 0) {
                Auth::logout();
                return back()->with('error', 'you are blocked by admin');
            }
            // Login success
            return redirect('/')->with('success', 'Login successful');
        } else {
            // Login failed
            return back()->with('error', 'Invalid email or password');
        }
    }

    public function showLogout()
    {
        return view('logout');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success', 'Logged out successfully');
    }

    public function requestAccountDeletion()
    {
        $user = Auth::user();
        $otp = rand(100000, 999999);

        Session::put('delete_account_data', [
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(10),
        ]);

        Mail::send('emails.otp', ['otp' => $otp, 'name' => $user->name], function($message) use ($user) {
            $message->to($user->email)
                    ->subject('TERMINATION_PROTOCOL: Account Deletion Code');
        });

        return redirect()->route('user.delete.verify')->with('success', 'Termination code sent to your comm link.');
    }

    public function showVerifyDeletion()
    {
        if (!Session::has('delete_account_data')) {
            return redirect('user/');
        }
        return view('user.verify-delete');
    }

    public function confirmAccountDeletion(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $data = Session::get('delete_account_data');

        if (!$data || $request->otp != $data['otp'] || now()->gt($data['expires_at'])) {
            return back()->with('error', 'Invalid or expired termination code.');
        }

        $user = User::findOrFail($data['user_id']);
        
        Auth::logout();
        $user->delete();

        Session::forget('delete_account_data');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Identity purged from the system.');
    }


    // User dashboard Start Here
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->take(5)->get();
        return view('user/index', compact('orders'));
    }

    public function history()
    {
        return view('user/order-history');
    }

    public function detail()
    {
        return view('user/detail');
    }

    public function settings()
    {
        return view('user/settings');
    }

    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/profile'), $imageName);
            $data['photo'] = $imageName;
        }

        User::where('id', $user->id)->update($data);

        return back()->with('success', 'Settings updated successfully!');
    }

    // Forgot Password Flow
    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    public function sendResetOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = rand(100000, 999999);
        $user = User::where('email', $request->email)->first();

        Session::put('reset_password_data', [
            'email' => $request->email,
            'otp' => $otp,
            'expires_at' => now()->addMinutes(15),
        ]);

        Mail::send('emails.otp', ['otp' => $otp, 'name' => $user->name], function($message) use ($request) {
            $message->to($request->email)
                    ->subject('RECOVERY_LINK: Access Key Reset Code');
        });

        return redirect()->route('password.verify.otp')->with('success', 'Recovery code sent to your signal address.');
    }

    public function showVerifyResetOtp()
    {
        if (!Session::has('reset_password_data')) {
            return redirect()->route('forgot.password');
        }
        return view('verify-reset-otp');
    }

    public function verifyResetOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $data = Session::get('reset_password_data');

        if (!$data || $request->otp != $data['otp'] || now()->gt($data['expires_at'])) {
            return back()->with('error', 'Invalid or expired recovery code.');
        }

        Session::put('reset_otp_verified', true);
        return redirect()->route('password.reset.form')->with('success', 'Identity verified. You may now re-initialize your access key.');
    }

    public function showResetPassword()
    {
        if (!Session::get('reset_otp_verified')) {
            return redirect()->route('forgot.password');
        }
        return view('reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $data = Session::get('reset_password_data');
        $user = User::where('email', $data['email'])->first();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        Session::forget(['reset_password_data', 'reset_otp_verified']);

        return redirect()->route('login')->with('success', 'Access key re-initialized. You may now sync your profile.');
    }
}
