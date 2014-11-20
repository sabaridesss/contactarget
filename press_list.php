<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {
    $query2= "select * from press_tbl";
	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Article Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Article Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from press_tbl where id=".$id;
		if(mysql_query($query)) {
					header("Location:press_list.php?msg=4");		
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
    <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="add_press.php">Add Press</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center" class="welcome">
      <tr class="table1">
        <td height="30" align="center" ><strong>ID</strong></td>
        <td align="left" ><strong>Press Name</strong></td>
        <td align="left" ><strong>Author</strong></td>
		<td align="left" ><strong>Published Date</strong></td>
		<td align="left" ><strong>Created Date</strong></td>
        <td ><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		if($item['news_date'] == '0000-00-00')
		{
			$newsDate = '';
		}
		else
		{	
			$newsDate = date("m-d-Y",strtotime($item['news_date']));
		}	
	   ?>
      <tr class="<?=$class?>" >
        <td width="3%" height="27" align="center" class="font2"><?=$i?></td>
        <td width="26%" align="left" class="font2"><?=$item["press_name"]?></td>
        <td width="32%" align="left" class="font2"><?=$item["press_author"]?></td>
		<td width="11%" align="center" class="font2"><?=$newsDate?></td>
		<td width="14%" align="left" class="font2"><?=$item["created_date"]?></td>
        <td width="14%">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" align="center" class="font2"><a href="add_press.php?id=<?=$item["id"]?>" class="style3">Edit </a> </td>
			  <td width="31%" align="center" class="font2"><a href="press_list.php?id=<?=$item["id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> Delete</a> </td>
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

