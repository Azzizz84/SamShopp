<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $appends = ['name'];


    protected $guarded = [];
    protected $casts = [
        "id"=>"integer",
        "user_id"=>"integer",
    ];


    public function getNameAttribute()
    {
        if($this->type=='user'){
            $name = User::find($this->user_id)->name;
        }else if($this->type=='market'){
            $name = Market::find($this->user_id)->name;
        }else {
            $name = ServiceProvider::find($this->user_id)->name;
        }
        return $name;
    }
}
