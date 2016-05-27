<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use View;
class rutascontroller extends Controller
{
    public function index()
    {
    	return view('rutas.index');
    }

    public function index2()
    {
    	return view('rutas.index2');
    }

    public function index3()
    {
    	return view('rutas.ruta3');
    }

    public function store(Request $request)
    {
    	$latitudes=$request['cLatitud'];
    	$longitudes=$request['cLongitud'];

    	$ltd=explode(",",$latitudes);
    	$lng=explode(",",$longitudes);

    	
    	if(strlen($latitudes)>0 && strlen($longitudes)>0)
        {
        	for($i=0;$i<count($ltd);$i++){
    			\App\rutas::create([
                  'latitud'=>$ltd[$i],
                  'longitud'=>$lng[$i],
                  'encargado'=>'2'
                ]); 
    		}
        }

        return view('rutas.ruta3');

    }
}
