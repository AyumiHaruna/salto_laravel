<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaSuscripcion extends Model
{
    protected $table = 'listasuscripcion';

    protected $fillable = ['nombre', 'correo']; 

    public $timestamps = true;
}
