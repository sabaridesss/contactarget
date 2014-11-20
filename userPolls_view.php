<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

    $query2= "select * from user_pollos";
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
		
		$query = "delete from user_pollos where polls_id =".$id;
		if(mysql_query($query)) {
					header("Location:userPolls_view.php?msg=4");		
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
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_polls.php">Add Polls</a> </div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center" >
      <tr class="table1">
        <td height="30" align="center" class="style6"><strong>ID</strong></td>
        <td align="left" class="style6"><strong>Question</strong></td>
        <td align="left" class="style6"><strong>Answer A</strong></td>
        <td align="left" class="style6"><strong>Answer B</strong></td>
        <td align="left" class="style6"><strong>Answer C</strong></td>
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
        <td width="4%" height="27" align="center" class="style6"><?=$i?></td>
        <td width="35%" align="left" class="style6"><?=$item["qustion"]?></td>
        <td width="15%" align="left" class="style6"><?=$item["ans_a"]?></td>
        <td width="16%" align="left" class="style6"><?=$item["ans_b"]?></td>
        <td width="13%" align="left" class="style6"><?=$item["ans_c"]?></td>
        <td width="17%">
		<table width="100%"  border="0">
            <tr>
              <td width="22%" align="center"><a href=" add_polls.php?id=<?=$item["polls_id"]?>" class="style6">Edit </a> </td>
              <td width="32%" align="center"><a href="userPolls_view.php?id=<?=$item["polls_id"]?>&delete=true" class="style6" onclick='return deleteContent1(<?=$item["polls_id"]?>,"delete_menus","")'> Delete</a> </td>
              <td width="46%" align="center"><a href=" view_polls_result.php?id=<?=$item["polls_id"]?>" class="style6">View Result</a></td>
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
