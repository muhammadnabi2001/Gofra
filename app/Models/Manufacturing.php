<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manufacturing extends Model
{
    protected $fillable=[
        'product_id',
        'total_count',
        'produced_count',
        'waste_count',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
