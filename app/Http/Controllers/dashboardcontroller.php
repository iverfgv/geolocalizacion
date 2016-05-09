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

        $diadosmayor = "select fecha,count(id) as diaunomayor from embarques where cast(embarques.fecha as date) = date(date_sub(curdate(),interval 1 day)) and peso>=1000";    
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

        
        if($diaunomenor!=null && $diaunomedio && $diaunomayor!=null){$day1="";} else{$day1=$diaunomenor->fecha;}
        if($diadosmenor!=null && $diadosmedio && $diadosmayor!=null){$day2="";} else{$day2=$diadosmenor->fecha;}
        if($diatresmenor!=null && $diatresmedio && $diatresmayor!=null){$day3="";} else{$day3=$diatresmenor->fecha;}
        if($diacuatromenor!=null && $diacuatromedio && $diacuatromayor!=null ){$day4="";} else{$day4=$diacuatromenor->fecha;}
        if($diacincomenor!=null && $diacincomedio && $diacincomayor!=null ){$day5="";} else{$day5=$diacincomenor->fecha;}

        $dataembarques='{';
        $dataembarques .= 'labels : ["'.$day1.'","'.$day2.'","'.$day3.'","'.$day4.'","'.$day5.'"],';
       
        $d1menor=null; $d1medio=null; $d1mayor=null;
        if($diaunomenor!=null){$d1menor=0;} else{$d1menor=$diaunomenor->diaunomenor;}
        if($diaunomedio!=null){$d1medio=0;} else{$d1medio=$diaunomedio->diaunomedio;}
        if($diaunomayor!=null){$d1mayor=0;} else{$d1mayor=$diaunomayor->diaunomayor;}

        $d2menor=null; $d2medio=null; $d2mayor=null;
        if($diadosmenor!=null){$d2menor=0;} else{$d2menor=$diadosmenor->diadosmenor;}
        if($diadosmedio!=null){$d2medio=0;} else{$d2medio=$diadosmedio->diadosmedio;}
        if($diadosmayor!=null){$d2mayor=0;} else{$d2mayor=$diadosmayor->diadosmayor;}

        $d3menor=null; $d3medio=null; $d3mayor=null;
        if($diatresmenor!=null){$d3menor=0;} else{$d3menor=$diatresmenor->diatresmenor;}
        if($diatresmedio!=null){$d3medio=0;} else{$d3medio=$diatresmedio->diatresmedio;}
        if($diatresmayor!=null){$d3mayor=0;} else{$d3mayor=$diatresmayor->diatresmayor;}

        $d4menor=null; $d4medio=null; $d4mayor=null;
        if($diacuatromenor!=null){$d4menor=0;} else{$d4menor=$diacuatromenor->diacuatromenor;}
        if($diacuatromedio!=null){$d4medio=0;} else{$d4medio=$diacuatromedio->diacuatromedio;}
        if($diacincomayor!=null){$d4mayor=0;} else{$d4mayor=$diacincomayor->diacincomayor;}

        $d5menor=null; $d5medio=null; $d5mayor=null;
        if($diacincomenor!=null){$d5menor=0;} else{$d5menor=$diacincomenor->diacincomenor;}
        if($diacincomedio!=null){$d5medio=0;} else{$d5medio=$diacincomedio->diacincomedio;}
        if($diacincomayor!=null){$d5mayor=0;} else{$d5mayor=$diacincomayor->diacincomayor;}
        
        $dataembarques .= 'datasets : [
                {
                    label: "My First dataset",
                    fillColor : "rgba(255,255,255,0)",
                    strokeColor : "rgba(244, 161, 44, 0.9)",
                    pointColor : "rgba(244, 161, 44, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(220,220,220,1ss)",
                    data : ['.$d1menor.','.$d2menor.','.$d3menor.','.$d4menor.','.$d5menor.']
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
                    data : ['.$d1medio.','.$d2medio.','.$d3medio.','.$d4medio.','.$d5medio.']
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
                    data : ['.$d1mayor.','.$d2mayor.','.$d3mayor.','.$d4mayor.','.$d5mayor.']
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
        $etiquetasinferior=null;
        $etiquetasvertical=null;
        $dataclientes=null;

        $dataclientes='{';
        $etiquetasinferior='labels : [';
        $etiquetasvertical='data: [';
       
        foreach ($clientes as $c){
            $etiquetasinferior .= '"'.$c->nombre.'",';
            $etiquetasvertical .= $c->total.',';
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
    	
    	$sql = "select count(materiales.grupos_id) as total, grupos.grupo as nombre from materiales join grupos on materiales.grupos_id=grupos.id where grupos_id in (select id from grupos) group by grupos_id";       
        
	    $materials = DB::select(DB::raw($sql));
	    $datos=null;
	    $datos .= "[";
	 
	    $i=0;
	    foreach ($materials as $m) {
	    	if($i==98)
	    	{
	    		$i=0;
	    	}
	    	
	    	$datos .= '{'.
	    		'value: '.$m->total.','.
	    		'color:'.'"'.$colores[$i].'",'.
	    		'highlight:'.'"#FF5A5E",'.
	    		'label:'.'"'.$m->nombre.'"'
	    		."},";

			$i++;
	    	
	    } 



	    $datos= substr($datos, 0, -1);

	    $datos .= "]";

        /*********************** grafica de pastel **********************************/

     

            return View::make('dashboard',compact('datos','dataclientes','dataembarques'));
    }
}
