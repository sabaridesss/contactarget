<?php
session_start();
include("smarty_config.php");
include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	//List products
	$query_result = $obj_mysql->get_prod_category_query();
	
	// Add products
	if(isset($_POST['submit']) && ($_POST['submit'] == "add")){
		$cat_name = $_REQUEST['cat_name'];

		 $query = "INSERT INTO prod_category(cate_name,created_at)VALUES('".$cat_name."',now())";
		
		if(mysql_query($query)) {
			$msg = "Category successfully added";
		}	 
}

//Edit product
if(isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "edit")){
	$cat_name = $_REQUEST['cat_name'];
	
	$query = "update prod_category set prod_category='".$cat_name."' where prod_id='".$prod_id."'";
	
	if(mysql_query($query)) {
		$msg = "Category successfully Updated";
	}
	
}

//Fetch product records for edit and show 
if( (isset($_REQUEST['edit'])) && ($_REQUEST['edit'] == "true") ){

	$cat_id = $_REQUEST['cat_id'];
	$query_result = $obj_mysql->get_prod_category_for_edit($cat_id);
	$item=mysql_fetch_array($query_result);
	$cat_name = $item["cate_name"];
}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form name="category_add" method="post" action="category_add.php" >
<table width="963" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
<td align="right"><?php include("top_menu.php"); ?></td>
  </tr>
  <tr>
    <td width="173" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" valign="top"><table width="650" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
	
      <tr>
        <td height="50" align="right"> <?=$msg?></td>
		<?php if(isset($_REQUEST['edit'])) {?>
		<td width="232" id="link_title"><strong>Edit Category</strong></td>
		<?php } else {?>
		<td width="232" id="link_title"><strong>Add Category</strong></td>
		<?php }?>          
      </tr>
	  
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right" valign="top" id="title_name">Category Name:</td>
		<?php if(isset($_REQUEST['edit'])) {?>
		<td colspan="2" align="left"><input type="text" name="cat_name" id="cat_name" value="<?php echo $cat_name;?>"/></td>
		<?php } else {?> 
		<td colspan="2" align="left"><input type="text" name="cat_name" id="cat_name" /></td>
		<?php }?>     
      </tr>
      
      <tr>
        <td align="right" valign="top"></td>
		<?php if(isset($_REQUEST['edit'])) {?>
		<td><input type="submit" name="edit" value="edit" />&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" /></td>
		<input type="hidden" name="hid_prod_id" value="<?php echo $prod_id;?>" />
		<?php } else {?>
		<td><input type="submit" name="submit" value="add" />&nbsp;&nbsp;<input type="reset" name="reset" value="Reset" /></td>
		<?php }?>
      </tr>
	  
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>


<?php if(isset($query_result)) {?>

<table width="100%" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="style3"><strong>ID</strong></td>
        <td align="left" class="style3"><strong>Category Name</strong></td>
        <td class="style3"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $bgcolor="#ffffff";
	   if(($i%2)==0)
	     $bgcolor="#f6f6f6";


		  
	   ?>
      <tr bgcolor="<?=$bgcolor?>" onmouseover="this.className='tableover'" onmouseout="this.className='dataclass'">
        <td width="4%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="25%" align="left" class="style3"><?Php echo $item["cate_name"]; ?></td>
		<td width="21%" ><a href="category_add.php?edit=true&cat_id=<?=$item["id"]?>" class="style3">Edit </a>&nbsp;&nbsp;&nbsp;<a href="products_list.php?delete=true&cat_id=<?=$item["id"]?>" class="style3">Delete </a></td>
      </tr>
      <? $i++; } ?>
    </table>
	
<?php }?>


</form>
</body>
</html>
