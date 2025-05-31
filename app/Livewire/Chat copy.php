<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Chat extends Component
{
    use WithFileUploads;

    public User $user;

    public $message = '';

    public function sendMessage()
    {
        // dd($this->message);
        Message::create([
            'form_user_id' => auth()->id(),
            'to_user_id' => $this->user->id,
            'message' => $this->message,
        ]);

        $this->reset('message');
    }


    public function render()
    {
        return view('livewire.chat',[
            'messages' => Message::where(function (Builder $query) {
                $query->where('form_user_id', auth()->id())
                      ->where('to_user_id', $this->user->id);
            })->orWhere(function (Builder $query) {
                $query->where('form_user_id', $this->user->id)
                      ->where('to_user_id', auth()->id());
            })->orderBy('created_at')->get(),

        ]);
    }
}
