<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
    ];
    protected $table='roles';
    protected $appends = ['name'];

    public function permissions(){
        return $this->belongsToMany(Permission::class,'role_permissions','role_id',
            'permission_id');
    }


    public function getNameAttribute(){
        $name = $this->attributes['name_ar'];
        $lang = request()->header('lang') ?: request()->get('lang') ?: request()->lang;
        if ($lang && isset($this->attributes["name_$lang"])) {
            $name = $this->attributes["name_$lang"];
        }
        return $name;
    }
}
