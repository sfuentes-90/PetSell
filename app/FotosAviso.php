<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotosAviso extends Model
{
  protected $fillable = ['idAviso', 'filename'];

  public function product()
  {
      return $this->belongsTo('App\Aviso');
  }
}
