<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spot;
use App\Models\SpotUserPivot;
use App\Models\Category;
use App\Models\Recommendation;
use Illuminate\Http\Request;

class SpotApplicationsController extends Controller
{
    private $spot;
    private $category;
    private $recommendation;

    public function __construct(Spot $spot, Category $category, Recommendation $recommendation)
    {
        $this->spot = $spot;
        $this->category = $category;
        $this->recommendation = $recommendation;
    }

    // Display pending spots
    public function index(Request $request)
    {
        // Initial query setup (fetch all spot applications)
        $query = $this->spot->query();

        // Search process: Search by 'name', 'postalcode', or 'address'
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%'; // Add wildcard to search keywords
            $query->where(function($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('postalcode', 'like', $searchTerm)
                    ->orWhere('address', 'like', $searchTerm);
            });
        }

        // Retrieve pending spot applications and set pagination
        $pendingSpots = $query->where('status', 'pending')->paginate(5)->withQueryString();

        // Fetch additional data
        $categories = $this->category->all();
        $existingRecommendation = $this->recommendation->first();

        // Pass data to the view
        return view('admin.spot_applications.spot_applications-index', [
            'pendingSpots' => $pendingSpots,
            'categories' => $categories,
            'existingRecommendation' => $existingRecommendation,
            'search' => $request->search, // 検索条件をビューに渡す
        ]);
    }

    // Update the status of a spot
    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'status' => 'required|in:approved,denied',  // Only allowed values are 'approved' or 'denied'
        ]);

        // Find the spot by ID
        $spot = $this->spot->findOrFail($id);

        // Check if the status is already approved
    if ($spot->status === 'approved') {
        return redirect()->route('admin.spot_applications.index')
            ->with('error', 'Approved spots cannot be changed.');
    }

        // Update the status of the spot
        $spot->status = $validated['status'];
        $spot->save();

        // Redirect back to the index with a success message
        return redirect()->route('admin.spot_applications.index')
            ->with('success', 'Spot status updated successfully!');
    }

}
