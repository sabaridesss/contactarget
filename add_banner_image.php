<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	$menu_order = $_REQUEST['menu_order'];
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit"))
	{
		

	
		$fname = $_FILES['upImg']['name'];
		$tmpname = $_FILES['upImg']['tmp_name'];
		$path = "uploads/banner/";
		$p_small = $path."home-banner-".$fname;
		$file_name_img="home-banner-".$fname;
		move_uploaded_file($tmpname,$p_small);
	
	$query = 'INSERT INTO home_page_banner
								SET
									alt_text	= \''.$_POST['alt_text'].'\',
									h1_title	= \''.$_POST['title'].'\',
									h2_title	= \''.$_POST['content'].'\',
									image_order	= \''.$_POST['image_order'].'\',
									company_admin=\''.$company_admin.'\',
									image_type	= \'banner\',
									Posted_Date = "now()",
									image_name	= \''.$file_name_img.'\'';
									
		
		$exInsert = mysql_query($query);
		if(!$exInsert)
		echo mysql_error();
		else
		header('location:banner_images.php?msg=2');									
	
	}


//Edit Image

	$editImg = "SELECT * FROM  home_page_banner WHERE company_admin=$company_admin and image_id =".$_REQUEST['menus_id'];
	$exEdit = mysql_query($editImg);
	$viewRow = mysql_fetch_array($exEdit);

//Cancel Page
if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
{
	header('location:banner_images.php');		
}


// Update Information

if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Update')
{		
		$imgId = $_REQUEST['menus_id'];
		$fname = $_FILES['upImg']['name'];
		if($fname != '')
		{
			$fname = $_FILES['upImg']['name'];
		$tmpname = $_FILES['upImg']['tmp_name'];
		$path = "uploads/banner/";
		$p_small = $path."home-banner-".$fname;
		$file_name_img="home-banner-".$fname;
		move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img = $viewRow['image_name'];
			
		}   	
	
	$update = 'UPDATE home_page_banner
							  SET
									alt_text	= \''.$_POST['alt_text'].'\',
										h1_title	= \''.$_POST['title'].'\',
										h2_title	= \''.$_POST['content'].'\',
									image_order	= \''.$_POST['image_order'].'\',
									company_admin='.$company_admin.',
										image_type	= \'banner\',
									Posted_Date = "now()",
									image_name	= \''.$file_name_img.'\'
									WHERE image_id  ='.$_REQUEST['menus_id'];
	$exUpdate = mysql_query($update);
	if(!$exUpdate)
		echo mysql_error();
		else
	header('location:banner_images.php?msg=3');								
							  	
								
}

}
?>

<?php include ('common/header.php')?>

<form  method="post" enctype="multipart/form-data" name="form1" >
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
    <td align="left" valign="top" class="login-top"><?php if($_REQUEST['menus_id'] != ''){ ?>Edit <?php } else{?> Add <?php } ?>Image </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      
        <tr>
        <td width="210" align="right" valign="top" id="title_name">Title</td>
        <td width="482" align="left"><input name="title" type="text" id="title" size="60" class="login-texbox1" value="<?php echo $viewRow['h1_title']; ?>"/></td>
      </tr>
      <!-- <tr>
        <td width="210" align="right" valign="top" id="title_name">Read More Url </td>
        <td width="482" align="left"><input name="alt_text" type="text" id="alt_text" size="60" class="login-texbox1" value="<?php echo $viewRow['alt_text']; ?>"/></td>
      </tr>
      <tr>
        <td width="210" align="right" valign="top" id="title_name">Image Order</td>
        <td width="482" align="left"><input name="image_order" type="text" id="image_order" size="60" class="login-texbox1" value="<?php echo $viewRow['image_order']; ?>" onblur="return allownumbers(event)" onchange="return allownumbers(event)" onkeydown="return allownumbers(event)" onkeyup="return allownumbers(event)"/></td>
      </tr>
      
      <tr>
        <td width="210" align="right" valign="top" id="title_name">Description</td>
        <td width="482" align="left"><textarea name="content" class="login-textarea1" style="width: 418px; height: 114px;"><?=$viewRow['h2_title']?></textarea></td>
      </tr>-->
      <tr>
        <td align="right" valign="top" id="title_name">Uplode Image :</td>
        <td align="left"><input name="upImg" type="file"  class="login-texbox1" id="upImg"  /></td>
      </tr>
      
	  <?php if($_REQUEST['menus_id'] != '')
	  {
	  ?>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><img src="uploads/banner/<?=$viewRow["image_name"]?>" width="180" height="130" />
       
        </td>
      </tr>
	 <?php } ?>
       
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<?php if($_REQUEST['menus_id'] != '') {?> 
		 <input type="submit" name="Submit" value="Update"  class="btn btn-large btn-primary" />
		 <?php } else {?>
		 <input type="submit" name="Submit" value="Submit"  class="btn btn-large btn-primary" />
		 <?php } ?>
		 
          &nbsp;&nbsp;&nbsp;
          <input type="submit" name="Cancel" value="Cancel" class="btn btn-large btn-primary" />        </td>
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

