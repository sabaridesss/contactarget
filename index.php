<?php
include("smarty_config.php");


class index_class {
	var $str_username;
	var $str_password;
	var $error_msg;
	
	function run() {
		if( isset($_REQUEST['login']) && ($_REQUEST['login'] == "Login")) {
			$this->str_username    = $_REQUEST['username'];
			$this->str_password    = $_REQUEST['password'];
			$this->str_companyname = $_REQUEST['company_name'];
			if($this->validation()) {
				if($val = $this->dbquery()) {
					if($val['user_permission'] == 1) {
						$_SESSION['sadmin'] = "sadmin";
					}
					if($val['user_permission'] == 3) {
						$_SESSION['sadmin'] = "superadmin";
					}
					$_SESSION['username'] = $this->str_username;
					$_SESSION['company_admin'] = $val['id'];
					$_SESSION['role'] = $val['role'];
					$_SESSION['companyname'] = $val['company_admin'];
					header("Location:campaign.php");				
				}	
			}
		} 
	}
	
	function validation() {
	
		if(( $this->str_username !="")&&($this->str_password !="")) {
			return true;
		} else {
			$this->error_msg =  "username and  password must be entered";
			return false;
		}
	}
	
	function dbquery() {
		 $query = "select * from admin where username='".$this->str_username."' and password='".$this->str_password."'  and company_admin='".$this->str_companyname."'";
		$output = mysql_query($query) or die();
		
		$num_rows = mysql_num_rows($output);
		if($num_rows == 1) {
			$row = mysql_fetch_assoc($output);
			return $row;
		} else {
			$this->error_msg =  "username or password incorrect";
			return false;
		}
	}
}

$obj = new index_class();
$obj->run();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home page</title>
<style type="text/css">

</style>

<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" >
</script>

</head>
<body>
<center>
<div class="wholesite">
<form name="content_add" method="post" action="" >
<!--header start here-->
<div class="header"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="300" height="110" align="center" valign="bottom"><a href="#"><img src="images/logo.png" width="270" height="110" border="0" /></a></td>
    <td align="right" valign="middle">
	<div class="contact">Email: support@desss.com <br /> Phone: (713)589-6496</div>
	</td>
  </tr>
</table>
</div>
<!--header end here-->

<div class="wholesite-inner" style="border-top:solid 1px #c4c1b0;"><br />
  <br />
  <table width="40%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="top" class="login-top">Login</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
        <tr>
          <td align="right" valign="top" id="title_name">Company Name:</td>
          <td colspan="2" align="left"><input type="text" name="company_name" id="company_name" class="login-texbox"  value=""/></td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">UserName:</td>
          <td colspan="2" align="left"><input type="text" name="username" id="username" class="login-texbox"  value=""/></td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">Password:</td>
          <td colspan="2" align="left"><input type="password" name="password" id="password" class="login-texbox" value="" /></td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td align=""><input type="submit" name="login" value="Login" class="submit" />
		  
            &nbsp;&nbsp;&nbsp;
            <input type="reset" name="reset" value="Reset" class="submit"/>          </td>
          <td width="18" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td colspan="2" valign="top" class="welcome-admin" id="title_name"><?php echo $obj->error_msg;?></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <br />
  <br />
</div>


<!--footer start here-->
<?php include('common/footer.php'); ?>
<!--footer end here-->
</form>

</div>
</center>
</body>

</html>