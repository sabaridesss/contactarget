<?php
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");
include("fckeditor/fckeditor.php");

$content_id = $_REQUEST["content_id"];

$sub_id = $_REQUEST['sub_id'];
$sub_title = $_REQUEST['sub_title'];
$content =  $_REQUEST['content'];
$cat_id = $_REQUEST['cat_id'];
$action = $_REQUEST['action'];

$cat_query = "select * from main_category_list";
$cat_result = mysql_query($cat_query);


// Add Contents
if(isset($_POST['Submit'])){

if($_REQUEST['action'] == "tabs_for_main_menu")
{
/*echo $cat_id;
echo "<br>";
echo $sub_title;
echo "<br>";
echo $content;
exit;*/
        $query = "INSERT INTO main_tabs_tbl(main_cat_id,tap_title,tap_description)VALUES('$cat_id','$sub_title','$content')";
		
		$rs = mysql_query($query);

}else{

	    $query = "INSERT INTO taps_tpl(sub_id,tap_title,tap_description)VALUES('$sub_id','$sub_title','$content')";
		
		$rs = mysql_query($query);

}

//	 $query = "INSERT INTO taps_tpl(sub_id,tap_title,tap_description)VALUES('$sub_id','$sub_title','$content')";
		
//		$rs = mysql_query($query);
		if($rs){
		//echo 'suceesfully added';
			header("location:tap_menus.php?msg=1");
		}
 
}

$subcat_query = "select * from page_contents";
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
        <td align="left"><a href="childtaps_add.php"><strong>Add Child Tabs </strong></a></td>
      </tr>
<?php if($action == "tabs_for_main_menu") { ?>
<tr><td colspan="3" id="title_name">Main Menus:<select name="cat_id" id="cat_id">
            <option value="0">--Select--</option>
            <? while($cat_row=mysql_fetch_array($cat_result)) {?>
            <option value="<?=$cat_row['Main_category_ID']?>">
              <?=$cat_row['Main_category_name']?>
              </option>
            <? }?>
          </select></td></tr>
<?php }else{ ?>
      <tr>
        <td colspan="3" align="left" valign="top" id="title_name">Sub Menus:
          <select name="sub_id" id="sub_id">
            <option value="0">--Select--</option>
            <? while($subcat_row=mysql_fetch_array($subcat_result)) {?>
            <option value="<?=$subcat_row['id']?>">
              <?=$subcat_row['sub_title']?>
              </option>
            <? }?>
                  </select></td>
        </tr>
<?php } ?>
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
        <td width="226" align="center"><label>
          <input type="submit" name="Submit" value="Add" />
        </label></td>
        <td width="263" align="center">&nbsp;</td>
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
