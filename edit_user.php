<?php
include("smarty_config.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	// Add Contents
	if($_POST['Submit']){
	$title            = $_REQUEST['title'];
	$page_name        = $_REQUEST['page_name'];
	$menus_id         = $_REQUEST["userid_contact"];
	$company          = $_REQUEST["company"];	
	$bounce_password  = $_REQUEST["bounce_password"];	
	$bounce_email     = $_REQUEST["bounce_email"];	
	$from_email = $_REQUEST['from_email'];
	$role_contact     = $_REQUEST["role_contact"];	
	
     if($role_contact  == "superadmin")
	 {
		 $company_check = "select * from admin where company_admin='$company' and role='superadmin' and id != '".$menus_id."'";
	
	
	$company_result = mysql_query($company_check);
	if(mysql_num_rows($company_result)>0) {
			$msg = "This Company Has Already Superadmin....";
		}
		else
		{
		$query = "update admin set from_email='".$from_email."',bounce_password='".$bounce_password."',bounce_email='".$bounce_email."',company_admin='".$company."', username='".$title."', password='".$page_name."', user_permission='1',role='".$role_contact."' where  id = '".$menus_id."'";
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
		echo	$query = "update admin set from_email='".$from_email."',bounce_password='".$bounce_password."',bounce_email='".$bounce_email."',company_admin='".$company."', username='".$title."', password='".$page_name."', user_permission='1',role='".$role_contact."' where  id = '".$menus_id."'";
			$rs = mysql_query($query);
			if($rs){
					header("location:user_list.php?msg=3");
					}	 
		}
			
	}
	}
	
	$edit_query = "select * from `admin` where id='".$_REQUEST["menus_id"]."'";
	$edit_query_result = mysql_query($edit_query);
	while($edit_item = mysql_fetch_array($edit_query_result)){
				$menus_id = $edit_item["id"];
				$menus_name = $edit_item["username"];
				$page_name = $edit_item["password"];	
				$bounce_password = $edit_item["bounce_password"];					
				$bounce_email = $edit_item["bounce_email"];	
				$from_email = $edit_item["from_email"];	
				
				$company = $edit_item["company_admin"];	
			    $role_contact     = $edit_item["role"];
						
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
                <td align="left" valign="top" class="login-top">Edit User</td>
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
                          <option value="<?=$fetch_comp['companyname'];?>" <?php if($company == $fetch_comp['companyname']) { echo 'selected="selected"'; }?>  >
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
                      <td colspan="2" align="left"><input name="title" type="text" id="title"  value="<?=$menus_name?>" size="30" class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Password:</td>
                      <td colspan="2" align="left"><input name="page_name" type="text" id="page_name" value="<?=$page_name?>" size="30" class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">From Email:</td>
                      <td colspan="2" align="left"><input name="from_email" type="text" id="from_email"  value="<?=$from_email?>" size="30" class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Bounce Email:</td>
                      <td colspan="2" align="left"><input name="bounce_email" type="text" id="bounce_email"  value="<?=$bounce_email?>" size="30" class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Bounce Email Password:</td>
                      <td colspan="2" align="left"><input name="bounce_password" type="password" id="bounce_password"  value="<?=$bounce_password?>" size="30" class="login-textarea1"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Role:</td>
                      <td colspan="2" align="left"><select name="role_contact" id="role_contact">
                          <option value="superadmin" <?php if($role_contact == "superadmin") { echo 'selected="selected"';  }?>>superadmin</option>
                          <option value="user" <?php if($role_contact == "user") { echo 'selected="selected"';  }?>>user</option>
                        </select>
                        <input type="hidden" name="userid_contact" value="<?=$menus_id;?>" />
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><input type="submit" name="Submit" value="Update" class="btn btn-large btn-primary" />
                        &nbsp;&nbsp;&nbsp; <a href="user_list.php" style="text-decoration:none;">
                        <input type="button" name="Cancel" value="Cancel" class="btn btn-large btn-primary" />
                        </a>
                        <!--onclick="return redirect_user_list()"-->
                      </td>
                      <td width="10" align="center">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br>
            <br />
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