<?php
include("smarty_config.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Add")){
	
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	$company = $_REQUEST['company'];
	$bounce_password = $_REQUEST['bounce_password'];
	$bounce_email = $_REQUEST['bounce_email'];
	$from_email = $_REQUEST['from_email'];
	$role_contact = $_REQUEST['role_contact'];
	     if($role_contact  == "superadmin")
	 {
		 $company_check = "select * from admin where company_admin='$company' and role='superadmin'";
	
	
	$company_result = mysql_query($company_check);
	if(mysql_num_rows($company_result)>0) {
			$msg = "This Company Has Already Superadmin....";
		}
		else
		{
		$query = "INSERT INTO admin(from_email,bounce_password,bounce_email,company_admin,username,password,user_permission,role,created_date)VALUES('".$from_email."','".$bounce_password."','".$bounce_email."','".$company."','".$title."','".$page_name."',1,'".$role_contact."','date()')";	
		$rs = mysql_query($query);
			if($rs){
					header("location:user_list.php?msg=3");
					}	 
		}
	}
	else
	{	
		$qry = "select * from admin where username='blabla'";
		$qry_result = mysql_query($qry);
		if(mysql_num_rows($qry_result)>0) {
			$msg = "User Name already exists";
		} else {
			$query = "INSERT INTO admin(from_email,bounce_password,bounce_email,company_admin,username,password,user_permission,role,created_date)VALUES('".$from_email."','".$bounce_password."','".$bounce_email."','".$company."','".$title."','".$page_name."',1,'".$role_contact."','date()')";	
		$rs = mysql_query($query);
			if($rs){
					header("location:user_list.php?msg=3");
					}	 
		}
			
	}
	}
}
if($_SESSION['sadmin'] == "superadmin")
	{
$company_user =  "select * from company order by companyname asc";
}
else
{
$company_user =  "select * from company where companyname = '".$_SESSION['companyname']."' order by companyname asc";
}
$impl_query   =   mysql_query($company_user);

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
          <!--welcome admin start here-->
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
          <div class="content"><br>
            <table width="40%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top">Add User </td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td align="right" valign="top" id="title_name">Company:</td>
                      <td colspan="2" align="left"><select name="company" id="company">
                          <?php
		while($fetch_comp  =  mysql_fetch_array($impl_query))
		{
		?>
                          <option value="<?=$fetch_comp['companyname'];?>">
                          <?=$fetch_comp['companyname'];?>
                          </option>
                          <?php
		 }
		 ?>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">UserName:</td>
                      <td colspan="2" align="left"><input name="title" type="text" id="title" size="30" class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Password:</td>
                      <td colspan="2" align="left"><input name="page_name" type="password" id="page_name" size="30"  class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">From Email:</td>
                      <td colspan="2" align="left"><input name="from_email" type="text" id="from_email" size="30" class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Bounce Email:</td>
                      <td colspan="2" align="left"><input name="bounce_email" type="text" id="bounce_email" size="30" class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Bounce Email Password:</td>
                      <td colspan="2" align="left"><input name="bounce_password" type="password" id="bounce_password" size="30"  class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Role:</td>
                      <td colspan="2" align="left"><select name="role_contact" id="role_contact">
                          <option value="superadmin">superadmin</option>
                          <option value="user">user</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><input type="submit" name="Submit" value="Add"  class="btn btn-large btn-primary"/>
                        &nbsp;&nbsp;&nbsp;
                       <a href="user_list.php" style="text-decoration:none;"> <input type="button" name="Cancel" value="Cancel" class="btn btn-large btn-primary" /></a> <!--onclick="return redirect_user_list()"-->
                      </td>
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
</body></html>