<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;

class UserController
{

    private function getProfileData($user_id)
    {
        $curentlyFollowing = 0;
        if (auth()->check()) {
            $curentlyFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followed_user', '=', $user_id->id]])->count();
        }
        View::share('sharedData', ['followers' => $user_id->followers()->count(), 'following' => $user_id->following()->count(), 'profilePhoto' => $user_id->photo, 'user' => $user_id, 'postCount' => $user_id->posts()->count()]);
    }
    public function profile(User $user_id)
    {

        var_dump(
            $curentlyFollowing = Follow::where([['user_id', '=', auth()->user()->id], ['followed_user', '=', $user_id->id]])->count(),
            $followingCount = Follow::count('followed_user'),
            $postCount = Post::count('id')
        );
        $userPosts = $user_id->posts()->latest()->get();
        foreach ($userPosts as $post) {
            $post['body'] = strip_tags(Str::markdown($post->body), '<p><ul><ul><ol><li><strong><em><h3><br>');
        }
        $this->getProfileData($user_id);
        return view('profile-posts', ['posts' => $userPosts]);
    }
    public function getFollowers(User $user_id)
    {
        $this->getProfileData($user_id);

        return view('followers', ['followers' => $user_id->followers()->latest()->get()]);
    }
    public function getFollowing(User $user_id)
    {
        $this->getProfileData($user_id);
        return view('following', ['following' => $user_id->following()->latest()->get()]);
    }

    // Photo upload
    public function uploadPhotoForm()
    {
        return view('upload-photo-form');
    }
    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'profilePhoto' => 'required|image|max:5000'

        ]);
        $user = auth()->user();
        $fileName = $user->id . "-" . uniqid() . ".jpg";
        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('profilePhoto'));
        $imageData = $image->cover(120, 120)->toJpeg();
        Storage::put('public/profilePhotos/' . $fileName, $imageData);
        $oldProfilePhoto = $user->photo;

        $user->photo = $fileName;
        $user->save();

        if ($oldProfilePhoto != "/fallback-photo.jpg") {
            storage::disk('public')->delete(str_replace('/storage/', '', $oldProfilePhoto));
        }
        return back()->with('success', 'Profile photo upodated successfully!');
    }
}
