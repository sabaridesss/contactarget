<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {
    $query2= "select * from news_letter_tbl";
	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Article Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Article Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}else if($_REQUEST["msg"] == '5'){
	
		$msg = "News Letter Suceessfully Sent to Subscribers";	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from news_letter_tbl where id=".$id;
		if(mysql_query($query)) {
					header("Location:news_letter.php?msg=4");		
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
    <td width="53%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="11%" align="right" valign="middle"><div class="addmenu"><a href="n_l_content.php">Add News Letter</a></div></td>
    <td width="15%" align="right" valign="middle"><div class="addmenu"><a href="subscribers_list.php">Subscribers</a></div></td>
    <td width="1%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center">
      <tr class="table1">
        <td height="30" align="left" >ID</td>
        <td align="left" >News Letter</td>
		<td align="left">Date</td>
        <td >Action</td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
      <tr class="<?=$class?>" >
        <td width="3%" height="27" align="left" ><?=$i?></td>
        <td width="20%" align="left" ><?=$item["title"]?></td>
		<td width="12%" align="left" ><?=$item["created_date"]?></td>
        <td width="28%">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" align="center"><a href="n_l_content.php?id=<?=$item["id"]?>" >Edit </a> </td>
			  <td width="21%" align="center"><a href="testmail2.php?title=<?=$item["title"]?>&id=<?=$item["id"]?>" >Send Mail </a> </td>
              <td width="21%" align="center"><a href="n_l_sent_list.php?id=<?=$item["id"]?>" >Send List </a> </td>
              <td width="31%" align="center"><a href="news_letter.php?id=<?=$item["id"]?>&delete=true" class="style3" onclick='return deleteContent1()'> Delete</a> </td>
              
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


