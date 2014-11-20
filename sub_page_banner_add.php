<?php
include("smarty_config.php");
include("top_menu.php");
	error_reporting(0);
   $action = $_REQUEST['action'];
   
   if($_REQUEST['edit_id'])
   $page_id = $_REQUEST['edit_id'];
   else 
    $page_id = $_REQUEST['page_id'];
   $content_id = $_REQUEST['content_id'];
   $parent_id = $_REQUEST['parent_id'];
   $subcat_id = $_REQUEST['subcat_id'];
   $id = $_REQUEST['id'];
 

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



if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'cancel')
{
header('location:sub_page_banner.php?msg=2&page_id='.$page_id);

}
if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'update')
{


		$fname = $_FILES['upload_file']['name'];
		
		if($fname!="")
		{
		$tmpname = $_FILES['upload_file']['tmp_name'];
		$path = "../uplodeImage/thumbImg/";		
		$p_small = $path.$page_id.'-banner-'.$fname;
		$file_name_img=$page_id.'-banner-'.$fname;
		move_uploaded_file($tmpname,$path.$file_name_img);
		}
		else 
		
		{ $file_name_img=$_REQUEST['noimg']; }
		
		
	
		$fname1 = $_FILES['upload_icon']['name'];
		$tmpname1 = $_FILES['upload_icon']['tmp_name'];
		$p_small = $path.$page_id.'-icon-'.$fname1;
		$file_name_img1=$page_id.'-icon-'.$fname1;
		move_uploaded_file($tmpname1,$path.$file_name_img1);

	
	
	
	
	
	

	$imgType="Thumb Image";
	$img_des=addslashes($_REQUEST['imgdes']);
	$img_template_id =addslashes($_REQUEST['ban_template']);
	
	$query = 'update sub_page_banner_new
								SET
									page_id		= \''.$page_id.'\',
									alt_text	= \''.$_POST['altText'].'\',
									img_des		=\''.$img_des.'\',
									img_template_id 	=\''.$img_template_id.'\',
									status	= 1,
									image_type	= \''.$imgType.'\',
									icon_name	= \''.$file_name_img1.'\',
									image_name	= \''.$file_name_img.'\' WHERE id='.$id;
	$exQuery = mysql_query($query);	
	

header('location:sub_page_banner.php?msg=2&page_id='.$page_id);

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
	
	
	
	header('location:sub_page_banner.php?msg=2&page_id='.$page_id);
								
	
}

$viewSelect = 'SELECT * FROM sub_page_banner_new WHERE page_id = '.$page_id.' AND status = \'1\'';
$exViewQuery = mysql_query($viewSelect);
$num = mysql_num_rows($exViewQuery);
$row = mysql_fetch_array($exViewQuery);



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
<script type="text/javascript" src="menu_css_js/jquery.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
        <!--<td width="15%" align="left" valign="top" class="login-top"><a href="#" onclick="return close_window()"  class="login-top">Close</a></td>-->
        <td width="6%" align="left" valign="top" class="login-top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="left" valign="top"><table width="100%" border="0" align="center">
            <tr>
              <td width="3%" class="login-inner">Alt Text </td>
              <td  width="3%" class="login-inner"><input name="altText" type="text" class="calender" id="altText" value="<?php echo $row['alt_text']; ?>" />
              
              <input name="id" type="hidden" class="calender" id="id" value="<?php echo $row['id']; ?>" />
              </td>
            </tr>
            <tr>
              <td width="3%" class="login-inner">Description</td>
              <td  width="3%" class="login-inner"><textarea name="imgdes" type="text" style="width: 287px; height: 97px;" id="imgdes" /><?php echo $row['img_des']; ?></textarea></td>
            </tr>
<!--<script type="text/javascript">
    CKEDITOR.replace('imgdes');
 </script> -->

            <!--<tr>
              <td width="3%" class="login-inner">Image Type</td>
              <td  width="3%" class="login-inner"><select name="imgType" id="imgType" class="calender">
                  <option value="Select" selected="selected">--Select--</option>
                  <option value="Image Gallery">Image Gallery</option>
                  <option value="Thumb Image">Thumb Image</option>
                </select>
              </td>
            </tr>-->
            <tr>
              <td  width="3%" class="login-inner"> Image </td>
              <td  width="3%" class="login-inner"><input type="file" id="upload_file" name="upload_file" class="calender"/>
               <input name="noimg" type="hidden" class="calender" id="noimg" value="<?php echo $row['image_name']; ?>" />
              <img src="../uplodeImage/thumbImg/<?php echo $row['image_name']; ?>" width="115" height="115" /> 
              
              </td>
            </tr>
            <!--<tr>
              <td  width="3%" class="login-inner"> Icon </td>
              <td  width="3%" class="login-inner"><input type="file" id="upload_icon" name="upload_icon" class="calender"/></td>
            </tr>-->
            <tr>
              <td class="login-inner">Select Template</td>
              <td class="login-inner"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <?php 
				$viewtemp = 'SELECT * FROM banner_template_new ';
				$exviewtemplate = mysql_query($viewtemp);
				$numexviewtemp = mysql_num_rows($exviewtemplate);
				
				
				$i=1; while ($selectRow = mysql_fetch_array($exviewtemplate))
			  {
			  	$value = $selectRow['template_id'];
			  if($i%3==1)
				{
				?>
                  <tr>
                    <?php }?>
                    <td align="left"><p style="padding-left:55px">
                        <input name="ban_template" type="radio" <?php if($row['img_template_id']==$selectRow['template_id']) echo 'checked="checked"'; ?>   value="<?php echo $selectRow['template_id']; ?>"/>
                      </p>
                      <img src="../images/templates/<?php echo $selectRow['template_name']; ?>"  width="135" height="100" border="1"/></td>
                    <?php if($i%3==0){?>
                  </tr>
                  <?php } $i++; }?>
                </table></td>
            </tr>
            <tr>
              <td  class="login-inner"></td>
              <td colspan="3" class="login-inner" >
              
              <?php  if($_REQUEST['edit_id']) { ?>
              <input type="submit" name="Submit" value="update"  class="submit"/>
              <?php } else { ?>
              <input type="submit" name="Submit" value="Upload"  class="submit"/> <?php } ?>
              
              
              <input type="submit" name="Submit" value="cancel"  class="submit"/>
              </td>
            </tr>
          </table></td>
      </tr>
    </table>
    <br />
  </form>
</div>

</body>
</html>
