<?php
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();
//include("top_menu.php");

//include('bounce.php');

$id  = $_REQUEST['send_id'];
$click_id  = $_REQUEST['click_id'];
if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} 
	  
$Campaign_Blasts 	 = $php_mail->Campaign_Details_JOIN($id,$company_admin);
$Campaign_Details	 = mysql_fetch_assoc($Campaign_Blasts);
$c_name 		     = $Campaign_Details['c_name'];
$email_subject 		 = $Campaign_Details['email_subject'];
 
$Select_Blasts 	     = $php_mail->Select_Blast('template_urls','click_id',$click_id);
$Blasts_values		 = mysql_fetch_assoc($Select_Blasts);
$Url 		         = $Blasts_values['url_subject'];       
	
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
        <div class="unit nomargin">
  <ul class="campaign-data dotted-list">
    <li style="float:left; margin-left: 49px;"> 
    <span class="title fwb" style="width:60px;">URL:</span> 
    <span class="description" style="text-align:left"><a href="<?=$Url;?>" target="_blank"><?=$Url;?></a></span> </li>
  </ul>
</div>
          <table  border="0" align="center" class="table table-striped table-bordered bootstrap-datatable datatable" style="float:left">
          <thead>
            <tr class="table1">
              <td align="left" >Email</td>
              <td height="30" align="left" ><strong>First Name</strong></td>
              <td align="left" >Last Name</td>
              <td align="left" >Date & Time</td>
            </tr>
            <?php 
			$Click_View 	 = $php_mail->Click_View_JOIN($click_id);
			while($Click_Viewitem=mysql_fetch_array($Click_View)){
			$class="table2";
	        if(($i%2)==0)
	        $class="table3";
			?>
            <tr class="<?=$class?>" >
              <td width="15%" height="27" align="left" class="font2"><?=$Click_Viewitem['email'];?></td>
              <td width="15%" align="left" class="font2"><?=$Click_Viewitem['firstname'];?></td>
              <td width="15%" align="left" class="font2"><?=$Click_Viewitem['lastname'];?></td>
               <td width="15%" align="left" class="font2"><?=$Click_Viewitem['click_time'];?></td>
            </tr>
            <?php $i++;}?>
            <thead>
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