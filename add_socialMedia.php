<?php
include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Add')
	{
			$fileName	= $_POST['fieldName'];
			$linkName	= $_POST['link'];
			$active		= $_POST['active'];
			$order		= $_POST['order'];

		$fname = $_FILES['imgName']['name'];
		$tmpname = $_FILES['imgName']['tmp_name'];
		$path = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/soundMedia/";
		$file_name_img=basename($fname);
		$p_small = $path.$fname;
		move_uploaded_file($tmpname,$p_small);

		
		 $insert = 'INSERT INTO social_media_tbl 
										SET
											company_name 	= \''.$_REQUEST['name'].'\',
											media_name 		= \''.$fileName.'\',
											media_image 	= \''.$file_name_img.'\',
											media_link 		= \''.$linkName.'\',
											active 			= \''.$active.'\',
											image_order 	= \''.$order.'\'';

		$query = mysql_query($insert);
		header('location:social_media_list.php?msg=2');									

	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		$query2 =  'select * from social_media_tbl where social_id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		
			$fileName	= $_POST['fieldName'];
			$linkName	= $_POST['link'];
			$active		= $_POST['active'];
			$order		= $_POST['order'];

		$fname = $_FILES['imgName']['name'];
		if($fname != '')
		{
			$tmpname = $_FILES['imgName']['tmp_name'];
			$path = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/soundMedia/";
			$file_name_img=basename($fname);
			$p_small = $path.$fname;
			move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img = $displaySite['media_image'];
		}	

		
		$insert = 'UPDATE social_media_tbl
										SET
											company_name 	= \''.$_REQUEST['name'].'\',
											media_name 		= \''.$fileName.'\',
											media_image 	= \''.$file_name_img.'\',
											media_link 		= \''.$linkName.'\',
											active 			= \''.$active.'\',
											image_order 	= \''.$order.'\'
											WHERE social_id ='.$id;
		$query = mysql_query($insert);
		header('location:social_media_list.php?msg=3');
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location: social_media_list.php");
	}

	
}	
?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" enctype="multipart/form-data">
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
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td colspan="2" align="center" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
		    <?php if($_REQUEST['id'] != '')
			  {
			   ?><br>

		  <table width="60%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Social Media </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td width="18%" align="right" valign="top" id="title_name">Site Name :</td>
                    <td colspan="2" align="left"><input name="name" type="text" id="name" value="<?php echo $displaySite['company_name']; ?>" size="60" class="login-textarea1"/></td>
                  </tr>

                  <tr>
                    <td align="right" valign="top">Image Name :</td>
                    <td colspan="2" align=""><input name="fieldName" type="text" class="login-textarea1" id="fieldName" size="40" value="<?php echo $displaySite['media_name']; ?>"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Image :</td>
                    <td width="49%" align="" valign="top"><input name="imgName" type="file" class="login-textarea1" id="imgName"/></td>
                    <td width="33%" align="left"><img src="../uplodeImage/soundMedia/<?php echo $displaySite['media_image']; ?>" width="70" height="60" /></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Link  : </td>
                    <td colspan="2" align=""><textarea name="link" cols="60" rows="7" class="login-textarea2" id="link"><?php echo $displaySite['media_link']; ?></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Active/Inactive</td>
                    <td colspan="2" align=""><input name="active" type="checkbox" id="active" value="1" <?php if($displaySite['active'] == '1' ){?>checked="checked"<?php } ?> /></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Image Order</td>
                    <td colspan="2" align=""><input name="order" type="text" class="login-textarea1" id="order" value="<?php echo $displaySite['image_order']; ?>"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td colspan="2" align="">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td colspan="2" align=""><input name="Modify" type="submit" id="Modify" value="Modify" class="addmenu2"/>
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                    </tr>

              </table></td>
            </tr>
          </table><br>

            <?php } else { ?><br>

            <table width="70%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add Social Media </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td width="16%" align="right" valign="top" id="title_name">Site Name :</td>
                    <td width="84%" align="left"><input name="name" type="text" id="name" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Image Name :</td>
                    <td align=""><input name="fieldName" type="text" class="login-textarea1" id="fieldName" size="40"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Image :</td>
                    <td align=""><input name="imgName" type="file" class="login-textarea1" id="imgName"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Link :</td>
                    <td align=""><textarea name="link" cols="60" rows="7" class="login-textarea2" id="link"></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Active/Inactive :</td>
                    <td align=""><input name="active" type="checkbox" id="active" value="1" /></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Image Order :</td>
                    <td align=""><input name="order" type="text" class="login-textarea1" id="order"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align="">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align="">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input type="submit" name="Submit" value="Add" class="addmenu2" />
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                  </tr>
              </table></td>
            </tr>
          </table><br>

<?php } ?>
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

