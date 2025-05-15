<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $guarded = [];
    protected $table='admins';

    protected $casts = [
        "id"=>"integer",
        "super"=>"integer",
        'role_id' => 'integer',
    ];

    public function role(){
        return $this->belongsTo(Role::class,);
    }

    public function havePermission($permission) {
        if($this->super){
            return true;
        }
        return $this->role->permissions()->where('key_name',$permission)->exists();
    }

    public function cities(){
        return $this->belongsToMany(City::class,'admin_cities','admin_id',
            'city_id');
    }


}
