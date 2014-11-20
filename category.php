<?php
session_start();
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	//List products
	$query_result = $obj_mysql->get_prod_category_query();
	
	if($_REQUEST['msg'] == "added") {
		$msg = "Category successfully added.";
	}elseif($_REQUEST['msg'] == "edited") {
		$msg = "Category successfully Updated";
	}elseif($_REQUEST['msg'] == "deleted") {
		$msg = "Category successfully deleted";
	}
	
	// Add products
	if(isset($_POST['submit']) && ($_POST['submit'] == "add")){
		
		$cat_name = $_REQUEST['cat_name'];

		 $query = "INSERT INTO prod_category(cate_name,created_at)VALUES('".$cat_name."',now())";
		
		if(mysql_query($query)) {
			header("Location:category.php?msg=added");
		}	 
	}
	
	//Edit product
	if(isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "edit")){
		$cat_id = $_REQUEST['hid_cat_id'];
		$cat_name = $_REQUEST['cat_name'];
		$query = "update prod_category set cate_name='".$cat_name."' where id='".$cat_id."'";
		
		if(mysql_query($query)) {
			header("Location:category.php?msg=edited");
		}
		
	}
	
	//Fetch product records for edit and show 
	if( (isset($_REQUEST['edit'])) && ($_REQUEST['edit'] == "true") ){
		
		$cat_id = $_REQUEST['cat_id'];
		$query_result = $obj_mysql->get_prod_category_for_edit($cat_id);
		$item=mysql_fetch_array($query_result);
		$cat_name = $item["cate_name"];
		$cat_id = $item["id"];
	}
	
	//delete products from table
	if(isset($_REQUEST["delete"]) && ($_REQUEST["delete"] == "true")) {
	$cat_id = $_REQUEST["cat_id"];
		$query = "delete from prod_category where id='".$cat_id."'";
		if(mysql_query($query)) {
			header("Location:category.php?msg=deleted");
		}       	
	}
}
?>
<?php include ('common/header.php')?>
<form name="category" method="post" action="category.php" >
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
  <table width="650" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
	
      <tr class="login-top">
        <td height="50" colspan="3" align="left">
		<?php if(isset($_REQUEST['edit'])) {?>
		<strong>Edit Category</strong>
		<?php } else {?>
		<strong>Add Category</strong>
		<?php }?>		</td>          
      </tr>
	  
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right" valign="top" id="title_name">Category Name:</td>
		<?php if(isset($_REQUEST['edit'])) {?>
		<td colspan="2" align="left"><input type="text"  maxlength="50"  size="50" class="login-texbox1" name="cat_name" id="cat_name" value="<?php echo $cat_name;?>" /></td>
		<?php } else {?> 
		<td colspan="2" align="left"><input type="text" maxlength="50"  size="50" class="login-texbox1" name="cat_name" id="cat_name"  /></td>
		<?php }?>     
      </tr>
      
      <tr>
        <td align="right" valign="top"></td>
		<?php if(isset($_REQUEST['edit'])) {?>
		<td width="232"><input type="submit" name="edit" value="edit" class="addmenu2"/>&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="addmenu2"/></td>
		<input type="hidden" name="hid_cat_id" value="<?php echo $cat_id;?>" />
		<?php } else {?>
		<td width="232"><input type="submit" name="submit" value="add" class="addmenu2"/>&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" class="addmenu2" /></td>
		<?php }?>
      </tr>
	  
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
	  
	  <tr>
        <td colspan="3" align="center"><h3 style="color:#FF0000"><?=$msg?>
        </h3><div id="delete_content" style="color:#FF0000;font-weight:bold;margin-left:120px;"></div></td>
        </tr>
    </table>
  <br>
  <?php if(isset($query_result)) {?>

<table width="100%" border="0" align="center" >
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1">ID</td>
        <td align="left" class="table1">Category Name</td>
        <td class="table1">Action</td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	  $class="table2";
	   if(($i%2)==0)
	    $class="table3";


		  
	   ?>
      <tr class="<?= $class ?>" >
        <td width="4%" height="28" align="left" class="style3"><?=$i?></td>
        <td width="25%" align="left" class="style3"><?Php echo $item["cate_name"]; ?></td>
		<td width="21%" align="left" ><a href="category.php?edit=true&cat_id=<?=$item["id"]?>" class="style3">Edit </a>&nbsp;&nbsp;&nbsp;<a href="category.php?cat_id=<?=$item["id"]?>&amp;delete=true" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_category","")'>Delete </a></td>
      </tr>
      <? $i++; } ?>
  </table>
	
<?php }?>

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


