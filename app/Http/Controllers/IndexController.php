<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\BlogTemas;
use App\Contacto;
use App\ListaSuscripcion;
use Mail;

class IndexController extends Controller
{
    //  return index view
    public function index()
    {
      return view('welcome');
    }

    //  return about view
    public function about()
    {
      return view('nosotros');
    }

    //  return suscribe view
    public function suscribe()
    {
      return view('suscribe');
    }

    //  store contact in database
    public function suscribeCreate()
    {
      // print_r( $_POST );
      //searh for poster email
      $search = Contacto::where('correo', $_POST['email'])->get();

      if( count($search) > 0 ){
        //if email already exists return an alert
        return 0;         //0 = email already exists

      } else {
        //send mail, then send posted mail
        $data = $_POST;
        Mail::send('emails.newSuscription', ['data' => $data], function ($message)
        {
            $message->from(env('MAIL_CONTACT'), 'contacto Saltum');
            $message->subject("Saltum - nueva suscripción");
            $message->to(env('MAIL_CONTACT'), 'Marketing');
        });

        $query = Contacto::create(['correo' => $_POST['email'],
                                    'telefono' => $_POST['phone'],
                                    'nombre' => $_POST['name'],
                                    'schedule' => $_POST['schedule'],
                                    'comment' => $_POST['comment']
                                  ]);

        return 1;       //1 = email saved, and mail sent
      }
    }

    //  return tankYou page
    public function tankyou()
    {
      return view('tankyou');
    }

    //  suscribe to newsletter
    public function suscribeNews()
    {
        //searh for poster email
        $search = ListaSuscripcion::where('correo', $_POST['correo'])->get();

        if( count($search) > 0 ){
          //if email already exists return an alert
          return 0;         //0 = email already exists

        } else {
          //send mail, then send posted mail
          $data = $_POST;
          Mail::send('emails.newContactNewsletter', ['data' => $data], function ($message)
          {
              $message->from(env('MAIL_CONTACT'), 'contacto Saltum');
              $message->subject("Saltum - contacto registrado a newsletter");
              $message->to(env('MAIL_MARKETING'), 'Marketing');
          });

          $query = ListaSuscripcion::create(['correo' => $_POST['correo']]);

          return 1;       //1 = email saved, and mail sent
        }
    }
}
