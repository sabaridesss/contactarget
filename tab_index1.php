<?php

include("smarty_config.php");
include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$tab_id = $_REQUEST['tab_id'];

	$action = $_REQUEST['action'];
	
	$main_catg_id = $_REQUEST['main_catg_id'];
	if(!isset($main_catg_id)) {
	$main_catg_id = $_REQUEST['page_content_id'];
	}
	if(!isset($main_catg_id)) {
	$main_catg_id = $_REQUEST['sub_catg_id'];
	}
	//if(isset($main_catg_id)) {
//		$query = "select * from page_contents where Main_category_ID='".$main_catg_id."'";
//		$page_id_query_exec=mysql_query($query);
//		if(mysql_num_rows($page_id_query_exec) > 0) {
//			$page_id = mysql_fetch_array($page_id_query_exec);
//			$main_catg_id = $page_id['id'];	
//			
//		}
//	}
	if( ($_REQUEST['delete'] == "true") && (isset($_REQUEST['tab_id'])) ) {
		$deletetab_id = $_REQUEST['tab_id'];
		$parent_id = $_REQUEST['parent_id'];
		$query = "delete from tabs_tbl where Tab_ID ='".$deletetab_id."'";
		if(mysql_query($query))
		{	
			header("location:tab_index.php?&main_catg_id=$parent_id&msg=del");
		}
	}
	
	$sub_catg_id = $_REQUEST['sub_catg_id'];
	
	$page_content_id = $_REQUEST['page_content_id'];
	
	if($tab_id != "" && $action == "delete_tab_content")
	{
	
	 $del_query = "delete from `tabs_tbl` where `Tab_ID` = $tab_id ";
		  
	 $del_query_result = mysql_query($del_query);
	 
	 if($del_query_result)
	 {
	 
	 if($main_catg_id != "")
	 {
	 
	 header("location:tab_index.php?&main_catg_id=$main_catg_id&msg=del");
	 }else if($sub_catg_id != "")
	 {
	 
	 header("location:tab_index.php?sub_catg_id=$sub_catg_id&msg=3");
	 }else if($page_content_id != "")
	 {
	 
	  header("location:tab_index.php?page_content_id=$page_content_id&msg=del");
	 }
	 }
	
	
	}
	
	if($main_catg_id != "")
	{
	
	 $query = "select * from `tabs_tbl` where `parent_id` = $main_catg_id";
	
	}else if($sub_catg_id != "")
	{
	
	$query = "select * from `tabs_tbl` where `Sub_Category_ID` = $sub_catg_id";
	}else if($page_content_id != "")
	{
	
	 $query = "select * from `tabs_tbl` where `Page_Content_ID` = $page_content_id";
	}	  
	 $query_result = mysql_query($query);
	
	
	 
	 
	 $msg = "";
	if($_REQUEST["msg"] == 'add'){
		$msg = "Sucessfully Added";
		
	}else if($_REQUEST["msg"] == 'update'){
	
		$msg = "Updated Sucessfully";	
	}else if($_REQUEST["msg"] == 'del'){
		$msg = "Deleted Sucessfully";	
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
<script type="text/javascript">
function delete_tab_content(tab_id,main_catg_id,sub_catg_id,page_content_id)
{
	
   if(main_catg_id != 0 && main_catg_id != "")
   {
		 var conf = confirm("Are you sure you wish to delete?");
		 if(!conf)
		{
			return false;
		} else {
			window.location = "tab_index.php?tab_id="+tab_id+"&action=delete_tab_content&main_catg_id="+main_catg_id
		}	
   }
   else if(sub_catg_id != 0 && sub_catg_id != "")
   {
   		var conf = confirm("Are you sure you wish to delete?");
		 if(!conf)
		{
			return false;
		} else {
			window.location = "tab_index.php?tab_id="+tab_id+"&action=delete_tab_content&sub_catg_id="+sub_catg_id
		}	
   }else if(page_content_id != 0 && page_content_id != "")
   {
   		var conf = confirm("Are you sure you wish to delete?");
		 if(!conf)
		{
			return false;
		} else {
			window.location = "tab_index.php?tab_id="+tab_id+"&action=delete_tab_content&page_content_id="+page_content_id
		}		
   }
}
</script>

<script type="text/javascript">
function deleteContent1()
{
var conf = confirm("Are you sure you wish to delete?");
	if(!conf)
	{
		return false;
	} else {
		return true;
	}
}
</script>
<link rel="stylesheet" type="text/css" href="css/cms.css" />



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

	<td align="right"><?php include("top_menu.php"); ?></td>
	
  </tr>
  <tr>
    <td width="167" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" align="left" valign="top"><table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="100%" align="left"><strong><font color="#FF0000">
          <?=$msg?>
          </font></strong>
            <div id="delete_content" style="color:#FF0000;font-weight:bold;margin-left:120px;"></div></td>
      </tr>
    </table>
      <table width="717" border="0" cellpadding="5">
        <tr>
          <td width="672" align="right">
		  <?php if($main_catg_id != "") {?>
		  <a href="add_tab.php?main_catg_id=<?=$main_catg_id?>&action=add_tab_menu"><strong>Add Tab</strong></a>
		  <?php }else if($sub_catg_id != ""){ ?>
		  <a href="add_tab.php?sub_catg_id=<?=$sub_catg_id?>&action=add_tab_menu"><strong>Add Tab</strong></a>
		  <?php }else if($page_content_id != ""){ ?>
  		  <a href="add_tab.php?page_content_id=<?=$page_content_id?>&action=add_tab_menu"><strong>Add Tab</strong></a>
		  <?php } ?>
		  &nbsp;<!--&nbsp;|&nbsp;&nbsp;<a href="taps_add.php?action=tabs_for_main_menu"><strong>Add Tabs</strong></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="edit_main_menu_tabs.php"><strong>Edit Tabs </strong></a>--></td>
        </tr>
      </table>
      <table width="100%" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="style3"><strong>ID</strong></td>
        <td align="left" class="style3"><strong>Tab Name</strong></td>
        <td align="left" class="style3"><strong>Tab Content</strong></td>
		<td align="left" class="style3"><strong>Order Id</strong></td>
        <td class="style3"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  if($query_result > 0)
	  {
	  while($item=mysql_fetch_array($query_result)){
	   $bgcolor="#ffffff";
	   if(($i%2)==0)
	     $bgcolor="#f6f6f6";


		  
	   ?>
      <tr bgcolor="<?=$bgcolor?>" onmouseover="this.className='tableover'" onmouseout="this.className='dataclass'">
        <td width="5%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="10%" align="left" class="style3"><?=$item["Tab_Title"]?></td>
        <td width="63%" align="left" class="style3"><?=$item["Tab_Description"]?></td>
		<td width="9%" align="left" class="style3"><?=$item["order_id"]?></td>
        <td width="13%"><table width="100%"  border="0">
            <tr>
              <td width="21%" align="center">
			  <?php if($main_catg_id != "") {?>
			  <a href="add_tab1.php?tab_id=<?=$item["Tab_ID"]?>&parent_id=<?=$main_catg_id?>&edit=true" class="style3">Edit </a>              
			  <?php }else if($sub_catg_id != ""){ ?>
              <a href="add_tab1.php?tab_id=<?=$item["Tab_ID"]?>&sub_catg_id=<?=$item["Sub_Category_ID"]?>" class="style3">Edit </a>			               <?php }else if($page_content_id != ""){ ?>
			  <a href="add_tab1.php?tab_id=<?=$item["Tab_ID"]?>&page_content_id=<?=$item["Page_Content_ID"]?>" class="style3">Edit </a>
			  <?php } ?>
			  </td>
              <td width="29%" align="center">
			  
			  <?php /*?><a href="javascript:void(0)" class="style3" onclick='delete_tab_content(<?=$item["Tab_ID"]?>,<?=$item["Main_category_ID"]?>,<?=$item["Sub_Category_ID"]?>,<?=$item["Page_Content_ID"]?>)'> Delete</a> <?php */?>
			  <a href="tab_index1.php?tab_id=<?=$item["Tab_ID"]?>&parent_id=<?=$main_catg_id?>&delete=true" class="style3" onclick='deleteContent1(<?=$item["Tab_ID"]?>,"delete_tab","<?=$main_catg_id?>")'> Delete</a>
			  </td>
              
            </tr>
        </table></td>
      </tr>
      <? $i++; } }?>
    </table>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</form>
</html>

<body>


</body>
