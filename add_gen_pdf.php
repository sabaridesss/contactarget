<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit"))
	{
		
	
	 $query = 'INSERT INTO  file_attach
			  SET
			  company_admin=\''.$company_admin.'\', name_file = \''.$_REQUEST['name_file'].'\''; 
									
		
		$exInsert = mysql_query($query);
		if(!$exInsert)
		echo mysql_error();
		else
		{
		$lastid= mysql_insert_id();
		header("location:select_type.php?pdfid=$lastid");	
		
		}								
	
	}



// Update Information



}
?>
<?php include ('common/header.php')?>

<form  method="post" enctype="multipart/form-data" name="form1" >
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
            <table width="60%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top">Generate PDF </td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="210" align="right" valign="top" id="title_name">Title</td>
                      <td width="482" align="left"><input name="name_file" type="text" id="name_file " size="60" class="login-texbox1" value="<?php echo $viewRow['name_file ']; ?>"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><?php if($_REQUEST['menus_id'] != '') {?>
                        <input type="submit" name="Submit" value="Update"  class="btn btn-large btn-primary" />
                        <?php } else {?>
                        <input type="submit" name="Submit" value="Submit"  class="btn btn-large btn-primary" />
                        <?php } ?>
                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" name="Cancel" value="Cancel" class="btn btn-large btn-primary" />
                      </td>
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