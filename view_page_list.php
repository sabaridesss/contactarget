<?php
include("smarty_config.php");
//include("top_menu.php");

$id = $_REQUEST['id'];

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
}
else
{
	$selectQuery = 'SELECT * FROM tracking_tbl WHERE id = '.$id;
	$exQuery = mysql_query($selectQuery);
	$row = mysql_fetch_array($exQuery); 
}
	
?>
<?php // include ('common/header.php')?>

 <form id="form1" name="form1" method="post" action="">
<table width="1200px" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	<?php // include('common/top_menu.php') ?>
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
            <td colspan="2" align="center">Track Details</td>
          </tr>
          <tr class="table2">
            <td width="49%" height="25" align="left" style="padding-left:15px;"><strong>Ip address</strong></td>
            <td width="51%" align="left"><?php echo $row['ip_address']; ?></td>
          </tr>
          
          <?php for($val_d1=1;$val_d1<=20;$val_d1++) { ?>
          <tr class="table3">
            <td height="25" align="left" style="padding-left:15px;"><strong>Page <?=$val_d1?></strong></td>
            <td align="left"><?php echo $row['d'.$val_d1]; ?></td>
          </tr>
         <?php } ?>
     
         <!-- <tr class="table2">
            <td height="25" align="left" style="padding-left:15px;"><strong>Questions / Comments</strong></td>
            <td align="left"><?php echo $row['quote_qustcomments']; ?></td>
          </tr>
          <tr>
		  <td height="25" colspan="2" align="center" ><input name="Close" type="submit" id="Close" value="Close" class="addmenu" /></td>
		   </tr>-->
        </table>
</div>
<!--welcome admin end here-->
</div>
<!--footer start here-->
<?php // include('common/footer.php'); ?>
<!--footer end here--></td>
  </tr>
</table>
</form>


</div>
</center>
</body>
</html>
