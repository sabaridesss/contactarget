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
 

		if(isset($_POST['Delete']) && $_POST['Delete'] == 'Delete')
		{
			foreach($_POST['del'] as $key=>$value)
			{
			$del_pro=$_POST['del'][$key];
			
			$update_qry1 =   "UPDATE sub_page_banner_new
										 SET status = '0' WHERE id = '$del_pro'";
			$exupdate1 = mysql_query($update_qry1);
			}
			$msg = "Deleted Sucessfully";
		}



if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Upload')
{
	
		$fname = $_FILES['upload_file']['name'];
		$tmpname = $_FILES['upload_file']['tmp_name'];
		$path = "../uplodeImage/thumbImg/";
		
		$p_small = $path.$page_id.'-banner-'.$fname;
		$file_name_img=$page_id.'-banner-'.$fname;
		move_uploaded_file($tmpname,$path.$file_name_img);
	
		$fname1 = $_FILES['upload_icon']['name'];
		$tmpname1 = $_FILES['upload_icon']['tmp_name'];
		$p_small = $path.$page_id.'-icon-'.$fname1;
		$file_name_img1=$page_id.'-icon-'.$fname1;
		move_uploaded_file($tmpname1,$path.$file_name_img1);

	
	
	
	
	
	

	$imgType="Thumb Image";
	$img_des=addslashes($_REQUEST['imgdes']);
	$img_template_id =addslashes($_REQUEST['ban_template']);
	
	$query = 'INSERT INTO sub_page_banner_new
								SET
									page_id		= \''.$page_id.'\',
									alt_text	= \''.$_POST['altText'].'\',
									img_des		=\''.$img_des.'\',
									img_template_id 	=\''.$img_template_id.'\',
									status	= 1,
									image_type	= \''.$imgType.'\',
									icon_name	= \''.$file_name_img1.'\',
									image_name	= \''.$file_name_img.'\'';
	$exQuery = mysql_query($query);								
	
}

$viewSelect = 'SELECT * FROM sub_page_banner_new WHERE page_id = '.$page_id.' AND status = \'1\'';
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


<?php if($num != 0)
{
?>
<form id="form2" name="form2" method="post" action="">
  <h2 class="welcome-admin">Image List</h2>
  <h2 style="float:right"><a href="#" style="text-decoration:none" onclick="return close_window()"  class="login-top">Close</a></h2>
  
  <div class="content">
    <table width="100%" border="1">
      <tr>
        <td align="left" class="table1"> Image</td>
       <!-- <td align="left" class="table1">Icon</td>-->
        <td align="left" class="table1">Selected Template</td>
        <td align="left" class="table1">Alt Text </td>
         <td align="left" class="table1">Description</td>
          <td align="left" class="table1">Edit</td>
        <td align="left" class="table1">Delete</td>
      </tr>
      <?php while ($row = mysql_fetch_array($exViewQuery))
	{ 
	   $class="table2";
	   if(($i%2)==0)
	   $class="table3";
	?>
      <tr class="<?= $class ?>">
        <td><img src="../uplodeImage/thumbImg/<?php echo $row['image_name']; ?>" width="115" height="115" /> </td>
       <!-- <td><img src="../uplodeImage/thumbImg/<?php echo $row['icon_name']; ?>" width="115" height="115" /> </td>-->
        <td><?php 
          $view_template = "SELECT * FROM banner_template_new WHERE template_id=".$row['img_template_id'];
		$exview_template = mysql_query($view_template);
		$selectexview_template = mysql_fetch_array($exview_template);
         echo  '<img src="../images/templates/'.$selectexview_template['template_name'].'" width="115" height="115" />';
         
         ?>
        </td>
        <td align="center"><?php echo $row['alt_text']; ?></td>
          <td align="center"><?php echo $row['img_des']; ?></td>
        <td align="center"><a href="sub_page_banner_add.php?edit_id=<?=$_REQUEST['page_id']?>&img_id=<?=$row['id']?>">Edit Image</a></td>
        
       <td align="center"> <input name="del[]" type="checkbox" id="del[]"  value="<?php echo $row['id']; ?>"/></td>
      </tr>
      <?php $i++; } ?>
      <tr>
        <td colspan="5" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF"><input name="Delete" type="submit" id="Delete" value="Delete"  class="submit"/></td>
      </tr>
    </table>
  </div>
</form>
<?php } else {  ?> 




<table width="550px" style="margin:0px auto; float:left" border="0" cellpadding="0">
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
                <td width="25%" align="right" valign="middle"></td>
              </tr>
              <tr>
                <td align="left" valign="middle">&nbsp;</td>
                <td colspan="2" align="right" valign="middle"><table width="35%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div class="addmenu"><a href="sub_page_banner_add.php?page_id=<?=$_REQUEST['page_id']?>">Add Image</a></div></td>
                      
                    </tr>
                  </table></td>
              </tr>
            </table>
          </div>
          
          <!--welcome admin end here-->
        </div>
        <!--footer start here-->
        <!--footer end here--></td>
    </tr>
  </table>


  
  
  
  
  
  
</form>


<?php } ?>
</body>
</html>
