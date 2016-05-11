<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ubicaciones;
use DB;
use Session;

class ubicacionescontroller extends Controller
{
	public function __construct()
  {
    $this->middleware('auth');
  }
    
	public function store(Request $request){
		$activo=0;
		if($request['activo']=="si")
		{	
			$activo=1;
		}

	    ubicaciones::create([
	            		'ubicacion'=>$request['ubicacion'],
	            		'clave'=>$request['clave'],
	            		'descripcion'=>$request['descripcion'],
	            		'activo'=>$activo
	            	]);

	    $ubicaciones=DB::table('ubicaciones')
    				 	 ->select('ubicaciones.*') ->paginate(10);;

    	Session::flash('message','Ubicacion Agregado Correctamente'); 

	    return view('ubicaciones',compact('ubicaciones'));
    }

    public function index(){
    	$ubicaciones=DB::table('ubicaciones')
    				 	 ->select('ubicaciones.*')->paginate(10);;

	   return view('ubicaciones',compact('ubicaciones'));
    }

    public function delete($id)
    {
        try
        {
           ubicaciones::destroy($id);
  		   Session::flash('message','Ubicacion Eliminado Correctamente');    
    	
    	   return redirect('/ubicaciones');
        }

        catch(\Illuminate\Database\QueryException $e)
        {
            Session::flash('message-error','No se a Podido Eliminar la Ubicacion');    
            return redirect('/ubicaciones');
        }
    }

    public function update(Request $request)
    { 
        $id=$request['id']; 
        $ubicacion=$request['ubicacion'];
        $clave=$request['clave'];
        $descripcion=$request['descripcion'];
        $activo=0;

        if($request['activo']==1){
            $activo=1;
        }

        DB::update('update ubicaciones set ubicacion = ?, clave = ?, descripcion = ?, activo = ?  where id = ? ',array($ubicacion, $clave, $descripcion, $activo, $id));


        Session::flash('message','Ubicacion Actualizado Correctamente');     
        return redirect('/ubicaciones');
    }
}
