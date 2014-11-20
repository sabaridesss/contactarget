<?php

include("smarty_config.php");
//include("top_menu.php");

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
    <td width="49%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="31%" align="right" valign="middle">
		  <?php if($main_catg_id != "") {?>
		  <div class="addmenu"><a href="add_tab.php?main_catg_id=<?=$main_catg_id?>&action=add_tab_menu">Add Tab</a></div>
		  <?php }else if($sub_catg_id != ""){ ?>
		  <div class="addmenu"><a href="add_tab.php?sub_catg_id=<?=$sub_catg_id?>&action=add_tab_menu">Add Tab</a></div>
		  <?php }else if($page_content_id != ""){ ?>
  		  <div class="addmenu"><a href="add_tab.php?page_content_id=<?=$page_content_id?>&action=add_tab_menu">>Add Tab</a></div>
		  <?php } ?>
	</td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1">ID</td>
        <td align="left" class="table1">Tab Name</td>
        <td align="left" class="table1">Tab Content</td>
		<td align="left"class="table1">Order Id</td>
        <td class="table1">Action</td>
      </tr>
      <? 
	  $i=1;
	  if($query_result > 0)
	  {
	  while($item=mysql_fetch_array($query_result)){
	  $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
      <tr  class="<?= $class ?>" >
        <td width="5%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="10%" align="left" class="style3"><?=$item["Tab_Title"]?></td>
        <td width="63%" align="left" class="style3"><?=$item["Tab_Description"]?></td>
		<td width="9%" align="left" class="style3"><?=$item["order_id"]?></td>
        <td width="13%"><table width="100%"  border="0">
            <tr>
              <td width="21%" align="center">
			  <?php if($main_catg_id != "") {?>
			  <a href="add_tab.php?tab_id=<?=$item["Tab_ID"]?>&parent_id=<?=$main_catg_id?>&edit=true" class="style3">Edit </a>              
			  <?php }else if($sub_catg_id != ""){ ?>
              <a href="add_tab.php?tab_id=<?=$item["Tab_ID"]?>&sub_catg_id=<?=$item["Sub_Category_ID"]?>" class="style3">Edit </a>			               <?php }else if($page_content_id != ""){ ?>
			  <a href="add_tab.php?tab_id=<?=$item["Tab_ID"]?>&page_content_id=<?=$item["Page_Content_ID"]?>" class="style3">Edit </a>
			  <?php } ?>
			  </td>
              <td width="29%" align="center">
			  
			  <?php /*?><a href="javascript:void(0)" class="style3" onclick='delete_tab_content(<?=$item["Tab_ID"]?>,<?=$item["Main_category_ID"]?>,<?=$item["Sub_Category_ID"]?>,<?=$item["Page_Content_ID"]?>)'> Delete</a> <?php */?>
			  <a href="tab_index.php?tab_id=<?=$item["Tab_ID"]?>&parent_id=<?=$main_catg_id?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["Tab_ID"]?>,"delete_tab","<?=$main_catg_id?>")'> Delete</a>
			  </td>
              
            </tr>
        </table></td>
      </tr>
      <? $i++; } }?>
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
