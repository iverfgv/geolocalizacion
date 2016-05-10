<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App;
use Auth;
use Session;
class EmpresaController extends Controller
{  
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
          	$tipoempre = \App\tipoempresas::All();
        		$flag=1;

            $sql = "select empresas.*, tiposempresas.tipoempresa as tipempresa, count(ubicacionesempresas.empresas_id) as ubi from empresas join ubicacionesempresas on empresas.id=ubicacionesempresas.empresas_id join tiposempresas on empresas.tiposempresas_id=tiposempresas.id group by empresas.empresa";       
        
     $empresa = DB::select(DB::raw($sql));
              
            return view('/empresas',['empresa'=>$empresa, 'tipoempre'=>$tipoempre]);
  }

  public function store(Request $request)
  {   
      $idubis = $request['ubicaciones'];
      $valores=explode(",",$idubis);
            \App\empresas::create([
                'empresa'=>$request['empresa'],
                'razonsocial'=>$request['razon'],
                'tiposempresas_id'=>$request['tipoempresa'],
              ]);

            $idempre = $request['empresa'];
            $empresaid = DB::table('empresas')
              ->select('empresas.id')
              ->where('empresas.empresa','=',$idempre)->first();
       
      foreach ($valores as $valor) {
              
              $idubicacion = DB::table('ubicaciones')
              ->select('ubicaciones.id')
              ->where('ubicaciones.ubicacion','=',$valor)->first();
              
              
                 \App\ubicacionempresa::create([
                'ubicaciones_id'=>$idubicacion->id,
                'empresas_id'=>$empresaid->id,
                
              ]); 
  
            }

    
            return redirect('/empresas');
  }

    public function delete($id)
    { 
        try
       {
         \App\empresas::destroy($id);
       }
       catch(\Illuminate\Database\QueryException $e)
       {
            Session::flash('message-error','No se a Podido Eliminar Empresa');    
            return redirect('/empresas');
       }
            
            Session::flash('message','Empresa Eliminado Correctamente');    
            return redirect('/empresas');
    }

    public function update(Request $request)
      {   
            $id=$request['id'];
            $Empresa = \App\empresas::find($id);
            $Empresa->fill($request->all());
            $Empresa->save();

            $idubicaciones=$request['id'];
            
            $idempresa = DB::table('ubicacionesempresas')
              ->select('ubicacionesempresas.id')
              ->where('empresas_id','=',$idubicaciones)->first();
              

                            
            Session::flash('message','Empresa Actualizado Correctamente');     
            return redirect('/empresas');
      }


}
