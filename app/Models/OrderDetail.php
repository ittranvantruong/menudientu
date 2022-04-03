<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';

    protected $fillable = [
        'order_id', 'name', 'price', 'option', 'quantity', 'quantity_item', 'unit'
    ];
    protected $attributes = [
        'unit' => 'set'
    ];
}
