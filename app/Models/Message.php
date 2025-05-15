<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "chat_id"=>"integer",
        'role_id' => 'integer',
    ];

    public function chat(){
        return $this->belongsTo(Chat::class);
    }

}

