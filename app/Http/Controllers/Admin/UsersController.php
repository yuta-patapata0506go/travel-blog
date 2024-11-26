<?php

// app/Http/Controllers/Admin/UsersController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $user;
    protected $category;
    protected $recommendation;

    public function __construct(User $user, Category $category, Recommendation $recommendation)
    {
        $this->user = $user;
        $this->category = $category;
        $this->recommendation = $recommendation;
    }

    public function index(Request $request)
    {
        // Initialize user query
        $query = User::withTrashed();
        
        // Search processing
        if ($request->has('search')) {
            $query->where('username', 'like', '%' . $request->search . '%');
        }
    
        // Status Filter
        if ($request->status !== null) {
            $query->where('status', $request->status);
        }
    
        // Retrieve user information and set pagination
        $all_users = $query->paginate(5)->withQueryString();
    
        // Retrieve other data
        $categories = $this->category->all();
        $existingRecommendation = $this->recommendation->first();
    
        // Pass data to the view
        return view('admin.users.users-index', compact('all_users', 'categories', 'existingRecommendation'));
    }

    public function hide($id)
    {
        $user = User::find($id);
        if ($user) {
            // If the user exists, change status to 'suspended'
            $user->status = 1; // suspended
            $user->save();

            // Soft delete the user
            $user->delete();

            return redirect()->back()->with('success', 'User hidden successfully!');
        }
        return redirect()->back()->with('error', 'User not found.');
    }
    
    public function unhide($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user && $user->trashed()) {
            // Restore the user
            $user->restore();
    
            // Change the status back to 0 (active)
            $user->status = 0; // active
            $user->save();
    
            return redirect()->back()->with('success', 'User unhidden successfully!');
        }
        return redirect()->back()->with('error', 'User not found or not hidden.');
    }

}


