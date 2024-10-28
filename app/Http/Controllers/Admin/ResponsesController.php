<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Response;
use App\Models\Inquiry;
use App\Models\User;
// use Illuminate\Support\Facades\Mail;

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
                ->with('myUsername', $myUsername);
    }

    // store


}
