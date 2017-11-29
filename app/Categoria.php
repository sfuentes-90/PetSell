<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
  use SoftDeletes;
  /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'categorias';
}
