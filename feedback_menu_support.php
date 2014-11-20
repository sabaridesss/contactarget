<?php
include("smarty_config.php");
include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {
	$id = $_REQUEST['id'];
	
    $query = "select * from feedback_menu_support_tbl where fb_menu_id=".$id;
	$query_result = mysql_query($query);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	if($_REQUEST['delete']=="true") {
			$menus_id = $_REQUEST['id'];
			$id1 = $_REQUEST['id1'];
			$query = "delete from feedback_menu_support_tbl where id='".$menus_id."'";
			if(mysql_query($query))
			{	
				header("Location:feedback_menu_support.php?msg=4&id=$id1");		
			}
			else
			{
			 echo mysql_error();
			}
		
		
	}
}
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home page</title>
<style type="text/css">
<!--
#link_title {font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:20px;
font-weight:bold;
margin-left:32px;
color:#003333;
}
#title_name {font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
font-weight:bold;
margin-left:32px;
color:#006666;
}
-->
</style>

<style type="text/css">
<!--
.style3 {font-size: 12px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<script type="text/javascript">
function deleteContent1(str,action,parent_id)
{
var conf = confirm("Are you sure you wish to delete?");
if(!conf)
	{
		return false;
	} else {
		return true;
	}
}
</script>
</head>
<form name="content_add" method="post" action="" >
<body>
<table width="950" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
	<td align="right"><?php include("top_menu.php"); ?></td>
	
  </tr>
  <tr>
    <td width="167" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" align="left" valign="top"><table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="100%" align="left"><strong><font color="#FF0000">
          <?=$msg?>
          </font></strong>
            <div id="delete_content" style="color:#FF0000;font-weight:bold;margin-left:120px;"></div></td>
      </tr>
    </table>
      <table width="717" border="0" cellpadding="5">
        <tr>
          <td width="672" align="right"><a href="fb_menu_support_add.php?id=<?=$id;?>" ><strong>Add Value </strong></a> &nbsp; &nbsp;<a href="feedback_menu_edit.php?id=<?=$id;?>" ><strong>Close</strong></a></td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="style3"><strong>ID</strong></td>
        <td align="left" class="style3"><strong>Option Name </strong></td>
        <td align="left" class="style3"><strong>Option Value </strong></td>
		<td align="left" class="style3"><strong>Option Order</strong></td>
        <td class="style3"><strong> Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $bgcolor="#ffffff";
	   if(($i%2)==0)
	     $bgcolor="#f6f6f6";
	   ?>
	   
      <tr bgcolor="<?=$bgcolor?>" onmouseover="this.className='tableover'" onmouseout="this.className='dataclass'">
        <td width="3%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="20%" align="left" class="style3"><?=$item["name_show"]?></td>
        <td width="18%" align="left" class="style3"><?=$item["value"]?></td>
		<td width="12%" align="left" class="style3"><?=$item["order_id"]?></td>
        <td width="28%">
		<table width="100%"  border="0">
            <tr>
              <td width="44%" align="center"><a href="fb_menu_support_edit.php?menus_id=<?=$item["id"]?>" class="style3">Edit </a> </td>
              <td width="56%" align="center"><a href="feedback_menu_support.php?id=<?=$item["id"]?>&id1=<?=$id?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","");'> Delete</a> </td>
            </tr>
        </table></td>
      </tr>
      <? $i++; } ?>
    </table>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</form>
</html>

<body>


</body>
