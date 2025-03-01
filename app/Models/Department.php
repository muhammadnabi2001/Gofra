<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use LogTrait;
    protected $fillable=[
        'name'
    ];
}
