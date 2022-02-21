<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
  protected $table = 'chat';

  protected $fillable = ['id', 'id_coachee', 'id_support', 'status', 'file', 'created_at', 'updated_at', 'attended_at', 'closed_at'];

  public $timestamps = false;

}
