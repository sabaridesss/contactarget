<?php

include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
include("cfg/MYSQL.php");

//connect to the database

	db_connect(DB_HOST,DB_USER,DB_PASS) or die (db_error());

	db_select_db(DB_NAME) or die (db_error());
	
	
	if($_REQUEST["msg"] == '2'){
				$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Campaign Type Added Successfully.
</div>';
	}else if($_REQUEST["msg"] == '3'){
	
				$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Campaign Type Updated Successfully.
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
Campaign Type Deleted Successfully.
</div>';
	}	
	
	
	
	
		if(isset($_REQUEST['delete']))
		{
		$menus_id = $_REQUEST['id'];
		 $sel_query = "delete from camp_category where company_admin='$company_admin' AND id ='".$menus_id."'";
		$exec_Sel_auery = mysql_query($sel_query);
		header("Location:camp_cat_list.php?msg=4");	
		
	}

?>
<?php include ('common/header.php')?>
<script type="text/javascript">
<!--
function getConfirmation(){
   var retVal = confirm("Do you want to Delete ?");
   if( retVal == true ){
     
	  return true;
   }else{
    
	  return false;
   }
}
//-->
</script>
<form name="content_add" method="post" action="campaign.php" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
                       <div>
 <?=$msg?>
          </div>
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="10%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="15%" align="center" valign="middle"><strong><font color="#FF0000">
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td ><a href="camp_cat_add.php" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Add Campaign Type</a></td>
              </tr>
            </table>
          </div>
           <div class="content"><br>
          <table width="100%" border="0" class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr>
              <td align="left" class="table1">S.no</td>
              <td align="left" class="table1">Campaign Type</td>
               <td align="left" class="table1">Action</td>
            </tr>
            </thead>
            <?php 
	$viewSelect = "SELECT * FROM camp_category where company_admin='$company_admin'";
$exViewQuery = mysql_query($viewSelect);
$num = mysql_num_rows($exViewQuery);
	
	$i=1;
	while ($row = mysql_fetch_array($exViewQuery))
	{ 
	   $class="table2";
	   if(($i%2)==0)
	   $class="table3";
	?>
            <tr class="<?= $class ?>">
              <td align="center"><?=$i?></td>
              <td align="center"><?php echo $row['cate_name']; ?></td>
              <td width="21%" align="left" ><a href="camp_cat_add.php?edit=true&prod_id=<?=$row["id"]?>&page_id=<?=$row["id"]?>" class="btn btn-info " style="text-decoration:none;"><i class="icon-edit icon-white"></i>Edit </a>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger"  onclick="return getConfirmation();" href="camp_cat_list.php?id=<?=$row["id"]?>&delete=true&page_id=<?=$row["id"]?>" >
										<i class="icon-trash icon-white"></i> 
										Delete
									</a></td>
            </tr>
            <?php $i++; } ?>
            <tr>
              <td colspan="4" bgcolor="#EAEAEA">&nbsp;</td>
            </tr>
          </table>
           </div><br>
      <!--welcome admin end here-->
        </div><br>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here--></td>
    </tr>
  </table>
</form>
</div>
</center>
</body></html>