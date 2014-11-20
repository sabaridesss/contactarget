<?php
include("smarty_config.php");
//include("top_menu.php");


/*if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {*/
	$msg = "";
	if($_REQUEST['delete']=="true") {
		$menus_id = $_REQUEST['id'];
	    $qry1 = "delete from company where id=$menus_id";
		mysql_query($qry1);
		$qry2 = "delete from company where user_id=$menus_id";
		mysql_query($qry2);
		$msg = "Suceessfully deleted";	
	}
	
	$qry = "select * from company";
	$query_result = mysql_query($qry);
	
	if($_REQUEST["msg"] == '2'){
				$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Company Name  Successfully Added.
</div>';
	}else if($_REQUEST["msg"] == '3'){
	
				$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Company Name  Successfully Updated.
</div>';
	}else if($_REQUEST["msg"] == '1'){
	
					$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Mail Send Sucessfully!
</div>';	
	}else if($_REQUEST["msg"] == '4'){
	
					$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Company Name  Successfully Deleted.
</div>';
	}	
	
/*}
	*/
	
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
    <td width="25%" align="right" valign="middle"><a href="add_company.php" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Add Company</a></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0"   class="table table-striped table-bordered bootstrap-datatable datatable">
      <thead>
      <tr bgcolor="#cccccc">
      
        <td height="30" align="left" class="table1">ID</td>
        <td align="left" class="table1">Company Name</td>
        <td class="table1">Action</td>
      </tr>
      </thead>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
      <tr class="<?= $class ?>" >
        <td width="3%" height="20" style="padding-left:10px; height:15px;"><?=$i?></td>
        <td width="20%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["companyname"]?></td>
        <td width="28%" style="padding-left:10px;">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" height="20" align="center"><a href="edit_company.php?menus_id=<?=$item["id"]?>" class="btn btn-info " style="text-decoration:none;"><i class="icon-edit icon-white"></i>Edit </a>&nbsp;&nbsp;&nbsp;</td>
              <td width="31%" height="20" align="center"><a class="btn btn-danger" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")' href="company_name.php?id=<?=$item["id"]?>&delete=true" >
										<i class="icon-trash icon-white"></i> 
										Delete
									</a></td>
        
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

