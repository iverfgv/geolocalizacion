<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rutas extends Model
{
    public $timestamps = false;
    protected $table='ubicaciones';
   protected $fillable=['latitud','longitud','encargado'];
   protected $guarded=['id'];
}
