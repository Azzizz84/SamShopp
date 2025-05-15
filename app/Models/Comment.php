<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        "id"=>"integer",
        "user_id"=>"integer",
        "market_id"=>"integer",
        "rate"=>"double",
    ];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function market(){
        return $this->belongsTo(Market::class)->withTrashed();
    }
}
