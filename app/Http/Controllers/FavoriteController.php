<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    private $favorite;
    public function __construct(Favorite $favorite) {
        $this->favorite = $favorite;
    }
    /**
     * Display a listing of the resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $spot_id, $post_id)
    {
        //
        $this->favorite->user_id = auth()->user()->id;
        $this->favorite->spot_id = $spot_id;
        $this->favorite->post_id = $post_id; 
        $this->favorite->save();

        return back();
    }

    /**
     * Display the specified resource.
     */



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($spot_id)
    {
        //
        $this->favorite->where('spot_id',$spot_id)->where('user_id',auth()->user()->id)->delete();

        return back();
    }
}
