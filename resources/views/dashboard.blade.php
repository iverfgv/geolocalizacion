@include('includes.header')

<div class="content-page">
            <!-- Start content -->
<div class="content">
<div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">Dashboard</h4>
                                <p class="text-muted page-title-alt"></p>
                            </div>
                        </div>

                        <div class="row">

                        </div>
                        
        
                        <!-- end row -->

	<style>
    #canvas-holder {
        width: 30%;
        margin-top: 50px;
        text-align: left;
    }
    #chartjs-tooltip {
        opacity: 1;
        position: absolute;
       /*background: rgba(0, 0, 0, .7);*/
        color: white;
        padding: 3px;
        border-radius: 3px;
        -webkit-transition: all .1s ease;
        transition: all .1s ease;
        pointer-events: none;
        -webkit-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
    }
    #chartjs-tooltip.below {
        -webkit-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
    }
    #chartjs-tooltip.below:before {
        border: solid;
        border-color: #111 transparent;
        border-color: rgba(0, 0, 0, .8) transparent;
        border-width: 0 8px 8px 8px;
        bottom: 1em;
        content: "";
        display: block;
        left: 50%;
        position: absolute;
        z-index: 99;
        -webkit-transform: translate(-50%, -100%);
        transform: translate(-50%, -100%);
    }
    #chartjs-tooltip.above {
        
    }
    
    #chartjs-tooltip.above:before {
        border: solid;
        border-color: #111 transparent;
        border-color: rgba(0, 0, 0, .8) transparent;
        border-width: 8px 8px 0 8px;
        bottom: 1em;
        content: "";
        display: block;
        left: 50%;
        top: 100%;
        position: absolute;
        z-index: 99;
        -webkit-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
    }
    </style>

<script>
    Chart.defaults.global.customTooltips = function(tooltip) {

    	// Tooltip Element
        var tooltipEl = $('#chartjs-tooltip');

        // Hide if no tooltip
        if (!tooltip) {
            tooltipEl.css({
                opacity: 0
            });
            return;
        }

        // Set caret Position
        tooltipEl.removeClass('above below');
        tooltipEl.addClass(tooltip.yAlign);

        // Set Text
        tooltipEl.html(tooltip.text);

        // Find Y Location on page
        var top;
        if (tooltip.yAlign == 'above') {
            top = tooltip.y - tooltip.caretHeight - tooltip.caretPadding;
        } else {
            top = tooltip.y + tooltip.caretHeight + tooltip.caretPadding;
        }

        // Display, position, and set styles for font
        tooltipEl.css({
            opacity: 1,
            left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
            top: tooltip.chart.canvas.offsetTop + top + 'px',
            fontFamily: tooltip.fontFamily,
            fontSize: tooltip.fontSize,
            fontStyle: tooltip.fontStyle,
        });
    };

    var pieData = [{value: 3,color:"#FA5858",highlight:"#FF5A5E",label:"Cartón"},{value: 3,color:"#DF7401",highlight:"#FF5A5E",label:"Papel"},{value: 2,color:"#F7BE81",highlight:"#FF5A5E",label:"PET"},{value: 4,color:"#F5DA81",highlight:"#FF5A5E",label:"LDPE"},{value: 2,color:"#F3F781",highlight:"#FF5A5E",label:"PP"},{value: 2,color:"#D8F781",highlight:"#FF5A5E",label:"HDPE"},{value: 1,color:"#81F7D8",highlight:"#FF5A5E",label:"PC"},{value: 3,color:"#81BEF7",highlight:"#FF5A5E",label:"Metales"},{value: 3,color:"#9F81F7",highlight:"#FF5A5E",label:"Vidrio"}];



   /************************ grafica de barras *************************************/
	var barChartData =<?php echo $dataclientes?>

	/************************ grafica de embarques *************************************/

	var randomScalingFactor = function(){ return Math.round(Math.random()*20)};
		var lineChartData = <?php echo $dataembarques?>
		/*{
			labels : ["Lunes","Martes","Miercoles","Jueves","Viernes"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(255,255,255,0)",
					strokeColor : "rgba(244, 161, 44, 0.9)", //colore linea
					pointColor : "rgba(244, 161, 44, 0.9)", //color punto
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1ss)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				},
				{
					label: "My Second dataset",
					fillColor : "rgba(255,255,255,0)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				},
				{
					label: "My Second dataset",
					fillColor : "rgba(255,255,255,0)",
					strokeColor : "rgba(151,187,205,1)",
					pointColor : "rgba(151,187,205,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(151,187,205,1)",
					data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
				}
			]

		}*/



	
    window.onload = function() {
    	var ctxc = document.getElementById("canvasembarques").getContext("2d");
    	var ctx = document.getElementById("canvas-barras").getContext("2d");
    	var ctx1 = document.getElementById("chart-area1").getContext("2d");
    	var ctx2 = document.getElementById("chart-area2").getContext("2d");
		
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});

        
        window.myPie = new Chart(ctx1).Pie(pieData, {
			responsive : true
		});
        window.myPie = new Chart(ctx2).Pie(pieData, {
			responsive : true
		});

		window.myLine = new Chart(ctxc).Line(lineChartData, {
			responsive: true
		});
    };
    </script>


    
   
    <div id="chartjs-tooltip"></div>
	
    <!--
	<div class="col-lg-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Embarques</b></h4>
				<p class="text-muted m-b-30 font-13">
										
				</p>
									
			<div id="simple-line-chart" class="ct-chart ct-golden-section"></div>
		</div>
	</div>-->        

                        <div class="row">
							     
                        </div>


                        <div style="width:97%; height:7%;">
							<div>
								<canvas id="canvasembarques" ></canvas>
							</div>
						</div>

						<div class="row">												

						 	<!-- grafica de pastel -->
							 	<div id="canvas-holder">
							        <canvas id="chart-area1" width="0" height="0" />
							    </div>
							    <div id="canvas-holder">
							        <canvas id="chart-area2" width="300" height="300" />
							    </div>
							    <div id="chartjs-tooltip"></div>
						    <!-- ****************** -->

						    <!-- grafica de barras -->
							<div style="width: 40%">
								<canvas id="canvas-barras" height="450" width="600"></canvas>
							</div>							
						<!-- ****************** -->

							

                        </div> <!-- end row -->

                        
                        

                    </div>

       

</div> <!-- content -->

</div>

@include('includes.footer')