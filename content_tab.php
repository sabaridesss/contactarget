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
			$query = "delete from content_tab where footer_id ='".$menus_id."'";
			if(mysql_query($query))
			{
				header("Location:content_tab.php?msg=4");		
			}
		
	}



$cat_query = "select * from content_tab";
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
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?> </td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="content_tab_add.php">Add Content Tab</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="80%" border="0" align="center" class="content">
            <tr class="table1">
              <td height="30" align="center" class="style6"><strong>ID</strong></td>
              <td width="66%" align="center" class="style6"><strong>Content Tab Name</strong></td>
               <td width="66%" align="center" class="style6"><strong>Content Tab Order</strong></td>
              <td align="center" class="style6"><strong>Action</strong></td>
            </tr>
            <? 
	  $i=1;
	  while($item=mysql_fetch_array($rs)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";
			

		  
	   ?>
            <tr class="<?= $class; ?>">
              <td width="12%" height="27" align="center" class="style6"><?=$i?></td>
              <td align="left" class="style6"><a href="javascript:void(0)" onclick="window.open('content_tab_image.php?page_id=<?=$item['footer_id']?>',
'mywindow','width=550,height=410,top=200,left=300,scrollbars=yes'); "><?=$item["footer_name"]?></a></td>
 <td width="12%" height="27" align="center" class="style6"><?=$item["footer_order"]?></td>
              <td width="22%"><table width="100%"  border="0">
                  <tr>
                    <td width="22%" align="center">&nbsp;</td>
                    <td width="36%" align="center"><a href="content_tab_add.php?webId=<?=$item["footer_id"]?>" class="style6">Edit </a> </td>
                    <td width="42%" align="center"><a href="content_tab.php?id=<?=$item["footer_id"]?>&amp;delete=true" class="style6" onclick='return deleteContent1(<?=$item["footer_id"]?>,&quot;delete_menus&quot;,&quot;&quot;)'> Delete</a> </td>
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

