<?php
include("smarty_config.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Add")){
	
		$qry = "select * from company where companyname='".$title."'";
		$qry_result = mysql_query($qry);
		if(mysql_num_rows($qry_result)>0) {
			$msg = "Company Name already exists";
		} else {
		
			
			echo $query = "INSERT INTO company(companyname)VALUES('".$title."')";	
		$rs = mysql_query($query);
		if($rs){
					header("location:company_name.php?msg=2");
				}	 
		}
	
		
	}
}

?>
<?php include ('common/header.php')?>

<form action="" method="post" enctype="multipart/form-data" name="content_add" >
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
</table>
</div>
<div class="content"><br>
  <table width="40%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Add Company </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td align="right" valign="top" id="title_name">Company Name:</td>
        <td colspan="2" align="left"><input name="title" type="text" id="title" size="60" /></td>
      </tr>
            <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><input type="submit" name="Submit" value="Add"  class="btn btn-large btn-primary"/>&nbsp;&nbsp;&nbsp;
		 <a href="company_name.php" style="text-decoration:none;"> <input type="button" name="Cancel" value="Cancel" class="btn btn-large btn-primary"/> </a>       </td>  <!--onclick="return redirect_company_name()"-->
        <td width="18" align="center">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
  <br>
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



