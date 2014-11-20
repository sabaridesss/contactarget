<?php
include("smarty_config.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Add"))
	{
	
			$fname = $_FILES['photo']['name'];
			$tmpname = $_FILES['photo']['tmp_name'];
			//$path = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/uplodeImage/newsTemplate/";
			$path = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/newsTemplate/";
			
			$p_small = $path.$fname;
			$file_name_img=$fname;
			move_uploaded_file($tmpname,$p_small);

		$insert = 'INSERT INTO news_template 
							SET
								 temp_name 		= \''.$_REQUEST['tempName'].'\',
							     template_name	= \''.$file_name_img.'\'';
		$exQuery = mysql_query($insert);
		header('location:template_list.php?msg=2');					  
	
	}
	
	if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
	{
		header('location:template_list.php');
	}

}
?>
<?php include ('common/header.php')?>

<form action="" method="post" enctype="multipart/form-data" name="content_add" >
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
    <td align="left" valign="top" class="login-top">Add Templates</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="141" align="right" valign="top" id="title_name">Template Name:</td>
        <td colspan="2" align="left"><input name="tempName" type="text" id="tempName" size="60" class="login-textarea1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">Template:</td>
        <td colspan="2" align=""><input name="photo" type="file" id="photo" class="login-textarea1"/></td>
        </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td width="472" align=""><input type="submit" name="Submit" value="Add"  class="addmenu2"/>&nbsp;&nbsp;&nbsp;
		  <input type="submit" name="Cancel" value="Cancel" class="addmenu2" />        </td>
        <td width="67" align="center">&nbsp;</td>
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



