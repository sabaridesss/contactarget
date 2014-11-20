<?php
session_start();
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$msg = "";
	//products added message and updaed message
	if(isset($_REQUEST["add"]) && ($_REQUEST["add"] == "true")) {
		$msg = "Product Sucessfully Added";	
	}else if(isset($_REQUEST["update"]) && ($_REQUEST["update"] == "true")) {
		$msg = "Product Sucessfully Updated";	
	}
	
	//delete products from table
	if(isset($_REQUEST["delete"]) && ($_REQUEST["delete"] == "true")) {
	$prod_id = $_REQUEST["id"];
		$query = "delete from products where prod_id='".$prod_id."'";
		if(mysql_query($query)) {
			$msg = "Product Sucessfully Deleted";	
		}       	
	}
	//List products
	$query_result = $obj_mysql->get_products_query_for_admin();
}

?>

<?php include ('common/header.php')?>

<form name="product_list" method="post" action="" >

<table width="1200px" border="0" cellpadding="0">
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="right" class="top">
	<?php include('common/top_menu.php') ?>
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"><table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="585"  align="right"><div class="addmenu"><a href="products_add.php">Add Products</a></div></td>
        <td width="106"  align="right"><div class="addmenu"><a href="category.php">Category</a></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>

      <div class="content">
     <table width="100%" border="0" >
      <tr bgcolor="#cccccc" class="table1">
        <td height="30" align="left" >ID</td>
        <td align="left" >Product Name</td>
        <td align="left">Action</td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	  $class="table2";
	   if(($i%2)==0)
	    $class="table3";


		  
	   ?>
      <tr class="<?= $class ?>">
        <td width="4%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="25%" align="left" class="style3"><a href="products_add.php?show=true&prod_id=<?=$item["prod_id"]?>"><?Php echo $item["prod_name"]; ?></a></td>
		<td width="21%" align="left" ><a href="products_add.php?edit=true&prod_id=<?=$item["prod_id"]?>" class="style3">Edit </a>&nbsp;&nbsp;&nbsp;<a href="products_list.php?id=<?=$item["prod_id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["prod_id"]?>,"delete_menus","")'> Delete</a></td> 
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
