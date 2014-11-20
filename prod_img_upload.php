<?php
error_reporting(0);
$folder = $_REQUEST['folder'];
$prod_id = $_REQUEST['prod_id'];
$img_type = $_REQUEST['img_type'];

$current_dir = "Main_Menu/".$folder."/";
mkdir($current_dir);
$current_dir.= $prod_id."/";
mkdir($current_dir);
if($img_type == "thumb_nail")
{
	$current_dir .= "Thumbs/";
	mkdir($current_dir);
}

if($_REQUEST['upload'] == "true"){
	$msg = "Uploaded Sucessfully";
	
}

if($_POST['Submit'])
{

	$fileName = $_FILES['upload_file']['name'];
	if($fileName != "")
	{
		$empty_space = '/ /';
		$replace = '-';
		$fileName = preg_replace($empty_space,$replace,$fileName);
		$tmpName = $_FILES['upload_file']['tmp_name'];
		$fileSize = $_FILES['upload_file']['size'];
		$fileType = $_FILES['upload_file']['type'];
		$fileName = "main.jpg";
		$uploadDir = $current_dir;
		$filePath = $uploadDir.$fileName;
		$upload_file = move_uploaded_file($tmpName,$filePath);
		if($upload_file)
		{
			header("Location:prod_img_upload.php?upload=true");
		}
	}
}
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
<form enctype="multipart/form-data" method="post" name="form1"> <span style="float:right">
<a href="#" onclick="return close_window()">Close</a>
</span><br />

<table width="40%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="left" valign="top" class="login-top">&nbsp;</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
        <tr>
          <td width="9%" align="right" valign="top" id="title_name">&nbsp;</td>
          <td width="91%" align="left"><input type="file" id="upload_file" name="upload_file" class="login-texbox"/></td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top">&nbsp;</td>
          <td align=""><input type="submit" name="Submit" value="Upload"  class="submit"/></td>
          </tr>
      </table></td>
    </tr>
  </table>
 </form> 
</div>
<br />
<?php
 //$dir = "../Main_Menu/".$page_id."/";
 $dir = $current_dir;

 if(is_dir($dir))
{
$read_dir = opendir($dir);
$i = 0;

echo "<table border='0'><tr>";

while (($file = readdir($read_dir)) !== false)
  {
 // echo "<tr>";
   if($file != "." && $file != ".." && $file != "Thumbs" && $file != "Thumbs.db")
   {
     if($i%3 == 0)
	 {
	 echo "</tr><tr>";
	 
	 }


echo "<td align=center width='100'><img src=".$dir."/".$file." width=100 height=75 align=absmiddle><br>".$file."</td>";

	 
	 $i++;
   }
  // echo "</tr>";
  }
echo "</tr></table>";

closedir($read_dir);
}
?>
</body>
</html>
