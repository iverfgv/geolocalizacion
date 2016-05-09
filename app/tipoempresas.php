<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipoempresas extends Model
{ 
	public $timestamps = false;
    protected $table = 'tiposempresas';
    protected $fillable = ['tipoempresa','cliente','provedor','activo'];
    protected $guarded=['id'];
}
