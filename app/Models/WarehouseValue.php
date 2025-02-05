<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseValue extends Model
{
    protected $fillable=[
        'warehouse_id',
        'product_id',
        'value'
    ];
}
