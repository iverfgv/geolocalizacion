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

    var pieData =<?php echo $datos?>

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
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i>Grafica de Embarques por Día
						</div> 
						<br>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="submit" class="btn btn-warning">
						<h6 style="color: white;">Embarques con peso menor a 100</h6></button>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="submit" class="btn btn-primary">
						<h6 style="color: white;">Embarques con peso menor a 1000</h6></button>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<button type="submit" class="btn" style="background-color: #9966CC;;">
						<h6 style="color: white;">Embarques con peso mayor a 1000</h6></button>
						<canvas id="canvasembarques" width="1000px" height="400"></canvas>	
					</div>
				</div>
		</div>
		
			<div class="tam">
			<div class="col-md-5">
				<div class="panel panel-default ">
					<div class="panel-heading ">
						<i class="fa fa-bar-chart-o fa-fw"></i>Grafica de Materiales
					</div>
						
							<canvas  id="chart-area1" width="0" height="0"></canvas>
				
						<canvas  id="chart-area2" width="500" height="340"></canvas>	
				</div>	
				</div>
				</div>
											
			

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i>Grafica de clientes
					</div>
					 		<canvas id="canvas-barras" width="580px" height="350px"></canvas>	
				</div>
			</div>
                        <!--<div style="width:97%; height:7%;">
							<div>
								<canvas id="canvasembarques" ></canvas>
							</div>
						</div>-->
						 	<!-- grafica de pastel -->
							 	<!--
									 	<div id="canvas-holder">
									        <canvas id="chart-area1" width="0" height="0" />
									    </div>
									    <div id="canvas-holder">
									        <canvas id="chart-area2" width="300" height="300" />
									    </div>
									    <div id="chartjs-tooltip"></div>
								-->
						    <!-- ****************** -->

						    <!-- grafica de barras 
							<div style="width: 40%">
								<canvas id="canvas-barras" height="450" width="600"></canvas>
							</div>							
						    -->

                        
                        

                    </div>

       

</div> <!-- content -->

</div>

@include('includes.footer')