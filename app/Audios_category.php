<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audios_category extends Model
{
    protected $table = 'audios_category';    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'category', 'display_name', 'description', 'thumbnail', 'active', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
