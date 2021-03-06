<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers:  'Content-Type, Accept, Authorization, X-Requested-With'");
header('Access-Control-Allow-Headers: Origin, Content-Type, *');

use Illuminate\Http\Request;
use App\Http\Requests;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::resource('ruta','rutascontroller');       
Route::get('rutas','rutascontroller@index'); 
Route::get('rutas2','rutascontroller@index2'); 
Route::get('rutas3','rutascontroller@index3'); 







////////////ACCESO-ECOPLAST///////////////////
Route::resource('accesos','AccesosController');       
Route::get('accesos','AccesosController@index'); 
Route::get('accesos/accesodel/{id}','AccesosController@delete');

////////////MATERIALES-ECOPLAST///////////////////
Route::resource('materiales','MaterialesController');       
Route::get('materiales','MaterialesController@index'); 
Route::get('materiales/materialdel/{id}','MaterialesController@delete');

////////////GRUPO-ECOPLAST///////////////////
Route::resource('grupos','GruposController');       
Route::get('grupos','GruposController@index'); 
Route::get('grupos/grupodel/{id}','GruposController@delete');

/////////////TIPO-EMPRESA-ECOPLAST///////////////////
Route::resource('tipoempresa','TipoempresaController');       
Route::get('tipoempresa','TipoempresaController@index'); 
Route::get('tipoempresa/tipoempresadel/{id}','TipoempresaController@delete');

/**************************************************************************************************/
/////////////EMPRESA-ECOPLAST///////////////////
Route::resource('empresas','EmpresaController');       
Route::get('empresas','EmpresaController@index'); 
Route::get('empresas/empresadel/{id}','EmpresaController@delete');





Route::post('obtenerid', function(Request $request)
{
 		$idempresa =$request->input('ide');

          $sql = "select ubicacionesempresas.*, ubicaciones.ubicacion from ubicacionesempresas join ubicaciones on ubicaciones.id=ubicacionesempresas.ubicaciones_id 
          where ubicacionesempresas.empresas_id =".$idempresa;


        
     $datos = DB::select(DB::raw($sql));

     
	
	return Response::json( array(
		'sms' => " Parametro AJAX y JSON", 
		'datos' => $datos, 
		));

});

/////////////RASTREOS-ECOPLAST///////////////////
//Route::resource('rastreo','EmpresaController');       
Route::resource('rastreo','RastreoController');       
Route::get('rastreo','RastreoController@index');  
Route::get('rastreo/rastreodel/{id}','RastreoController@delete');


/////////////EMBARQUES-ECOPLAST///////////////////
Route::resource('embarques','EmbarqueController');    
Route::get('embarques','EmbarqueController@index');
Route::get('embarques/embarquedel/{id}','EmbarqueController@delete');


/////////////USUARIOS-ECOPLAST///////////////////
Route::resource('usuario','usuariocontroller');
Route::get('/usuarios','usuariocontroller@index');
Route::get('usuarios/usuariodel/{id}','usuariocontroller@delete');

Route::get('/','sesioncontroller@login');
Route::get('/logout','sesioncontroller@logout');



/////////////PERFIL-ECOPLAST///////////////////
Route::resource('perfil','perfilcontroller');
Route::get('/perfiles','perfilcontroller@index');
Route::get('perfiles/perfildel/{id}','perfilcontroller@delete');


/////////////UBICACION-ECOPLAST///////////////////
Route::resource('ubicacion','ubicacionescontroller');
Route::get('/ubicaciones','ubicacionescontroller@index');
Route::get('ubicaciones/ubicacionesdel/{id}','ubicacionescontroller@delete');

Route::get('/menu','dashboardcontroller@index');


/***************** Rutas para aplicacion movil **************************/
/////////////LOGIN-ECOPLAST///////////////////
Route::resource('dashboard','logincontroller'); //login

Route::post('login','logincontroller@login');


Route::post('login/obtener','logincontroller@obtener');
Route::post('login/getallusers','logincontroller@obtenerusers');

/////////////MOVIMIENTOS-ECOPLAST///////////////////
Route::post('movimientos','movimientocontroller@registrar');
Route::post('historial/obtener','historialcontroller@obtener');
Route::post('historial/obtenerh','historialcontroller@obtenerhistorial');

/////////////SINCRONIZAR-ECOPLAST///////////////////
Route::post('sincronizar','sincronizarcontroller@registrar');
