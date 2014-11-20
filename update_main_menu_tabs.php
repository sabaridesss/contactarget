<?php
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");
include("fckeditor/fckeditor.php");

$tabs_id = $_REQUEST['tabs_id'];
$content_id = $_REQUEST["content_id"];
$tabsub_id = $_REQUEST['sub_id'];
$sub_title = $_REQUEST['sub_title'];
$content =  $_REQUEST['content'];


// Add Contents
if(isset($_POST['Update'])){

	  $query = "update `main_tabs_tbl` set `main_cat_id`  ='".$tabsub_id."', `tap_title` ='".$sub_title."', `tap_description` ='".$content."' 
where `tab_id` = '".$tabs_id."'";
		//exit;
		$rs = mysql_query($query);
		if($rs){
		//echo 'suceesfully added';
			header("location:edit_main_menu_tabs.php?msg=2");
		}
 
}

$tabs_query = "select * from main_tabs_tbl where `tab_id` = '".$tabs_id."' ";
$tabs_result = mysql_query($tabs_query);
while($edit_item = mysql_fetch_array($tabs_result)){ 
			$tap_id = $edit_item["tap_id"];
			$main_cat_id = $edit_item["main_cat_id"];
			$tap_title = $edit_item["tap_title"];
			$tap_description = $edit_item["tap_description"];
}

$subcat_query = "select * from main_category_list";
$subcat_result = mysql_query($subcat_query);

$subcat_query1 = "select * from main_category_list where Main_category_ID = '".$main_cat_id."'";
$subcat_result1 = mysql_query($subcat_query1);
while($edit_item = mysql_fetch_array($subcat_result1)){ 
			//$id = $edit_item["id"];
			$sub_title1 = $edit_item["Main_category_name"];
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
        <td width="123" height="50" align="right">&nbsp;</td>
            <td width="257" id="link_title"><strong>Taps Names</strong></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="top" id="title_name">Sub Menus: 
          <select name="sub_id" id="sub_id">
          <option value="0">--Select--</option>
          <? while($subcat_row=mysql_fetch_array($subcat_result)) 

             {
            if($main_cat_id == $subcat_row['Main_category_ID'])

            {
  
		  ?>
<option value="<?=$subcat_row['Main_category_ID']?>" selected="selected">
          <?=$subcat_row['Main_category_name']?>
          </option>
       <?php }else {?>
          <option value="<?=$subcat_row['Main_category_ID']?>">
          <?=$subcat_row['Main_category_name']?>
          </option>
          <? } }
 
             ?>
        </select>        </td>
        </tr>
      <tr>
        <td colspan="3" align="left" valign="top" id="title_name">Sub Title: 
          <input type="text" name="sub_title" id="sub_title" value="<?=$tap_title?>" /></td>
        </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Content:</td>
        <td colspan="2"><?php
			
			$oFCKeditor           = new FCKeditor('content') ;
			$oFCKeditor->BasePath = 'fckeditor/';
			$oFCKeditor->Value    =  $tap_description;
			$oFCKeditor->Width    = '700';
			$oFCKeditor->Height   = '350px';
			$oFCKeditor->Create();
			
			
      ?></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="center"><label>
          <input name="Update" type="submit" id="Update" value="Update" />
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
