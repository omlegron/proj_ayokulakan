<?php

namespace App\Models\Chat;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;
use App\Models\Barang\LapakBarang;
use App\Models\Chat\Chat;

class ChatRoom extends Model
{
    protected $table 		= 'trans_chat_room';
    protected $fillable 	= [
        'chat_id',
        'user_id',
        'chat_to',
        'id_barang',
        'message',
        'waktu',
        'status',
        'type',
        'created_by'
    ];

    public function chatFriend()
    {
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
