<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
  protected $table = 'blogpost';

  protected $fillable = ['foto', 'titulo', 'metatag', 'mensaje', 'id_usuario', 'visible', 'likes', 'publiDate'];

  public $timestamps = true;

}
