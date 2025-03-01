<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use LogTrait;
    protected $fillable=[
        'name',
        'slug'
    ];
    public function invoiceMaterials()
    {
        return $this->hasMany(InvoiceMaterial::class, 'material_id');
    }
}
