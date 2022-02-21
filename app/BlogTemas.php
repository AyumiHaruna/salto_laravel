<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTemas extends Model
{
  protected $table = 'blogtemas';

  protected $fillable = ['descripcion', 'display_url', 'foto', 'activo'];

  public $timestamps = false;
}
