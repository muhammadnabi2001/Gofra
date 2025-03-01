<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use LogTrait;
    protected $fillable = [
        'company_name',
        'date',
        'text'
    ];
    // Invoice Model

    public function invoiceMaterials()
    {
        return $this->hasMany(InvoiceMaterial::class,'invoice_id');
    }
}
