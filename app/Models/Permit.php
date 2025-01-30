<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $fillable=[
        'group_id',
        'name'
    ];
    public function group()
    {
        return $this->belongsTo(PermissionGroup::class,'group_id');
    }
}
