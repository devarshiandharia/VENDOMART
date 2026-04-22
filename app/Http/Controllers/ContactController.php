<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'user_message' => $request->message
        ];

        Mail::send('emails.contact', $data, function($message) use ($data) {
            $message->to('andhariadevarshi11@gmail.com')
                    ->subject('NEW_TRANSMISSION: ' . $data['subject']);
        });

        return back()->with('success', 'TRANSMISSION_SUCCESS: Your message has been beamed to our servers!');
    }
}
