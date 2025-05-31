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
    public $photo;


    public function sendMessage()
    {
        $this->validate([
            'message' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->photo ? $this->photo->store('chat_images', 'public') : null;

        Message::create([
            'form_user_id' => auth()->id(),
            'to_user_id' => $this->user->id,
            'message' => $this->message,
            'image' => $imagePath,
            'is_read' => false,
        ]);

        $this->reset(['message', 'photo']);
    }

    public function markMessagesAsRead()
    {
        Message::where('form_user_id', $this->user->id)
            ->where('to_user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
    }

    public function render()
    {
        $this->markMessagesAsRead(); // auto tandai pesan sebagai 'dibaca'

        return view('livewire.chat', [
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
