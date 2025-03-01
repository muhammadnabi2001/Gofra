<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use LogTrait;
    protected $fillable = [
        'name',
        'phone',
        'balance',
        'longitude',
        'latitude',
    ];
}
