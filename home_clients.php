<?php
include("smarty_config.php");
//include("top_menu.php");
if( !isset($_SESSION['username']) ) 
{
	header("Location:index.php");		
}
 else
  {

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = " Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	$custId = $_REQUEST['page_id'];

	$action = $_REQUEST['action'];
	
	if($_REQUEST['menus_id'])
	{
	$custId=$_REQUEST['menus_id'];
	 $del_query = "delete from homeclients where image_id = $custId";
		  
	 $del_query_result = mysql_query($del_query);
	 
	 if($del_query_result)
	 {
	 
	 header("location:home_clients.php?msg=4");
	 
	 }
	
	
	}
	
$select = 'SELECT * FROM homeclients ORDER BY image_id DESC';
$query_result = mysql_query($select);
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
<div class="welcome-admin">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
      <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
        <?=$msg?>
      </font></strong></td>
      <td width="25%" align="right" valign="middle"></td>
    </tr>
    <tr>
      <td align="left" valign="middle">&nbsp;</td>
      <td colspan="2" align="right" valign="middle"><table width="35%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            
            <td><div class="addmenu"><a href="add_hclients.php">Add Clients</a></div></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
<div class="content">
<table width="100%" border="0" >
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1">ID</td>
        <td align="left" class="table1">Client Name</td>
        <td align="left" class="table1">Logo </td>
		<td width="5%" align="left" class="table1">Action</td>
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
        <td width="42%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["imagename"]?></td>
        <td width="45%" height="20" align="left" valign="middle" style="padding-left:10px;"><img src="../uplodeImage/clients/<?=$item["image_type"]?>" width="120" height="60" /></td>
		<td height="20" align="left" style="padding-left:10px;">&nbsp;&nbsp;<a href="add_hclients.php?menus_id=<?=$item["image_id"]?>" class="style3">Edit </a></td>
		<td width="5%" style="padding-left:10px;"><a class="style3" href="home_clients.php?menus_id=<?=$item["image_id"]?>"> Delete</a> </td>
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
