<?php
ob_start();
session_start();
require_once('auth.php');
include("../smarty_config.php");
include("fckeditor/fckeditor.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$content_id = $_REQUEST["content_id"];
	$content =  $_REQUEST['content'];
	$cat_id = $_REQUEST['cat_id'];
	$subcat_id = $_REQUEST['sub_cat'];
	$sub_title = $_REQUEST['sub_title'];
	$meta_name = $_REQUEST['meta_name'];
	$meta_content = $_REQUEST['meta_content'];
	$link_name = $_REQUEST['link_name'];
	$meta_tile = $_REQUEST['meta_tile'];
	$header_title = $_REQUEST['header_title'];
	
	
	
	// Add Contents
	if(isset($_POST['Submit'])){
	
	  $query = "select * from `page_contents` where `page_name` ='".addslashes($page_name)."' and `active` = 1";
	  $query_result = mysql_query($query);
	  
			if($query_result > 0)
			{
			  $num_of_rows = mysql_num_rows($query_result);
			}
		
				
		 $query = "update page_contents set page_name='".$link_name."', content='".$content."', meta_name='".$meta_name."',meta_content='".$meta_content."', link_name='".$link_name."', image_url='".$filePath."', meta_title='".$meta_title."', h1_title='".$header_title."' where id='".$subcat_id."'";
		
		 rename("user_images/temp/","user_images/$subcat_id/");
		  mkdir("user_images/temp/");
			$rs = mysql_query($query);
			if($rs){
			//echo 'suceesfully added';
				header("location:index.php?msg=2");
			}
	 
	}
	
	$cat_query = "select * from main_category_list";
	$cat_result = mysql_query($cat_query);
	
	$subcat_query = "select * from page_contents";
	$subcat_result = mysql_query($subcat_query);
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
</script>

</head>
<form name="content_add" method="post" action="" enctype="multipart/form-data">
<input type="hidden" id="sub_catid" value="2" />
<body>
<table width="980" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td width="188" height="56"><a href="index.php"><strong>Show Content Mangement </strong></a></td>
    <td width="93"><a href="content_add.php"><strong>Add Content</strong></a></td>
    <td width="85"><a href="tab_menus.php"><strong> Tab Menus </strong></a><a href="logout.php"></a></td>
    <td width="113"><a href="main_menus.php"><strong> Main Menus </strong></a></td>
    <td width="87"><a href="sub_menus.php"><strong> Sub Menus </strong></a></td>
    <td width="202"><a href="logout.php"><strong>Logout</strong></a></td>
  </tr>
  <tr>
    <td width="126" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="6" valign="top"><table width="650" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      <tr>
        <td height="50" align="right">&nbsp;</td>
            <td width="232" id="link_title"><strong>Link Names</strong></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right" valign="top" id="title_name">Main Menus:</td>
        <td colspan="2" align="left"><select name="cat_id" id="cat_id" onChange="getSubcat(this.value)">
		<option value="0">--Select--</option>
		<? while($cat_row=mysql_fetch_array($cat_result)) {?>
		<option value="<?=$cat_row['Main_category_ID']?>"><?=$cat_row['Main_category_name']?></option>
		<? }?>
        </select>        </td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Sub Menus: </td>
        <td colspan="2" align="left"><div id="statediv"><select name="sub_cat" id="sub_cat">
          <option value="0">--Select--</option>
          <? while($subcat_row=mysql_fetch_array($subcat_result)) {?>
          <option value="<?=$subcat_row['id']?>">
            <?=$subcat_row['sub_title']?>
            </option>
          <? }?>
        </select></div></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Meta-Keyword:</td>
        <td colspan="2" align="left"><input type="text" name="meta_name" id="meta_name"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Meta-Description:</td>
        <td colspan="2" align="left"><input type="text" name="meta_content" id="meta_content" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Meta-Title:</td>
        <td colspan="2" align="left"><input type="text" name="meta_title" id="meta_title" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Link Name:</td>
        <td colspan="2" align="left"><input type="text" name="link_name" id="link_name" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Header&nbsp;Title:</td>
        <td colspan="2" align="left"><input type="text" name="header_title" id="header_title" /></td>
      </tr>
      <tr>
        <td align="left" valign="top" id="title_name">&nbsp;</td>
        <td align="left" valign="top" id="title_name">
		<a href="javascript:void(0)" onclick="ShowDiv('mainbody')">Upload  Images</a>
		<div id="mainbody" style="display:none; margin-top:10px;" >
          <div id="upload" ><span>Upload File<span></div>
          <span id="status" ></span>
		  <ul id="files" >
          </ul>
        </div></td>
        <td width="235" align="left" valign="top" id="title_name">&nbsp;</td>
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
        <td align="center"><label>
          <input type="submit" name="Submit" value="Add" />
        </label></td>
        <td align="center">&nbsp;</td>
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
