<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {

    $query2= "select * from careers_main_cat_tbl_job order by cat_order ASC";
	
	$query_result = mysql_query($query2);
	
	
	
   
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Details Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Details Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from careers_main_cat_tbl_job where main_cat_id=".$id;
		if(mysql_query($query)) {
					header("Location:categories.php?msg=4");		
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
<td width="25%" align="right" valign="middle"><div class="addmenu"><a href="categories_add.php">Add Categories</a></div></td>
<td width="25%" align="right" valign="middle"><div class="addmenu"><a href="job_position_list.php">Careers</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center" class="welcome">
      <tr class="table1">
        <td height="30" align="left" ><strong>ID</strong></td>
        <td align="left" width="60%" ><strong>Categories Name</strong></td>
       <!-- <td align="left" ><span class="font"><strong>Job Title</strong></span></td>
		<td align="left" ><span class="font"><strong>Experience</strong></span></td>
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
        <td width="20%" align="left" class="font2"><a href="sub_categories_add.php?id=<?=$item["main_cat_id"]?>&add=true" class="style3" ><?=$item["cat_name"]?></a></td>
       <!-- <td width="18%" align="left" class="font2"><?=$item["job_title"]?></td>
		<td width="12%" align="left" class="font2"><?=$item["job_exp"]?></td>
		<td width="12%" align="left" class="font2"><?=$item["post_date"]?></td>-->
        <td width="28%">
		<table width="100%"  border="0">
            <tr>
            <!--  <td width="50%" align="center" class="font2"><a href="categories_edit.php?id=<?=$item["main_cat_id"]?>" class="style3">Edit </a> </td>-->
			<!--  <td width="21%" align="center" class="font2"><a href="job_response_list.php?id=<?=$item["job_id"]?>" class="style3">Response </a> </td>-->
			  
               <td width="50%" align="center" class="font2"><a href="sub_categories_add.php?id=<?=$item["main_cat_id"]?>&add=true" class="style3" > Add Sub Category</a> </td>
              
              <td width="50%" align="center" class="font2"><a href="categories.php?id=<?=$item["main_cat_id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["main_cat_id"]?>,"delete_menus","")'> Delete</a> </td>
              
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

