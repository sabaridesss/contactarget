<?php

include("smarty_config.php");
//include("top_menu.php");

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
					header("location:tab_index.php?main_catg_id=$main_catg_id&msg=add");
				} elseif($value == "Update") {
					header("location:tab_index.php?main_catg_id=$parent_id&msg=update");
				}
			}else if($sub_catg_id != "")
			{
				//header("location:tab_index.php?sub_catg_id=$sub_catg_id&msg=3");
				header("location:www.google.com");
			}
			else if($page_content_id != "")
			{
				if($value == "Add") {
					header("location:tab_index.php?page_content_id=$page_content_id&msg=add");
				} elseif($value == "Update") {
					header("location:tab_index.php?page_content_id=$page_content_id&msg=update");
				}
			}
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
<div class="content"><br>
  <table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Add Tabs</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="134" align="right" valign="top" id="title_name">Tab Title:</td>
        <td width="797" align="left"><input name="tab_title" type="text" id="tab_title" value="<?=$tab_item["Tab_Title"]?>" size="50" class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Order Id:</td>
        <td align="left"><input type="text" name="order_id" id="order_id" value="<?=$tab_item["order_id"]?>" class="login-texbox"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">Tab Description:</td>
        <td align=""><textarea id="tab_desc" name="tab_desc" rows="8" cols="35" class="login-textarea1"><?=$tab_item["Tab_Description"]?></textarea>
		
<script type="text/javascript">
    CKEDITOR.replace('tab_desc');
 </script></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><input type="submit" name="Submit" value="<?=$value?>" class="addmenu2"/>
          &nbsp;&nbsp;&nbsp;
          <input type="button" name="Cancel" value="Cancel" onClick="return redirect_page('<?=$_SERVER['HTTP_REFERER']?>')" class="addmenu2"/>
        </td>
      </tr>
    </table></td>
  </tr>
</table>
<br>
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

