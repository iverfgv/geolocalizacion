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
        width: 100%;
        margin-top: 50px;
        text-align: center;
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
    /*  < de letrero
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
    }*/
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

    var pieData = <?php echo $datos?>;







   /************************ grafica de barras *************************************/
   var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData =<?php echo $dataclientes?>
	



    window.onload = function() {
    	var ctx = document.getElementById("canvas-barras").getContext("2d");
    	var ctx1 = document.getElementById("chart-area1").getContext("2d");
    	var ctx2 = document.getElementById("chart-area2").getContext("2d");
		
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});

        
        window.myPie = new Chart(ctx1).Pie(pieData);
        window.myPie = new Chart(ctx2).Pie(pieData);
    };
    </script>


    
   
    <div id="chartjs-tooltip"></div>
	
                        <div class="row">
							<div class="col-lg-12">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Embarques</b></h4>
									<p class="text-muted m-b-30 font-13">
										
									</p>
									
									<div id="simple-line-chart" class="ct-chart ct-golden-section"></div>
								</div>
							</div>             
                        </div>

						<div class="row">	
							<!--<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										<i class="fa fa-bar-chart-o fa-fw"></i>Materiales
									</div>
									<div id="canvas-holder">
									    <canvas id="chart-area2" width="250" height="250" />
									</div>	
								    <div id="chartjs-tooltip"></div>						 		
								</div>
							</div>-->

							<div class="col-lg-6">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Clientes</b></h4>
									<p class="text-muted m-b-30 font-13">
										
									</p>
									
									<div id="distributed-series" class="ct-chart ct-golden-section"></div>
								</div>
							</div>

						<!-- grafica de barras -->
							<div style="width: 50%">
								<canvas id="canvas-barras" height="450" width="600"></canvas>
							</div>
						<!-- ****************** -->

 	<!-- grafica de pastel -->
	 	<div id="canvas-holder">
	        <canvas id="chart-area1" width="0" height="0" />
	    </div>
	    <div id="canvas-holder">
	        <canvas id="chart-area2" width="300" height="300" />
	    </div>
	    <div id="chartjs-tooltip"></div>
    <!-- ****************** -->

						<!--
							<div class="col-lg-6">
								<div class="card-box">
									<div style="width: 50%">
											<canvas id="canvas" height="450" width="600"></canvas>
										</div>
									
									<div id="distributed-series" class="ct-chart ct-golden-section"></div>
								</div>
							</div>-->


							

                        </div> <!-- end row -->

                        
                        

                    </div>

       

</div> <!-- content -->

</div>

@include('includes.footer')