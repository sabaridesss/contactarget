<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

    $query2= "select * from twitter_tbl";
	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Twitter Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Twitter Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from twitter_tbl where twitter_id =".$id;
		if(mysql_query($query)) {
					header("Location:twitter_list.php?msg=4");		
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
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_twitter.php">Add Twitter</a> </div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center" >
      <tr class="table1">
        <td height="30" align="center" class="style6"><strong>ID</strong></td>
        <td width="78%" align="left" class="style6"><strong>API Key </strong></td>
        <td class="style6"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";


		  
	   ?>
      <tr class="<?=$class?>">
        <td width="5%" height="27" align="center" class="style6"><?=$i?></td>
        <td align="left" class="style6"><?=$item["api_key"]?></td>
        <td width="17%">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" align="center"><a href=" add_twitter.php?id=<?=$item["twitter_id"]?>" class="style6">Edit </a> </td>
              <td width="31%" align="center"><a href="twitter_list.php?id=<?=$item["twitter_id"]?>&delete=true" class="style6" onclick='return deleteContent1(<?=$item["twitter_id"]?>,"delete_menus","")'> Delete</a> </td>
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
