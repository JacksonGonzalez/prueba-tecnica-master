<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventarios';
    protected $fillable = ['id', 'id_bodega', 'id_producto', 'cantidad', 'created_at'];
}
