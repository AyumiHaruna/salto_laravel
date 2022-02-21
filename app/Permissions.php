<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Permissions extends Authenticatable
{

    protected $table = 'permissions';    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'display_name', 'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
