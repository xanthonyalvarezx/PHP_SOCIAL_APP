<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function createFollow(User $user)
    {
        // no following  yourself
        if ($user->id == auth()->user()->id) {
            return "You can't follow yourself";
        }

        // no followng  who you're already following
        if ($alreadyFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followed_user', '=', $user->id]])->count())
            if ($alreadyFollowing) {
                return back()->with("failure', 'You're already following {$user->username}");
            }



        $newFollow = new Follow();
        $newFollow->user_id = auth()->user()->id;
        $newFollow->followed_user = $user->id;
        $newFollow->save();
        return back()->with('success', "Successfully followed {$user->username}");
    }
    public function removeFollow(User $user)
    {
        Follow::where([['user_id', '=', auth()->user()->id], ['followed_user', '=', $user->id]])->delete();
        return back()->with('success', "You successsfully unfollowed {$user->username}");
    }
}
