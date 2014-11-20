<?php
include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}

	if($_REQUEST['delete']=="true")
	 {
	 		$menus_id = $_REQUEST['id'];
			$query = "delete from clients_tbl where id ='".$menus_id."'";
			if(mysql_query($query))
			{
				header("Location:clients_list.php?msg=4");		
			}
		
	}



$cat_query = "select * from clients_tbl";
$rs = mysql_query($cat_query);
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
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td colspan="2" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="addmenu"><a href="view_siteinfo.php" class="style5">View Category </a></div></td>
        <td><div class="addmenu"><a href="view_sitedetails.php"  class="style5">View Site Details</a></div></td>
        <td><div class="addmenu"><a href="view_technology.php" class="style5">View Technologys</a></div></td>
        <td><div class="addmenu"><a href="view_industry.php"  class="style5">View Industry</a></div></td>
        <td><div class="addmenu"><a href="add_clients.php"  class="style5">Add Clients</a></div></td>
      </tr>
    </table></td>
    </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center">
              <tr class="table1">
                <td height="30" align="center">ID</td>
                <td width="66%" align="center">Clients</td>
                <td align="center">Action</td>
              </tr>
              <? 
	  $i=1;
	  while($item=mysql_fetch_array($rs)){
	   $class="table2";
	   if(($i%2)==0)
	      $class="table3";


		  
	   ?>
              <tr class="<?=$class?>">
                <td width="8%" height="27" align="center" class="style6"><?=$i?></td>
                <td align="left" class="style6" style="padding-left:10px;"><?=$item['client_name']?></td>
                <td width="26%"><table width="100%"  border="0">
                    <tr>
                      <td width="43%" align="center"><a href="add_clients.php?id=<?=$item["id"]?>" class="style6">Edit </a> </td>
                      <td width="57%" align="center"><a href="clients_list.php?id=<?=$item["id"]?>&amp;delete=true" class="style6" onclick='return deleteContent1(<?=$item["id"]?>,&quot;delete_menus&quot;,&quot;&quot;)'> Delete</a> </td>
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

