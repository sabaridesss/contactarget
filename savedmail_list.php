<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

     $query2= "select * from   compaign_name where company_admin='$company_admin' and status='' order by id desc";
	$query_result = mysql_query($query2);
	$count_save_mail=mysql_num_rows($query_result);

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = '<div class="alert alert-success">

<strong> Success ! </strong>
Your Mail Saved Successfully.
</div> ';	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg =  '<div class="alert alert-success">

<strong>Success ! </strong>
Your Mail Updated Successfully.
</div> ';	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = '<div class="alert alert-info">
<button type="button" data-dismiss="alert" class="close"></button>
<strong>Success ! </strong>Your
Mail Deleted Successfully.
</div>';	
	}else if($_REQUEST["msg"] == '5'){
	
		$msg = '<div class="alert alert-info">
<button type="button" data-dismiss="alert" class="close"></button>
<strong>Success ! </strong>Your
Mail scheduled Successfully.
</div>';	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from compaign_name where company_admin='$company_admin' and id =".$id;
		if(mysql_query($query)) {
					header("Location:savedmail_list.php?msg=4");		
				}
	}
	
	
	
	
	
	if($_REQUEST['Edit']) {
		$id = $_REQUEST['id'];
		

					header("Location:select_campaign.php?camp_id=".$id);		
				
	}
	
	if($_REQUEST['Copy']) {
		$id = $_REQUEST['id'];
		$sub_name = $_REQUEST['sub_name'];
 $query = "INSERT INTO `compaign_name` ( camp_id,email_subject , company_admin, from_name, from_email, to_address ,mail_content,org_content,template_type,pdfname,template_id ,status)
		  SELECT camp_id,  '".$sub_name."' , company_admin, from_name, from_email, to_address ,mail_content,org_content,template_type,pdfname,template_id  ,status
		  FROM `compaign_name`
		  WHERE `id`=".$id;
		  if(mysql_query($query)) {
					header("Location:savedmail_list.php?msg=3");	} }		
	
	
	
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
              <td width="25%" align="right" valign="middle"><!--<div class="addmenu">time now <?php echo date("H:i:s");?> </div>--></td>
            </tr>
          </table>
        </div>
        <div class="content">
          <style > 
form {
    margin: 0 0 0 0 !important;
}
</style>
          <table width="100%" border="0" align="center" >
            <tr class="table1">
              <td height="30" align="center" class="style6"><strong>ID</strong></td>
              <td align="left" class="style6"><strong>Date </strong></td>
              <td align="left" class="style6"><strong>Campaign</strong></td>
              <td align="left" class="style6"><strong> Subject </strong></td>
              <td align="left" class="style6"><strong> Group </strong></td>
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
 
          
			$campaign  =  "select c_name from campaign_list where id = ".$item["camp_id"];
			$displayQuery = mysql_query($campaign);
			$displayresults = mysql_fetch_array($displayQuery);
		
	
	   ?>
            <tr class="<?=$class?>">
              <td width="4%" height="27" align="center" class="style6"><?=$i?></td>
              <td width="20%" align="left" class="style6"><?php echo date("d-M-Y h:i A", strtotime($item["data_updated"])); echo "<br>"; if($item["schedule_mail"] > date("Y-m-d H:m:s") ) echo " <br> Scheduled On:".$item["schedule_mail"];  ?></td>
              <td width="30%" align="left" class="style6"><?=$displayresults["c_name"]?></td>
              <td width="30%" align="left" class="style6"><?php echo $item["email_subject"];  ?></td>
              <td width="30%" align="left" class="style6"><?php 
			 
			 $name_to_val=count(unserialize(stripslashes($item["to_address"])));
			
			
			 if($name_to_val!=0) { 
			 $i_val=1;
			 foreach(unserialize(stripslashes($item["to_address"])) as $value_counte)
			 {
			 print_r($value_counte);
			 if($i_val!=$name_to_val)
			 echo ",";
			  $i_val++;
			 
			 } }
			 ?></td>
              <td width="24%"><table width="100%"  border="0">
                  <form name="content_add<?=$i?>" method="post" action="" >
                    <tr>
                      <!--<td width="31%" align="center"><a onclick="TINY.box.show({url:'preview_email.php',post:'id=<?=$item["id"]?>',boxid:'frameless',fixed:false,closejs:function(){closeJS()}})">Preview</a> </td>-->
                      <td width="30%" align="center"><input type="hidden" name="id" value="<?=$item["id"]?>" id="id" readonly="readonly" />
                        <input type="hidden" name="camp_id" value="<?=$item["camp_id"]?>" id="camp_id" readonly="readonly" />
                        <input type="hidden" name="sub_name" value="<?=$item["email_subject"]?>-copy" id="sub_name" readonly="readonly" />
                        <input type="submit" class="btn btn-large btn-info " value="Edit" id="Edit" name="Edit">
                      </td>
                      <td><input type="submit" class="btn btn-large btn-primary" value="Copy" id="Copy" name="Copy"></td>
                      <td width="31%" align="center"><a onclick="return getConfirmation();" href="savedmail_list.php?id=<?=$item["id"]?>&delete=true" class="btn btn-large btn-danger" > Delete</a> </td>
                    </tr>
                  </form>
                </table></td>
            </tr>
            <? $i++; } } else { ?>
            <tr class="table3">
              <td width="4%" height="27" align="center" colspan="4" class="style6"> No Saved Content Available</td>
            </tr>
            <?php } ?>
          </table>
        </div>
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