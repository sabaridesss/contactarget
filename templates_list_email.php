<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

    $query2= "select * from emailnl_template_tbl where  company_admin='$company_admin' ";
	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = " Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from emailnl_template_tbl where company_admin='$company_admin' and id =".$id;
		if(mysql_query($query)) {
					header("Location:templates_list_email.php?msg=4");		
				}
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
<form name="content_add" method="post" action="" >
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
            <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
            <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
              <?=$msg?>
              </font></strong></td>
            <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_templates_email.php">Add Template</a> </div></td>
          </tr>
        </table>
      </div>
      <div class="content">
        <table width="100%" border="0" align="center" >
          <tr class="table1">
            <td height="30" align="center" class="style6"><strong>ID</strong></td>
            <td align="left" class="style6"><strong> Template Name </strong></td>
            <!-- <td align="left" class="style6"><strong>Image </strong></td>-->
            <td class="style6"><strong>Action</strong></td>
          </tr>
          <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";

	
	   ?>
          <tr class="<?=$class?>">
          
          <td width="4%" height="27" align="center" class="style6"><?=$i?></td>
          <td width="34%" align="left" class="style6"><?=$item["title"]?></td>
          <!--<td width="15%" align="left" class="style6"><?php $path = "mail_logo/temp/";		
?>
            <img src="<?=$path.$item['image']?>" alt="<?=$item["title"]?>" width="120px" height="120px" > </td>-->
          <td width="17%">
          
          <table width="100%"  border="0">
            <tr>
              <!--<td width="31%" align="center"><a onclick="TINY.box.show({url:'preview_email.php',post:'id=<?=$item["id"]?>',boxid:'frameless',fixed:false,closejs:function(){closeJS()}})">Preview</a> </td>-->
              <td width="21%" align="center"><a href=" add_templates_email.php?id=<?=$item["id"]?>" class="style6">Edit </a> </td>
              <td width="31%" align="center"><a onclick="return getConfirmation();" href="templates_list_email.php?id=<?=$item["id"]?>&delete=true" class="style6" > Delete</a>
            </td>
            
            </tr>
            
          </table>
          </td>
          
          </tr>
          
          <? $i++; } ?>
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
</form>
</div>
</center>
</body></html>