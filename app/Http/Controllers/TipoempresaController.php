<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session;

class TipoempresaController extends Controller
{
    public function index()
    {
    	$flag=1;
        $tipoempresa = DB::table('tiposempresas')
          ->select('tiposempresas.*')
		  ->where('tiposempresas.activo','=', $flag)                      
          ->get();
          

        return view('/tipoempresa',compact('tipoempresa'));
    }

  	public function store(Request $request)
    {

    	$cliente=0;
    	$provedor=0;

    	if($request['cliente']=="on")
		{
			$cliente=1;
		}

		if($request['proveedor']=="on")
		{
			$provedor=1;
		}

        \App\tipoempresas::create([
               'tipoempresa'=>$request['tipoemp'],
               'cliente'=>$cliente,
               'provedor'=>$provedor,
               'activo'=>1,
              ]);
        Session::flash('message','Tipo de Empresa Creado Correctamente');     
        return redirect('/tipoempresa');
    }


  	public function delete($id)
    {
          $tipo = \App\tipoempresas::find($id);
          $tipo->activo=0;
          $tipo->save();
          Session::flash('message','Tipo empresa Eliminada Correctamente');    
          return redirect('/tipoempresa');
    }
      

    public function update(Request $request)
    {   
        
            $id=$request['id'];
        $cliente=0;
    	$provedor=0;
    	

    	if($request['cliente']==1)
		{
			$cliente=1;
		}

		if($request['proveedor']==1)
		{
			$provedor=1;
		}
		
		DB::update('update tiposempresas set tipoempresa = ?, cliente = ?, provedor = ?  where id = ? ',array($request['tipoempresa'], $cliente, $provedor, $id));
               
            Session::flash('message','Tipo empresa Actualizada Correctamente');     
            return redirect('/tipoempresa');
    }



}
