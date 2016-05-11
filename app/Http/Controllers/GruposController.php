<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class GruposController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function index()
    {
        $grupos = DB::table('grupos')
          ->select('grupos.*')
          ->get();
        return view('/grupos',compact('grupos'));
    }


    public function delete($id)
    { 
    	try
	     {
         \App\grupos::destroy($id);
	     }
	     catch(\Illuminate\Database\QueryException $e)
	     {
	         	Session::flash('message-error','No se a Podido Eliminar Grupo');    
            return redirect('/grupos');
	     }
      
        Session::flash('message','Grupo Eliminado Correctamente');    
        return redirect('/grupos');
    }

    public function store(Request $request)
    {
      \App\grupos::create([
               'grupo'=>$request['grupo'],
               'clave'=>$request['clave'],
              ]);

        Session::flash('message','Grupo Creado Correctamente');     
        return redirect('/grupos');
    }
     public function update(Request $request)
    {   
        $id=$request['id'];
        $grupo = \App\grupos::find($id);
        $grupo->fill($request->all());
        $grupo->save();                
        Session::flash('message','Grupo Actualizado Correctamente');     
        return redirect('/grupos');
    }

}
