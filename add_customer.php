<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	$menu_order = $_REQUEST['menu_order'];
	
	$custId = $_REQUEST['page_id'];
	
	// Add customer
	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Submit')
	{
		$insertQuery = 'INSERT INTO customer_type 
										SET
											cust_name = \''.$_REQUEST['cust_name'].'\'';
		$exQuery = mysql_query($insertQuery);
		header('location:customer_view.php');									
	}
	
	
	if(isset($_REQUEST['Edit']) && $_REQUEST['Edit'] == 'Edit')
	{
		$insertQuery = 'UPDATE customer_type 
										SET
											cust_name = \''.$_REQUEST['cust_name'].'\'
											WHERE cust_id ='.$custId;
		$exQuery = mysql_query($insertQuery);
		header('location:customer_view.php');									
	}

	
	if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
	{
		header('location:customer_view.php');
	}
	
	$selectCust = 'SELECT * FROM customer_type WHERE cust_id ='.$custId;
	$exCust = mysql_query($selectCust);
	$rowCust = mysql_fetch_array($exCust);
			
		
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
    <td align="left" valign="top" class="login-top"><?php if($custId != ''){?>Edit <?php } else { ?>Add <?php } ?>Main Menus</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="210" align="right" valign="top" id="title_name">Customer Type :</td>
        <td width="482" align="left"><input name="cust_name" type="text" id="cust_name" size="60" class="login-texbox1" value="<?php echo $rowCust['cust_name'];?>"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<?php
		if($custId != '')
		{
		?>
		 <input name="Edit" type="submit" id="Edit" value="Edit" class="addmenu2"/>
		 <?php }  else {?>
		 &nbsp;&nbsp;
		 <input type="submit" name="Submit" value="Submit"  class="addmenu2"/>
		 <?php } ?>
          &nbsp;&nbsp;&nbsp;
          <input type="submit" name="Cancel" value="Cancel" class="addmenu2" />        </td>
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

