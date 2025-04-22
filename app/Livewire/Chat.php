<?php

namespace App\Livewire;

use App\Events\ChatMessage;
use Livewire\Component;

class Chat extends Component
{
    public $textvalue = '';

    public $chatLog = array();
    public $x = '';

    public function getListeners()
    {
        return [
            "echo-private:chatchannel,ChatMessage" => 'notifyNewMessage'
        ];
    }
    public function notifyNewMessage($x)
    {
        $this->x = $x['chat'];
        array_push($this->chatLog, $x['chat']);
    }


    public function send()
    {
        if (!auth()->check()) {
            abort(403, 'unautorized');
        }

        if (trim(strip_tags($this->textvalue)) == "") {
            return;
        }

        array_push($this->chatLog, ['selfMessage' => true, 'username' => auth()->user()->username, 'textvalue' => strip_tags($this->textvalue), 'photo' => auth()->user()->photo]);
        broadcast(new ChatMessage(['selfMessage' => false, 'username' => auth()->user()->username, 'textvalue' => strip_tags($this->textvalue), 'photo' => auth()->user()->photo]))->toOthers();
        $this->textvalue = "";
    }
    public function render()
    {
        return view('livewire.chat');
    }
}
