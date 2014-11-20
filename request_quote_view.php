<?php
include("smarty_config.php");
//include("top_menu.php");

$id = $_REQUEST['id'];

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
}
else
{
	$selectQuery = 'SELECT * FROM re_quote WHERE quote_id = '.$id;
	$exQuery = mysql_query($selectQuery);
	$row = mysql_fetch_array($exQuery); 
}
	
?>
<?php include ('common/header.php')?>

 <form id="form1" name="form1" method="post" action="request_quote.php">
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
<div class="content">
<table width="70%" border="1" align="center" class="content">
          <tr class="table1">
            <td colspan="2" align="center">Request quote Details</td>
          </tr>
          <tr class="table2">
            <td width="49%" height="25" align="left" style="padding-left:15px;"><strong>Name</strong></td>
            <td width="51%" align="left"><?php echo $row['quote_name']; ?></td>
          </tr>
          <tr class="table3">
            <td height="25" align="left" style="padding-left:15px;"><strong>Last Name</strong></td>
            <td align="left"><?php echo $row['quote_lastname']; ?></td>
          </tr>
          <tr class="table2">
            <td height="25" align="left" style="padding-left:15px;"><strong>Industry</strong></td>
            <td align="left"><?php echo $row['quote_industry']; ?></td>
          </tr>
          <tr class="table3">
            <td height="25" align="left" style="padding-left:15px;"><strong>Company</strong></td>
            <td align="left"><?php echo $row['quote_company']; ?></td>
          </tr>
          <tr class="table2">
            <td height="25" align="left" style="padding-left:15px;"><strong>Phone</strong></td>
            <td align="left"><?php echo $row['quote_phone']; ?></td>
          </tr>
          <tr class="table3">
            <td height="25" align="left" style="padding-left:15px;"><strong>Fax</strong></td>
            <td align="left"><?php echo $row['quote_fax']; ?></td>
          </tr>
          <tr class="table2">
            <td height="25" align="left" style="padding-left:15px;"><strong>Email</strong></td>
            <td align="left"><?php echo $row['quote_email']; ?></td>
          </tr>
          <tr class="table3">
            <td height="25" align="left" style="padding-left:15px;"><strong>Address</strong></td>
            <td align="left"><?php echo $row['quote_address']; ?></td>
          </tr>
          <tr class="table2">
            <td height="25" align="left" style="padding-left:15px;"><strong>City</strong></td>
            <td align="left"><?php echo $row['quote_city']; ?></td>
          </tr>
          <tr class="table3">
            <td height="25" align="left"style="padding-left:15px;"><strong>State</strong></td>
            <td align="left"><?php echo $row['quote_state']; ?></td>
          </tr>
          <tr class="table2">
            <td height="25" align="left" style="padding-left:15px;"><strong>Zip Code</strong></td>
            <td align="left"><?php echo $row['quote_zipcode']; ?></td>
          </tr>
          <tr class="table3">
            <td height="25" align="left" style="padding-left:15px;"><strong>Country</strong></td>
            <td align="left"><?php echo $row['quote_country']; ?></td>
          </tr>
          <tr class="table2">
            <td height="25" align="left" style="padding-left:15px;"><strong>Questions / Comments</strong></td>
            <td align="left"><?php echo $row['quote_qustcomments']; ?></td>
          </tr>
          <tr>
		  <td height="25" colspan="2" align="center" ><input name="Close" type="submit" id="Close" value="Close" class="addmenu" /></td>
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
