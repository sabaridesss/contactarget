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
		$msg = "Data Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Data Successfully Added";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Successfully deleted";	
	}
	else if($_REQUEST["msg"] == '5'){
	
		$msg = "All Records Successfully deleted";	
	}
	
	
	
	
	
		if(isset($_REQUEST['delete']))
		{
		$menus_id = $_REQUEST['id'];
		 $sel_query = "delete from email_spam where company_admin='$company_admin' and id ='".$menus_id."'";
		$exec_Sel_auery = mysql_query($sel_query);
		header("Location:spam_content.php?msg=4");	
		
	}
	if(isset($_REQUEST['Delete']) && $_REQUEST['Delete'] == 'Delete')
	{
		foreach($_POST['del'] as $key=>$value)
		{
		$del_pro=$_POST['del'][$key];
		
		 $update_qry1 =  "DELETE FROM email_spam WHERE company_admin='$company_admin' and id = '$del_pro'";
		$exupdate1 = mysql_query($update_qry1);
		}
		header("Location:spam_content.php?msg=4");	
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

<form name="content_add" method="post" action="" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <table border="0" align="right">
            <tr>
              <td></td>
            </tr>
            <tr>
              <td ><div class="addmenu"><a style="text-decoration:none" href="spam_content_add.php">Add Spam Words</a></div></td>
              
              <td width="32%"></td>
            </tr>
          </table>
          <table width="100%" border="0">
            <tr>
              <td align="left" class="table1">S.no</td>
              <td align="left" class="table1">Spam Words</td>
          
              <td align="left" class="table1">Action</td>
            </tr>
            <?php 
	$viewSelect = "SELECT * FROM email_spam where company_admin='$company_admin'";
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
            
              <td width="21%" align="left" ><a href="spam_content_add.php?edit=true&prod_id=<?=$row["id"]?>&page_id=<?=$row["id"]?>" class="style3">Edit </a>&nbsp;&nbsp;&nbsp;<a onclick="return getConfirmation();" href="spam_content.php?id=<?=$row["id"]?>&delete=true&page_id=<?=$row["id"]?>" class="style3" > Delete</a> &nbsp; <input  name="del[]" type="checkbox" id="del[]"  value="<?php echo $row['id']; ?>"/></td>
            </tr>
            <?php $i++; } ?>
            <tr >
                <td height="27" colspan="2" align="left" class="style3">&nbsp;</td>
                <td align="center"><input onclick="return getConfirmation();" name="Delete" type="submit" id="Delete" value="Delete" class="submit"/></td>
              </tr>
            <tr>
              <td colspan="4" bgcolor="#EAEAEA">&nbsp;</td>
            </tr>
          </table>
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