<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Follow;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow){
        $this->follow = $follow;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($user_id)
    {
        /**
         * Note: In this situation, the AUTH use is doing the action.
         */
        $this->follow->followed_user_id = Auth::user()->id; //the follower(Auth User is always the follower)
        $this->follow->following_user_id = $user_id;    //the user being followed
        $this->follow->save(); 
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        $this->follow
            ->where('followed_user_id', Auth::user()->id)
            ->where('following_user_id', $user_id)
            ->delete();

            return redirect()->back();
    }
}
