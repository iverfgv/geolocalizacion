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


          $empresa = DB::table('empresas')
          ->join('ubicacionesempresas', 'empresas.id', '=', 'ubicacionesempresas.empresas_id')
          ->join('tiposempresas', 'empresas.tiposempresas_id', '=', 'tiposempresas.id')
          ->select(DB::raw('empresas.*, tiposempresas.tipoempresa as tipempresa, count(ubicacionesempresas.empresas_id) as ubi'))
          ->groupBy('empresas.empresa')
          ->paginate(10);


              
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
       
      foreach ($valores as $valor) 
      {
        \App\ubicacionempresa::create([
            'ubicaciones_id'=>$valor,
            'empresas_id'=>$empresaid->id,
          ]); 
     }

        Session::flash('message','Empresa Creada Correctamente');     
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
        
            $idubis = $request['ubicaciones'];
            $valores=explode(",",$idubis);

            $id=$request['id'];
            $Empresa = \App\empresas::find($id);
            $Empresa->fill($request->all());
            $Empresa->save();
           
            $sql = "delete from ubicacionesempresas where empresas_id=".$id;        
            $eliminar = DB::select(DB::raw($sql));
            
          if(strlen($idubis)>0)
          {
               foreach ($valores as $valor) 
            
            {
              \App\ubicacionempresa::create([
                  'ubicaciones_id'=>$valor,
                  'empresas_id'=>$id,
                ]); 
            }
          }
              

                            
            Session::flash('message','Empresa Actualizado Correctamente');     
            return redirect('/empresas');
  }


}
