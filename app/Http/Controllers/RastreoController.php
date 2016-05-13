<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Session;
use Gate;
use Auth;

class RastreoController extends Controller
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
            $flag=1;
            $rastreo = DB::table('rastreo')
              ->select('rastreo.*')
              ->paginate(10);
        return view('/rastreo',['rastreos'=>$rastreo]);
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
        
        \App\rastreo::create([
               'embarques_id'=>$request['embarques'],
               'fecha'=>$request['fecha'],
               'entrada'=>$request['entrada'],
               'usuarios_id'=>$request['usuarios'],
               'ubicaciones_id'=>$request['ubicacion'],
               'placas'=>$request['placas'],
              ]);
        Session::flash('message','Rastreo Creado Correctamente');     
        return redirect('/rastreo');
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
          \App\rastreo::destroy($id);
       }
       catch(\Illuminate\Database\QueryException $e)
       {
            Session::flash('message-error','No se a Podido Eliminar Rastreo');    
            return redirect('/rastreo');
       }

          
        Session::flash('message','Rastreo Eliminado Correctamente');    
        return redirect('/rastreo');
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
            $Rastreo = \App\rastreo::find($id);
            $Rastreo->fill($request->all());
            $Rastreo->save();                
        Session::flash('message','Rastreo Actualizado Correctamente');     
        return redirect('/rastreo');
    }

}
