<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$mail_id = $_REQUEST['contact_no'];
	// Add Contents
	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit']=="Add"){
	
		if($page_name==''){
				$page_name = 'Nill';
		}
	
		$query = "INSERT INTO nl_subscribers_tbl(mail)VALUES('".$mail_id."')";
		$rs = mysql_query($query);
		if($rs){	
					header("location:subscribers_list.php?msg=2");
				}	 
	}
}

?>
<?php include ('common/header.php')?>
<form name="" method="post" action="" >
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
  <table width="50%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Add Subscriber </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td align="right" valign="top" id="title_name">E-Mail Id :</td>
        <td align="left"><input type="text" name="contact_no" id="contact_no" maxlength="50" size="50" class="login-textarea1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><input type="submit" name="Submit" value="Add" class="addmenu2" />&nbsp;&nbsp;&nbsp;&nbsp;
		  <input type="button" name="Cancel" value="Cancel" class="addmenu2" onclick="return redirect_news();"/></td>
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


