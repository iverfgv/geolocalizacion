<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Gate;
use Auth;

class MaterialesController extends Controller
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
        $Materiales = DB::table('materiales')
         ->join('grupos', 'grupos.id', '=', 'materiales.grupos_id')
          ->select('materiales.*','grupos.grupo as gruponame')
          ->paginate(10);
        return view('/materiales',compact('Materiales'));
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
         \App\materiales::destroy($id);
	     }
	     catch(\Illuminate\Database\QueryException $e)
	     {
	        Session::flash('message-error','No se a Podido Eliminar Material');    
            return redirect('/materiales');
	     }
      
        Session::flash('message','Material Eliminado Correctamente');    
        return redirect('/materiales');
    }



    public function store(Request $request)
    {
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }
      \App\materiales::create([
               'material'=>$request['material'],
               'clave'=>$request['clave'],
               'grupos_id'=>$request['grupo'],
              ]);

        Session::flash('message','Material Creado Correctamente');     
        return redirect('/materiales');
    }


    public function update(Request $request)
    {
      if(Gate::denies('verificar-administracion'))
      {
        Auth::logout();
        return view('login');
      }   
        $id=$request['id'];
        $grupo = \App\materiales::find($id);
        $grupo->fill($request->all());
        $grupo->save();                
        Session::flash('message','Material Actualizado Correctamente');     
        return redirect('/materiales');
    }




}

