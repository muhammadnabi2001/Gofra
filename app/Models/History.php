<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable=[
        'type',
        'status',
        'material_id',
        'quantity',
        'previous_value',
        'current_value',
        'from_id',
        'to_id'
    ];
}
