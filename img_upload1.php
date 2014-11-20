<?php
include("smarty_config.php");
include("top_menu.php");
	
   $article_id = $_REQUEST['article_id'];
  
		if(isset($_POST['Delete']) && $_POST['Delete'] == 'Delete')
		{
			foreach($_POST['del'] as $key=>$value)
			{
			$del_pro=$_POST['del'][$key];
			
			$update_qry1 =   "UPDATE article_image_gallery
										 SET status = '0' WHERE image_id = '$del_pro'";
			$exupdate1 = mysql_query($update_qry1);
			}
			$msg = "Deleted Sucessfully";
		}



if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Upload')
{
	if($_POST['imgType'] == 'Thumb Image')
	{
		$fname = $_FILES['upload_file']['name'];
		$tmpname = $_FILES['upload_file']['tmp_name'];
		//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-cities1/uplodeImage/thumbImg/";
		 $path = $_SERVER['DOCUMENT_ROOT']."\uplodeImage\thumbImg\\";
		
		$p_small = $path.$article_id.'-'.$fname;
		$file_name_img=$article_id.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);
	}
	else
	{
		$fname = $_FILES['upload_file']['name'];
		$tmpname = $_FILES['upload_file']['tmp_name'];
		//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-cities1/uplodeImage/galleryImg/";
		$path = $_SERVER['DOCUMENT_ROOT']."\uplodeImage\galleryImg\\";
		$p_small = $path.$article_id.'-'.$fname;
		$file_name_img=$article_id.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);

	}
	
	  $query = 'INSERT INTO article_image_gallery
								SET
									article_id	= \''.$article_id.'\',
									alt_text	= \''.$_POST['altText'].'\',
									image_type	= \''.$_POST['imgType'].'\',
									image_name	= \''.$file_name_img.'\'';
									
	$exQuery = mysql_query($query);								
	
}

$viewSelect = 'SELECT * FROM article_image_gallery WHERE article_id = '.$article_id.' AND status = \'1\'';
$exViewQuery = mysql_query($viewSelect);

  $num = mysql_num_rows($exViewQuery);
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function close_window()
{
 window.close();

}
</script>
</head>

<body>
<font color="#FF0000" style="font-family:Verdana; font-size:12px; font-weight:bold">
          <?=$msg?>
</font>
<div align="">
<form enctype="multipart/form-data" method="post" name="form1">
  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="79%" align="left" valign="top" class="login-top">Add Image </td>
      <td width="15%" align="left" valign="top" class="login-top"><a href="#" onclick="return close_window()"  class="login-top">Close</a></td>
      <td width="6%" align="left" valign="top" class="login-top">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="left" valign="top"><table width="100%" border="0" align="center">
        <tr>
          <td width="20%" class="login-inner">Alt Text </td>
          <td width="50%" class="login-inner">Image Type</td>
          <td width="30%" class="login-inner">Upload Image </td>
          </tr>

        <tr>
          <td><input name="altText" type="text" class="calender" id="altText" /></td>
          <td><select name="imgType" id="imgType" class="calender">
              <option value="Select" selected="selected">--Select--</option>
              <option value="Image Gallery">Image Gallery</option>
              <option value="Thumb Image">Thumb Image</option>
            </select>          </td>
          <td><input type="file" id="upload_file" name="upload_file" class="calender"/></td>
          </tr>
        <tr>
          <td colspan="3" align="center"><input type="submit" name="Submit" value="Upload"  class="submit"/></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
</div>
<br />
<?php if($num != 0)
{
?>
<form id="form2" name="form2" method="post" action="">
<h2>Image List</h2> 
  <div class="content"> 
  <table width="100%" border="1">
    <tr>
      <td align="left" class="table1">Image</td>
      <td align="left" class="table1">Name</td>
      <td align="left" class="table1">Alt Text </td>
      <td align="left" class="table1">Image Type </td>
      <td align="left" class="table1">Delete</td>
    </tr>
	<?php while ($row = mysql_fetch_array($exViewQuery))
	{ 
	   $class="table2";
	   if(($i%2)==0)
	   $class="table3";
	?>
    <tr class="<?= $class ?>">
      <td>
	  <?php if($row['image_type'] == 'Thumb Image' ){?>
	  <img src="../uplodeImage/thumbImg/<?php echo $row['image_name']; ?>" width="115" height="115" />
	  <?php } ?>
	  <?php if($row['image_type'] == 'Image Gallery' ){?>
	  <img src="../uplodeImage/galleryImg/<?php echo $row['image_name']; ?>" width="115" height="115" />
	  <?php } ?>
	  </td>
      <td align="center"><?php echo $row['image_name']; ?></td>
      <td align="center"><?php echo $row['alt_text']; ?></td>
      <td align="center"><?php echo $row['image_type']; ?></td>
      <td align="center"><input name="del[]" type="checkbox" id="del[]"  value="<?php echo $row['image_id']; ?>"/></td>
    </tr>
	<?php $i++; } ?>
    <tr>
      <td colspan="4" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF"><input name="Delete" type="submit" id="Delete" value="Delete"  class="submit"/></td>
    </tr>
  </table>
</div>
 
</form>
<?php } ?>
</body>
</html>
