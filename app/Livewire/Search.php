<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class Search extends Component
{
    public string $search = '';
    public $results;


    public function render()
    {
        if ($this->search == '') {
            $this->results = array();
        } else {

            $this->results = Post::search($this->search)->get();
        }
        return view('livewire.search');
    }
}
