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
                highlightFill: "rgba(220,220,220,0.75)",
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

     


        return View::make('dashboard',compact('datos','dataclientes'));
    }
}
