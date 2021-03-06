<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sessions extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'description', 'coach_id', 'coachee_id', 'status',
        'start_datetime', 'end_datetime', 'origin_type', 'first_session', 'eval'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
