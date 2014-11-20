<?php
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");
include("fckeditor/fckeditor.php");

$content_id = $_REQUEST["content_id"];
$child_id = $_REQUEST['child_id'];
$sub_title = $_REQUEST['sub_title'];
$content =  $_REQUEST['content'];

// Add Contents
if(isset($_POST['Submit'])){

	 $query = "INSERT INTO childtaps_tpl(child_id,tap_title,tap_description)VALUES('$child_id','$sub_title','$content')";
		
		$rs = mysql_query($query);
		if($rs){
		//echo 'suceesfully added';
			header("location:showchild_tap_menus.php?msg=1");
		}
 
}

$subcat_query = "select * from sub_subpagecontents";
$subcat_result = mysql_query($subcat_query);

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
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				if(response==="success"){
					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});
</script>


</head>
<form name="content_add" method="post" action="">
<body>
<table width="946" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td width="303" height="56" align="center"><a href="index.php"><strong>Show Content Mangement </strong></a></td>
    <td width="109" align="left"><a href="tap_menus.php"><strong>Tab Menus</strong></a></td>
    <td width="128"><a href="main_menus.php"><strong> Main Menus</strong></a></td>
    <td width="106"><a href="sub_menus.php"><strong> Sub Menus</strong></a></td>
    <td width="67"><a href="logout.php"><strong>Logout</strong></a><a href="logout.php"></a></td>
  </tr>
  <tr>
    <td width="132" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="4" valign="top"><table width="650" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      
      <tr>
        <td width="123" height="46" align="right" valign="top" id="title_name">&nbsp;</td>
        <td align="left" id="link_title"><strong>Taps Names</strong></td>
        <td align="left"><a href="showchild_tap_menus.php"><strong>Show Child Tab Menus</strong></a></td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="top" id="title_name">Sub Menus:
          <select name="child_id" id="child_id">
            <option value="0">--Select--</option>
            <? while($subcat_row=mysql_fetch_array($subcat_result)) {?>
            <option value="<?=$subcat_row['sub_id']?>">
              <?=$subcat_row['sub_title']?>
              </option>
            <? }?>
                  </select></td>
        </tr>
      <tr>
        <td colspan="3" align="left" valign="top" id="title_name">Sub Title:
           &nbsp;&nbsp;<input type="text" name="sub_title" id="sub_title" /></td>
        </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Content:</td>
        <td colspan="2"><?php
			
			$oFCKeditor           = new FCKeditor('content') ;
			$oFCKeditor->BasePath = 'fckeditor/';
			$oFCKeditor->Value    =  $content;
			$oFCKeditor->Width    = '700';
			$oFCKeditor->Height   = '350px';
			$oFCKeditor->Create();
			
			
      ?></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td width="257" align="center"><label>
          <input type="submit" name="Submit" value="Add" />
        </label></td>
        <td width="232" align="center">&nbsp;</td>
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
