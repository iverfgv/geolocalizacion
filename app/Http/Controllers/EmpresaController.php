<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App;
use Auth;
use Session;
use Gate;
use Redirect;
class EmpresaController extends Controller
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

          	$tipoempre = \App\tipoempresas::All();
        		$flag=1;


          $empresa = DB::table('empresas')
          ->leftjoin('ubicacionesempresas', 'empresas.id', '=', 'ubicacionesempresas.empresas_id')
          ->join('tiposempresas', 'empresas.tiposempresas_id', '=', 'tiposempresas.id')
          ->select(DB::raw('empresas.*, tiposempresas.tipoempresa as tipempresa, count(ubicacionesempresas.empresas_id) as ubi'))
          ->groupBy('empresas.empresa','empresas.razonsocial','empresas.tiposempresas_id')
          ->paginate(10);


              
            return view('/empresas',['empresa'=>$empresa, 'tipoempre'=>$tipoempre]);
  }

  public function store(Request $request)
  {   
    if(Gate::denies('verificar-administracion'))
    {
      Auth::logout();
      return view('login');
    }

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
        ->whereempresa($request['empresa'])
        ->whererazonsocial($request['razon'])
        ->wheretiposempresas_id($request['tipoempresa'])->first();
       
          
          if(strlen($idubis)>0)
          {
               foreach ($valores as $valor) 
            
            {
              \App\ubicacionempresa::create([
                  'ubicaciones_id'=>$valor,
                  'empresas_id'=>$empresaid->id,
                ]); 
            }
          }

        Session::flash('message','Empresa Creada Correctamente');     
        return redirect('/empresas');
  }

  public function delete($id)
  { 
    if(Gate::denies('verificar-administracion'))
    {
      Auth::logout();
      return view('login');
    }
    //dd($id);
      try{
          $unicaciones = DB::table('ubicacionesempresas')
              ->select('ubicacionesempresas.id')
              ->whereempresas_id($id)->first();
          try
          {   
            if($unicaciones!=null)
            {
                $sql = "delete from ubicacionesempresas where empresas_id = ".$id;        
                $eliminar = DB::select(DB::raw($sql));              
            }
          }
            catch(\Illuminate\Database\QueryException $e)
         {
         }


         /*****************/
        $accesos = DB::table('accesos')
              ->select('accesos.id')
              ->where('accesos.empresas_id','=',$id)->first();

       try
          {   
            if($accesos!=null)
            {
                $sql = "delete from accesos where empresas_id = ".$id;        
                $eliminar = DB::select(DB::raw($sql));              
            }
          }
          catch(\Illuminate\Database\QueryException $e)
          {
          }

      
          try
          {
           
                 $sq = "delete from empresas where id=".$id;        
                        $elimina= DB::select(DB::raw($sq));  
          }
       catch(\Illuminate\Database\QueryException $e)
       {
       }
     }

      catch(\Illuminate\Database\QueryException $e)
       {
        Session::flash('message-error','Empresa no se ha Eliminado Correctamente');    
            return redirect('/empresas');
       }
            
            Session::flash('message','Empresa Eliminado Correctamente');    
            return redirect('/empresas');
  }

  public function update(Request $request)
  {   
    if(Gate::denies('verificar-administracion'))
    {
      Auth::logout();
      return view('login');
    }
            $idubis = $request['ubicaciones'];
            $valores=explode(",",$idubis);

            $id=$request['id'];
            $Empresa = \App\empresas::find($id);
            $Empresa->fill($request->all());
            $Empresa->save();
            try
       {
           $sql = "delete from ubicacionesempresas where empresas_id=".$id;        
            $eliminar = DB::select(DB::raw($sql));
       }
       catch(\Illuminate\Database\QueryException $e)
       {
           
       }

           
            
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
