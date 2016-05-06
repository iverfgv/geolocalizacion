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
    	$rastreo = DB::table('rastreos')
          ->select('rastreos.*')
          ->paginate(20);
      	return view('/rastreo',['rastreos'=>$rastreo]);
    }

       public function store(Request $request)
     {   
        
        \App\rastreo::create([
               'embarques_id'=>$request['embarques'],
               'fecha'=>$request['fecha'],
               'entrada'=>$request['entrada'],
               'usuario_id'=>$request['usuarios'],
               'ubicaciones_id'=>$request['ubicacion'],
               'placas'=>$request['placas'],
              ]);
        Session::flash('message','Rastreo Creado Correctamente');     
        return redirect('/rastreo');
      }

       public function delete($id)
    {
           \App\rastreo::destroy($id);
          Session::flash('message','Rastreo Eliminado Correctamente');    
          return redirect('/rastreo');
    }

}
