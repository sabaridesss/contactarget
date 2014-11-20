<?php
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");


 $query = "select * from `main_category_list`";
	  
 $query_result = mysql_query($query);

 
 $msg = "";
if($_REQUEST["msg"] == '2'){
	$msg = "Menus Sucessfully Added";
	
}else if($_REQUEST["msg"] == '3'){

	$msg = "Menus Sucessfully Updated";
	
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


<style type="text/css">
<!--
.style3 {font-size: 12px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
</head>
<form name="content_add" method="post" action="" >
<body>
<table width="950" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
<!--    <td width="254" height="56"><a href="index.php"><strong>Show Content Mangement </strong></a></td>
    <td width="103"><a href="tab_menus.php"><strong>Tab Menus </strong></a></td> -->
<!--    <td ><a href="main_menus.php"><strong> Main Menus </strong></a></td> -->
<!--    <td width="125"><a href="sub_menus.php"><strong> Sub Menus</strong></a></td>
    <td width="114"><a href="logout.php"><strong>Logout</strong></a></td> -->
  </tr>
  <tr>
    <td width="167" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" align="center" valign="top"><table width="381" border="0" cellpadding="5">
      <tr>
        <td width="367"><strong><font color="#FF0000">
          <?=$msg?>
          </font></strong>
            <div id="delete_content" style="color:#FF0000; font-weight:bold; margin-left:120px;"></div></td>
      </tr>
    </table>
      <table width="717" border="0" cellpadding="5">
        <tr>
          <td width="672" align="right"><a href="add_menus.php"><strong>Add Menus</strong></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="taps_add.php?action=tabs_for_main_menu"><strong>Add Tabs</strong></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="edit_main_menu_tabs.php"><strong>Edit Tabs</strong></a></td>
        </tr>
      </table>
      <table width="88%" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="style3"><strong>ID</strong></td>
        <td align="left" class="style3"><strong>Menus Name</strong></td>
        <td align="left" class="style3"><strong>Page Name</strong></td>
        <td class="style3"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $bgcolor="#ffffff";
	   if(($i%2)==0)
	     $bgcolor="#f6f6f6";


		  
	   ?>
      <tr bgcolor="<?=$bgcolor?>" onmouseover="this.className='tableover'" onmouseout="this.className='dataclass'">
        <td width="6%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="31%" align="left" class="style3"><?=$item["Main_category_name"]?></td>
        <td width="28%" align="left" class="style3"><?=$item["page_name"]?></td>
        <td width="100%"><table width="100%"  border="0">
            <tr>
              <td width="24%" align="center"><a href="edit_menus.php?menus_id=<?=$item["Main_category_ID"]?>" class="style3"> <img src="../images/edit.gif" alt="edit" border="0" title="edit" /></a> </td>
              <td width="37%" align="center"><a href="javascript:void(0)" class="style3"> <img src="../images/delete.gif" alt="delete" border="0" title="delete" onclick='deleteContent(<?=$item["Main_category_ID"]?>,"delete_menus")' /></a> </td>
              <td width="75%" align="center"><a href="content_edit.php?page_name=<?=$item["page_name"]?>&action=edit_main_contents" class="style3">Edit Content</a></td>
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
