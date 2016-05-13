<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Gate;
use Auth;

class AccesosController extends Controller
{
    public function index()
    {
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }
        $Accesos = DB::table('accesos')
         ->join('empresas', 'empresas.id', '=', 'accesos.empresas_id')
          ->select('accesos.*','empresas.empresa as nameempresa')
          ->paginate(10);
        return view('/accesos',compact('Accesos'));
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
         \App\accesos::destroy($id);
	     }
	     catch(\Illuminate\Database\QueryException $e)
	     {
	         	Session::flash('message-error','No se a Podido Eliminar Acceso');    
            return redirect('/accesos');
	     }
      
        Session::flash('message','Acceso Eliminado Correctamente');    
        return redirect('/accesos');
    }

    public function store(Request $request)
    {
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }
      \App\accesos::create([
               'acceso'=>$request['acceso'],
               'nombre'=>$request['nombre'],
               'email'=>$request['email'],
               'activo'=>$request['activo'],
               'empresas_id'=>$request['empresa'],
              ]);

        Session::flash('message','Acceso Creado Correctamente');     
        return redirect('/accesos');
    }

    public function update(Request $request)
    {   
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }
        $id=$request['id'];
        $grupo = \App\accesos::find($id);
        $grupo->fill($request->all());
        $grupo->save();                
        Session::flash('message','Acceso Actualizado Correctamente');     
        return redirect('/accesos');
    }


}
