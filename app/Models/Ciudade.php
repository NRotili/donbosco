<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudade extends Model
{
    use HasFactory;

    protected $guarded = ['id','created_at', 'updated_at'];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
