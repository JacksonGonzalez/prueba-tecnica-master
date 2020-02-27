<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bodega extends Model
{
    protected $table = 'bodegas';
    protected $fillable = ['id', 'nombre', 'id_responsable', 'created_at'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
