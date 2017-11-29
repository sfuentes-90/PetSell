<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Aviso extends Model
{
  use SoftDeletes;

  protected $fillable = ['idUsuario', 'titulo', 'descripcion', 'precio', 'activo', 'activadoPor', 'idCategoria', 'imagen_1', 'imagen_2', 'imagen_3', 'imagen_4', 'imagen_5'];

  /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'avisos';
}
