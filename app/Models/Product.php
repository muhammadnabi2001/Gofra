<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'img'
    ];
    public function ingredients()
    {
        return $this->hasMany(ProductIngredient::class);
    }
}
