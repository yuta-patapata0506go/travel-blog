<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\ReplyMail;

class ResponsesController extends Controller
{

    private $response;
    private $inquiry;
    private $user;

    public function __construct(Response $response, Inquiry $inquiry, User $user)
    {
        $this->response = $response;
        $this->inquiry = $inquiry;
        $this->user = $user;
    }

    public function create($inquiry_id)
    {
        $inquiry = $this->inquiry->findOrFail($inquiry_id);
        $myUsername = auth()->user()->username;
        return view('admin.inquiries.create_reply')
                ->with('inquiry', $inquiry)
                ->with('myUsername', $myUsername)
                ->with('inquiry_id', $inquiry_id);
    }

    // store
    public function store(Request $request, $inquiry_id)
    {
        // Validate
        $request->validate([
            'title' => 'required|min:1|max:255',
            'body' => 'required|min:1|max:1000',
        ]);

        DB::transaction(function () use ($request, $inquiry_id) {
            // save the reply
            $this->response->user_id = Auth::user()->id;
            $this->response->inquiry_id = $inquiry_id;
            $this->response->title = $request->title;
            $this->response->body = $request->body;
            $this->response->save(); // Save changes
        
            // If an error occurs here, the transaction will be rolled back
            
            // send mail
            $inquiry = $this->inquiry->findOrFail($inquiry_id);
            Mail::to($inquiry->user->email)->send(new ReplyMail($this->response->title, $this->response->body));
            
            // make status responsed
            // $inquiry->status = 'Responsed';
            // $inquiry->save();
        });

        // redirect
        return redirect()->route('admin.inquiries.inquiry_details', $inquiry_id)
                            ->with('success', 'Reply has been sent successfully!');
    }


}
