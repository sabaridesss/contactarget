<?php
include("smarty_config.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	
	// Add Contents
	
	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		$query2 =  'select * from news_template where template_id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Update"))
	{
	
		$fname = $_FILES['photo']['name'];
		if($fname != '')
		{	
			$tmpname = $_FILES['photo']['tmp_name'];
			//$path = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/uplodeImage/newsTemplate/";
			$path = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/newsTemplate/";
			$p_small = $path.$fname;
			$file_name_img=$fname;
			move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img =$displaySite['template_name'];
		}

		$insert = 'UPDATE news_template 
							SET
								 temp_name 		= \''.$_REQUEST['tempName'].'\',
							     template_name	= \''.$file_name_img.'\'
								 WHERE template_id ='.$id;
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
    <td align="left" valign="top" class="login-top">Edit Templates</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="141" align="right" valign="top" id="title_name">Template Name:</td>
        <td colspan="2" align="left"><input name="tempName" type="text" id="tempName" size="60" class="login-textarea1" value="<?php echo $displaySite['temp_name']; ?>"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">Template:</td>
        <td colspan="2" align=""><input name="photo" type="file" id="photo" class="login-textarea1"/>
<a href="#" onMouseOver="return overlay(this, 'subcontent4', 'bottomleft')" onMouseOut="overlayclose('subcontent4'); return false">
                        <input value="preview" class="commentslist" type="button" />
                  </a>
						 <div id="subcontent4" style="border: 1px solid black;  position: absolute; display: none; background-color: rgb(255, 255, 255); "><img src="../uplodeImage/newsTemplate/<?php echo $displaySite['template_name'];?>"  width="180" height="135"/> </div>		</td>
        </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td width="472" align=""><input type="submit" name="Submit" value="Update"  class="addmenu2"/>&nbsp;&nbsp;&nbsp;
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



