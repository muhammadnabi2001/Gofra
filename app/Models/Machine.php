<?php

namespace App\Models;

use App\LogTrait;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use LogTrait;
    protected $fillable=[
        'name',
        'status'
    ];
    public function machineproducts()
    {
        return $this->hasMany(MachineProduct::class);
    }
}
