<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class InvoiceMaterial extends Model
{
    use LogTrait;
    protected $fillable=[
        'material_id',
        'invoice_id',
        'unit',
        'price',
        'quantity',
        'summa'
    ];
    public function material()
    {
        return $this->belongsTo(Material::class,'material_id');
    }
}
