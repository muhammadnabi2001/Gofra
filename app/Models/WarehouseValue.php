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
    public function material()
    {
        return $this->belongsTo(Material::class, 'product_id');  // product_id ishlatiladi
    }
}
