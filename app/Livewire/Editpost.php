<?php

namespace App\Livewire;

use Livewire\Component;

class Editpost extends Component
{
    public $post;
    public $title;
    public $body;

    public function mount()
    {
        $this->title = $this->post->title;
        $this->body = $this->post->body;
    }
    public function edit()
    {
        $validatedData = $this->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $validatedData['title'] = strip_tags($validatedData['title']);
        $validatedData['body'] = strip_tags($validatedData['body']);


        //store post in database
        $this->authorize('update', $this->post);
        $this->post->update($validatedData);
        session()->flash('success', 'Post successfully updated.');
        return $this->redirect('/edit-post/' . $this->post->id, navigate: true);
    }
    public function render()
    {
        return view('livewire.editpost');
    }
}
