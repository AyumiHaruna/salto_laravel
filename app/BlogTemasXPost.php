<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTemasXPost extends Model
{
  protected $table = 'blogtemasxpost';
  protected $fillable = ['id_Tema', 'id_Post'];
  public $timestamps = false;
}
