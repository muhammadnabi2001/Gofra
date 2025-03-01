<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use LogTrait;
    protected $fillable = [
        'name',
        'img',
        'price',
        'slug'
    ];
    public function ingredients()
    {
        return $this->hasMany(ProductIngredient::class);
    }
}
