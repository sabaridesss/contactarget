<?php
ob_start();
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");
include("fckeditor/fckeditor.php");

// Add Contents
if(isset($_POST['Submit'])){

 $news_title = $_REQUEST["news_title"];
 $publish_date =  $_REQUEST['publish_date'];
 $short_desc = $_REQUEST['short_desc'];
 $brief_desc = $_REQUEST['brief_desc'];

$query = "insert into news_tbl1(newspub_date,news_title,short_desc,brief_desc)values('".$publish_date."','".$news_title."','".$short_desc."','".$brief_desc."')";
	$rs = mysql_query($query);

 	if($rs){
		//echo 'suceesfully added';
			header("location:view_news.php?msg=2");
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
<script language="JavaScript" src="tigra_calendar/calendar_us.js"></script>
<link rel="stylesheet" type="text/css" href="tigra_calendar/calendar.css" />

</head>
<form name="content_add" method="post" action="" >

<body>
<table width="980" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td width="179" height="56"><a href="index.php"><strong>Show Content Mangement </strong></a></td>
    <td width="84"><a href="content_add.php"><strong>Add Content</strong></a></td>
    <td width="79"><a href="tab_menus.php"><strong> Tab Menus </strong></a><a href="logout.php"></a></td>
    <td width="97"><a href="main_menus.php"><strong> Main Menus </strong></a></td>
    <td width="88"><a href="sub_menus.php"><strong> Sub Menus </strong></a></td>
    <td width="61"><a href="view_news.php"><strong> News </strong></a></td>
    <td width="168"><a href="logout.php"><strong>Logout</strong></a></td>
  </tr>
  <tr>
    <td width="126" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="7" valign="top"><table width="825" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      <tr>
        <td width="135" height="50" align="right">&nbsp;</td>
            <td width="234" id="link_title"><strong>News Details </strong></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">News-Title:</td>
        <td colspan="2" align="left"><input type="text" name="news_title" id="news_title" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Publish Date: </td>
        <td colspan="2" align="left">
		<input name="publish_date" type="text" id="publish_date" style="width:70px; ">
		&nbsp;<script language="JavaScript">
	new tcal ({
		// form name
		'formname': 'content_add',
		// input name
		'controlname': 'publish_date'
	});

	</script>
		</td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Short - Description:</td>
        <td colspan="2" align="left"><textarea name="short_desc" cols="80" rows="5" id="short_desc"></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Brief - Description:</td>
        <td colspan="2" align="left"><textarea name="brief_desc" cols="80" rows="20" id="brief_desc"></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="center"><label>
          <input type="submit" name="Submit" value="Add" />
        </label></td>
        <td width="243" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</form>
</html>

<body>


</body>
