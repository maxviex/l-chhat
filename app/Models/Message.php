<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'form_user_id',
        'to_user_id',
        'message',
        'image',
        'is_read',
    ];

    public function formUser()
    {
        return $this->belongsTo(User::class, 'form_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
