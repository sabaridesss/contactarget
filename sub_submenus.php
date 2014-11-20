<?php
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");


 $query = "select * from `sub_subpagecontents`";
	  
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
<table width="954" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td width="221" height="56"><a href="index.php"><strong>Show Content Mangement </strong></a></td>
    <td width="95"><a href="tab_menus.php"><strong>Tab Menus </strong></a></td>
    <td width="105"><a href="main_menus.php"><strong> Main Menus </strong></a></td>
    <td width="111"><a href="sub_menus.php"><strong> Sub Menus</strong></a></td>
    <td width="131"><a href="logout.php"><strong>Logout</strong></a></td>
  </tr>
  <tr>
    <td width="156" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" align="center" valign="top"><table width="381" border="0" cellpadding="5">
      <tr>
        <td width="367"><strong><font color="#FF0000">
          <?=$msg?>
          </font></strong>
            <div id="delete_content" style="color:#FF0000; font-weight:bold; margin-left:120px;"></div></td>
      </tr>
    </table>
      <table width="580" border="0" cellpadding="5">
        <tr>
          <td width="326" align="right"><strong>Child Menus Content Mangement </strong></td>
          <td width="228" align="right"><a href="add_sub_submenus.php"><strong>Add Child Menus</strong></a></td>
        </tr>
      </table>
      <table width="95%" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="style3"><strong>ID</strong></td>
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
		  
	   ?>
      <tr bgcolor="<?=$bgcolor?>" onmouseover="this.className='tableover'" onmouseout="this.className='dataclass'">
        <td width="22%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="22%" align="left" class="style3"><?=$item["sub_title"]?></td>
        <td width="26%" align="left" class="style3"><?=$item["page_name"]?></td>
        <td width="30%"><table width="100%"  border="0">
            <tr>
              <td width="25%" align="center"><a href="edit_childmenus.php?submenus_id=<?=$item["sub_id"]?>" class="style3"> <img src="../images/edit.gif" alt="edit" border="0" title="edit" /></a></td>
              <td width="21%" align="center"><a href="javascript:void(0)" class="style3"><img src="../images/delete.gif" alt="delete" border="0" title="delete" onclick='deleteContent(<?=$item["sub_id"]?>,"delete_submenus")' /></a></td>
              <td width="54%" align="center"><a href="content_editsubmenus.php?content_id=<?=$item["sub_id"]?>" class="style3">Edit Content</a></td>
            </tr>
        </table></td>
      </tr>
      <? $i++; } ?>
    </table>    </td>
  </tr>
</table>
</body>
</form>
</html>

<body>


</body>
