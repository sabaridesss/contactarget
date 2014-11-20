<?php
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");


 $query = "select * from `page_contents` where `cat_id` != 0";
	  
 $query_result = mysql_query($query);
 
 $msg = "";
if($_REQUEST["msg"] == '2'){
	$msg = "Contents Sucessfully Added";
	
}else if($_REQUEST["msg"] == '3'){

	$msg = "Contents Sucessfully Updated";
	
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
.style3 {font-size: 12px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>

<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<script src="javascript/validation.js" type="text/javascript"></script>
<script src="javascript/common.js" type="text/javascript"></script>
<script language="JavaScript" src="tigra_calendar/calendar_us.js"></script>
<script language="javascript" src="ajax/ajax_js.js"></script>
</head>
<form name="content_add" method="post" action="" enctype="multipart/form-data">
<body>
<table width="955" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td width="229" height="56"><a href="index.php"><strong>Show Content Mangement </strong></a></td>
    <td width="84"><a href="tap_menus.php"><strong> Tab Menus </strong></a></td>
    <td width="92"><a href="main_menus.php"><strong> Main Menus </strong></a></td>
    <td width="86"><a href="sub_menus.php"><strong> Sub Menus</strong></a></td>
    <td width="55"><a href="view_news.php"><strong>News</strong></a></td>
    <td width="101"><a href="logout.php"><strong>Logout</strong></a></td>
  </tr>
  <tr>
    <td width="222" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></strong></td>
    <td height="395" colspan="6" align="center" valign="top"><table width="381" border="0" cellpadding="5">
      <tr>
        <td width="367"><strong><font color="#FF0000">
          <?=$msg?>
          </font></strong>
		  <div id="delete_content" style="color:#FF0000; font-weight:bold; margin-left:120px;"></div>           </td>
      </tr>
    </table>
      <br />
      <table width="381" border="0" cellpadding="5">
        <tr>
          <td width="367"><strong>Sub Menus Content Management </strong></td>
        </tr>
      </table>
      <table width="101%" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="style3"><strong>ID</strong></td>
        <td align="left" class="style3"><strong>Main Menus</strong></td>
        <td align="left" class="style3"><strong>Sub Menus</strong></td>
        <td align="left" class="style3"><strong>Page Name</strong></td>
        <td class="style3"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $bgcolor="#ffffff";
	   if(($i%2)==0)
	     $bgcolor="#f6f6f6";
		 $cat_id = $item["cat_id"];
		 $menus_query = "select * from `main_category_list` where Main_category_ID='".$cat_id."'";
		 $menus_result = mysql_query($menus_query);
		  while($menus_item=mysql_fetch_array($menus_result)){
		  				 $menus_name = $menus_item["Main_category_name"];
		  }
		  
	   ?>
      <tr bgcolor="<?=$bgcolor?>" onmouseover="this.className='tableover'" onmouseout="this.className='dataclass'">
        <td width="3%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="35%" align="left" class="style3"><?=$menus_name?></td>
        <td width="31%" align="left" class="style3"><?=$item["sub_title"]?></td>
        <td width="13%" align="left" class="style3"><?=$item["page_name"]?></td>
        <td width="18%"><table width="100%"  border="0">
            <tr>
              <td width="24%" align="center"><a href="content_edit.php?content_id=<?=$item["id"]?>" class="style3"> <img src="../images/edit.gif" alt="edit" border="0" title="edit" /></a> </td>
              <td width="37%" align="center"><a href="javascript:void(0)" class="style3"> <img src="../images/delete.gif" alt="delete" border="0" title="delete" onclick='deleteContent(<?=$item["id"]?>,"delete_content")' /></a> </td>
            </tr>
        </table></td>
      </tr>
      <? $i++; } ?>
    </table></td>
  </tr>
</table>
</body>
</form>
</html>
