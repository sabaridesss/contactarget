<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {

    $query2= "select * from pakage_categories order by cat_order ASC";
	
	$query_result = mysql_query($query2);
	
	
	
   
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Details Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Details Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	else if($_REQUEST["msg"] == '5'){
	
		$msg = "Can't delete This Can Affect Packages";	
	}
	
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query_chk = "select  package_id from pkg_tbl where package_id=".$id;
		$query_find_exists=mysql_query($query_chk);
		if(mysql_num_rows($query_find_exists)>0)
		header("Location:package_categories.php?msg=5");
		else 
		{
		
		$unlink_del="select url from `pakage_categories` where id='".$id."'";
		$exe_link=mysql_query($unlink_del);
		$row_link = mysql_fetch_array($exe_link);
		$file_del= $row_link['url'];
		$name = "../";
		
		
		$query = "delete from pakage_categories where id=".$id;
		if(mysql_query($query)) {
		 unlink($name.$file_del);
					header("Location:package_categories.php?msg=4");		
				}
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


<td width="25%" align="right" valign="middle"><div class="addmenu"><a href="packages.php">Packages</a></div></td>
<td width="25%" align="right" valign="middle">&nbsp;</td>
<td width="25%" align="right" valign="middle"><div class="addmenu"><a href="package_add.php">Add Package Type</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center" class="welcome">
      <tr class="table1">
        <td height="30" align="left" ><strong>Id</strong></td>
        <td align="left" width="30%" ><strong>Package Type</strong></td>
         <td align="left" width="30%" ><strong>URL</strong></td>
     <td align="left" ><span class="font"><strong>Sort Order</strong></span></td>
		  <!-- <td align="left" ><span class="font"><strong>Experience</strong></span></td>
		<td align="left" ><span class="font"><strong>Post Date</strong></span></td>-->
        <td width="40%" ><strong>Action</strong></td>
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
        <td width="20%" align="left" class="font2"><?=$item["cat_name"]?></td>
        <td width="20%" align="left" class="font2"><?=$item["url"]?></td>
         <td width="20%" align="left" class="font2"><?=$item["cat_order"]?></td>
      
        <td width="28%">
		<table width="100%"  border="0">
            <tr>
              <td width="50%" align="center" class="font2"><a href="package_add.php?id=<?=$item["id"]?>" class="style3">Edit </a> </td>
			
               
              
              <td width="50%" align="center" class="font2"><a href="package_categories.php?id=<?=$item["id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> Delete</a> </td>
              
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

