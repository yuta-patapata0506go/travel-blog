<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    private $inquiry;

    public function __construct(Inquiry $inquiry, User $user)
    {
        $this->inquiry = $inquiry;
        $this->user = $user;
    }

    public function index()
    {
        $all_inquiries = $this->inquiry->orderBy('created_at', 'desc')->get(); //get->paginate(10)
        return view('admin.inquiries.inquiries-index')->with('all_inquiries', $all_inquiries);
    }

    public function show($id)
    {
        $inquiry = $this->inquiry->findOrFail($id);
        return view('admin.inquiries.inquiry_details')->with('inquiry', $inquiry);
    }
}
