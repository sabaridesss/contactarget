<?php
session_start();
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$msg = "";
	
	if($_REQUEST['msg']=="1"){
		$msg = "Sucessfully Added";	
	}elseif($_REQUEST['msg']=="3"){
		$msg = "Sucessfully Updated";	
	}
	
	//delete from table
	if(isset($_REQUEST["del_id"])) {
	$id = $_REQUEST["del_id"];
		$query = "delete from textarea_tbl where id='".$id."'";
		if(mysql_query($query)) {
			$msg = "Sucessfully Deleted";	
		}       	
	}
	//List products
	$query = "select * from textarea_tbl";
	$query_result = mysql_query($query);
}

?>
<?php include ('common/header.php')?>

<form name="product_list" method="post" action="" >
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
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000"><?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="textarea_edit.php"><strong>Add</strong></a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center">
      <tr class="table1">
        <td height="30" align="left" >ID</td>
        <td align="left" >Name</td>
        <td >Action</td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
      <tr class="<?=$class?>">
        <td width="4%" height="27" align="left" class="style3"><?=$i?></td>
        <td width="25%" align="left" class="style3"><?Php echo $item["id"]; ?></td>
		<td width="21%" ><a href="textarea_edit.php?edit_id=<?=$item["id"]?>" class="style3">Edit</a>&nbsp;&nbsp;&nbsp;<a href="textarea.php?del_id=<?=$item["id"]?>" class="style3" onClick="return delete_page_content();">Delete </a></td>
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

