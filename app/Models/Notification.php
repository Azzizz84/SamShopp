<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        "id"=>"integer",
    ];
    protected $table='notifications';
    protected  $appends = ['title','description'];
    protected $hidden = ['title_en','title_ar',
        'description_ar','description_en'];


    public function getTitleAttribute(){
        $title = $this->attributes['title_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["title_$lang"])) {
            $title = $this->attributes["title_$lang"];
        }
        return $title;
    }


    public function getDescriptionAttribute(){
        $description = $this->attributes['description_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["description_$lang"])) {
            $description = $this->attributes["description_$lang"];
        }
        return $description;
    }
}
