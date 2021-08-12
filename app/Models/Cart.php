<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $fillable = [
        'subtotal',
        'discount',
        'total',
        'created_by',
        'updated_by'
    ];
}
