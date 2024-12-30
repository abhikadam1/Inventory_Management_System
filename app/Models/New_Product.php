<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class New_Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'name', 'category', 'stock', 'unit_price', 'sale_price'
    ];
}
