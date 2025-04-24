<?php

namespace App\Livewire;

use Livewire\Component;

class Changephoto extends Component
{
    public $photo;
    public function uploadphoto()
    {
        return view('livewire.changephoto');
    }
    public function render()
    {
        return view('livewire.changephoto');
    }
}
