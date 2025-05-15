<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "user_id"=>"integer",
        'service_provider_id' => 'integer',
        'service_order_id' => 'integer',
    ];

    public function user(){
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function service_order(){
        return $this->belongsTo(ServiceOrder::class)->withTrashed();
    }
    public function service_provider(){
        return $this->belongsTo(ServiceProvider::class)->withTrashed();
    }
    public function messages(){
        return $this->hasMany(Message::class);
    }
}
