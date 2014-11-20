<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

    $query2= "select * from social_media_tbl";
	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Social Media Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Social Media Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from social_media_tbl where social_id =".$id;
		if(mysql_query($query)) {
					header("Location:social_media_list.php?msg=4");		
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
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_socialMedia.php">Add Social Media</a> </div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center" >
      <tr class="table1">
        <td height="30" align="center" class="style6"><strong>ID</strong></td>
        <td align="left" class="style6"><strong> Site Name </strong></td>
        <td align="left" class="style6"><strong>Image Name </strong></td>
        <td align="left" class="style6"><strong>Active/Inactive</strong></td>
        <td align="left" class="style6"><strong>Image Orde</strong></td>
        <td class="style6"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";

		if($item["active"] == '1')
		{
			$active = 'Active';
		}
		else
		{
			$active = 'Inactive';
		}
		  
	   ?>
      <tr class="<?=$class?>">
        <td width="4%" height="27" align="center" class="style6"><?=$i?></td>
        <td width="34%" align="left" class="style6"><?=$item["company_name"]?></td>
        <td width="15%" align="left" class="style6"><?=$item["media_name"]?></td>
        <td width="14%" align="left" class="style6"><?=$active?></td>
        <td width="16%" align="left" class="style6"><?=$item["image_order"]?></td>
        <td width="17%">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" align="center"><a href=" add_socialMedia.php?id=<?=$item["social_id"]?>" class="style6">Edit </a> </td>
              <td width="31%" align="center"><a href="social_media_list.php?id=<?=$item["social_id"]?>&delete=true" class="style6" onclick='return deleteContent1(<?=$item["social_id"]?>,"delete_menus","")'> Delete</a> </td>
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
