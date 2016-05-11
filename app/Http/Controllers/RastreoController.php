<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;

class RastreoController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index()
    {
             
            $flag=1;
            $rastreo = DB::table('rastreo')
              ->select('rastreo.*')
              ->paginate(10);
        return view('/rastreo',['rastreos'=>$rastreo]);
    }

       public function store(Request $request)
     {   
        
        \App\rastreo::create([
               'embarques_id'=>$request['embarques'],
               'fecha'=>$request['fecha'],
               'entrada'=>$request['entrada'],
               'usuarios_id'=>$request['usuarios'],
               'ubicaciones_id'=>$request['ubicacion'],
               'placas'=>$request['placas'],
              ]);
        Session::flash('message','Rastreo Creado Correctamente');     
        return redirect('/rastreo');
      }

       public function delete($id)
    {

        try
       {
          \App\rastreo::destroy($id);
       }
       catch(\Illuminate\Database\QueryException $e)
       {
            Session::flash('message-error','No se a Podido Eliminar Rastreo');    
            return redirect('/rastreo');
       }

          
        Session::flash('message','Rastreo Eliminado Correctamente');    
        return redirect('/rastreo');
    }

    public function update(Request $request)
    {   
            $id=$request['id'];
            $Rastreo = \App\rastreo::find($id);
            $Rastreo->fill($request->all());
            $Rastreo->save();                
        Session::flash('message','Rastreo Actualizado Correctamente');     
        return redirect('/rastreo');
    }

}
