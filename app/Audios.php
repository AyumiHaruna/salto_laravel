<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audios extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'category', 'title', 'description', 'url', 'thumbnail', 'position', 'lock', 'active', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
