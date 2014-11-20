<?php
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();
//include("top_menu.php");

//include('bounce.php');

 $id  = $_REQUEST['send_id'];
if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} 
	  
$Campaign_Blasts 	 = $php_mail->Campaign_Details_JOIN($id,$company_admin);
$Campaign_Details	 = mysql_fetch_assoc($Campaign_Blasts);
$c_name 		     = $Campaign_Details['c_name'];
$email_subject 		 = $Campaign_Details['email_subject'];
          

$no_of_clicked_Blasts_p 	 = $php_mail->clicked_Blasts_JOIN($id);
	
	

?>
<?php include ('common/tracking_count.php')?>
<?php include ('common/header.php')?>

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
           <?php include('common/tracking_views.php') ?>
          
        <div style="width:64%">
          <table border="0" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr class="table1">
              <td align="left" >URL</td>
              <td align="left" >Total Clicks</td>
            </tr>
            <?php 
				while($url=mysql_fetch_array($no_of_clicked_Blasts_p)){
				$Select_Blasts 	 = $php_mail->Select_Blast('click_rate','click_id',$url['click_id']);
				$item_cnt = mysql_num_rows($Select_Blasts);
				
					$class="table2";
					if(($i%2)==0)
					$class="table3";
            ?>
            <tr class="<?=$class?>" >
              <td width="15%" height="27" align="left" class="font2"><?=$url['url_subject'];?></td>
              <td width="15%" align="left" class="font2"><a href="click_view_details.php?click_id=<?=$url['click_id'];?>&send_id=<?=$id?>"><?=$item_cnt;?></a></td>
            </tr>
            <?php $i++; }?>
            </thead>
          </table>
        </div>
        <div style="clear:both"></div>
        <!--welcome admin end here-->
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