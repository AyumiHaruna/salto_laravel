<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\ListaSuscripcion;

class ProvisionalController extends Controller
{
    //muestra la vista provisional de SALTUM
    public function index()
    {
        return view('provisional.index');
    }

    //obtiene los datos del formulario provisional y los guarda
    public function store(Request $request)
    {
        $this->validate($request,[
          'nombre' => 'required|min:3|max:255',
          'correo' => 'required',
        ],[
          'nombre.required' => ' Hace falta capturar el nombre.',     'nombre.min' => ' El nombre debe contener almenos 3 caracteres.', 			'nombre.max' => ' El nombre debe contener máximo 255 caracteres.',
          'correo.required' => ' Hace falta capturar el correo'
        ]);


        try {
             $query = ListaSuscripcion::create(['nombre' => $_POST['nombre'], 'correo' => $_POST['correo']]);
             if($query){
               return view('provisional.suscrito');
             }
         } catch(\Illuminate\Database\QueryException $ex) {
            //return redirect()->back()->with('mensaje de prueba');
            Session::flash('message', "No se encuentra la base de datos, favor de reintentar.");
            return Redirect::back()->withInput();
         } catch(\PDOException $ex){
            //return redirect()->back()->with('mensaje de prueba');
            Session::flash('message', "No se encuentra la base de datos, favor de reintentar.");
            return Redirect::back()->withInput();
         }
    }
}
