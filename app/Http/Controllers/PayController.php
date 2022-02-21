<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class PayController extends Controller
{
    //show pay index view
    public function index()
    {
        return view('pay.index');
    }
}
