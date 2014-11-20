<?php
session_start();
require_once('auth.php');
//include("connect.php");
	include("../smarty_config.php");
include("fckeditor/fckeditor.php");


$content_id = $_REQUEST["content_id"];

$content =  $_REQUEST['content'];
$cat_id = $_REQUEST['cat_id'];
$subcat_id = $_REQUEST['sub_cat'];
$sub_title = $_REQUEST['sub_title'];
$meta_name = $_REQUEST['meta_name'];
$meta_content = $_REQUEST['meta_content'];
$page_name = $_REQUEST['page_name'];
$meta_title = $_REQUEST['meta_title'];
$meta_keyword = $_REQUEST['meta_keyword'];
$header_title1 = $_REQUEST['header_title1'];
$header_title2 = $_REQUEST['header_title2'];
$meta_misc = $_REQUEST['meta_misc'];


if(isset($_POST['Update'])){

			
	$query = "update `sub_subpagecontents` set `content` ='".addslashes($content)."',
										`cat_id` = '".addslashes($cat_id)."',
										`subcat_id` = '".addslashes($subcat_id)."',
										`sub_title` = '".addslashes($sub_title)."',
										`meta_name` =  '".addslashes($meta_name)."',
										 `meta_content` =  '".addslashes($meta_content)."',
										 `page_name` = '".addslashes($page_name)."',
										 `meta_title` ='".addslashes($meta_title)."',
										  `meta_keyword` ='".addslashes($meta_keyword)."',
										 `h1_title` ='".addslashes($header_title1)."',
										 `h2_title` ='".addslashes($header_title2)."',
										  `meta_misc` ='".addslashes($meta_misc)."'
										 where `sub_id` = '".$_REQUEST["content_id"]."'" ;
	
	  
			$rs = mysql_query($query);
			if($rs){
			
				header("location:sub_submenus.php?msg=3");
			
			}
			
	}		
			
$edit_query = "select * from `sub_subpagecontents` where  sub_id='".$_REQUEST["content_id"]."'";
$edit_query_result = mysql_query($edit_query);
while($edit_item = mysql_fetch_array($edit_query_result)){
			$id = $edit_item["sub_id"];
			$cat_id = $edit_item["cat_id"];
			$subcat_id = $edit_item["subcat_id"];
			$title = $edit_item["title"];
			$sub_title = $edit_item["sub_title"];
			$meta_name = $edit_item["meta_name"];
			$meta_content = $edit_item["meta_content"];
			$page_name = $edit_item["page_name"];
			$content = $edit_item["content"];
			$image_url = $edit_item["image_url"];
			$meta_title = $edit_item['meta_title'];
			$meta_keyword = $edit_item['meta_keyword'];
			$header_title1 = $edit_item['h1_title'];
			$header_title2 = $edit_item['h2_title'];
			$meta_misc = $edit_item["meta_misc"];
			
	 }
	 
	 


$cat_query1 = "select * from main_category_list where Main_category_ID='".$cat_id."'";
$cat_result1 = mysql_query($cat_query1);
while($edit_item1 = mysql_fetch_array($cat_result1)){
			$menus_id = $edit_item1["Main_category_ID"];
			$menus_name = $edit_item1["Main_category_name"];

}

$sucat_query1 = "select * from page_contents where id='".$subcat_id."'";
$subcat_result1 = mysql_query($sucat_query1);
while($edit_subitem1 = mysql_fetch_array($subcat_result1)){
			$sub_id1 = $edit_subitem1["id"];
			$sub_title1 = $edit_subitem1["sub_title"];

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
		var url = "upload-file1.php?sub_cat="+sub_catid;
		
		new AjaxUpload(btnUpload, {
			action: url,
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif|pdf)$/.test(ext))){ 
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
			alert(response);
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
<input type="hidden" value="<?=$content_id?>" id="sub_catid" />
<body>
<table width="1012" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
    <td width="219" height="56"><a href="index.php"><strong>Show Content Mangement </strong></a></td>
    <td width="143"><a href="tab_menus.php"><strong>Tab Menus </strong></a></td>
    <td width="158"><a href="main_menus.php"><strong> Main Menus </strong></a></td>
    <td width="146"><a href="sub_menus.php"><strong> Sub Menus </strong></a></td>
    <td width="193"><a href="logout.php"><strong>Logout</strong></a></td>
  </tr>
  <tr>
    <td width="164" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" align="left" valign="top"><table width="666" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      <tr>
        <td width="120" height="50" align="right">&nbsp;</td>
        <td width="218">&nbsp;</td>
        <td width="274" id="link_title"><strong>Link Names</strong></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Main Menus:</td>
        <td colspan="2" align="left"><select name="cat_id" id="cat_id">
          <option value="0">--Select--</option>
          <? while($cat_row=mysql_fetch_array($cat_result)) {
		  
		  if($cat_row['Main_category_ID'] == $menus_id){
		  ?>
          <option value="<?=$cat_row['Main_category_ID']?>" selected="selected">
          <?=$menus_name?>
          </option>
          <? }
		  else{
		  ?>
          <option value="<?=$cat_row['Main_category_ID']?>">
          <?=$cat_row['Main_category_name']?>
          </option>
          <? }} ?>
        </select>        </td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Sub Menus: </td>
        <td colspan="2" align="left"><div id="statediv">
            <select name="sub_cat" id="sub_cat">
            <option value="0">--Select--</option>
          <? while($subcat_row=mysql_fetch_array($subcat_result)) {
		  
		  if($subcat_row['id'] == $sub_id1){
		  ?>
          <option value="<?=$subcat_row['id']?>" selected="selected">
          <?=$sub_title1?>
          </option>
          <? }
		  else{
		  ?>
          <option value="<?=$subcat_row['id']?>">
          <?=$subcat_row['sub_title']?>
          </option>
          <? }} ?>
            </select>
        </div></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Sub Sub_menus: </td>
        <td colspan="2" align="left"><input name="sub_title" type="text" id="sub_title" value="<?=$sub_title?>" size="50" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Meta-Title:</td>
        <td colspan="2" align="left">
		  <textarea name="meta_title" cols="50" rows="5" id="meta_title"><?=$meta_title?></textarea>		</td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Meta-Description:</td>
        <td colspan="2" align="left">
		<textarea name="meta_content" cols="50" rows="5" id="meta_content" ><?=$meta_content?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Meta-Keyword:</td>
        <td colspan="2" align="left">
		<textarea name="meta_keyword" cols="50" rows="5" id="meta_keyword"><?=$meta_keyword?></textarea>        </td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">H1:</td>
        <td colspan="2" align="left"><input name="header_title1" type="text" id="header_title1" value="<?=$header_title1?>" size="50"  /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">H2:</td>
        <td colspan="2" align="left"><input name="header_title2" type="text" id="header_title2" value="<?=$header_title2?>" size="50"></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Meta-Misc:</td>
        <td colspan="2" align="left">
		<textarea name="meta_misc" cols="50" rows="5" id="meta_misc"><?=$meta_misc?></textarea>        </td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;Page Name:</td>
        <td colspan="2" align="left"><input name="page_name" type="text" id="page_name" value="<?=$page_name?>" size="70" /></td>
      </tr>
      

      <tr>
        <td align="left" valign="top" id="title_name">&nbsp;</td>
        <td align="left" valign="top" id="title_name"><a href="javascript:void(0)" onclick="ShowDiv('mainbody')">Upload  Images</a>
            <div id="mainbody" style="display:none; margin-top:10px;" >
              <div id="upload" ><span>Upload File<span></div>
              <span id="status" ></span>
              <ul id="files" >
              </ul>
            </div></td>
        <td align="left" valign="top" id="title_name">&nbsp;</td>
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
          <input type="submit" name="Update" value="Update" />
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
