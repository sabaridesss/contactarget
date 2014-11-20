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
		$select = 'SELECT * FROM video_gallery';
		$exSelect = mysql_query($select);
		$numRow = mysql_num_rows($exSelect);
		$imgId = $numRow+1;
		
		$fname = $_FILES['upImg']['name'];
		$tmpname = $_FILES['upImg']['tmp_name'];
		//$path = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/uplodeImage/uplodeVideo/img/";
		 $path = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/uplodeVideo/img/";
		
		$p_small = $path.$imgId.'-'.$fname;
		$file_name_img=$imgId.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);
		
		if($_REQUEST['videoType'] == 'uplode')
		{
			$fname1 = $_FILES['upVideo']['name'];
			$tmpname1 = $_FILES['upVideo']['tmp_name'];
			//$path1 = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/uplodeImage/uplodeVideo/video/";
			 $path1 = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/uplodeVideo/video/";
			
			$p_small1 = $path1.$imgId.'-'.$fname1;
			$file_name_img1=$imgId.'-'.$fname1;
			move_uploaded_file($tmpname1,$p_small1);
		}
		else
		{
			 $file_name_img1 = $_REQUEST['youtubeLink'];
		}
		
		
		 $insert = 'INSERT INTO video_gallery 
										SET
											video_type 		= \''.$_POST['videoType'].'\',
											video_image		= \''.$file_name_img.'\',
											upload_video	= \''.$file_name_img1.'\'';
		$exInsert = mysql_query($insert);
		header('location:video_gallery_view.php?msg=2');									
	
	}


//Edit Image

	$editImg = 'SELECT * FROM  video_gallery WHERE video_id ='.$_REQUEST['menus_id'];
	$exEdit = mysql_query($editImg);
	$viewRow = mysql_fetch_array($exEdit);

//Cancel Page
if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
{
	header('location:video_gallery_view.php');		
}


// Update Information

if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Edit')
{		
		$imgId = $_REQUEST['menus_id'];
		$fname = $_FILES['upImg']['name'];
		if($fname != '')
		{
			$tmpname = $_FILES['upImg']['tmp_name'];
			//$path = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/uplodeImage/uplodeVideo/img/";
			 $path = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/uplodeVideo/img/";
			
			$p_small = $path.$imgId.'-'.$fname;
			$file_name_img=$imgId.'-'.$fname;
			move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img = $viewRow['video_image'];
		} 
		
		if($_REQUEST['videoType'] == 'uplode')
		{
			$fname1 = $_FILES['upVideo']['name'];
			if($fname1 != '')
			{
				$tmpname1 = $_FILES['upVideo']['tmp_name'];
				//$path1 = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/uplodeImage/uplodeVideo/video/";
				 $path1 = $_SERVER['DOCUMENT_ROOT']."/uplodeImage/uplodeVideo/video/";
			
				$p_small1 = $path1.$imgId.'-'.$fname1;
				$file_name_img1=$imgId.'-'.$fname1;
				move_uploaded_file($tmpname1,$p_small1);
			}
			else
			{
				$file_name_img1 = $viewRow['upload_video'];
			}
		}	
		else
		{
			 $file_name_img1 = $_REQUEST['youtubeLink'];
		}
	
	$update = 'UPDATE video_gallery
							  SET
									video_type 		= \''.$_POST['videoType'].'\',
									video_image		= \''.$file_name_img.'\',
									upload_video	= \''.$file_name_img1.'\'
									WHERE video_id  ='.$_REQUEST['menus_id'];
	$exUpdate = mysql_query($update);
	header('location:video_gallery_view.php?msg=3');								
								
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
        <td width="190" align="right" valign="top" id="title_name">Video Type: </td>
        <td width="502" align="left">
		<select name="videoType" id="videoType" onchange="videoGallery(this.value)">
		<option value="">--Select--</option>
		<option value="youtube"<?php if($viewRow['video_type'] == 'youtube'){ echo 'selected';} ?>>YouTube Link</option>
		<option value="uplode"<?php if($viewRow['video_type'] == 'uplode'){ echo 'selected';} ?>>Uplode Video</option>
        </select>        </td>
      </tr>
      <tr>
        <td colspan="2" align="right" valign="top" id="title_name">
		<div id="youtube" <?php if($viewRow['video_type'] == 'youtube'){ ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> >
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="30%" align="right">YouTube Link: </td>
            <td width="70%" align="left"><textarea name="youtubeLink" cols="50" rows="6" id="youtubeLink"><?php if($viewRow['video_type'] == 'youtube') { ?><?php echo $viewRow['upload_video']; ?><?php } ?></textarea></td>
          </tr>
        </table>
		</div>
		</td>
        </tr>
      <tr>
        <td colspan="2" align="right" valign="top" id="title_name">
		<div id="uplode" <?php if($viewRow['video_type'] == 'uplode'){ ?> style="display:block;" <?php } else { ?> style="display:none;" <?php } ?> >
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
          <tr>
            <td width="28%" align="right">Uplode Image: </td>
            <td width="72%" align="left"><input name="upImg" type="file"  class="login-textarea1" id="upImg"></td>
          </tr>
          <tr>
            <td align="right">Uplode Video: </td>
            <td align="left"><input name="upVideo" type="file" class="login-textarea1" id="upVideo"/> 
              (only .Mp4,.Flv) </td>
          </tr>
        </table>
		</div>
		</td>
        </tr>
	  <?php if($_REQUEST['menus_id'] != '')
	  {
	  ?>
      <tr>
        <td colspan="2" align="center" valign="top">
		<?php if($viewRow['video_type'] == 'youtube')
		{?>
				
			<?php echo $viewRow['upload_video']; ?>
			
		<?php } 
		else
		{
		 $videofile= '/kumar/webdesign-houston/uplodeImage/uplodeVideo/video/'.$viewRow['upload_video'];
		 //$videofile= 'http://webdesignerhouston.us/uplodeImage/uplodeVideo/video/'.$viewRow['upload_video'];
		 $imgfile='';
		?>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="459" height="406" id="player4">
<param name="movie" value="player.swf">
<param name="allowfullscreen" value="true">
<param name="allowscriptaccess" value="always">
<param name="wmode" value="transparent">
<param name="flashvars" value="file=<?php echo $videofile; ?>&image=<?php echo $imgfile; ?>">
<!--[if !IE]>
<object type="application/x-shockwave-flash" data="player.swf" width="459" height="406">
<param name="allowfullscreen" value="true">
<param name="allowscriptaccess" value="always">
<param name="wmode" value="transparent">
<param name="flashvars" value="file=<?php echo $videofile; ?>&image=<?php echo $imgfile; ?>">
<![endif]-->
<embed
            type="application/x-shockwave-flash"
            id="player2"
            name="player"
            src="player.swf"
            width="480"
            height="406"
            allowscriptaccess="always"
            allowfullscreen="true"
            wmode="transparent"
            flashvars="file=<?php echo $videofile; ?>&image=<?php echo $imgfile; ?>"
        />
<!--[if !IE]>
</object>
<![endif]-->
</object>


	 <script type="text/javascript">
    jwplayer("container").setup({
        flashplayer: "player.swf",
        file: "<?php echo $videofile; ?>",
		image: "<?php echo $imgfile; ?>",
        height: 406,
        width: 480
    });
</script>
		<?php } ?>
		</td>
        </tr>
	 <?php } ?> 
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<?php if($_REQUEST['menus_id'] != '') {?> 
		 <input type="submit" name="Submit" value="Edit"  class="addmenu2"/>
		 <?php } else {?>
		 <input type="submit" name="Submit" value="Submit"  class="addmenu2"/>
		 <?php } ?>
		 
          &nbsp;&nbsp;&nbsp;
          <input type="submit" name="Cancel" value="Cancel" class="addmenu2" />        </td>
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

