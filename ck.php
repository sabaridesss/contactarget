<?php
// Create connection
$con=mysql_connect("localhost","eblast_user","eblast_p@$$");

// Check connection
if (!$con)
  {
  echo "Failed to connect to MySQL: " . mysql_error();
  }
$db_selected = mysql_select_db("eblast_final", $con);
if (!$db_selected) {
    die ('Can\'t use bei_forms : ' . mysql_error());
}
else
echo "Connected";




/*if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {*/
	$msg = "";
	if($_REQUEST['delete']=="true") {
		$menus_id = $_REQUEST['id'];
	    $qry1 = "delete from admin where id=$menus_id";
		mysql_query($qry1);
		$qry2 = "delete from admin where user_id=$menus_id";
		mysql_query($qry2);
		$msg = "Suceessfully deleted";	
	}
	
	if($_SESSION['sadmin'] == "superadmin")
	{
	$qry = "select * from admin where user_permission != 3";
	}
	else
	{
 $qry = "select * from admin where user_permission != 3 and company_admin = '".$_SESSION['companyname']."' and role != 'superadmin'";
	}
	
$qry = "select * from admin ";
	
	$query_result = mysql_query($qry);
	
	if(!$query_result)
	echo mysql_error();
	
	if($_REQUEST["msg"] == '2'){
		$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
User Added Successfully.
</div>';	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
User Updated Successfully.
</div>';	
	}else if($_REQUEST["msg"] == '4'){
	
			$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
User Deleted Successfully.
</div>';	

	}else if($_REQUEST["msg"] == '5'){
	
	
	$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
User Permission Sucessfully Updated.
</div>';

	}
	
/*}*/
	
	
?>
<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" >
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
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                 <!-- <?=$msg?>-->
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">
                
                <a class="btn btn-large btn-primary" href="add_user.php"><i class="icon-chevron-left icon-white"></i> Add User </a>
                
                
                </td>
              </tr>
            </table>
          </div>
          <div class="content">
            <table width="100%" border="0"  class="content">
              <tr bgcolor="#cccccc">
                <td height="30" align="left" class="table1">ID</td>
                <td height="30" align="left" class="table1">Company Name</td>
                <td align="left" class="table1">User Name </td>
                <td align="left" class="table1">Password</td>
                <td align="left" class="table1">Role</td>
                <td class="table1">Action</td>
              </tr>
              <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
              <tr class="<?= $class ?>" >
                <td width="3%" height="20" style="padding-left:10px; height:15px;"><?=$i?></td>
                <td width="20%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["company_admin"]?></td>
                <td width="20%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["username"]?></td>
                <td width="18%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["password"]?></td>
                <td width="18%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["role"]?></td>
                <td width="28%" style="padding-left:10px;"><table width="100%"  border="0">
                    <tr>
                      <td width="21%" height="20" align="center"><a href="edit_user.php?menus_id=<?=$item["id"]?>"  style="text-decoration:none;" class="btn btn-info"><i class="icon-edit icon-white"></i>Edit </a> </td>
                      <td width="31%" height="20" align="center"><a href="user_list.php?id=<?=$item["id"]?>&delete=true" class="btn btn-danger" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> <i class="icon-trash icon-white"></i>Delete</a> </td>
                      <!-- <td width="48%" height="20" align="center"><a href="user_permission.php?id=<?=$item["id"]?>" class="style3">Permissions</a></td>-->
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
</body></html>

?> 