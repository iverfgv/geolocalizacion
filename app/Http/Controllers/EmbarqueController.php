<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RequestEmbarques;
use DB;
use App;
use Session;
use Auth;

class EmbarqueController extends Controller
{
  public function __construct()
  {
     $this->middleware('auth');
  }

    public function index()
    {
        $embarques = DB::table('embarques')
          ->join('materiales', 'materiales.id', '=', 'embarques.materiales_id')
          ->join('usuarios', 'usuarios.id', '=', 'embarques.usuarios_id')
          ->join('ubicaciones', 'ubicaciones.id', '=', 'embarques.ubicaciones_id')
          ->select('embarques.*','materiales.material as material','usuarios.usuario as usuari','ubicaciones.ubicacion as ubica')
          ->paginate(10);
          

        return view('/embarques',compact('embarques'));
    }

     public function store(Request $request)
     {   
       
         $fechasistema = date('Y-m-d');
       
        \App\embarques::create([
               'usuarios_id'=>$request['usuario'],
               'materiales_id'=>$request['material'],
               'ubicaciones_id'=>$request['ubicacion'],
               'peso'=>$request['peso'],
               'fecha'=>$fechasistema,
               'fechalocal'=>$request['fecha'],
               'codigocontrol'=>$request['codigo'],
               'cancelado'=>$request['cancelado'],
               'notasalidaecoplast'=>$request['ecoplastn'],
               'notasalidacliente'=>$request['clienten'],
              ]);
        Session::flash('message','Embarque Creado Correctamente');     
        return redirect('/embarques');
      }


      public function delete($id)
      { 

          try
       {
          \App\embarques::destroy($id);
       }
       catch(\Illuminate\Database\QueryException $e)
       {
            Session::flash('message-error','No se a Podido Eliminar Embarque');    
            return redirect('/embarques');
       }
         
          Session::flash('message','Embarque Eliminado Correctamente');    
          return redirect('/embarques');
      }

      public function update(Request $request)
      {   
            $id=$request['id'];
            $Embarque = \App\embarques::find($id);
            $Embarque->fill($request->all());
            $Embarque->save();                
            Session::flash('message','Embarque Actualizado Correctamente');     
            return redirect('/embarques');
      }


}
