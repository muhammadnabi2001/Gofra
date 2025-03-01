<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use LogTrait;
    protected $fillable=[
        'group_id',
        'name',
        'path',
        'status'
    ];
    public function group()
    {
        return $this->belongsTo(PermissionGroup::class,'group_id');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
