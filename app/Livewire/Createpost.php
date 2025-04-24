<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Createpost extends Component
{
    public $title;
    public $body;


    public function create()
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }
        $validatedData = $this->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $validatedData['title'] = strip_tags($validatedData['title']);
        $validatedData['body'] = strip_tags($validatedData['body']);
        $validatedData['user_id'] = auth()->id();

        //store post in database
        $newPost = Post::create($validatedData);
        session()->flash('success', 'New post created successfully.');
        return $this->redirect("/posts/{$newPost->id}", navigate: true);
    }
    public function render()
    {
        return view('livewire.createpost');
    }
}
