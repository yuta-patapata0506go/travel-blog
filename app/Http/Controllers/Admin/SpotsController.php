<?php

// app/Http/Controllers/Admin/SpotsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotsController extends Controller
{
    public function index()
    {
        $all_spots = Spot::withTrashed()->paginate(10);
        return view('admin.spots.index', compact('all_spots'));
    }

    public function edit($id)
    {
        $spot = Spot::findOrFail($id);
        return view('admin.spots.edit', compact('spot'));
    }

    public function show($id)
    {
        $spot = Spot::findOrFail($id);
        return view('admin.spots.show', compact('spot'));
    }

    public function hide($id)
    {
        $spot = Spot::findOrFail($id);
        $spot->delete();
        return redirect()->route('admin.spots.index')->with('status', 'Spot hidden successfully');
    }

    public function unhide($id)
    {
        $spot = Spot::withTrashed()->findOrFail($id);
        $spot->restore();
        return redirect()->route('admin.spots.index')->with('status', 'Spot unhidden successfully');
    }
}
