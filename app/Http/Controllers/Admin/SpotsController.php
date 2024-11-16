<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Spot;
use App\Models\Recommendation;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // for Access an external API
use App\Http\Controllers\ImageController; // Specify the full path for the namespace

class SpotsController extends Controller
{
    private $category;
    private $spot;
    private $recommendation;
    private $image;

    public function __construct(Category $category, Spot $spot, Recommendation $recommendation, Image $image)
    {
        $this->spot = $spot;
        $this->category = $category;
        $this->recommendation = $recommendation;
        $this->image = $image;
    }

    public function index()
    {
        $all_spots = $this->spot->with('images')->orderBy('created_at', 'desc')->paginate(10);

        $categories = $this->category->all();
        $existingRecommendation = $this->recommendation->first();

        return view('admin.spots.spots-index')
            ->with('all_spots', $all_spots)
            ->with('categories', $categories)
            ->with('existingRecommendation', $existingRecommendation);
    }

    public function create()
    {
        return view('admin.spots.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
                'postalcode' => 'required|string|max:10',
                'address' => 'required|string|max:255',           
                'image' => 'required|array',
        ]);

        // Use the Geocoding API to get latitude and longitude from an address
        $address = $request->address;
        $mapboxApiKey = env('MAPBOX_API_KEY');

        $response = Http::withOptions([ 'verify' => false ])->get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", [
            'access_token' => $mapboxApiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();
            $coordinates = $data['features'][0]['geometry']['coordinates'];
            $latitude = $coordinates[1];
            $longitude = $coordinates[0];
        } else {
            return back()->withErrors(['error' => 'The retrieval of latitude and longitude for the address has failed.']);
        }

        // Save
        $this->spot->name = $request->name;
        $this->spot->postalcode  = $request->postalcode;
        $this->spot->address     = $request->address;
        $this->spot->user_id     = auth()->user()->id;
        $this->spot->latitude = $latitude;
        $this->spot->longitude = $longitude;

        $this->spot->save();

        app(ImageController::class)->store($request, null, spotId: $this->spot->id);


        return redirect()->route('admin.spots.index')->with('success', 'Spot created successfully.');
    }

    public function edit($id)
    {
        $spot = $this->spot->findOrFail($id);
        $images = $spot->images;

        return view('admin.spots.update')
        ->with('spot', $spot)
        ->with('images', $images);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'postalcode' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'image' => 'nullable|array', // Allow optional upload of new images
        ]);
    
        $spot = $this->spot->findOrFail($id);
    
        // If the address changes, update the latitude and longitude
        if ($spot->address !== $request->address) {
            $mapboxApiKey = env('MAPBOX_API_KEY');
            $address = $request->address;
    
            $response = Http::withOptions(['verify' => false])->get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$address}.json", [
                'access_token' => $mapboxApiKey,
            ]);
    
            if ($response->successful()) {
                $data = $response->json();
                $coordinates = $data['features'][0]['geometry']['coordinates'];
                $latitude = $coordinates[1];
                $longitude = $coordinates[0];
    
                $spot->latitude = $latitude;
                $spot->longitude = $longitude;
            } else {
                return back()->withErrors(['error' => 'Failed to retrieve latitude and longitude for the updated address.']);
            }
        }
    
        // update
        $spot->name = $request->name;
        $spot->postalcode = $request->postalcode;
        $spot->address = $request->address;
        $spot->save();
    
        // Delete existing images
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = $spot->images()->find($imageId);
                if ($image) {
                    $image->delete();
                }
            }
        }
    
        // Add new images
        if ($request->has('image')) {
            app(ImageController::class)->store($request, null, spotId: $spot->id);
        }
    
        return redirect()->route('admin.spots.index')->with('success', 'Spot updated successfully.');
    }

    // change status
    public function changeStatus(Request $request, $id)
    {
        $spot = $this->spot->findOrFail($id);
    
        // Cannot be changed if it is 'approved'.
        if ($spot->status == 'approved') {
            return back()->with('error', 'The status cannot be changed because it is already approved.');
        }
    
        // update status
        $spot->status = $request->input('status');
        $spot->save();
    
        return back()->with('success', 'Status changed successfully.');
    }

    // delete
    public function deleteSpot($id)
    {
        // get specific spot
        $spot = $this->spot->findOrFail($id);

        // delete all images of spot
        foreach ($spot->images as $image) {
            $image->delete();
        }

        // delete spot
        $spot->delete();

        return redirect()->route('admin.spots.index')->with('success', 'Spot has been deleted successfully.');
    }




    

}
