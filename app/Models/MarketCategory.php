<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketCategory extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        "id"=>"integer",
        "market_id"=>"integer",
        'category_id' => 'integer',
    ];
}
