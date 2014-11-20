<?php
include("smarty_config.php");
include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$id = $_REQUEST['menus_id'];
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	$menu_order = $_REQUEST['menu_order'];
	$opt_id = $_REQUEST['hid_opt_id'];
	// Add Contents
	if($_POST['Submit']){
	
	if($page_name==''){
			$page_name = 'Nill';
	}
	
	
	$query = "update feedback_menu_support_tbl set name_show='".$title."', value='".$page_name."', order_id='".$menu_order."' where  id = '".$id."'";
	$rs = mysql_query($query);
			if($rs)
			{		
				header("location:feedback_menu_support.php?msg=3&id=$opt_id");
			}
			
	}
	
	
	$edit_query = "select * from `feedback_menu_support_tbl` where id='".$_REQUEST["menus_id"]."'";
	$edit_query_result = mysql_query($edit_query);
	while($edit_item = mysql_fetch_array($edit_query_result)){
	
				$menus_id = $edit_item["fb_menu_id"];
				$menus_name = $edit_item["name_show"];
				$page_name = $edit_item["value"];
				$menu_order = $edit_item["order_id"];
			
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

<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/cms.css" />
<script type="text/javascript" >
function redirect()
{
window.location = "main_page.php";
}
</script>
</head>

<body>
<form name="content_add" method="post" action="" >
<table width="950" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
<td align="right"><?php include("top_menu.php"); ?></td>
  </tr>
  <tr>
    <td width="178" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" valign="top"><table width="650" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      <tr>
        <td height="50" align="right">&nbsp;</td>
            <td width="232" id="link_title"><strong>Edit Option Value </strong></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right" valign="top" id="title_name">Main Menu Name:</td>
        <td colspan="2" align="left"><input type="text" name="title" id="title"  value="<?=$menus_name?>"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Page Name:</td>
        <td colspan="2" align="left"><input type="text" name="page_name" id="page_name" value="<?=$page_name?>" /></td>
      </tr>
	  <tr>
        <td align="right" valign="top" id="title_name">Menu Order:</td>
        <td colspan="2" align="left"><input type="text" name="menu_order" id="menu_order" value="<?=$menu_order?>" /></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
          <input type="submit" name="Submit" value="Update" />&nbsp;&nbsp;&nbsp;

		  <input type="button" name="Cancel" value="Cancel" onclick="return redirect()"/>
        </td>
        <td width="235" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="right"><input type="hidden" name="menus_id" value="<?= $id;?>" /></td>
        <td colspan="2"><input type="hidden" name="hid_opt_id" value="<?= $menus_id;?>" /></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>

</html>


