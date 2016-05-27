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
        /**************************** dia uno menor que 100 *******************************/
        $diaunomenor= "select fecha,count(id) as diaunomenor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 0 day)) and peso<100";    
        $diaunomenor = DB::select(DB::raw($diaunomenor));

        $diaunomedio = "select fecha,count(id) as diaunomedio from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 0 day)) and peso>=100 and peso<1000";   
        $diaunomedio = DB::select(DB::raw($diaunomedio));

        $diaunomayor = "select fecha,count(id) as diaunomayor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 0 day)) and peso>=1000";    
        $diaunomayor = DB::select(DB::raw($diaunomayor));

        /**************************** dia uno menor que 100 *******************************/
        $diadosmenor= "select fecha,count(id) as diadosmenor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 1 day)) and peso<100";    
        $diadosmenor = DB::select(DB::raw($diadosmenor));

        $diadosmedio = "select fecha,count(id) as diadosmedio from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 1 day)) and peso>=100 and peso<1000";   
        $diadosmedio = DB::select(DB::raw($diadosmedio));

        $diadosmayor = "select fecha,count(id) as diadosmayor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 1 day)) and peso>=1000";    
        $diadosmayor = DB::select(DB::raw($diadosmayor));
       
        /**************************** dia uno menor que 100 *******************************/
        $diatresmenor= "select fecha,count(id) as diatresmenor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 2 day)) and peso<100";    
        $diatresmenor = DB::select(DB::raw($diatresmenor));

        $diatresmedio = "select fecha,count(id) as diatresmedio from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 2 day)) and peso>=100 and peso<1000";   
        $diatresmedio = DB::select(DB::raw($diatresmedio));

        $diatresmayor = "select fecha,count(id) as diatresmayor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 2 day)) and peso>=1000";    
        $diatresmayor = DB::select(DB::raw($diatresmayor));
        /**************************** dia uno menor que 100 *******************************/
        $diacuatromenor= "select fecha,count(id) as diacuatromenor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 3 day)) and peso<100";    
        $diacuatromenor = DB::select(DB::raw($diacuatromenor));

        $diacuatromedio = "select fecha,count(id) as diacuatromedio from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 3 day)) and peso>=100 and peso<1000";   
        $diacuatromedio = DB::select(DB::raw($diacuatromedio));

        $diacuatromayor = "select fecha,count(id) as diacuatromayor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 3 day)) and peso>=1000";    
        $diacuatromayor = DB::select(DB::raw($diacuatromayor));
        /**************************** dia uno menor que 100 *******************************/
        $diacincomenor= "select fecha,count(id) as diacincomenor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 4 day)) and peso<100";    
        $diacincomenor = DB::select(DB::raw($diacincomenor));

        $diacincomedio = "select fecha,count(id) as diacincomedio from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 4 day)) and peso>=100 and peso<1000";   
        $diacincomedio = DB::select(DB::raw($diacincomedio));

        $diacincomayor = "select fecha,count(id) as diacincomayor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 4 day)) and peso>=1000";   
        $diacincomayor = DB::select(DB::raw($diacincomayor));


        $day1=null;
        $day2=null;
        $day3=null;
        $day4=null;
        $day5=null;

        foreach ($diaunomenor as $d1){
             if($d1->fecha!=null)
             {$day1=$d1->fecha;}
        }if($day1==null)
        {
            foreach ($diaunomedio as $d1){
             if($d1->fecha!=null)
             {$day1=$d1->fecha;}
             }
        }if($day1==null)
        {
            foreach ($diaunomayor as $d1){
             if($d1->fecha!=null)
             {$day1=$d1->fecha;}
             }
        }if($day1==null)
        {$day1="";}

        /**********************/
        foreach ($diadosmenor as $d2){
             if($d2->fecha!=null)
             {$day2=$d2->fecha;}
        }if($day2==null)
        {
            foreach ($diadosmedio as $d2){
             if($d2->fecha!=null)
             {$day2=$d2->fecha;}
             }
        }if($day2==null)
        {
            foreach ($diadosmayor as $d2){
             if($d2->fecha!=null)
             {$day2=$d2->fecha;}
             }
        }if($day2==null)
        {$day2="";}
        /**********************/
        foreach ($diatresmenor as $d3){
             if($d3->fecha!=null)
             {$day3=$d3->fecha;}
        }if($day3==null)
        {
            foreach ($diatresmedio as $d3){
             if($d3->fecha!=null)
             {$day3=$d3->fecha;}
             }
        }if($day3==null)
        {
            foreach ($diatresmayor as $d3){
             if($d3->fecha!=null)
             {$day3=$d3->fecha;}
             }
        }if($day3==null)
        {$day3="";}
        /**********************/
        foreach ($diacuatromenor as $d4){
             if($d4->fecha!=null)
             {$day4=$d4->fecha;}
        }if($day4==null)
        {
            foreach ($diacuatromedio as $d4){
             if($d4->fecha!=null)
             {$day4=$d4->fecha;}
             }
        }if($day4==null)
        {
            foreach ($diacuatromayor as $d4){
             if($d4->fecha!=null)
             {$day4=$d4->fecha;}
             }
        }if($day4==null)
        {$day4="";}
        /**********************/
        foreach ($diacincomenor as $d5){
             if($d5->fecha!=null)
             {$day5=$d5->fecha;}
        }if($day5==null)
        {
            foreach ($diacincomedio as $d5){
             if($d5->fecha!=null)
             {$day5=$d5->fecha;}
             }
        }if($day5==null)
        {
            foreach ($diacincomayor as $d5){
             if($d5->fecha!=null)
             {$day5=$d5->fecha;}
             }
        }if($day5==null)
        {$day5="";}

        $day1 = substr($day1, 0, -9);
        $day2 = substr($day2, 0, -9);
        $day3 = substr($day3, 0, -9);
        $day4 = substr($day4, 0, -9);
        $day5 = substr($day5, 0, -9);

        $dataembarques='{';
        $dataembarques .= 'labels : ["'.$day5.'","'.$day4.'","'.$day3.'","'.$day2.'","'.$day1.'"],';
        
        $d1menor=null;
        foreach ($diaunomenor as $d1){
             if($d1->diaunomenor!=null)
             {$d1menor=$d1->diaunomenor;}
        }if($d1menor==null)
        {$d1menor=0;}  
        $d2menor=null;
        foreach ($diadosmenor as $d2){
             if($d2->diadosmenor!=null)
             {$d2menor=$d2->diadosmenor;}
        }if($d2menor==null)
        {$d2menor=0;}  
        $d3menor=null;
        foreach ($diatresmenor as $d3){
             if($d3->diatresmenor!=null)
             {$d3menor=$d3->diatresmenor;}
        }if($d3menor==null)
        {$d3menor=0;}  
        $d4menor=null;
        foreach ($diacuatromenor as $d4){
             if($d4->diacuatromenor!=null)
             {$d4menor=$d4->diacuatromenor;}
        }if($d4menor==null)
        {$d4menor=0;}   
        $d5menor=null;
        foreach ($diacincomenor as $d5){
             if($d5->diacincomenor!=null)
             {$d5menor=$d5->diacincomenor;}
        }if($d5menor==null)
        {$d5menor=0;}   

        /**************************************/
        $d1medio=null;
        foreach ($diaunomedio as $d1){
             if($d1->diaunomedio!=null)
             {$d1medio=$d1->diaunomedio;}
        }if($d1medio==null)
        {$d1menor=0;}  
        $d2medio=null;
        foreach ($diadosmedio as $d2){
             if($d2->diadosmedio!=null)
             {$d2medio=$d2->diadosmedio;}
        }if($d2medio==null)
        {$d2medio=0;}  
        $d3medio=null;
        foreach ($diatresmedio as $d3){
             if($d3->diatresmedio!=null)
             {$d3medio=$d3->diatresmedio;}
        }if($d3medio==null)
        {$d3medio=0;}  
        $d4medio=null;
        foreach ($diacuatromedio as $d4){
             if($d4->diacuatromedio!=null)
             {$d4medio=$d4->diacuatromedio;}
        }if($d4medio==null)
        {$d4medio=0;}   
        $d5medio=null;
        foreach ($diacincomedio as $d5){
             if($d5->diacincomedio!=null)
             {$d5medio=$d5->diacincomedio;}
        }if($d5medio==null)
        {$d5medio=0;}   
        /**************************************/
        $d1mayor=null;
        foreach ($diaunomayor as $d1){
             if($d1->diaunomayor!=null)
             {$d1mayor=$d1->diaunomayor;}
        }if($d1mayor==null)
        {$d1mayor=0;}  
        $d2mayor=null; 
        foreach ($diadosmayor as $d2){
             if($d2->diadosmayor!=null)
             {$d2mayor=$d2->diadosmayor;}
        }if($d2mayor==null)
        {$d2mayor=0;}  
        $d3mayor=null;
        foreach ($diatresmayor as $d3){
             if($d3->diatresmayor!=null)
             {$d3mayor=$d3->diatresmayor;}
        }if($d3mayor==null)
        {$d3mayor=0;}  
        $d4mayor=null;
        foreach ($diacuatromayor as $d4){
             if($d4->diacuatromayor!=null)
             {$d4mayor=$d4->diacuatromayor;}
        }if($d4mayor==null)
        {$d4mayor=0;}  
        $d5mayor=null;
        foreach ($diacincomayor as $d5){
             if($d5->diacincomayor!=null)
             {$d5mayor=$d5->diacincomayor;}
        }if($d5mayor==null)
        {$d5mayor=0;}   

        
        $dataembarques .= 'datasets : [
                {
                    label: "My First dataset",
                    fillColor : "rgba(255,255,255,0)",
                    strokeColor : "rgba(244, 161, 44, 0.9)",
                    pointColor : "rgba(244, 161, 44, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(220,220,220,1ss)",
                    data : ['.$d5menor.','.$d4menor.','.$d3menor.','.$d2menor.','.$d1menor.']
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
                    data : ['.$d5medio.','.$d4medio.','.$d3medio.','.$d2medio.','.$d1medio.']
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
                    data : ['.$d5mayor.','.$d4mayor.','.$d3mayor.','.$d2mayor.','.$d1mayor.']
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
