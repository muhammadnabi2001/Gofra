<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    use LogTrait;
    protected $fillable=[
        'name',
        'status'
    ];
    public function permissions()
    {
        return $this->hasMany(Permit::class,'group_id');
    }
}
