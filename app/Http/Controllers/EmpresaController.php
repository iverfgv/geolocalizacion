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

            $idsubicaciones=$request['id'];

            $idubicaciones='1,2,3';
            
            /*$idempresa = DB::table('ubicacionesempresas')
              ->select('ubicacionesempresas.id')
              ->where('empresas_id','=',$idubicaciones)->first();*/
            
            $sql = "delete from ubicacionesempresas where empresas_id=".$id;        
            $eliminar = DB::select(DB::raw($sql));
            
            $valores=explode(",",$idubicaciones);

             

            /*foreach ($valores as $valor) {
              $empresaelimina = DB::table('ubicacionesempresas')
              ->select('ubicacionesempresas.id,ubicacionesempresas.')
              ->whereubicaciones_id($valor)
              ->whereempresas_id($id)->first();
               
            }*/


            $valores=explode(",",$idubicaciones);
            foreach ($valores as $valor) {
             /* $empresatv = DB::table('ubicacionesempresas')
              ->select('ubicacionesempresas.id')
              ->whereubicaciones_id($valor)
              ->whereempresas_id($id)->first();*/

              
                \App\ubicacionempresa::create([
                  'ubicaciones_id'=>$valor,
                  'empresas_id'=>$id,
                  
                ]); 
             
               
            }  
             
            Session::flash('message','Empresa Actualizado Correctamente');     
            return redirect('/empresas');
      }

      public function search(Request $request)
      {
           if($request->ajax()){
               $dato='in here';
                return Response::json($dato);
           }
      }

      

      /*public function actualizar()
      {   
       
        $idubis = "1,2,3";
        $nombreempresa="nombreempresauno";

        $empresaid = DB::table('empresas')
                ->select('empresas.id')
                ->where('empresa','=',$nombreempresa)->first();


       
        $valores=explode(",",$idubis);
         foreach ($valores as $valor) {

             $idubicacion = DB::table('ubicaciones')
                ->select('ubicaciones.id')
                ->where('ubicaciones.ubicacion','=',$valor)->first();

            $ubicacionempresas = \App\ubicacionempresa::find($idubicacion->id);
            $ubicacionempresas->delete();
         }

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
      }*/


}
