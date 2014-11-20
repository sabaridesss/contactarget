<?php
include("smarty_config.php");
include("top_menu.php");
	error_reporting(0);
   $action = $_REQUEST['action'];
   $page_id = $_REQUEST['page_id'];
   $content_id = $_REQUEST['content_id'];
   $parent_id = $_REQUEST['parent_id'];
   $subcat_id = $_REQUEST['subcat_id'];
   $img = $_REQUEST['img'];
 
 	
//if(($action == "edit_main_contents" || $action == "edit_page_contents" || $action == "edit_submenu_contents") && $page_id != "")
//{
//	$current_dir = "Main_Menu/".$page_id."/";
//	if(!is_dir($current_dir)) {
//		mkdir($current_dir);
//	}
//	if($img == "thumb_nail")
//	{
//		$current_dir .= "/Thumbs/";
//	} elseif($img == "main_img") {
//		
//		$current_dir .= "/Main_img/";
//	}
//}
//
//if($_REQUEST["msg"] == '1'){
//	$msg = "Uploaded Sucessfully";	
//}
//if($_POST['Submit'] && $_POST['Submit']=="Upload") 
//{
//	$fileName = $_FILES['upload_file']['name'];
//	if($fileName != "")
//	{
//		$empty_space = '/ /';
//		$replace = '-';
//	    $fileName = preg_replace($empty_space,$replace,$fileName);
//		
//		$tmpName = $_FILES['upload_file']['tmp_name'];
//		
//		$fileSize = $_FILES['upload_file']['size'];
//		$fileType = $_FILES['upload_file']['type'];
//	
//	
//		//$uploadDir = '../libs/';
//		if(!is_dir($current_dir))
//		{
//			mkdir($current_dir);
//		}
//		//$dir_exists = $current_dir."main.jpg";
//		//if(!file_exists($current_dir."main.jpg"))
////		{
////			$fileName = "main.jpg";
////		} elseif(!file_exists($current_dir."main2.jpg")) {
////			$fileName = "main2.jpg";
////		}
//		$filePath = $current_dir.$fileName;
//		$upload_file = move_uploaded_file($tmpName,$filePath);
//		if($upload_file)
//		{
//		header("Location:img_upload.php?page_id=$page_id&action=$action&content_id=$content_id&parent_id=$parent_id&subcat_id=$subcat_id&img=$img&msg=1");
//			
//		}
//	}
//}
//
//if($_REQUEST['delete'] && $_REQUEST['delete']=="delete") {
//
//	$del_images = $_REQUEST['del_images'];
//	foreach($del_images as $del_img) {
//		$imgpath = "Main_Menu/".$page_id."/Thumbs/".$del_img;
//		unlink($imgpath);
//	}
//	
//	$msg = "Deleted Sucessfully";
//	$read_dir = opendir("Main_Menu/".$page_id."/Thumbs");  // delete directory
//	$j=0;
//	while (($file = readdir($read_dir)) !== false) {
//		if($file != "." && $file != ".." && $file != "Thumbs.db") {
//			$j++;
//		}
//	}
//	if($j == 0)	{
//		//rmdir("Main_Menu/".$page_id);
//	}
//	rmdir("Main_Menu/3");
//}


		if(isset($_POST['Delete']) && $_POST['Delete'] == 'Delete')
		{
			foreach($_POST['del'] as $key=>$value)
			{
			$del_pro=$_POST['del'][$key];
			
			$update_qry1 =   "UPDATE image_gallery
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
		//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/hydralic-torque/uplodeImage/thumbImg/";
		 $path = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/thumbImg/";
		
		$p_small = $path.$page_id.'-'.$fname;
		$file_name_img=$page_id.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);
	}
	else
	{
		$fname = $_FILES['upload_file']['name'];
		$tmpname = $_FILES['upload_file']['tmp_name'];
		//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/hydralic-torque/uplodeImage/galleryImg/";
		$path = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/galleryImg/";
		$p_small = $path.$page_id.'-'.$fname;
		$file_name_img=$page_id.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);

	}
	
	$query = 'INSERT INTO image_gallery
								SET
									page_id		= \''.$page_id.'\',
									alt_text	= \''.$_POST['altText'].'\',
									image_type	= \''.$_POST['imgType'].'\',
									image_name	= \''.$file_name_img.'\'';
	$exQuery = mysql_query($query);								
	
}

$viewSelect = 'SELECT * FROM image_gallery WHERE page_id = '.$page_id.' AND status = \'1\'';
$exViewQuery = mysql_query($viewSelect);
$num = mysql_num_rows($exViewQuery);

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
<font color="#FF0000" style="font-family:Verdana; font-size:12px; font-weight:bold">
          <?=$msg?>
</font>
<div align="">
<form enctype="multipart/form-data" method="post" name="form1">
  <br />
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
          <td width="38%" class="login-inner">Image Type</td>
          <td width="42%" class="login-inner">Upload Image <br />
            <samp style="color:#FF0000;">(IMG Size :   970 X 184) </samp></td>
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
  <br />
</form>
</div>
<br />
<?php if($num != 0)
{
?>
<form id="form2" name="form2" method="post" action="">
<h2 class="welcome-admin">Image List</h2>
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
