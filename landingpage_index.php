<?php

include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$page_id = $_REQUEST['page_id'];

	$action = $_REQUEST['action'];
	
	if($page_id != "" && $action == "delete_page_content")
	{
	
	 $del_query = "delete from `menu_page_tbl` where id = $page_id";
		  
	 $del_query_result = mysql_query($del_query);
	 
	 if($del_query_result)
	 {
	 
	 header("location:landingpage_index.php?msg=del");
	 
	 }
	
	
	}
	
	 $query = "select * from `menu_page_tbl` where `is_menu` = 0 ORDER BY `is_show` ASC";
		  
	 $query_result = mysql_query($query);
	
	
	 
	 
	 $msg = "";
	if($_REQUEST["msg"] == 'add'){
		$msg = "Sucessfully Added";
		
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Sucessfully Updated";
		
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
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="landing_add_page.php">Add Page</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1"><strong>ID</strong></td>
        <td align="left" class="table1"><strong>Page Name</strong></td>
        <td align="left" class="table1"><strong>File Name</strong></td>
		<td align="left" class="table1"><strong>Page Order</strong></td>
		<td align="left" class="table1">Status</td>
		<td align="left" class="table1">Preview</td>
        <td width="32%" class="table1"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	     $class="table3";
	   ?>
      <tr class="<?= $class ?>" >
        <td width="3%" height="27" align="left" style="padding-left:10px;"><?=$i?></td>
        <td width="15%" align="left" style="padding-left:10px;"><?=$item["title"]?></td>
        <td width="18%" align="left" style="padding-left:10px;"><?=$item["file_name"]?></td>
		<td align="left" style="padding-left:10px;"><?=$item["order_id"]?></td>
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
		<a><a href="javascript:void(0)" onclick="window.open('http://valoanshouston.us/<?=$item["file_name"]?>?type=p')">Preview</a></a>		</td>
        <td width="32%" style="padding-left:10px;"><table width="100%"  border="0">
            <tr>
              <td width="24%" align="center"><a href="landing_add_page.php?page_id=<?=$item["id"]?>" class="style3">Edit </a> </td>
              <td width="37%" align="center"><a href="javascript:void(0)" class="style3" onclick='return delete_page_content_landPage(<?=$item["id"]?>)'> Delete</a> </td>
              <td width="75%" align="center"><a href="landing_content_edit.php?page_id=<?=$item["id"]?>&action=edit_page_contents" class="style3">Edit Content</a></td>
            </tr>
        </table></td>
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

