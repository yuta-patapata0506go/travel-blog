<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth; // use loggedin user_id

class ContactController extends Controller
{
    private $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
    }

    public function create()
    {
        $user = Auth::user();
        return view('contact')->with('user', $user);
    }

    public function store(Request $request)
    {
        #1. Validate all form data
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        #2. Save the post
        $this->inquiry->user_id = Auth::user()->id;
        $this->inquiry->body = $request->body;
        $this->inquiry->save();

        #3. Retrieve the inquiry ID and set a flash message
        $inquiryId = $this->inquiry->id;
        return redirect()->back()->with('success', "Inquiry ID: $inquiryId\nYour inquiry has been successfully sent!\nThank you for reaching out to us. We have received your message and will respond as soon as possible. Please check your email for our reply.\nIf you don't see an email from us within 24-48 hours, kindly check your spam or junk folder.");
    }

}
