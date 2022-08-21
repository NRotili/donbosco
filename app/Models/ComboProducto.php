<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboProducto extends Model
{
    use HasFactory;

    protected $table = "combo_producto";
    protected $guarded = ['id','created_at', 'updated_at'];
}
