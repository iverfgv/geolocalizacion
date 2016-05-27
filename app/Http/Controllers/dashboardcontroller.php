<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use View;

class dashboardcontroller extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function index()
    {		
        /*********************** grafica de puntos **********************************/
        $dataembarques=null;
        $diaunomenor=null; 
        $diadosmayor=null;
       

        $tdias = date("t");
        $dataembarques='{';
        $dataembarques .= 'labels : [';

        for($i=1;$i<=$tdias;$i++)
        {
            $dataembarques .='"';
            $dataembarques .= $i;
            $dataembarques .='",';
        }

        $dataembarques = substr($dataembarques, 0, -1);
        $dataembarques .='],';
       
        //$dataembarques='{';
        //$dataembarques .= 'labels : ["'.$day5.'","'.$day4.'","'.$day3.'","'.$day2.'","'.$day1.'"],';
        
     



        $embarquesMenores=array();
        $embarquesMedios=array();
        $embarquesMayores=array();
        $tdias = date("t");
        $mes = date("m");
        $total=0;
        $b=0;

        for($i=1;$i<=$tdias;$i++)
        {            
            $total=0;   
            $embarquesmenor = "select count(*) as total from embarques where day(fecha)=".$i." and Month(fecha)=".$mes." and peso<100";
            $embarquesmenor = DB::select(DB::raw($embarquesmenor));
            $total=0;
            foreach ($embarquesmenor as $t){
             if($t->total!=null)
             {
               $b==1;
               $total=$t->total;
             }
            }
            
            $embarquesMenores[$i]=$t->total;

        }

        for($i=1;$i<=$tdias;$i++)
        {            
            $total=0;   
            $embarquesmedio = "select count(*) as total from embarques where day(fecha)=".$i." and Month(fecha)=".$mes." and peso>=100 and peso<1000";
            $embarquesmedio = DB::select(DB::raw($embarquesmedio));
            $total=0;
            foreach ($embarquesmedio as $t){
             if($t->total!=null)
             {
               $b==1;
               $total=$t->total;
             }
            }
            
            $embarquesMedios[$i]=$t->total;

        }

        for($i=1;$i<=$tdias;$i++)
        {            
            $total=0;   
            $embarquesMayore= "select count(*) as total from embarques where day(fecha)=".$i." and Month(fecha)=".$mes." and peso>=1000";
            $embarquesMayore = DB::select(DB::raw($embarquesMayore));
            $total=0;
            foreach ($embarquesMayore as $t){
             if($t->total!=null)
             {
               $b==1;
               $total=$t->total;
             }
            }
            
            $embarquesMayores[$i]=$t->total;

        }


        $diasmenores="";
        $diasmedios="";
        $diasmayores="";

        for($i=1;$i<=$tdias;$i++)
        {
            $diasmenores .= $embarquesMenores[$i].",";
            $diasmedios .= $embarquesMedios[$i].",";
            $diasmayores .= $embarquesMayores[$i].",";
        }

        $diasmenores = substr($diasmenores, 0, -1);
        $diasmedios = substr($diasmedios, 0, -1);
        $diasmayores = substr($diasmayores, 0, -1);

        $dataembarques .= 'datasets : [
                {
                    label: "My First dataset",
                    fillColor : "rgba(255,255,255,0)",
                    strokeColor : "rgba(244, 161, 44, 0.9)",
                    pointColor : "rgba(244, 161, 44, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(220,220,220,1ss)",
                    data : ['.$diasmenores.']
                },';

        $dataembarques .= '
        {
                    label: "My Second dataset",
                    fillColor : "rgba(255,255,255,0)",
                    strokeColor : "rgba(151,187,205,1)",
                    pointColor : "rgba(151,187,205,1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(151,187,205,1)",
                    data : ['.$diasmedios.']
        },';

         $dataembarques .= '
        {
                    label: "My Second dataset",
                    fillColor : "rgba(255,255,255,0)",
                    strokeColor : "rgba(181,137,205,1)",
                    pointColor : "rgba(181,137,205,1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(151,187,205,1)",
                    data : ['.$diasmayores.']
                }
            ]

        }';

      
        
        /****************************************************************************/


        /*********************** grafica de pastel **********************************/
        $colores = array("#FA5858", "#DF7401", "#F7BE81", "#F5DA81", "#F3F781", 
                         "#D8F781", "#81F7D8", "#81BEF7", "#9F81F7", "#F7819F",
                         "#FE2E2E", "#FE642E", "#FE9A2E", "#C8FE2E", "#2EFEC8", 
                         "#2E64FE", "#9A2EFE", "#FE2E9A", "#FE2E64", "#A4A4A4",
                         "#DF0101", "#DF3A01", "#F79F81", "#A5DF00", "#01DFA5", 
                         "#01DFA5", "#013ADF", "#7401DF", "#DF01A5", "#DF013A",
                         "#8A0808", "#8A4B08", "#AEB404", "#31B404", "#0B614B", 
                         "#0B3861", "#380B61", "#610B38", "#1C1C1C", "#3B0B17",
                         "#3B0B17", "#F5D0A9", "#DA81F5", "#F7819F", "#3B170B",
                         "#2E3B0B", "#0B3B17", "#120A2A", "#2A0A12", "#F6CED8",
                         "#190B07", "#222A0A", "#0A2A29", "#0A122A", "#1B0A2A", 
                         "#610B4B", "#FA8258", "#0174DF", "#A901DB", "#2A0A12",
                         "#FA5858", "#F79F81", "#F7BE81", "#F5DA81", "#F3F781", 
                         "#D8F781", "#81F7D8", "#81BEF7", "#9F81F7", "#F7819F",
                         "#FE2E2E", "#FE642E", "#FE9A2E", "#C8FE2E", "#2EFEC8", 
                         "#2E64FE", "#9A2EFE", "#FE2E9A", "#FE2E64", "#A4A4A4",
                         "#DF0101", "#DF3A01", "#DF7401", "#A5DF00", "#01DFA5", 
                         "#01DFA5", "#013ADF", "#7401DF", "#DF01A5", "#DF013A",
                         "#8A0808", "#8A4B08", "#AEB404", "#31B404", "#0B614B",
                         "#0B3861", "#380B61", "#610B38", "#1C1C1C", "#3B0B17");
        
        $sqlclientes = "select count(empresas.tiposempresas_id) as total, tiposempresas.tipoempresa as nombre from empresas join tiposempresas on empresas.tiposempresas_id=tiposempresas.id where tiposempresas_id in (select id from tiposempresas) group by tiposempresas_id";       
        
        $clientes = DB::select(DB::raw($sqlclientes));
        $etiquetasinferior="";
        $etiquetasvertical="";
        $dataclientes="";

        $dataclientes .= '{';
        $etiquetasinferior .= 'labels:[';
        $etiquetasvertical .= 'data:[';
       
        $nombrec="";
        $totalc="";
        $bc=0;
        foreach ($clientes as $c){
            if($c->nombre!=null){
                $nombrec=$c->nombre;
                $totalc=$c->total;
                $bc=1;
            }else{
                $nombrec="";
                $totalc=0;
            }
            $etiquetasinferior .= '"'.$nombrec.'",';
            $etiquetasvertical .= $totalc.',';
        }

        if($bc==0)
        {
            $etiquetasinferior .= '"'.''.'",';
            $etiquetasvertical .= '0'.',';
        }

        $etiquetasinferior= substr($etiquetasinferior, 0, -1);
        $etiquetasvertical= substr($etiquetasvertical, 0, -1);

        $etiquetasinferior .= '],';
        $etiquetasvertical .= ']'; 

        $dataclientes .= $etiquetasinferior;
        $dataclientes .= 'datasets : [
            {
                fillColor : "#5fbeaa", 
                strokeColor : "rgba(220,220,220,0.8)",
                highlightFill: "#389C87",
                highlightStroke: "rgba(220,220,220,1)",';

        $dataclientes .= $etiquetasvertical;  

        $dataclientes .='}]}'; 

       
    
        /*********************** grafica de pastel **********************************/


        /*********************** grafica de pastel **********************************/
    	$colores = array("#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", 
    				     "#D8F781", "#81F7D8", "#81BEF7", "#9F81F7", "#F7819F",
    				   	 "#FE2E2E", "#FE642E", "#FE9A2E", "#C8FE2E", "#2EFEC8", 
    				   	 "#2E64FE", "#9A2EFE", "#FE2E9A", "#FE2E64", "#A4A4A4",
    				     "#DF0101", "#DF3A01", "#F79F81", "#A5DF00", "#01DFA5", 
    				     "#01DFA5", "#013ADF", "#7401DF", "#DF01A5", "#DF013A",
    				     "#8A0808", "#8A4B08", "#AEB404", "#31B404", "#0B614B", 
    				     "#0B3861", "#380B61", "#610B38", "#1C1C1C", "#3B0B17",
    				     "#3B0B17", "#F5D0A9", "#DA81F5", "#F7819F", "#3B170B",
    				     "#2E3B0B", "#0B3B17", "#120A2A", "#2A0A12", "#F6CED8",
    				     "#190B07", "#222A0A", "#0A2A29", "#0A122A", "#1B0A2A", 
    				     "#610B4B", "#FA8258", "#0174DF", "#A901DB", "#2A0A12",
    				     "#FA5858", "#F79F81", "#F7BE81", "#F5DA81", "#F3F781", 
    				     "#D8F781", "#81F7D8", "#81BEF7", "#9F81F7", "#F7819F",
    				     "#FE2E2E", "#FE642E", "#FE9A2E", "#C8FE2E", "#2EFEC8", 
    				     "#2E64FE", "#9A2EFE", "#FE2E9A", "#FE2E64", "#A4A4A4",
    				     "#DF0101", "#DF3A01", "#DF7401", "#A5DF00", "#01DFA5", 
    				     "#01DFA5", "#013ADF", "#7401DF", "#DF01A5", "#DF013A",
    				     "#8A0808", "#8A4B08", "#AEB404", "#31B404", "#0B614B",
    				     "#0B3861", "#380B61", "#610B38", "#1C1C1C", "#3B0B17");
    	
    	$sql = "select count(materiales.grupos_id) as total, grupos.grupo as nombre from materiales join grupos on materiales.grupos_id=grupos.id where grupos_id in (select id from grupos) group by grupos_id";       
        
	    $materials = DB::select(DB::raw($sql));
	    $datos=null;
	    $datos .= "[";
	    $nombre="";
        $total="";
	    $i=0; 
        $b=0;
	    foreach ($materials as $m) {
            if($m->nombre!=null)
                {$nombre=$m->nombre;
                 $total=$m->total;
                 $b=1;}
            else
                {$nombre="";
                 $total=0;}
	    	if($i==98)
	    	{
	    		$i=0;
	    	}
	    	
	    	$datos .= '{'.
	    		'value: '.$total.','.
	    		'color:'.'"'.$colores[$i].'",'.
	    		'highlight:'.'"#FF5A5E",'.
	    		'label:'.'"'.$nombre.'"'
	    		."},";

			$i++;
	    	
	    } 


        if($b==0){
            $datos .= '{'.
                'value: '.'100'.','.
                'color:'.'"'.'  #c3c3c3'.'",'.
                'highlight:'.'"#9c9c9c",'.
                'label:'.'"'.'No hay datos'.'"'
                ."},";
        }
	    $datos= substr($datos, 0, -1);

	    $datos .= "]";
  
       
        /*********************** grafica de pastel **********************************/
     

        return View::make('dashboard',compact('datos','dataclientes','dataembarques'));
    }
}
