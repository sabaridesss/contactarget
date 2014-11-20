<?php
include("smarty_config.php");
include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$id = $_REQUEST['id'];
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	$menu_order = $_REQUEST['menu_order'];
	
	// Add Contents
	if(isset($_POST['Submit']) && $_POST['Submit'] == "Add"){
	
		if($page_name==''){
				$page_name = 'Nill';
		}
	
		$query = "INSERT INTO feedback_menu_support_tbl(fb_menu_id,name_show,value,order_id)VALUES('".$id."','".$title."','".$page_name."','".$menu_order."')";
		$rs = mysql_query($query);
		if($rs){
					header("location:fb_menu_support_add.php?msg=2&id=$id");
				}	 
	}
	
	if(isset($_POST['close']) && $_POST['close'] == "Close") {
		header("location:feedback_menu_support.php?id=$id");
	}
	
	if($_REQUEST['msg']==2){
		$msg = "Option Added";
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
</head>
<body>
<form name="content_add" method="post" >
<table width="963" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
<td align="right"><?php include("top_menu.php"); ?></td>
  </tr>
  <tr>
    <td width="173" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" valign="top"><table width="650" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      <tr>
        <td height="50" align="right">&nbsp;</td>
            <td width="232" id="link_title"><strong>Add Option Value </strong></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right" valign="top" id="title_name">Option Name :</td>
        <td colspan="2" align="left"><input type="text" name="title" id="title" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Option Value :</td>
        <td colspan="2" align="left"><input type="text" name="page_name" id="page_name" /></td>
      </tr>
	  <tr>
        <td align="right" valign="top" id="title_name">Option Order:</td>
        <td colspan="2" align="left"><input type="text" name="menu_order" id="menu_order" /></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="left"><label>
          <input type="submit" name="Submit" value="Add" />
		  &nbsp;&nbsp;
		  <input type="submit" id="close" name="close" value="Close" />
        </label></td>
       
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2"><input type="hidden" name="id" value="<?= $id;?>" /><div style="color:#FF0000;"><b><?php echo $msg;?></b></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>

</html>


