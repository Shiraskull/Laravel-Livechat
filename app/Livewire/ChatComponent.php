<?php

namespace App\Livewire;

use App\Events\MessageEvent;
use App\Models\Massage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
// use Illuminate\Container\Attributes\Auth;
use Livewire\Component;

class ChatComponent extends Component
{
    public $message;
    public $convo =[];
    public function mount(){
        $messages = Massage::with('user')->get();
        foreach ($messages as $message) {
            $this->convo[] =[
                'username' => $message->user->name,
                'message' => $message->message,
            ];
        }
    }
    public function submitMessage(){
        // dd(Auth::user());
        MessageEvent::dispatch(Auth::user()->id, $this->message);
        $this->message ="";
    }
    #[On('echo:channel-Shin,MessageEvent')]
    public function listenForMessages($data)
    {
        // dd($data);
        $this->convo[] =[
            'username' => $data['username'],
            'message' => $data['message'],

        ];
    }
    public function render()
    {
        return view('livewire.chat-component');
    }
}
