<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

     $query2= "select * from   compaign_name where company_admin='$company_admin' and status='complete' order by id desc";
	$query_result = mysql_query($query2);
	$count_save_mail=mysql_num_rows($query_result);

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = '<div class="alert alert-success">

<strong>Success!</strong>
Your Mail Saved Successfully.
</div> ';	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg =  '<div class="alert alert-success">

<strong>Success!</strong>
Your Mail Updated Successfully.
</div> ';	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = '<div class="alert alert-info">
<button type="button" data-dismiss="alert" class="close"></button>
<strong>Success!</strong>Your
Mail Deleted Successfully.
</div>';	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from compaign_name where company_admin='$company_admin' and id =".$id;
		if(mysql_query($query)) {
					header("Location:savedmail_list.php?msg=4");		
				}
	}
	
	
	
	
	
	
	
		if($_REQUEST["id"]!="" && $_REQUEST["camp_id"]!="") {
		
$query_up_camp= "UPDATE  compaign_name, (  SELECT org_content as old_content,template_type as old_template_type  FROM compaign_name where id = ".$_REQUEST["id"]."  ) compaign_name
SET compaign_name.org_content = old_content,template_type=old_template_type
WHERE id = ".$_REQUEST["camp_id"]; 

$query_result = mysql_query($query_up_camp);
if(!$query_result)
echo mysql_error();
else
header("Location:edit_dynamic_template.php?id=".$_REQUEST["id"]."&camp_id=".$_REQUEST["camp_id"]);	

}
	
	

	
	
}
?>
<?php include ('common/header.php')?>
<script type="text/javascript">
<!--
function getConfirmation(){
   var retVal = confirm("Do you want to Delete ?");
   if( retVal == true ){
     
	  return true;
   }else{
    
	  return false;
   }
}
//-->
</script>
<link rel="stylesheet" href="css/tinypopup_style.css" />
<script type="text/javascript" src="javascript/tinybox.js"></script>
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
              <td width="55%" align="center" valign="middle"><strong><font color="#FF0000"> </font></strong></td>
              <td width="25%" align="right" valign="middle"><!--<div class="addmenu"><a href="add_templates_email.php">Add Template</a> </div>--></td>
            </tr>
          </table>
        </div>
        <div class="content">
          <table width="100%" border="0" align="center" >
            <tr class="table1">
              <td height="30" align="center" class="style6"><strong>ID</strong></td>
              <td align="left" class="style6"><strong>Date </strong></td>
              <td align="left" class="style6"><strong>Campaign</strong></td>
              <td align="left" class="style6"><strong> Subject </strong></td>
              <!--<td align="left" class="style6"><strong>Image </strong></td>-->
              <td  align="left" class="style6"><strong>Action</strong></td>
            </tr>
            <? 
		  if($count_save_mail > 0)
		  {
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";
 
          
			$campaign  =  "select * from campaign_list where id = ".$item["camp_id"];
			$displayQuery = mysql_query($campaign);
			$displayresults = mysql_fetch_array($displayQuery);
		
	
	   ?>
            <tr class="<?=$class?>">
              <td width="4%" height="27" align="center" class="style6"><?=$i?></td>
              <td width="20%" align="left" class="style6"><?=$item["data_updated"]?></td>
              <td width="30%" align="left" class="style6"><?=$displayresults["c_name"]?></td>
              <td width="30%" align="left" class="style6"><?=$item["email_subject"]?></td>
              <td width="24%"><table width="100%"  border="0">
                  <tr>
                    <!--<td width="31%" align="center"><a onclick="TINY.box.show({url:'preview_email.php',post:'id=<?=$item["id"]?>',boxid:'frameless',fixed:false,closejs:function(){closeJS()}})">Preview</a> </td>-->
                    <td width="30%" align="center"><form name="content_add<?=$i?>" method="post" action="" >
                        <input type="hidden" name="id" value="<?=$item["id"]?>" id="id" readonly="readonly" />
                        <input type="hidden" name="camp_id" value="<?=$_REQUEST["camp_id"]?>" id="camp_id" readonly="readonly" />
                        <input type="submit" class="btn btn-large btn-primary" value="Select" id="Send" name="Send">
                      </form></td>
                    <!--<td width="31%" align="center"><a onclick="return getConfirmation();" href="savedmail_list.php?id=<?=$item["id"]?>&delete=true" class="style6" > Delete</a> </td>-->
                  </tr>
                </table></td>
            </tr>
            <? $i++; } } else { ?>
            <tr class="table3">
              <td width="4%" height="27" align="center" colspan="4" class="style6"> No Saved Content Available</td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <?php
			$camp_id = $_REQUEST['camp_id'];
			if($camp_id != "")
			{
			?>
        <div align="center">
          <ul id="status-page"  class="status-page">
            <li class="step step1 "> <a href="select_campaign.php?camp_id=<?=$camp_id;?>" class="" id="step1">Campaigns</a> </li>
            <li class="step step2 current"> <a href="select_template.php?camp_id=<?=$camp_id;?>" class="" id="step1">Template Selection</a> </li>
            <?php 
               if($item_save['template_type']!= "")
			   {
             
                  if($item_save['template_type'] == 'static')
				  {
				  ?>
            <li class="step step3  "><a   href="javascript:void(0);" class="" id="step3">Design</a> </li>
            <?php
				}
				else
				{
			?>
            <li class="step step3  "><a   href="javascript:void(0);" class="" id="step3">Design</a> </li>
            <?php
			    }
			?>
            <?php
			  } else {  ?>
            <li class="step step3  "><a  href="javascript:void(0);" class="" id="step3">Design</a> </li>
            <?php  }   if(trim($item_save['mail_content'])!="") {  ?>
            <li class="step step5  last"> <a href="preview_blast.php?camp_id=<?=$camp_id;?>" class="" id="step5">Preview</a> </li>
            <?php } else {  ?>
            <li class="step step5  last"> <a href="javascript:void(0);" class="" id="step5">Preview</a> </li>
            <?php } ?>
          </ul>
        </div>
        <?php
			}
			?>
        <div  style="clear:both;"></div>
        <br />
        <!--welcome admin end here-->
      </div>
      <!--footer start here-->
      <?php include('common/footer.php'); ?>
      <!--footer end here-->
    </td>
  </tr>
</table>
</div>
</center>
</body></html>