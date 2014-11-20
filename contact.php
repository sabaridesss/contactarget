<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	// Add Contents
	if(isset($_POST['Submit'])){
		$contact_no = $_REQUEST['contact_no'];
		$email = $_REQUEST['email'];
		if($contact_no !=""){
			
			$query = "INSERT INTO contact_tbl(contact,type,created_date)VALUES('".$contact_no."',1,now())";
			$rs = mysql_query($query);
			if($rs){
						$msg="Contact added";
					}
		}
		
		if($email !=""){
			
			$query = "INSERT INTO contact_tbl(contact,type,created_date)VALUES('".$email."',2,now())";
			$rs = mysql_query($query);
			if($rs){
						$msg="Contact added";
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
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="wholesite-inner">
  <table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Contact</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="144" align="right" valign="top" id="title_name">Contact no:</td>
        <td width="428" colspan="2" align="left"><input name="contact_no" type="text" id="contact_no"  class='calender' size="45" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">E-Mail:</td>
        <td colspan="2" align="left"><input name="email" type="text" id="email"  class='calender' size="45" /></td>
      </tr>
      <tr>
        <td colspan="3" align="center" valign="top"><input type="submit" name="Submit" value="Add" class="submit" /></td>
        </tr>
    </table></td>
  </tr>
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

