<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	if(isset($_REQUEST['login']) && $_REQUEST['login']=="Change Password") {
		
		$username = $_SESSION['username'];
		$pass = $_REQUEST['password'];
		$pass_new = $_REQUEST['password_new'];
		
		$query = "select * from admin where username='".$username."' and password='".$pass."'";
		$output = mysql_query($query);
		$num_rows = mysql_num_rows($output);
		if($num_rows == 1) {
			
			$query1 = "update `admin` set `password`='".addslashes($pass_new)."' where `username`='".$username."' and `password`='".$pass."'";
			if(mysql_query($query1)){
							$error_msg =  "New Password changed Successfully";
			}
		
		} else {
			$error_msg =  "username or password incorrect";
			
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
      <?=$error_msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>
  <table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Change Password </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="192" align="right" valign="top" id="title_name">Current Password:</td>
        <td width="380" align="left"><input type="password" name="password" id="password" value="" class="login-texbox"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">New Password:</td>
        <td align="left"><input type="password" name="password_new" id="password_new" value="" class="login-texbox"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><input type="submit" name="login" value="Change Password" class="addmenu"/></td>
        </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
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

