<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function createPostForm()
    {
        return view('blogPostForm');
    }
    public function createPost(Request $request)
    {
        //validate request
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $validatedData['title'] = strip_tags($validatedData['title']);
        $validatedData['body'] = strip_tags($validatedData['body']);
        $validatedData['user_id'] = auth()->id();

        //store post in database
        $newPost = Post::create($validatedData);

        return redirect("/posts/{$newPost->id}")->with('success', 'New post created successfully');
    }


    public function showPost(Post $post_id)
    {
        $post_id['body'] = strip_tags(Str::markdown($post_id->body), '<p><ul><ul><ol><li><strong><em><h3><br>');
        return view('single-post', ['post' => $post_id]);
    }

    public function editPostForm(Post $post_id)
    {

        return view('editPost', ['post' => $post_id]);
    }

    public function updatePost(Request $request, Post $post_id)
    {
        //validate request
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $validatedData['title'] = strip_tags($validatedData['title']);
        $validatedData['body'] = strip_tags($validatedData['body']);


        //store post in database
        $post_id->update($validatedData);

        return redirect("/posts/{$post_id->id}")->with('success', 'post updated successfully');
    }

    public function deletePost(Post $post_id)
    {
        $post_id->delete();
        return redirect('/profile/' . auth()->user()->id)->with('Post successfully deleted');
    }
}
