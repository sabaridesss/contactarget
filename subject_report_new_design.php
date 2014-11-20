<?php
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();
//include("top_menu.php");

//include('bounce.php');

$id  = $_REQUEST['id'];
$company_admin  = 17;

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} 
	  
$Campaign_Blasts 	 = $php_mail->Campaign_Details_JOIN($id,$company_admin);
$Campaign_Details	 = mysql_fetch_assoc($Campaign_Blasts);
$c_name 		     = $Campaign_Details['c_name'];
$email_subject 		 = $Campaign_Details['email_subject'];
          
$no_of_opened_Blasts 	 = $php_mail->Select_Blast_three('comp_user_tbl','send_id','no_of_read','company_admin',$id,1,$company_admin);
$no_of_opened	 		 = mysql_num_rows($no_of_opened_Blasts);

$no_of_failed_Blasts 	 = $php_mail->Select_Blast_three('comp_user_tbl','send_id','no_of_fail','company_admin',$id,1,$company_admin);
$no_of_failed	 		 = mysql_num_rows($no_of_failed_Blasts);

$no_of_clicked_Blasts 	 = $php_mail->Select_Blast_three('click_rate','email_subject_id','no_of_counts','company_user_id',$id,1,$company_admin);
$no_of_clicked	 		 = mysql_num_rows($no_of_clicked_Blasts);

$no_of_subs_Blasts 	 	 = $php_mail->Select_Blast_two('comp_user_tbl','send_id','company_admin',$id,$company_admin);
$no_of_subs	 		 	 = mysql_num_rows($no_of_subs_Blasts);

	
?>
<?php include ('common/header.php')?>
<script src="js/amcharts.js" type="text/javascript"></script>
<script type="text/javascript">
            var chart;
            var legend;

            var chartData = [{
                type: "Opened",
                value: <?=$no_of_opened;?>
            }, {
                type: "Clicked",
                value: <?=$no_of_clicked;?>
            }, {
                type: "Subscribers",
                value: <?=$no_of_subs;?>
            }, {
                type: "Failed",
                value: <?=$no_of_failed;?>
            }];

            AmCharts.ready(function () {
                // PIE CHART
                chart = new AmCharts.AmPieChart();
                chart.dataProvider = chartData;
                chart.titleField = "type";
                chart.valueField = "value";
                chart.outlineColor = "#FFFFFF";
                chart.outlineAlpha = 0.8;
                chart.outlineThickness = 2;
                // this makes the chart 3D
                chart.depth3D = 15;
                chart.angle = 30;
				// LEGEND
                legend = new AmCharts.AmLegend();
                legend.align = "center";
                legend.markerType = "square";
                chart.addLegend(legend);
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
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <!--welcome admin start here-->
          <div class="welcome-admin" style="float:left">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></th>
              </tr>
            </table>
          </div>
          <div class="unit nomargin" style="padding-left:53px">
            <ul class="campaign-data dotted-list">
              <li style="float:left"> <span class="title fwb ">Campaign Name:</span> <span class="description">
                <?=$c_name;?>
                </span> </li>
              <li style="float:right"> <span class="title fwb ">Subject name:</span> <span class="description">
                <?=$email_subject;?>
                </span> </li>
            </ul>
          </div>
          
          <div style="clear:both"></div>
          <div class="lastUnit size1of1">
            <div class="stat-block alignc unit size1of4" id="active">
              <h2 class="nomargin"><a href="opened_details.php?send_id=<?=$id;?>">
                <?=$no_of_opened;?>
                </a></h2>
              <p class="fwb">Opened</p>
            </div>
            <div style="clear:both"></div>
            <div class="stat-block alignc unit size1of4" id="active">
              <h2 class="nomargin"><a href="click_details.php?send_id=<?=$id;?>">
                <?=$no_of_clicked;?>
                </a></h2>
              <p class="fwb">Clicked</p>
            </div>
            <div style="clear:both"></div>
            <div class="stat-block alignc unit size1of4" id="active">
              <h2 class="nomargin">
                <?=$no_of_subs;?>
              </h2>
              <p class="fwb">Subscribers</p>
            </div>
            <div style="clear:both"></div>
            <div class="stat-block alignc unit size1of4" id="active">
              <h2 class="nomargin"><a href="failed_details.php?send_id=<?=$id;?>">
                <?=$no_of_failed;?>
                </a></h2>
              <p class="fwb">Failed</p>
            </div>
          </div>
          <!--welcome admin end here-->
          <div id="chartdiv" style="width: 82%; height: 400px;"></div>
        </div>
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