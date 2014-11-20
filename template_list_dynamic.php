<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{




	if($_REQUEST["next"])
	{
	
	if($_REQUEST["tid"]!="" && $_REQUEST["camp_id"]!="") {
	
	
	
	
	
	
	
$query_up_camp= "UPDATE  compaign_name, (
    SELECT emailnl_template_tbl.id, emailnl_template_tbl.content 
    FROM emailnl_template_tbl where id = ".$_REQUEST["tid"]."  ) emailnl_template_tbl
SET compaign_name.org_content = emailnl_template_tbl.content,compaign_name.template_type='static',
compaign_name.mail_content = emailnl_template_tbl.content,
compaign_name.template_id = emailnl_template_tbl.id
WHERE compaign_name.id = ".$_REQUEST["camp_id"];

$query_result = mysql_query($query_up_camp);
if(!$query_result)
echo mysql_error();
else
header("Location:edit_dynamic_template.php?id=".$_REQUEST["tid"]."&camp_id=".$_REQUEST["camp_id"]);	

}	
	
	}

   $query2= "select * from  emailnl_template_tbl where image!='' order by title ASC";
 
	$query_result = mysql_query($query2);
	$count_save_mail=mysql_num_rows($query_result);

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = " Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Sucessfully deleted";	
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

function onsettemplate(id,campid)
{

window.location.href = 'edit_dynamic_template.php?id='+id+'&camp_id='+campid; 
}


//-->
</script>
<style>
#preview {
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
}
.group li {
	list-style:none;
	float:left;
	display:inline;
	margin-right:10px;
	width:211px;
	height:271px;
}



</style>
<link rel="stylesheet" href="css/tinypopup_style.css" />
<script type="text/javascript" src="javascript/tinybox.js"></script>
<script src="javascript/tooltip-main.js" type="text/javascript"></script>
<table width="1200px" border="0" cellpadding="0">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td align="center" class="top"><?php include('common/top_menu.php') ?>
      <div class="wholesite-inner">
        <!--welcome admin start here-->
        <div class="welcome-admin">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
              <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                <?=$msg?>
                </font></strong></td>
              <td width="25%" align="right" valign="middle"><!--<div class="addmenu"><a href="add_templates_email.php">Add Template</a> </div>--></td>
            </tr>
          </table>
        </div>
        <div class="content" style="min-height:500px;">
          <h1  style="margin-bottom:12px;" >Pick a template to start with</h1>
          <ul class="group">
            <?php if($count_save_mail>0)
		   {
		   $valadd=1;
		while ($row = mysql_fetch_array($query_result)) { 
		   
		   ?>
            <li ><a href="images/<?=$row['image']?>" title="<?=$row['title']?>"  class="preview"><img onClick="onsettemplate('<?=$row['id']?>','<?=$_REQUEST['camp_id']?>')" height="150px" width="150px" src='images/<?=$row['image']?>' alt="<?=$row['title']?>" title="<?=$row['title']?>"  /></a><br>
              <p align="center">
                <?=$row['title']?>
              </p>
              <br>
              <form name="content_add<?=$valadd?>" method="post" action="" >
                <input type="hidden" readonly name="next" value="next" id="next">
                <input type="hidden" readonly name="tid" value="<?=$row['id']?>" id="tid">
                <input type="hidden" readonly name="camp_id" value="<?=$_REQUEST['camp_id']?>" id="camp_id">
                <input type="image" src="images/sel-button.png" name="submit" value="submit" style="width:73px; height:34px;">
              </form>
            </li>
            <?php $valadd++; ?>
            <?php }  }
		   ?>
          </ul>
          <div  style="clear:both"><br />
          </div>
        </div>
        <!--welcome admin end here-->
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
               if($template_type != "")
			   {
             
                  if($template_type == 'static')
				  {
				  ?>
            <li class="step step3  "><a   href="edit_dynamic_template.php?camp_id=<?=$camp_id;?>" class="" id="step3">Design</a> </li>
            <?php
				}
				else
				{
			?>
            <li class="step step3  "><a   href="dynamic_template.php?camp_id=<?=$camp_id;?>" class="" id="step3">Design</a> </li>
            <?php
			    }
			?>
            <?php
			  } else {  ?>
            <li class="step step3  "><a  href="javascript:void(0);" class="" id="step3">Design</a> </li>
            <?php  }   if(trim($org_content)!="") {  ?>
            <li class="step step5  last"> <a href="preview_blast.php?camp_id=<?=$camp_id;?>" class="" id="step5">Preview</a> </li>
            <?php } else {  ?>
            <li class="step step5  last"> <a href="javascript:void(0);" class="" id="step5">Preview</a> </li>
            <?php } ?>
          </ul>
        </div>
        <?php
			}
			?>
        <div  style="clear:both;"><br />
          <table>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
        </div>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
      </div>
      <!--footer end here-->
    </td>
  </tr>
</table>
</center>
</body></html>