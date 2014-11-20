<?php

include("smarty_config.php");
include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	//$action = $_REQUEST['action'];
//	$tab_title = $_REQUEST['tab_title'];
//	$tab_desc = $_REQUEST['tab_desc'];
//	$main_catg_id = $_REQUEST['main_catg_id'];
//	$tab_id = $_REQUEST['tab_id'];
//	$sub_catg_id = $_REQUEST['sub_catg_id'];
//	$page_content_id = $_REQUEST['page_content_id'];
//	$order_id = $_REQUEST['order_id'];
	$value = "Add";
	
	if($_REQUEST['edit']=="true") {
		$tab_id = $_REQUEST['tab_id'];
		$parent_id = $_REQUEST['parent_id'];
		if($tab_id != "") {
			$sel_tab_query = "select * from tabs_tbl where Tab_ID = $tab_id";
			$exec_sel_tab_query = mysql_query($sel_tab_query);
			$tab_item=mysql_fetch_array($exec_sel_tab_query);
			$value = "Update";
		}
	}
	
	// Add Contents
	if(isset($_POST['Submit'])){
		if($_REQUEST['action'] == "add_tab_menu")
		{
		
		 
			 $tab_title = $_REQUEST['tab_title'];
			 $order_id = $_REQUEST['order_id'];
			 $tab_desc = $_REQUEST['tab_desc'];
			
			 $main_catg_id = $_REQUEST['main_catg_id'];
			 if(!isset($main_catg_id)) {
			 $main_catg_id = $_REQUEST['page_content_id'];
			 } 
			 if(!isset($main_catg_id)) {
			  $main_catg_id = $_REQUEST['sub_catg_id'];
			 }
			 $tab_for = "menu";
			
			 if($main_catg_id != "")
			 {
			  	$query = "INSERT INTO tabs_tbl(Tab_Title,Tab_Description,parent_id,order_id,Created_Date)VALUES('".$tab_title."','".$tab_desc."','".$main_catg_id."','".$order_id."',now())";
		
			}else if($sub_catg_id != "")
			{
		
		 		$query = "INSERT INTO tabs_tbl(Tab_Title,Tab_Description,Page_Content_ID,order_id,Created_Date)VALUES('".$tab_title."','".$tab_desc."','".$sub_catg_id."','".$order_id."',now())";
		
			}else if($page_content_id != "")
			{
		
		 		$query = "INSERT INTO tabs_tbl(Tab_Title,Tab_Description,Page_Content_ID,order_id,Created_Date)VALUES('".$tab_title."','".$tab_desc."','".$page_content_id."','".$order_id."',now())";
			}		
		}
		else if($_REQUEST['edit']=="true" && isset($_REQUEST['tab_id']))
		{
			$tab_id = $_REQUEST['tab_id'];
			$tab_title = $_REQUEST['tab_title'];
			$tab_desc = $_REQUEST['tab_desc'];
			$order_id = $_REQUEST['order_id'];
			$tab_for = "menu";
			$query = "update tabs_tbl set Tab_Title = '$tab_title',Tab_Description = '$tab_desc',order_id = '$order_id' where Tab_ID = $tab_id";
		}
		$rs = mysql_query($query);
		if($rs){
			if($tab_for == "menu")
			{
				if($value == "Add") {
					header("location:tab_index1.php?main_catg_id=$main_catg_id&msg=add");
				} elseif($value == "Update") {
					header("location:tab_index1.php?main_catg_id=$parent_id&msg=update");
				}
			}else if($sub_catg_id != "")
			{
				//header("location:tab_index.php?sub_catg_id=$sub_catg_id&msg=3");
				header("location:www.google.com");
			}
			else if($page_content_id != "")
			{
				if($value == "Add") {
					header("location:tab_index1.php?page_content_id=$page_content_id&msg=add");
				} elseif($value == "Update") {
					header("location:tab_index1.php?page_content_id=$page_content_id&msg=update");
				}
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
<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="css/cms.css" />

</head>

<body>
<form name="content_add" method="post" action="" >
<table width="963" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
<td align="right"><?php include("top_menu.php"); ?></td>
  </tr>
  <tr>
    <td width="173" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" valign="top"><table width="100%" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      <tr>
        <td height="50" align="right">&nbsp;</td>
            <td width="232" id="link_title"><strong>Add Tabs</strong></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right" valign="top" id="title_name">Tab Title:</td>
        <td colspan="2" align="left"><input name="tab_title" type="text" id="tab_title" value="<?=$tab_item["Tab_Title"]?>" size="60"/></td>
      </tr>
	  <tr>
        <td width="145" align="right" valign="top" id="title_name">Order Id:</td>
        <td colspan="2" align="left"><input type="text" name="order_id" id="order_id" value="<?=$tab_item["order_id"]?>"/></td>
      </tr>
	  <tr>
        <td align="left" valign="top" id="title_name">&nbsp;</td>
       <?php /*?> <td align="left" valign="top" id="title_name"><a href="javascript:void(0)" onclick="window.open('img_upload.php?parent_id=<?php echo $page_content_id;?>&content_id=<?php echo $tab_id;?>&img=thumb_nail',
'mywindow','width=500,height=400,top=200,left=300,scrollbars=yes'); ">Upload Images</a>
            </td><?php */?>
        <td align="left" valign="top" id="title_name">&nbsp;</td>
      </tr>
	 
      <tr>
        <td align="right" valign="top" id="title_name">Tab Description:</td>
        <td colspan="2" align="left"><!--<input type="text" name="page_name" id="page_name" /> -->
		<textarea id="tab_desc" name="tab_desc" rows="8" cols="35"><?=$tab_item["Tab_Description"]?></textarea>
		
<script type="text/javascript">
    CKEDITOR.replace('tab_desc');
 </script>
		</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="center">
          <input type="submit" name="Submit" value="<?=$value?>" />&nbsp;&nbsp;&nbsp;
		  <input type="button" name="Cancel" value="Cancel" onclick="return redirect_page('<?=$_SERVER['HTTP_REFERER']?>')"/>		  
        </td>
        <td width="235" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>

</html>


