<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$rank = $_REQUEST['rank'];
	
	// Add Contents
	if(isset($_POST['Submit'])){
	
		if($page_name==''){
				$page_name = 'Nill';
		}
		
		$query1 = "select * from req_quote_contact where mail_id='".$title."'";
		$rs1 = mysql_query($query1);
		
		if(mysql_num_rows($rs1)>0) {
			$msg = "Invalid Mail Id";
		} else {
			$query = "INSERT INTO req_quote_contact(mail_id,mail_rank,Created_Date)VALUES('".$title."','".$rank."',now())";
			$rs = mysql_query($query);
			if($rs){
						header("location:contact-us-menu.php?msg=2");
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
<div class="content"><br>
  <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Add Mail Id</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td align="right" valign="top" id="title_name">Mail Id:</td>
        <td align="left"><input name="title" type="text" id="title" size="50" class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Type:</td>
        <td align="left"><select name="rank" id="rank" class="login-texbox">
          <option value="" selected="selected">Select</option>
          <option value="1" <?php if($field_type1 == 1){ ?> selected="selected" <?php } ?> >To</option>
          <option value="2" <?php if($field_type1 == 2){ ?> selected="selected" <?php } ?> >Bcc</option>
        </select></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><input type="submit" name="Submit" value="Add" onClick="javascript:return validate_request();" class="submit"/>                  </td>
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


