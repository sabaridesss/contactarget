<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {
    $query2= "select * from news_template";
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
		
		$query = "delete from news_template where template_id =".$id;
		if(mysql_query($query)) {
					header("Location:template_list.php?msg=4");		
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
    <td width="16%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="39%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
	<td width="17%" align="right" valign="middle"><div class="addmenu"><a href="news_letter.php">News Letter</a></div></td>
	<td width="14%" align="right" valign="middle"><div class="addmenu"><a href="subscribers_list.php">Subscribers</a></div></td>
    <td width="14%" align="right" valign="middle"><div class="addmenu"><a href="add_template.php">Add Template</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0"  class="content">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1">ID</td>
        <td align="left" class="table1">Template Name </td>
        <td align="left" class="table1">Template Image </td>
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
        <td width="5%" height="20" style="padding-left:10px; height:15px;"><?=$i?></td>
        <td width="40%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["temp_name"]?></td>
        <td width="26%" height="20" align="left" valign="middle" style="padding-left:10px;"><img src="../uplodeImage/newsTemplate/<?=$item["template_name"]?>" width="120" height="70" /></td>
        <td width="29%" style="padding-left:10px;">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" height="20" align="center"><a href="edit_template.php?id=<?=$item["template_id"]?>" class="style3">Edit </a> </td>
              <td width="31%" height="20" align="center"><a href="template_list.php?id=<?=$item["template_id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["template_id"]?>,"delete_menus","")'> Delete</a> </td>
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

