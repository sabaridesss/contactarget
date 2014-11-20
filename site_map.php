<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$rank = $_REQUEST['rank'];
	
}

$date = date('Y-m-d H:i:s');

?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="siteMap.php" >
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
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>
  <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Site Map Creation Tool</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="195" align="right" valign="top" id="title_name">Starting URL:</td>
        <td width="497" align="left"><input name="url" type="text" id="url" value="http://" size="60"  class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Change frequency:</td>
        <td align="left"><select name="frequency" id="frequency" class="login-texbox">
          <option value="" selected>None</option>
          <option value="always">Always</option>
          <option value="hourly">Hourly</option>
          <option value="daily">Daily</option>
          <option value="weekly">Weekly</option>
          <option value="monthly">Monthly</option>
          <option value="yearly">Yearly</option>
          <option value="never">Never</option>
        </select></td>
      </tr>
      <tr>
        <td align="right" valign="top">Last modification:</td>
        <td align=""><span class="datetime">Use this date/time:
          <input name="date" type="text" class="login-texbox" id="date" value="<?php echo $date; ?>" size="25" readonly="readonly"/>
        </span></td>
      </tr>
      <tr>
        <td align="right" valign="top">Portfolio Search:</td>
        <td align=""><span class="datetime">
          <input type="checkbox" name="pfs" value="1" />
        </span></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><input type="submit" name="Submit" value="Submit" class="addmenu2" /></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td valign="top" class="welcome-admin" id="title_name"><?php echo $obj->error_msg;?></td>
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

