<?php

include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");	
} else {
//	$parent_id = $_REQUEST['subcat_id'];
//
//	//$subcat_id = $_REQUEST['subcat_id'];
//	
//	if($parent_id != "")
//	{
//	 $query = "select * from `menu_page_tbl` where `is_menu`=3 and `parent_id` = '$parent_id'";
//	}	  
////	else if($subcat_id != "" && $parent_id == "" )
////	{
////	 $query = "select * from `page_contents` where `Sub_Parent_ID` = '$subcat_id'";
////	
////	}
////	else if($subcat_id != "" && $parent_id != "" )
////	{
////	 $query = "select * from `page_contents` where `Sub_Parent_ID` = '$subcat_id' and `parent_id` = '$parent_id'";
////	
////	}
//	 $query_result = mysql_query($query);
//	 //$parent_id = $_REQUEST['parent_id'];
//	 $msg = "";
//	if($_REQUEST["msg"] == 'add'){
//		$msg = "Menus Sucessfully Added";	
//	}else if($_REQUEST["msg"] == '3'){
//		$msg = "Menus Sucessfully Updated";	
//	}else if($_REQUEST["msg"] == 'delete'){
//		$msg = "Menus Sucessfully deleted";	
//	}
//	
//	if(isset($_REQUEST['delete'])=="true") {
//		$del_id = $_REQUEST['submenu_id'];
//		$parant_id = $_REQUEST['parent_id'];
//		$query = "delete from menu_page_tbl where id ='".$del_id."'";
//		if(mysql_query($query))
//		{
//			$query = "delete from tabs_tbl where parent_id ='".$del_id."'";
//			if(mysql_query($query)) {
//				header("Location:sub_menus.php?parent_id=$parant_id&msg=delete");	
//			}
//		}
//	}
//
//}
	$parent_id = $_REQUEST['parent_id'];	
	if($parent_id != "")
	{
	 $query = "select * from `menu_page_tbl` where `parent_id` = '$parent_id' order by order_id asc";
	 $query_result = mysql_query($query);
	}	  
	
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
	
	function recursive($id,$link)
	{
		//echo $link;
		$qry = "select * from menu_page_tbl where id=".$id;
		$qry_result = mysql_query($qry);
		$row = mysql_fetch_assoc($qry_result);
		 $title = $row['title'];
		 $par_id = $row['parent_id'];
		
		if($par_id != 0) {
			$link=" >> <a href='sub_menus.php?parent_id=".$id."'>".$title."</a>".$link;
			
			recursive($par_id,$link);
		} else {
			 
			 echo $link="<a href='main_page.php'>Main Menu</a>"." >> <a href='sub_menus.php?parent_id=".$id."'>".$title."</a>".$link;
			
			
		}
		
		
	}
	
	

}

?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" >
<table width="1200px" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	<?php include('common/top_menu.php') ?>
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_submenus1.php?parent_id=<?php echo $parent_id?>">Add Sub Menus</a></div></td>
  </tr>
  <tr>
    <td colspan="3" align="left" valign="middle" class="content1"><?php recursive($parent_id,""); ?></td>
    </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0">
      <tr bgcolor="#cccccc">
        <td height="33" align="left" class="table1"><strong>ID</strong></td>
        <td align="left" class="table1"><strong>Sub Menus</strong></td>
        <td align="left" class="table1"><strong>Page Name</strong></td>
		<td align="left" class="table1"><strong> Order</strong></td>
		<td width="13%" align="left" class="table1"><strong>Tabs</strong></td>
		<td width="8%" align="left" class="table1">Status</td>
		<td width="6%" align="left" class="table1">Preview</td>
        <td class="table1"><strong>Action</strong></td>
        <td class="table1">Delete</td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";
		  
	   ?>
      <tr class="<?= $class ?>">
        <td width="5%" height="27" align="left" style="padding-left:10px;"><?=$i?></td>
        <td width="16%" align="left" style="padding-left:10px;"><a href="#"><?=$item["title"]?></a></td>
        <td width="29%" align="left" style="padding-left:10px;"><?=$item["file_name"]?></td>
		<td width="5%" align="left" style="padding-left:10px;"><?=$item["order_id"]?></td>
		<td style="padding-left:10px;"><a href="add_tab.php?sub_catg_id=<?=$item["id"]?>&action=add_tab_menu">Add Tab</a>&nbsp;&nbsp;<a href="tab_index.php?sub_catg_id=<?=$item["id"]?>">View Tab</a></td>
		<td height="20" style="padding-left:10px;">
		<?php
		if($item["is_show"] == 1) {
		?>
		Publish
		<?php
		} elseif($item["is_show"] == 0) {
		?>
		<span style="color:#FF0000;">Unpublish</span>
		<?php
		}
		?>		</td>
		<td height="20" style="padding-left:10px;">
		<a><a href="javascript:void(0)" onClick="window.open('http://desss.com/<?=$item["file_name"]?>')">Preview</a></a>		</td>
        <td width="13%" style="padding-left:10px;"><table width="100%"  border="0">
            <tr>
              <td width="25%" align="center"><a href="edit_submenus1.php?submenus_id=<?=$item["id"]?>&parent_id=<?=$_REQUEST['parent_id']?>" class="style3">Edit</a></td>
              <td width="54%" align="center"><a href="content_edit.php?page_id=<?=$item["id"]?>&parent_id=<?=$_REQUEST["parent_id"]?>" class="style3">Edit Content</a></td>
            </tr>
        </table></td>
        <td width="5%" style="padding-left:10px;"><a href="sub_menus1.php?submenu_id=<?=$item["id"]?>&parent_id=<?=$_REQUEST['parent_id']?>&delete=true" class="style3" onclick='return deleteContent()'>Delete</a></td>
      </tr>
      <? $i++; } ?>
    </table>
</div>
<!--welcome admin end here-->
</div>
<!--footer start here-->
<?php include('common/footer.php'); ?>
<!--footer end here--></td>
  </tr>
</table>
</form>


</div>
</center>
</body>
</html>

