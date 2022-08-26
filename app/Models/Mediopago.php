<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediopago extends Model
{
    protected $guarded = ['id','created_at', 'updated_at'];

    use HasFactory;

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
