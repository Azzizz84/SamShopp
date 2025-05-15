<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProviderCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        "id"=>"integer",
        "service_provider_id"=>"integer",
        'category_id' => 'integer',
    ];


}
