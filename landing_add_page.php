<?php

include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	$page_id = $_REQUEST['page_id'];
	$page_order = $_REQUEST['page_order'];
	if($page_id != "")
	{
	
	 $query = "select * from `menu_page_tbl` where `is_menu` = 0 and id = $page_id";
		  
	 $query_result = mysql_query($query);
	 $item=mysql_fetch_array($query_result);
	 }
	 
	 
	 
	// Add Contents
	if(isset($_POST['add'])){
		
		if($_POST['add']=="Publish") {
				
				$query1 = "INSERT INTO menu_page_tbl(file_name,title,is_menu,order_id,is_show) VALUES('$page_name','$title',0,'$page_order','1')";
		$rs1 = mysql_query($query1);
		if($rs1){
				header("location:landingpage_index.php?msg=add");
			}
			
		} elseif($_POST['add']=="Add") {
		
				 $query1 = "INSERT INTO menu_page_tbl(file_name,title,is_menu,order_id,is_show) VALUES('$page_name','$title',0,'$page_order','0')";
				
		$rs1 = mysql_query($query1);
		if($rs1){
				header("location:landingpage_index.php?msg=add");
			}
			
		}
	}
	
	//edit contents
	if(isset($_POST['edit'])){
	
		if($_POST['edit']=="Publish") {
				
				$query1 = "update menu_page_tbl set file_name = '$page_name',title = '$title',order_id='$page_order',is_show='1' where id = $page_id";
		$rs1 = mysql_query($query1);
		if($rs1){
				header("location:landingpage_index.php?msg=3");
			}
			
		} elseif($_POST['edit']=="Edit") {
				
				$query1 = "update menu_page_tbl set file_name = '$page_name',title = '$title',order_id='$page_order',is_show='0' where id = $page_id";
		$rs1 = mysql_query($query1);
		if($rs1){
				header("location:landingpage_index.php?msg=3");
			}
			
		}
	}
	
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location:landingpage_index.php");
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
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>
  <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top"><?php if(isset($item)) {?>Edit Pages<?php } else { ?>Add Pages<?php	}?>

</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td align="right" valign="top" id="title_name"><span class="font">Page Title:</span></td>
        <td align="left"><input name="title" type="text" id="title" value="<?=$item["title"]?>" size="60" class="login-textarea1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name"><span class="font">Page Name:</span></td>
        <td align="left"><input name="page_name" type="text" id="page_name" value="<?=$item["file_name"]?>" size="60" class="login-textarea1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">Page Order:</span></td>
        <td align=""><input type="text" name="page_order" id="page_order" value="<?=$item["order_id"]?>" class="login-texbox"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<?php if($page_id != "") { ?>
		
		
		<?php if(isset($_SESSION['sadmin'])) {?> 
		 
		 <input type="submit" name="edit" value="Publish" class="addmenu2" />
		 <?php } else {?>
		 
		 <input type="submit" name="edit" value="Edit" class="addmenu2" />
		 <?php } ?>
		 
		 
		<?php } else { ?>
         
		  
		  <?php if(isset($_SESSION['sadmin'])) {?> 
		 
		 <input type="submit" name="add" value="Publish" class="addmenu2" />
		 <?php } else {?>
		 
		 <input type="submit" name="add" value="Add" class="addmenu2" />
		 <?php } ?>
		  <?php } ?>
		  <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
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

