<?php
namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use DB;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /******************** Dashboard *************************/
        $gate->define('verificar-dashboard',function()
        {            
            $b=False;
             $usuario=Auth::user()->usuario;
    
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.administracion')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

                if($r!=null){if($r->administracion==1){$b=True;}}
                else{$b=False;}
            
            return $b;
        });
        /*********************************************************/
        /******************** administracion *************************/
        $gate->define('verificar-administracion',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.administracion')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

             if($r!=null){if($r->administracion==1){$b=True;}}
             else{$b=False;}
            
            return $b;
        });
        /*********************************************************/
        /******************** modulo-embarques ****************************/
        $gate->define('verificar-modulo-embarques',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.pesaje','perfiles.supervisor','perfiles.embarques','perfiles.administracion')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

            if($r!=null)
            {
                if($r->pesaje==1 || $r->supervisor || $r->embarques || $r->administracion)
                    {$b=True;}
            }

            else{$b=False;}
            
            return $b;
        });
        /*********************************************************/
        /******************** modulo-pesaje ****************************/
        $gate->define('verificar-modulo-rastreo',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.pesaje','perfiles.supervisor','perfiles.administracion')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

            if($r!=null)
            {
                if($r->pesaje==1 || $r->supervisor || $r->administracion)
                    {$b=True;}
            }

            else{$b=False;}
            
            return $b;
        });
        /*********************************************************/



        /*********************************************************************************/
        /******************************* rutas *******************************************/
        /*********************************************************************************/
        $gate->define('verificar-pesaje',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.pesaje')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

            if($r!=null)
            {
                if($r->pesaje==1)
                    {$b=True;}
            }

            else{$b=False;}
            
            return $b;
        });
        /*********************************************************************************/
        $gate->define('verificar-supervisor',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.supervisor')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

            if($r!=null)
            {
                if($r->supervisor==1)
                    {$b=True;}
            }

            else{$b=False;}
            
            return $b;
        });
        /*********************************************************************************/
        $gate->define('verificar-embarques',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.embarques')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

            if($r!=null)
            {
                if($r->embarques==1)
                    {$b=True;}
            }

            else{$b=False;}
            
            return $b;
        });

        /*********************************************************************************/
        $gate->define('verificar-reportes',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.reportes')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

            if($r!=null)
            {
                if($r->reportes==1)
                    {$b=True;}
            }

            else{$b=False;}
            
            return $b;
        });
        /*********************************************************/
        $gate->define('verificar-eliminar-supervisor',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.supervisor')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();
          
            if($r!=null)
            {
                if($r->supervisor==1)
                    {$b=False;}
                else{
                    {$b=True;}
                }
            }

            else{$b=True;}
            
            return $b;
        });
        /******************** 
        $gate->define('verificar-perfiles',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.administracion')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

             if($r!=null){if($r->administracion==1){$b=True;}}
             else{$b=False;}
            
            return $b;
        });
         
         
        $gate->define('verificar-usuarios',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.administracion')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

             if($r!=null){if($r->administracion==1){$b=True;}}
             else{$b=False;}
            
            return $b;
        });
         
        $gate->define('verificar-ubicaciones',function()
        {            
            $b=False;
            $usuario=Auth::user()->usuario;
            
                $r=DB::table('usuarios')
                ->join('perfiles', 'usuarios.perfiles_id', '=', 'perfiles.id')
                ->select('perfiles.administracion')
                ->whereusuario($usuario)               
                ->where('perfiles.activo','=','1')->first();

             if($r!=null){if($r->administracion==1){$b=True;}}
             else{$b=False;}
            
            return $b;
        });
        
        /*********************************************************/
    }
}
