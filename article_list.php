<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {
    $query2= "select * from article_tbl";
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
		
		$query = "delete from article_tbl where id=".$id;
		if(mysql_query($query)) {
					header("Location:article_list.php?msg=4");		
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
    <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="article_page.php">Add Article</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center" class="welcome">
      <tr class="table1">
        <td height="30" align="left" ><strong>ID</strong></td>
        <td align="left" >Article Name</td>
        <td align="left" ><strong>Author</strong></td>
		<td align="left" ><strong>Date</strong></td>
        <td ><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
      <tr class="<?=$class?>" >
        <td width="3%" height="27" align="left" class="font2"><?=$i?></td>
        <td width="20%" align="left" class="font2"><?=$item["article_name"]?></td>
        <td width="18%" align="left" class="font2"><?=$item["article_author"]?></td>
		<td width="12%" align="left" class="font2"><?=$item["created_date"]?></td>
        <td width="28%">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" align="center" class="font2"><a href="article_page.php?id=<?=$item["id"]?>" class="style3">Edit </a> </td>
			  <td width="21%" align="center" class="font2"><a href="javascript:void(0)" class="style3" onclick="window.open('img_upload1.php?article_id=<?=$item['id']?>',
'mywindow','width=700,height=400,top=200,left=300,scrollbars=yes'); ">Images</a> </td>
              <td width="31%" align="center" class="font2"><a href="article_list.php?id=<?=$item["id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> Delete</a> </td>
              
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

