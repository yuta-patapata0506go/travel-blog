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
        $all_inquiries = $this->inquiry->with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.inquiries.inquiries-index')->with('all_inquiries', $all_inquiries);
    }

    public function show($id)
    {
        $inquiry = $this->inquiry->with('user')->findOrFail($id);
        return view('admin.inquiries.inquiry_details')->with('inquiry', $inquiry);
    }

    public function changeVisibility($id)
    {
        $inquiry = $this->inquiry->findOrFail($id);
        $inquiry->visibility = $inquiry->visibility === 'Visible' ? 'Hidden' : 'Visible'; 
        $inquiry->save();

        return redirect()->route('admin.inquiries.index', $id);
    }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:unprocessed,responded,resolved',
        ]);

        $inquiry = $this->inquiry->findOrFail($id);
        $inquiry->status = $request->status;
        $inquiry->save();

        return redirect()->route('admin.inquiries.index', $id);
    }
}
