<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $guarded = ['id','created_at', 'updated_at'];

    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function mediopago()
    {
        return $this->belongsTo(Mediopago::class);
    }

    public function productos()
    {
    	return $this->belongsToMany(Producto::class)
                    ->withPivot('cantidad')
                    ->withPivot('preciocosto')
                    ->withPivot('preciovendido');
    }
}
