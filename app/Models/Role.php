<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use LogTrait;
    protected $fillable = [
        'name',
        'status'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users'); 
    }
    public function permissions()
    {
        return $this->belongsToMany(Permit::class, 'role_permissions', 'role_id', 'permission_id');
    }
}
