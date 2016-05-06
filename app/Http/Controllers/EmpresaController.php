<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use App;
use Auth;

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
    	  ->join('tiposempresas', 'tiposempresas.id', '=', 'empresas.tiposempresas_id')
    	  ->join('ubicacionesempresas', 'ubicacionesempresas.empresas_id', '=', 'empresas.id')
          ->select('empresas.*', 'tiposempresas.tipoempresa as tipempresa','ubicacionesempresas.ubicaciones_id as ubi')
          ->where('tiposempresas.activo','=', $flag)            
          ->paginate(20);
          
      	return view('/empresas',['empresa'=>$empresa, 'tipoempre'=>$tipoempre]);
    }

    public function store(Request $request)
    {   
      \App\empresas::create([
               'empresa'=>$request['empresa'],
               'razonsocial'=>$request['razon'],
               'tiposempresas_id'=>$request['tipoempresa'],
              ]);

          $idempre = $request['empresa'];
          
          $empresaid = DB::table('empresas')
          ->select('empresas.id')
          ->where('empresas.empresa','=',$idempre)->first();
            
        \App\ubicacionempresa::create([
               'ubicaciones_id'=>$request['ubicacion'],
               'empresas_id'=>$empresaid->id,
              ]);

        return redirect('/empresas');
       
    }

    public function delete($id)
    { \App\empresas::destroy($id);
          Session::flash('message','Empresa Eliminado Correctamente');    
          return redirect('/empresas');
    }
}
