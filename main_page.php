<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {
	$query_result = $obj_mysql->get_topmenus();
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Menus Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Menus Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	else if($_REQUEST["msg"] == '5'){
	
		$msg = "Published Suceessfully ";	
	}
	if($_REQUEST['delete']=="true") {
		$menus_id = $_REQUEST['id'];
		$sel_query = "select * from `menu_page_tbl` where `parent_id` = '$menus_id'";
		$exec_Sel_auery = mysql_query($sel_query);
		$num_of_rows = mysql_num_rows($exec_Sel_auery);
		if($num_of_rows == 0)
		{
		$unlink_del="select * from `menu_page_tbl` where id='".$menus_id."'";
		$exe_link=mysql_query($unlink_del);
		$row_link = mysql_fetch_array($exe_link);
		$file_del= $row_link['file_name'];
		$name = $_SERVER['DOCUMENT_ROOT']."/";
		
			$query = "delete from menu_page_tbl where id='".$menus_id."'";
			if(mysql_query($query))
			{	
			    $query = "delete from tabs_tbl where parent_id ='".$menus_id."'";
				if(mysql_query($query)) {
				unlink($name.$file_del);
					header("Location:main_page.php?msg=4");		
				}
			}
			else
			{
			 echo mysql_error();
			}
		}else if($num_of_rows > 0)
		{
			 $msg = 'This menu has submenus.Hence cannot be deleted here.';
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
     
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_menus.php">Add Menus</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" >
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1">ID</td>
        <td align="left" class="table1">Menus Name</td>
        <td align="left" class="table1">File Name</td>
		<td align="left" class="table1"> Order</td>
		<td width="13%" align="left" class="table1">Tabs</td>
		<td width="7%" align="left" class="table1">Status</td>
		<td width="5%" align="left" class="table1">Preview</td>
        <td class="table1">Action</td>
        <td class="table1">Delete</td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
      <tr class="<?= $class ?>" >
        <td width="3%" height="20" style="padding-left:10px; height:15px;"><?=$i?></td>
        <td width="20%" height="20" align="left" valign="middle" style="padding-left:10px;"><a href="sub_menus.php?parent_id=<?=$item["id"]?>"><?=$item["title"]?></a></td>
        <td width="30%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["file_name"]?></td>
		<td width="4%" height="20" align="left" style="padding-left:10px;"><?=$item["order_id"]?></td>
		<td height="20" style="padding-left:10px;"><a href="add_tab.php?main_catg_id=<?=$item["id"]?>&amp;action=add_tab_menu">Add Tab</a>&nbsp;&nbsp;<a href="tab_index.php?main_catg_id=<?=$item["id"]?>">View Tab</a></td>
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
		?>
		</td>
		<td height="20" style="padding-left:10px;">
		<a><a href="javascript:void(0)" onclick="window.open('http://desss.com/<?=$item["file_name"]?>')">Preview</a></a>
		</td>
        <td width="13%" style="padding-left:10px;">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" height="20" align="center"><a href="edit_menus.php?menus_id=<?=$item["id"]?>" class="style3">Edit </a> </td>
              <td width="48%" height="20" align="center"><a href="content_edit.php?page_id=<?=$item["id"]?>&amp;action=edit_main_contents" class="style3">Edit Content</a></td>
            </tr>
        </table></td>
        <td width="5%" style="padding-left:10px;"><a href="main_page.php?id=<?=$item["id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> Delete</a> </td>
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
