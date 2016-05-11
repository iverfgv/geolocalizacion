<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\perfiles;
use Session;
use DB;

class perfilcontroller extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request){
    	$pesaje=0;
    	$supervisor=0;
    	$embarques=0;
    	$administracion=0;
    	$reportes=0;
		$activo=0;

		if($request['activo']=="si")
		{	
			$activo=1;
		}

		if($request['pesaje']=="on")
		{
			$pesaje=1;
		}

		if($request['supervisor']=="on")
		{
			$supervisor=1;
		}

		if($request['embarques']=="on")
		{
			$embarques=1;
		}

		if($request['administracion']=="on")
		{
			$administracion=1;
		}

		if($request['reportes']=="on")
		{
			$reportes=1;
		}

	    perfiles::create([
	            		'perfil'=>$request['perfil'],
	            		'pesaje'=>$pesaje,
	            		'supervisor'=>$supervisor,
	            		'embarques'=>$embarques,
	            		'administracion'=>$administracion,
	            		'reportes'=>$reportes,
	            		'activo'=>$activo
	            	]);

	    $perfiles=DB::table('perfiles')
    				 	 ->select('perfiles.*')->paginate(10);
    	Session::flash('message','Perfil Agregado Correctamente');  
	    return view('perfiles',compact('perfiles'));
    }

    public function index(){
    	 $perfiles=DB::table('perfiles')
    				 	 ->select('perfiles.*')->paginate(10);

	   return view('perfiles',compact('perfiles'));
    }

    public function delete($id)
    {
       try
       {
        perfiles::destroy($id);
        Session::flash('message','Perfil Eliminado Correctamente');
    	
    	return redirect('/perfiles');
       }

        catch(\Illuminate\Database\QueryException $e)
        {
            Session::flash('message-error','No se a Podido Eliminar el Perfil');    
            return redirect('/perfiles');
        }
    }

    public function update(Request $request)
    {   
    	$id=$request['id'];
    	$perfil=$request['perfil'];
    	$pesaje=0;
    	$supervisor=0;
    	$embarques=0;
    	$administracion=0;
    	$reportes=0;
    	$activo=0;

    	if($request['pesaje']==1){
    		$pesaje=1;
    	}

    	if($request['supervisor']==1){
    		$supervisor=1;
    	}

    	if($request['embarques']==1){
    		$embarques=1;
    	}

    	if($request['administracion']==1){
    		$administracion=1;
    	}

    	if($request['reportes']==1){
    		$reportes=1;
    	}

    	if($request['activo']==1){
    		$activo=1;
    	}

    	DB::update('update perfiles set perfil = ?, pesaje = ?, supervisor = ?, embarques = ?, administracion = ?, reportes = ?, activo = ?  where id = ? ',array($perfil, $pesaje, $supervisor, $embarques, $administracion, $reportes, $activo, $id));

        Session::flash('message','Perfil Actualizado Correctamente');     
        return redirect('/perfiles');
    }
}
