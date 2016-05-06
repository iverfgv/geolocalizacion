<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rastreo extends Model
{
   public $timestamps = false;
   protected $table='rastreos';
   protected $fillable=['embarques_id','fecha','firma','entrada','usuario_id','ubicaciones_id','placas'];
   protected $guarded=['id'];
}
