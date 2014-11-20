<?php

include("smarty_config.php");
include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");	
} else {
	$parent_id = $_REQUEST['parent_id'];

	//$subcat_id = $_REQUEST['subcat_id'];
	
	if($parent_id != "")
	{
	 $query = "select * from `menu_page_tbl` where `is_menu`=2 and `parent_id` = '$parent_id'";
	}	  
	else if($subcat_id != "" && $parent_id == "" )
	{
	 $query = "select * from `page_contents` where `Sub_Parent_ID` = '$subcat_id'";
	
	}
	else if($subcat_id != "" && $parent_id != "" )
	{
	 $query = "select * from `page_contents` where `Sub_Parent_ID` = '$subcat_id' and `parent_id` = '$parent_id'";
	
	}
	 $query_result = mysql_query($query);
	 //$parent_id = $_REQUEST['parent_id'];
	 $msg = "";
	if($_REQUEST["msg"] == 'add'){
		$msg = "Menus Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
		$msg = "Menus Sucessfully Updated";	
	}else if($_REQUEST["msg"] == 'delete'){
		$msg = "Menus Sucessfully deleted";	
	}
	
	if(isset($_REQUEST['delete'])=="true") {
		$del_id = $_REQUEST['submenu_id'];
		$parant_id = $_REQUEST['parent_id'];
		$query = "delete from menu_page_tbl where id ='".$del_id."'";
		if(mysql_query($query))
		{
			$query = "delete from tabs_tbl where parent_id ='".$del_id."'";
			if(mysql_query($query)) {
				header("Location:sub_menus.php?parent_id=$parant_id&msg=delete");	
			}
		}
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

-->
</style>
<link href="css/style_new.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/cms.css" />
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

<script type="text/javascript" >
function deleteContent()
{
var conf = confirm("Are you sure you wish to delete?");
if(!conf)
	{
		return false;
	}else{
		return true;
	}
}
</script>

<style type="text/css">
<!--
.style3 {font-size: 12px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
</head>

<body>
<form name="content_add" method="post" action="" >
<table width="100%" border="0" cellpadding="5">
<tr>
	<td><img src="images/banner.jpg" alt="" width="100%" /></td>
  </tr>
  <tr>
	<td class="top"><?= $top_menu ?></td>
  </tr>
  <tr>
	<td align="left" valign="middle"  class="welcome">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
	
  </tr>
  <tr>
    <td height="395" colspan="5" align="center" valign="top"><table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="367"><strong><font color="#FF0000">
          <?=$msg?>
          </font></strong>
            <div id="delete_content" style="color:#FF0000; font-weight:bold; margin-left:120px;"></div></td>
      </tr>
    </table>
      <table width="100%" border="0" cellpadding="5">
        <tr>
          <td width="689" align="right"><div class="addmenu"><a href="add_submenus.php?parent_id=<?php echo $parent_id?><?php if($_REQUEST['subcat_id'] != "") { ?>&subcat_id=<?php echo $subcat_id; }?>
		  
		  ">Add Sub Menus</a></div></td>
        </tr>
      </table>
      <table width="100%" border="0" class="content">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1"><strong>ID</strong></td>
        <td align="left" class="table1"><strong>Sub Menus</strong></td>
        <td align="left" class="table1"><strong>Page Name</strong></td>
		<td align="left" class="table1"><strong>Menu Order</strong></td>
		<td width="19%" align="left" class="table1"><strong>Tabs</strong></td>
        <td class="table1"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";
		  
	   ?>
      <tr  class="<?= $class ?>">
        <td width="6%" height="27" align="left" style="padding-left:10px;"><?=$i?></td>
        <td width="17%" align="left" style="padding-left:10px;"><a href="sub_menus1.php?subcat_id=<?=$item["id"]?>&parent_id=<?=$_REQUEST['parent_id']?>"><?=$item["title"]?></a></td>
        <td width="18%" align="left" style="padding-left:10px;"><?=$item["file_name"]?></td>
		<td width="12%" align="left" style="padding-left:10px;"><?=$item["order_id"]?></td>
		<td style="padding-left:10px;"><a href="add_tab.php?sub_catg_id=<?=$item["id"]?>&action=add_tab_menu">Add Tab</a>&nbsp;&nbsp;<a href="tab_index.php?sub_catg_id=<?=$item["id"]?>">View Tab</a></td>
        <td width="28%" style="padding-left:10px;"><table width="100%"  border="0">
            <tr>
              <td width="25%" align="center"><a href="edit_submenus.php?submenus_id=<?=$item["id"]?>&parent_id=<?=$_REQUEST['parent_id']?>" class="style3">Edit</a></td>
              <td width="21%" align="center"><a href="sub_menus.php?submenu_id=<?=$item["id"]?>&parent_id=<?=$_REQUEST['parent_id']?>&delete=true" class="style3" onclick='return deleteContent()'>Delete</a></td>
              <td width="54%" align="center"><a href="content_edit.php?page_id=<?=$item["id"]?>&parent_id=<?=$_REQUEST["parent_id"]?>&action=edit_submenu_contents" class="style3">Edit Content</a></td>
            </tr>
        </table></td>
      </tr>
      <? $i++; } ?>
    </table>    </td>
  </tr>
</table>
</form>
</body>

</html>

<body>


</body>
