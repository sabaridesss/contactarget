<?php
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();
//include("top_menu.php");

//include('bounce.php');

$id  = $_REQUEST['id'];
$company_admin  = 17;
//$camp_id  = 3;

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} 

$no_of_opened_Blasts 	 = $php_mail->Select_Blast_two('comp_user_tbl','send_id','no_of_read',$camp_id,1);
$no_of_opened	 		 = mysql_num_rows($no_of_opened_Blasts);
$no_of_failed_Blasts 	 = $php_mail->Select_Blast_two('comp_user_tbl','send_id','no_of_fail',$camp_id,1);
$no_of_failed	 		 = mysql_num_rows($no_of_failed_Blasts);
$no_of_clicked_Blasts 	 = $php_mail->Select_Blast_two('click_rate','email_subject_id','no_of_counts',$camp_id,1);
$no_of_clicked	 		 = mysql_num_rows($no_of_clicked_Blasts);
$no_of_subs_Blasts 	 	 = $php_mail->Select_Blast('comp_user_tbl','send_id',$camp_id);
$no_of_subs	 		 	 = mysql_num_rows($no_of_subs_Blasts);

	
?>
<?php include ('common/header.php')?>
<script type="text/javascript">
function sort_check()
{
var sort1 = document.content_add.sort.value;
window.location = "campaign_list.php?campaign_id="+sort1;
}
</script>
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
      <td align="center" class="top">
      <?php include('common/top_menu.php') ?>
      <div class="wholesite-inner">
        <!--welcome admin start here-->
        <div class="welcome-admin">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></th>
              <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                <?=$msg?>
                </font></strong></td>
              <td width="55%" align="left" valign="middle">&nbsp;</td>
              <td width="25%" align="left" valign="middle">&nbsp;</td>
              <td width="25%" align="right" valign="middle">&nbsp;</td>
              <td width="25%" align="right" valign="middle">&nbsp;</td>
              <td width="25%" align="right" valign="middle">&nbsp;</td>
            </tr>
          </table>
        </div>
        <div >
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th width="20%" align="right" valign="middle">Campaign Name:&nbsp;&nbsp; </th>
              <td width="45%" align="left" valign="middle">Desss News Letter</td>
              <th width="20%" align="left" valign="middle">Subject name&nbsp;
            </td>
            
            <td width="45%" align="left" valign="middle">&nbsp;</td>
              <td width="25%" align="right" valign="middle">Desss News Letter</td>
              <!--    <td width="25%" align="right" valign="middle">&nbsp;</td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>-->
            </tr>
          </table>
        </div>
        <div class="content">
          <table width="100%" border="0" align="center" class="welcome">
            <tr class="table1">
              <td height="30" align="left" ><strong>Opened</strong></td>
              <td align="left" >Clicked</td>
              <td align="left" >Subscribers</td>
              <td align="left" >Failed</td>
            </tr>
            <? 
 $query2="SELECT * FROM compaign_name where company_admin='$company_admin' and id = ".$id."  order by id ASC";		  


	$query_result = mysql_query($query2);
	
	  
	  while($item=mysql_fetch_array($query_result)){
	  
   $class="table2";
	   if(($i%2)==0)
	     $class="table3";

		  
	   ?>
            <script type="text/javascript">
<!--
function popup(url) 
{
 var width  = 800;
 var height = 500;
 var left   = (screen.width  - width)/2;
 var top    = (screen.height - height)/2;
 var params = 'width='+width+', height='+height;
 params += ', top='+top+', left='+left;
 params += ', directories=no';
 params += ', location=no';
 params += ', menubar=no';
 params += ', resizable=yes';
 params += ', scrollbars=yes';
 params += ', status=no';
 params += ', toolbar=no';
 newwin=window.open(url,'windowname5', params);
 if (window.focus) {newwin.focus()}
 return false;
}
// -->
</script>
            <tr class="<?=$class?>" >
              <td width="30%" height="27" align="left" class="font2"><?=$item['email_subject']?></td>
              <td width="15%" align="left" class="font2"><?=$item['email_subject']?></td>
              <td width="15%" align="left" class="font2"><?=$item['email_subject']?>
              </td>
              <td width="15%" align="left" class="font2"><a href="javascript:void(0)" onClick="popup('view_list_result.php?type=failed&campid=<?=$camp_id?>&sendid=<?=$item['id']?>'); ">
                <?=$item["fail"]?>
                </a> </td>
              <td width="15%" align="left" class="font2"><a href="javascript:void(0)" onClick="popup('view_list_result.php?type=bounced&campid=<?=$camp_id?>&sendid=<?=$item['id']?>'); ">
                <?=$item["bounce"]?>
                </a> </td>
              <td width="15%" align="left" class="font2"><a href="javascript:void(0)" onClick="popup('view_list_result.php?type=sent&campid=<?=$camp_id?>&sendid=<?=$item['id']?>'); ">
                <?=$item["sent"]?>
                </a> </td>
              <td width="15%" align="left" class="font2"><input name="del[]" type="checkbox" id="del[]"  value="<?php echo $item['id']; ?>"/>
                </a> </td>
            </tr>
            <? 	$i++;  	ob_flush();
flush(); }?>
          </table>
        </div>
        <!--welcome admin end here-->
        <div id="chartdiv" style="width: 100%; height: 400px;"></div>
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