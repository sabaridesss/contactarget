<?php
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");
include("fckeditor/fckeditor.php");


$cat_id = $_REQUEST['cat_id'];
$sub_cat = $_REQUEST['sub_cat'];
$sub_submenus = $_REQUEST['sub_submenus'];
$page_name = $_REQUEST['page_name'];


// Add Contents
if(isset($_POST['Submit'])){


if($page_name == ""){
		$page_name = 'Nill';
}

//$query = "update page_contents set sub_title='".$subtitle."', page_name='".$page_name."' where cat_id = '".$cat_id."'";

//$rs = mysql_query($query);

 $query = "INSERT INTO sub_subpagecontents(cat_id,subcat_id,sub_title,page_name)VALUES('".$cat_id."','".$sub_cat."','".$sub_submenus."','".$page_name."')";
		$rs = mysql_query($query);
		if($rs){
		
			header("location:sub_submenus.php");
		}
}

$cat_query = "select * from main_category_list";
$cat_result = mysql_query($cat_query);

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
		var sub_catid = $('#sub_catid').val();
		
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

<script language="javascript" type="text/javascript">
// Roshan's Ajax dropdown code with php
// This notice must stay intact for legal use
// Copyright reserved to Roshan Bhattarai - nepaliboy007@yahoo.com
// If you have any problem contact me at http://roshanbh.com.np
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	function getSubcat(catId) {		
		
		var strURL="findSubcat.php?cat_id="+catId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	}
	function getCity(countryId,stateId) {		
		var strURL="findCity.php?country="+countryId+"&state="+stateId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
</script></head>
<form name="content_add" method="post" action="" >
<body>
<table width="980" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td width="218" height="56"><a href="index.php"><strong>Show Content Mangement </strong></a></td>
    <td width="125"><a href="tab_menus.php"><strong>Tab Menus </strong></a></td>
    <td width="112"><a href="main_menus.php"><strong>Main Menus </strong></a></td>
    <td width="97"><a href="sub_menus.php"><strong> Sub Menus </strong></a></td>
    <td width="139"><a href="logout.php"><strong>Logout</strong></a></td>
    <td width="38">&nbsp;</td>
  </tr>
  <tr>
    <td width="165" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="6" valign="top"><table width="660" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      <tr>
        <td height="50" align="right">&nbsp;</td>
            <td width="232" id="link_title"><strong>Add Child Menus </strong></td>
            <td width="232"><a href="sub_submenus.php"><strong>Show Child Menus Content</strong></a></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Main Menu  Name: </td>
        <td colspan="3" align="left"><select name="cat_id" id="cat_id" onchange="getSubcat(this.value)">
            <option value="0">--Select--</option>
            <? while($cat_row=mysql_fetch_array($cat_result)) {?>
            <option value="<?=$cat_row['Main_category_ID']?>">
              <?=$cat_row['Main_category_name']?>
              </option>
            <? }?>
          </select>        </td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Sub Menus: </td>
        <td colspan="3" align="left"><div id="statediv">
          <select name="sub_cat" id="sub_cat">
              <option value="0">--Select--</option>
              <? while($subcat_row=mysql_fetch_array($subcat_result)) {?>
              <option value="<?=$subcat_row['id']?>">
              <?=$subcat_row['sub_title']?>
              </option>
              <? }?>
            </select>
        </div></td>
      </tr>
      <tr>
        <td width="145" align="right" valign="top" id="title_name">Child Menu :</td>
        <td colspan="3" align="left"><input type="text" name="sub_submenus" id="sub_submenus" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Page Name:</td>
        <td colspan="3" align="left"><input type="text" name="page_name" id="page_name" /></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="left"><input type="submit" name="Submit" value="Add" /></td>
        <td align="left"><label></label></td>
        <td width="1" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</form>
</html>

<body>


</body>
