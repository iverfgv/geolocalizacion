<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Gate;
use Auth;

class GruposController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
  
    public function index()
    {
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }   
        $grupos = DB::table('grupos')
          ->select('grupos.*')
          ->paginate(10);
        return view('/grupos',compact('grupos'));
    }


    public function delete($id)
    { 
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }   
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
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }   
      \App\grupos::create([
               'grupo'=>$request['grupo'],
               'clave'=>$request['clave'],
              ]);

        Session::flash('message','Grupo Creado Correctamente');     
        return redirect('/grupos');
    }
    
    public function update(Request $request)
    {   
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }   
        $id=$request['id'];
        $grupo = \App\grupos::find($id);
        $grupo->fill($request->all());
        $grupo->save();                
        Session::flash('message','Grupo Actualizado Correctamente');     
        return redirect('/grupos');
    }

}
