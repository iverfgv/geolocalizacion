<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
class AccesosController extends Controller
{
    public function index()
    {
        $Accesos = DB::table('accesos')
         ->join('empresas', 'empresas.id', '=', 'accesos.empresas_id')
          ->select('accesos.*','empresas.empresa as nameempresa')
          ->paginate(10);
        return view('/accesos',compact('Accesos'));
    }

    public function delete($id)
    { 
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
        $id=$request['id'];
        $grupo = \App\accesos::find($id);
        $grupo->fill($request->all());
        $grupo->save();                
        Session::flash('message','Acceso Actualizado Correctamente');     
        return redirect('/accesos');
    }


}
