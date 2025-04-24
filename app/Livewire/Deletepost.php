<?php

namespace App\Livewire;

use Livewire\Component;

class Deletepost extends Component
{
    public $post;
    public function delete()
    {
        $this->authorize('delete', $this->post);
        $this->post->delete();
        session()->flash('success', 'Post successfully deleted.');
        return $this->redirect('/profile/' . auth()->user()->id, navigate: true);
    }
    public function render()
    {
        return view('livewire.deletepost');
    }
}
