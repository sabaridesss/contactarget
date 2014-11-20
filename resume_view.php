<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	
	if(isset($_REQUEST['file'])) {
		
			$req_name = urldecode($_REQUEST['file']);
			$file_name = "../uplodeImage/carrier_resume/".$req_name;
			$file1 = fopen($file_name, "r") or exit("Unable to open file!");
			//Output a line of the file until the end is reached
			while(!feof($file1))
			  {
			 	 $css_content.= fgets($file1);
			  }
			fclose($file1);
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
<div class="content">
<table width="100%" border="0" cellpadding="5">
  <tr>
    <td width="122" align="left" valign="top">
	&nbsp;
	</td>
    <td height="395" colspan="5" align="left" valign="top"><table width="100%" border="0" cellpadding="5">
    </table>
      <table width="90%" border="0" align="center" class="content">
      <tr bgcolor="#cccccc">
      <td align="center" class="table1">Css</td>
      </tr>
    
      <tr >
         <td align="center" class="style3">
		 
		 <textarea rows="25" cols="90" name="css_content"><?= $css_content;?></textarea>
		 
		 </td>
      </tr>
     <input type="hidden" name="hid_file" value="<?= $req_name; ?>" />
    </table>
  </td>
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


