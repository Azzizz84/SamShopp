<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
    ];
    protected $appends = ['name'];


    protected $hidden = ['name_ar','name_en','pivot'];


    public function getNameAttribute(){
        $name = $this->attributes['name_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["name_$lang"])) {
            $name = $this->attributes["name_$lang"];
        }
        return $name;
    }
}
