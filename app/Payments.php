<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Payments extends Authenticatable
{

    protected $table = 'payments';    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'plan', 'amount', 'payment_datetime', 'invoice', 'invoice_rfc', 'invoice_email', 'invoice_address', 'invoice_name', 'first_payment'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
