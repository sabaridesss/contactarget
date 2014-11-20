<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Menus Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Menus Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	$custId = $_REQUEST['page_id'];

	$action = $_REQUEST['action'];
	
	if($custId != "" && $action == "delete_photoGallery")
	{
	
	 $del_query = "delete from photo_gallery where photo_id = $custId";
		  
	 $del_query_result = mysql_query($del_query);
	 
	 if($del_query_result)
	 {
	 
	 header("location:image_gallery_view.php?msg=4");
	 
	 }
	
	
	}
	
$select = 'SELECT * FROM photo_gallery ORDER BY photo_id DESC';
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
            <td><div class="addmenu"><a href="video_gallery_view.php">Video Gallery</a></div></td>
            <td><div class="addmenu"><a href="add_image_gallery.php">Add Image</a></div></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
<div class="content">
<table width="100%" border="0" >
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1">ID</td>
        <td align="left" class="table1">Image Name</td>
        <td align="left" class="table1">Image View </td>
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
        <td width="42%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["photo_name"]?></td>
        <td width="45%" height="20" align="left" valign="middle" style="padding-left:10px;"><img src="../uplodeImage/photoGallery/<?=$item["upload_photo"]?>" width="120" height="60" /></td>
		<td height="20" align="left" style="padding-left:10px;">&nbsp;&nbsp;<a href="add_image_gallery.php?menus_id=<?=$item["photo_id"]?>" class="style3">Edit </a></td>
		<td width="5%" style="padding-left:10px;"><a href="javascript:void(0)" class="style3" onclick='return delete_photoGallery_page(<?=$item["photo_id"]?>)'> Delete</a> </td>
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
