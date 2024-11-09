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
    public function index()
    {
        $pendingSpots = $this->spot->where('status', 'pending')->paginate(10);

        $categories = $this->category->all();
        $existingRecommendation = $this->recommendation->first();

        return view('admin.spot_applications.spot_applications-index')
            ->with('pendingSpots', $pendingSpots)
            ->with('categories', $categories)
            ->with('existingRecommendation', $existingRecommendation);
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
