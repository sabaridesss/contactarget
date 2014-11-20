<?php
include("smarty_config.php");
//include("top_menu.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();
//include('bounce.php');

$camp_id  = $_REQUEST['campaign_id'];

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {
 
	
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Data Added Successfully.
</div>';	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Audience Updated Successfully.
</div>';	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Data Deleted Successfully.
</div>';	
	}
	else if($_REQUEST["msg"] == '5'){
	
		$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Data Deleted Successfully.
</div>';	
	}
	
if(isset($_REQUEST['Delete']) && $_REQUEST['Delete'] == 'Delete')
	{
		foreach($_POST['del'] as $key=>$value)
		{
		$del_pro=$_POST['del'][$key];
		
		 $update_qry1 =  "DELETE FROM compaign_name WHERE  company_admin='$company_admin' AND id = '$del_pro'";
		$exupdate1 = mysql_query($update_qry1);
		}
		header("Location:campaign_list.php?msg=4&campaign_id=".$camp_id);	
	}
	
	
if(isset($_REQUEST['Back']) && $_REQUEST['Back'] == 'Back')
	{
		
		header("Location:campaign.php");	
	}	
	
	

}
	
$total_subscribers  = $php_mail->get_user_total_records_count($company_admin);	

?>
<?php include ('common/header.php')?>
<script type="text/javascript">
function sort_check()
{
var sort1 = document.content_add.sort.value;
window.location = "campaign_list.php?campaign_id="+sort1;
}</script>

<form name="content_add" method="post" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <div>
            <?=$msg?>
          </div>
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="50%" align="center" valign="middle" colspan="4"><strong><font color="#47A4DA">Campaign Name:
                  <?php 
				 
				 
$viewSelect = "SELECT c_name FROM  campaign_list where company_admin='$company_admin' AND id=".$camp_id;
$exViewQuery = mysql_query($viewSelect);
$row = mysql_fetch_array($exViewQuery);
echo $row['c_name'];	
				 
				 ?>
                  </font></strong></td>
                <td width="55%" align="right" valign="middle"><a href="usermail_list.php" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> User List</a></td>
                <td width="5%" align="right" valign="middle">&nbsp;</td>
                <!--  <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="mail_subscribers.php">Email Tool</a></div></td>
       <td width="25%" align="right" valign="middle">&nbsp;</td>
     <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="campaign.php">Campaign </a></div></td>-->
              </tr>
            </table>
          </div>
          <div class="content">
            <table width="100%" border="0" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
              <thead>
                <tr class="table1">
                  <td align="left" >S.NO</td>
                  <td align="left" >Report On</td>
                  <td height="20" align="left" ><strong>Subject Name</strong></td>
                  <td align="left" >Success Rate</td>
                  <td align="left" >Open Rate</td>
                  <td align="left" >Click Rate</td>
                  <td align="left" >PDF</td>
                  <td align="left" >Tracking Report</td>
                  <td align="left" >View Report</td>
                  <td align="left" >Delete</td>
                </tr>
              </thead>
              <? 
    $query2="SELECT A.*,(select count(*) from comp_user_tbl B where A.id=B.send_id and no_of_sent =1) as success,(select count(*) from comp_user_tbl C where A.id=C.send_id and no_of_read =1) as Open,(select count(*) from  click_rate D where A.id = D.email_subject_id and no_of_counts =1) as Click,(select count(*) from   template_urls E where A.id = E.email_subject_id ) as url_count , pdfname as pdfname  , (select created_date from comp_user_tbl F where A.id=F.send_id  and F.company_admin='$company_admin' order by created_date DESC limit 0,1   ) as reporton  
 FROM compaign_name A  where A.company_admin='$company_admin' and A.camp_id = ".$camp_id."  group by A.id order by  reporton  DESC";		  


	$query_result = mysql_query($query2);
	
	  $i =1;
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
                <td width="2%" align="left" class="font2"><?=$i?></td>
                <td width="10%" align="left" class="font2"><?=date("d-M-Y h:i A", strtotime($item["reporton"])) ?>
                </td>
                <td width="25%" height="27" align="left" class="font2"><?=$item['email_subject']?></td>
                <td width="15%" align="left" class="font2"><?php $success_rate  = ($item['success']/$total_subscribers)*100 ; echo number_format($success_rate, 2, '.', '');  ?>
                  %</td>
                <td width="15%" align="left" class="font2"><?php  $open_rate  = ($item['Open']/$total_subscribers)*100 ; echo number_format($open_rate, 2, '.', '');  ?>
                  %</td>
                <td width="15%" align="left" class="font2"><?php $click_rate =  (($item['Click']/$total_subscribers)*100)/$item['url_count'] ; echo number_format($click_rate, 2, '.', '');  ?>
                  %</a> </td>
                <td width="15%" align="left" class="font2"><?php if(trim($item["pdfname"])!="") { ?>
                  <a class="btn btn-success" target="_blank" href="pdf/<?=$item["pdfname"]?>"> <i class="icon-zoom-in icon-white"></i> Download PDF </a>
                  <?php } else { ?>
                  Pdf Not Specified
                  <?php } ?>
                </td>
                <td width="15%" align="left" class="font2"><a class="btn btn-success" href="track_list_campaign.php?send_id=<?=$item["id"]?>"> <i class="icon-zoom-in icon-white"></i> Tracking <br />Report </a> </td>
                <td width="15%" align="left" class="font2"><a class="btn btn-success" href="subject_report.php?id=<?=$item["id"]?>"> <i class="icon-zoom-in icon-white"></i> View  Report </a> </td>
                <td width="15%" align="left" class="font2"><input name="del[]" type="checkbox" id="del[]"  value="<?php echo $item['id']; ?>"/>
                  </a> </td>
              </tr>
              <? 	$i++;  	ob_flush();
flush(); }?>
              <tr>
                <td height="30" align="center" colspan="8" ><input type="submit" name="Back" value="Back" class="btn btn-large btn-primary" /></td>
                <td align="center"><input name="Delete" type="submit" id="Delete" value="Delete" class="btn btn-large  btn-danger"  onClick="return deleteContent1();"/></td>
              </tr>
            </table>
          </div>
          <!--welcome admin end here-->
        </div>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here--></td>
    </tr>
  </table>
</form>
</div>
</center>
</body></html>