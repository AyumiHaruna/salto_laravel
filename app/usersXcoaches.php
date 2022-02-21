<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersXcoaches extends Model
{
  protected $table = 'usersxcoaches';

  protected $fillable = ['id_user', 'id_coach', 'perfilCliente', 'seguimientoCliente', 'active'];

  public $timestamps = false;
}
