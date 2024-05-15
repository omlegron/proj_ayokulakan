<?php

namespace App\Models\Chat;

use App\Models\Model;
use App\Models\Roles;
use App\Models\User;
use App\Models\Files;
use App\Models\Attachments;
use App\Models\Barang\LapakBarang;
use App\Models\Lapak\Lapak;
use App\Models\Chat\ChatRoom;


use Mpociot\Firebase\SyncsWithFirebase;


class Chat extends Model
{
    use SyncsWithFirebase;
    protected $table 		= 'trans_chat_friend';
    protected $fillable 	= [
        'user_id',
        'friend_id',
        'created_by'
    ];


    public function form()
    {
        return $this->morphTo();
    }

    public function detail(){
        return $this->hasMany(ChatDetail::class, 'trans_id');
    }

    public function lapak(){
        return $this->belongsTo(Lapak::class, 'id_lapak');
    }

    public function lapakBarang(){
        return $this->belongsTo(LapakBarang::class, 'id_barang');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function friend(){
        return $this->belongsTo(User::class, 'friend_id');
    }

    public function createds(){
        $this->belongsTo(Users::class, 'created_by');
    }

    public function chatFriend()
    {
        return $this->hasMany(ChatRoom::class);
    }

}
