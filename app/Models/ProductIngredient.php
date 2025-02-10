<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductIngredient extends Model
{
    protected $fillable=[
        'product_id',
        'material_id',
        'value',
        'unit'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
