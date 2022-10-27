<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $guarded = ['id','created_at', 'updated_at'];

    use HasFactory;

    public function ventas()
    {
    	return $this->belongsToMany(Venta::class)
                    ->withPivot('id')
                    ->withPivot('cantidad');
    }

    public function combos()
    {
        return $this->belongsToMany(Producto::class, 'combo_producto', 'producto_id', 'combo_id')
                    ->withPivot('cantidad');
    }

    public function contproductos()
    {
        return $this->belongsToMany(Producto::class, 'combo_producto', 'combo_id', 'producto_id')
                    ->withPivot('cantidad');

    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

    
}
