<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RequestEmbarques;
use DB;
use App;
use Session;
use Auth;
use Gate;

class EmbarqueController extends Controller
{
  public function __construct()
  {
     $this->middleware('auth');
  }

    public function index()
    {
      $b1=0;
      $b2=0;
      $b3=0;
      $b4=0;
       if(Gate::denies('verificar-pesaje'))
       {
        $b1=1;

       } 

       if(Gate::denies('verificar-supervisor'))
       {$b2=1;} 
       if(Gate::denies('verificar-embarques'))
       {$b3=1;} 
       if(Gate::denies('verificar-administracion'))
       {$b4=1;} 
       if($b1==1 && $b2==1 && $b3==1 && $b4==1)
       {
         Auth::logout();
         return view('login'); 
       }        
     
        $embarques = DB::table('embarques')
          ->join('materiales', 'materiales.id', '=', 'embarques.materiales_id')
          ->join('usuarios', 'usuarios.id', '=', 'embarques.usuarios_id')
          ->join('ubicaciones', 'ubicaciones.id', '=', 'embarques.ubicaciones_id')
          ->select('embarques.*','materiales.material as material','usuarios.usuario as usuari','ubicaciones.ubicacion as ubica')
          ->paginate(10);
          

        return view('/embarques',compact('embarques'));
    }

     public function store(Request $request)
     {   
       $b1=0;
       $b2=0;
       $b3=0;
       $b4=0;
       if(Gate::denies('verificar-pesaje'))
       {
        $b1=1;
       } 

       if(Gate::denies('verificar-supervisor'))
       {$b2=1;} 
       if(Gate::denies('verificar-embarques'))
       {$b3=1;} 
       if(Gate::denies('verificar-administracion'))
       {$b4=1;} 
       if($b1==1 && $b2==1 && $b3==1 && $b4==1)
       {
         Auth::logout();
         return view('login'); 
       }     
         $fechasistema = date('Y-m-d');
       
        \App\embarques::create([
               'usuarios_id'=>$request['usuario'],
               'materiales_id'=>$request['material'],
               'ubicaciones_id'=>$request['ubicacion'],
               'peso'=>$request['peso'],
               'fecha'=>$fechasistema,
               'fechalocal'=>$request['fecha'],
               'codigocontrol'=>$request['codigo'],
               'cancelado'=>$request['cancelado'],
               'notasalidaecoplast'=>$request['ecoplastn'],
               'notasalidacliente'=>$request['clienten'],
              ]);
        Session::flash('message','Embarque Creado Correctamente');     
        return redirect('/embarques');
      }


      public function delete($id)
      { 
        $b1=0;
        $b2=0;
        $b3=0;
        $b4=0;
        
        if(Gate::denies('verificar-pesaje'))
        {
         $b1=1;
        } 

       if(Gate::denies('verificar-supervisor'))
       {$b2=1;}
       if(Gate::denies('verificar-embarques'))
       {$b3=1;} 
       if(Gate::denies('verificar-administracion'))
       {$b4=1;} 

       if($b1==1 && $b2==1 && $b3==1 && $b4==1)
       {
         Auth::logout();
         return view('login'); 
       }     

        if($b1==1 && $b2==0 && $b3==1 && $b4==1)
       {
         Auth::logout();
         return view('login'); 
       }     

          try
       {
          \App\embarques::destroy($id);
       }
       catch(\Illuminate\Database\QueryException $e)
       {
            Session::flash('message-error','No se a Podido Eliminar Embarque');    
            return redirect('/embarques');
       }
         
          Session::flash('message','Embarque Eliminado Correctamente');    
          return redirect('/embarques');
      }

      public function update(Request $request)
      {   
        $b1=0;
        $b2=0;
        $b3=0;
        $b4=0;
        
        if(Gate::denies('verificar-pesaje'))
        {
          $b1=1;
        }  

       if(Gate::denies('verificar-supervisor'))
       {$b2=1;} 
       if(Gate::denies('verificar-embarques'))
       {$b3=1;} 
       if(Gate::denies('verificar-administracion'))
       {$b4=1;} 
       if($b1==1 && $b2==1 && $b3==1 && $b4==1)
       {
         Auth::logout();
         return view('login'); 
       }     
            $id=$request['id'];
            $Embarque = \App\embarques::find($id);
            $Embarque->fill($request->all());
            $Embarque->save();                
            Session::flash('message','Embarque Actualizado Correctamente');     
            return redirect('/embarques');
      }


}
