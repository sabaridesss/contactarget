<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$page_id = $_REQUEST['page_id'];
	$image_id = $_REQUEST['image_id'];
	$sort_order = $_REQUEST['sort_order'];
		


//Edit Image
$editImg = 'SELECT * FROM featuresrest_tbl WHERE image_id = '.$image_id.' AND status = \'1\'';
$exEdit = mysql_query($editImg);
$viewRow = mysql_fetch_array($exEdit);

//Cancel Page
if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
{
	header('location:features.php?page_id='.$page_id);				
}


// Update Information

if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Update')
{		
		$imgId = $_REQUEST['image_id'];
		$fname = $_FILES['upImg']['name'];
		$image_type = $_REQUEST['imgType'];
		$title = $_REQUEST['title'];
		
		$alt_text = $_REQUEST['alt_text'];
		$page_id = $_REQUEST['page_id'];
		 	
	
		if($fname != '')
		{
		
		$fname = $_FILES['upImg']['name'];
		$tmpname = $_FILES['upImg']['tmp_name'];
		$path = "../images/banner/";
		$p_small = $path.$page_id.$fname;
		$file_name_img=$page_id.$fname;
		move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img = $viewRow['image_name'];
			
		}   	
	
	$update = "UPDATE featuresrest_tbl
							  SET
							  `alt_text` =  '".($alt_text)."',
							  `page_id` =  '".($page_id)."',
							  `title` =  '".($title)."',
							 `sort_order` =  '".($sort_order)."',
							  `image_type` =  '".($image_type)."',
							 `image_name` ='".($file_name_img)."'
												 where `image_id` = '".($imgId)."'";
							
	$exUpdate = mysql_query($update);
	header('location:features.php?page_id='.$_REQUEST['page_id'].'&msg=3');								
							  	
								
}



	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit"))
	{
		
	$imgId = $_REQUEST['image_id'];

		$image_type = $_REQUEST['imgType'];
		$title = $_REQUEST['title'];
		
		$alt_text = $_REQUEST['alt_text'];
		$page_id = $_REQUEST['page_id'];
	
		$fname = $_FILES['upImg']['name'];
		$tmpname = $_FILES['upImg']['tmp_name'];
	$path = "../images/banner/";
		$p_small = $path.$page_id.$fname;
		$file_name_img=$page_id.$fname;
		
		move_uploaded_file($tmpname,$p_small);
	
	$query = "INSERT INTO featuresrest_tbl
								SET
							`alt_text` =  '".($alt_text)."',
							  `page_id` =  '".($page_id)."',
							  `title` =  '".($title)."',
							  `sort_order` =  '".($sort_order)."',
							  `image_type` =  '".($image_type)."',
							 `image_name` ='".($file_name_img)."'";
		$exInsert = mysql_query($query);
		if(!$exInsert)
		echo mysql_error();
		else
		header('location:features.php?page_id='.$_REQUEST['page_id'].'&msg=2');				
	
	}



}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
function close_window()
{
 window.close();

}
</script>
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<form  method="post" enctype="multipart/form-data" name="form1" >
  <table width="800px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><div class="wholesite-inner">
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
              
            </table>
          </div>

            <table width="60%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top"><?php if($_REQUEST['image_id'] != ''){ ?>
                  Edit
                  <?php } else{?>
                  Add
                  <?php } ?>
                  Image </td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="130" align="right" valign="top" id="title_name">Title</td>
                      <td width="456" align="left"><input name="alt_text" type="text" id="alt_text" size="60" class="login-texbox1" value="<?php echo $viewRow['alt_text']; ?>"/></td>
                    </tr>
                    <tr>
                      <td width="130" align="right" valign="top" id="title_name">Content</td>
                      <td width="456" align="left">
                      <textarea  style="width: 412px; height: 141px;" name="title" cols="145" rows="8" id="title" class="login-textarea2"><?php echo $viewRow['title']; ?></textarea>
                      
                      
                      </td>
                    </tr>
                      <tr>
                      <td width="130" align="right" valign="top" id="title_name">Sort Order</td>
                      <td width="456" align="left"><input name="sort_order" type="text" id="sort_order" size="60" class="login-texbox1" value="<?php echo $viewRow['sort_order']; ?>"/></td>
                    </tr>
                    <tr>
                      <td width="130" align="right" valign="top" id="title_name">Image Type</td>
                      <td width="456" align="left">
                      <select name="imgType" id="imgType" class="calender">
                          <option value="Select" selected="selected">--Select--</option>
                          <option value="Image Gallery" <?php if($viewRow['image_type']=='Image Gallery') echo 'selected="selected"'?>  >Image Gallery</option>
                          <option value="Thumb Image" <?php if($viewRow['image_type']=='Thumb Image') echo 'selected="selected"'?>>Thumb Image</option>
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Uplode Image :</td>
                      <td align="left"><input name="upImg" type="file"  class="login-texbox1" id="upImg"  /></td>
                    </tr>
                    <?php if($_REQUEST['image_id'] != '')
	  {
	  ?>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">
                        <img src="../images/banner/<?php echo $viewRow['image_name']; ?>" width="115" height="115" />
                        
                      </td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><?php if($_REQUEST['image_id'] != '') {?>
                        <input type="submit" name="Submit" value="Update"  class="addmenu2" />
                        <?php } else {?>
                        <input type="submit" name="Submit" value="Submit"  class="addmenu2" />
                        <?php } ?>
                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" name="Cancel" value="Cancel" class="addmenu2" />
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br>
     
          <!--welcome admin end here-->
        </div>
        <!--footer start here-->
        <!--footer end here--></td>
    </tr>
  </table>
</form>
</div>
</center>
</body>
</html>
