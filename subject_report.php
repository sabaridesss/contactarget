<?php
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();
//include("top_menu.php");

//include('bounce.php');

$id  = $_REQUEST['id'];

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} 
	  
$Campaign_Blasts 	 = $php_mail->Campaign_Details_JOIN($id,$company_admin);
$Campaign_Details	 = mysql_fetch_assoc($Campaign_Blasts);
$c_name 		     = $Campaign_Details['c_name'];
$email_subject 		 = $Campaign_Details['email_subject'];


	
?>
<?php include ('common/tracking_count.php')?>
<?php include ('common/header.php')?>
<script src="js/amcharts.js" type="text/javascript"></script>
<script type="text/javascript">
            var chart;
            var legend;

            var chartData = [{
                type: "Opened",
                value1: <?=$no_of_opened;?>
            }, {
                type: "Clicked",
                value2: <?=$no_of_clicked;?>
            },  {
                type: "Unopened",
                value5: <?=($no_of_successcount-$no_of_opened);?>
            },{
                type: "Sent",
                value3: <?=$no_of_successcount;?>
            }, {
                type: "Failed",
                value4: <?=$no_of_failed;?>
            }];

AmCharts.ready(function () {
                // SERIAL CHART
                chart = new AmCharts.AmSerialChart();
                chart.dataProvider = chartData;
                chart.categoryField = "type";
                chart.startDuration = 1;
                chart.plotAreaBorderColor = "#DADADA";
                chart.plotAreaBorderAlpha = 1;
                chart.marginBottom = 10;
                chart.rotate = false;
				chart.rotate = false;
				chart.zoomOutButton = {
                backgroundColor: '#FF0000',
                backgroundAlpha: 0.15
                };
				chart.pathToImages = "images/";
                // AXES
                // Category
                var categoryAxis = chart.categoryAxis;
                categoryAxis.gridPosition = "start";
                categoryAxis.gridAlpha = 0.1;
                categoryAxis.axisAlpha = 0;
				categoryAxis.labelRotation = 90;
				categoryAxis.title = "Service Type";
                // Value
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.axisAlpha = 0;
                valueAxis.gridAlpha = 0.1;
                valueAxis.position = "top";
                valueAxis.tickLength = 0;
				valueAxis.title = "Totals";
                chart.addValueAxis(valueAxis);

                // GRAPHS
                // first graph
                var graph1 = new AmCharts.AmGraph();
                graph1.type = "column";
                graph1.title = "Opened";
                graph1.valueField = "value1";
                graph1.balloonText = "Opened:[[value1]]";
                graph1.lineAlpha = 0;
                graph1.fillColors = "#ADD981";
                graph1.fillAlphas = 1;
                chart.addGraph(graph1);

                // second graph
                var graph2 = new AmCharts.AmGraph();
                graph2.type = "column";
                graph2.title = "Clicked";
                graph2.valueField = "value2";
                graph2.balloonText = "Clicked:[[value2]]";
                graph2.lineAlpha = 0;
                graph2.fillColors = "#81acd9";
                graph2.fillAlphas = 1;
                chart.addGraph(graph2);
				    // Third graph
                var graph3 = new AmCharts.AmGraph();
                graph3.type = "column";
                graph3.title = "Unopened";
                graph3.valueField = "value5";
                graph3.balloonText = "Unopened:[[value5]]";
                graph3.lineAlpha = 0;
                graph3.fillColors = "#0000A0";
                graph3.fillAlphas = 1;
                chart.addGraph(graph3);
						    // Fourth graph
                var graph4 = new AmCharts.AmGraph();
                graph4.type = "column";
                graph4.title = "Sent";
                graph4.valueField = "value3";
                graph4.balloonText = "Sent:[[value3]]";
                graph4.lineAlpha = 0;
                graph4.fillColors = "#FF0000";
                graph4.fillAlphas = 1;
                chart.addGraph(graph4);
									    // Fourth graph
                var graph5 = new AmCharts.AmGraph();
                graph5.type = "column";
                graph5.title = "Failed";
                graph5.valueField = "value4";
                graph5.balloonText = "Failed:[[value4]";
                graph5.lineAlpha = 0;
                graph5.fillColors = "#00FF00";
                graph5.fillAlphas = 1;
                chart.addGraph(graph5);
                // LEGEND
                var legend = new AmCharts.AmLegend();
                chart.addLegend(legend);
				
				 // CURSOR
                chartCursor = new AmCharts.ChartCursor();
                chartCursor.cursorPosition = "mouse";
                chart.addChartCursor(chartCursor);
				
				// SCROLL BAR
				 var chartScrollbar = new AmCharts.ChartScrollbar();
                chartScrollbar.graph2 = graph2;
                chartScrollbar.scrollbarHeight = 10;
                chartScrollbar.color = "#FF0000";
				chartScrollbar.backgroundColor = "#FF9966";
                chartScrollbar.autoGridCount = false;
                chart.addChartScrollbar(chartScrollbar);
				chart.depth3D = 10;
                chart.angle = 15;
                // WRITE
                chart.write("chartdiv");
            });
			
        </script>

<form name="content_add" method="post" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php'); ?>
        <div class="wholesite-inner">
          <!--welcome admin start here-->
          <?php include('common/tracking_views.php'); ?>
          <!--welcome admin end here-->
          <div id="chartdiv" style="width: 65%; height: 400px;"></div>
          <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here-->
      </td>
    </tr>
  </table>
</form>
</div>
</center>
</body></html>