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
		$selectQuery = 'SELECT max(award_id)as siteId from awards_tbl'; 
		$result = mysql_query($selectQuery);
		$row = mysql_fetch_array($result); 
		$numValue = $row['siteId']+1;
		$category = 'award';
		$storedId = $numValue.'-'.$category;
		
		$fname = $_FILES['awdImg']['name'];
		$tmpname = $_FILES['awdImg']['tmp_name'];
		//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-houston/admin/user_images/";
		
		//$path = $_SERVER['DOCUMENT_ROOT']."/cms/admin/user_images/";
		
		//$path = $_SERVER['DOCUMENT_ROOT']."/webdesign-houston/admin/user_images/";
		
		$path = $_SERVER['DOCUMENT_ROOT']."\admin\user_images\\";

		$p_small = $path.$storedId.'-'.$fname;
		$file_name_img=$storedId.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);

		$web_sites_id = '';
		if(!empty($_POST['SiteName']))
		{
			$web_sites_id = implode(',', $_POST['SiteName']);
		}	

		$insert_query = 'INSERT INTO awards_tbl
											SET
												award_name 		= \''.$_POST['awdName'].'\',
												award_image		= \''.$file_name_img.'\',
												award_content	=\''.$_POST['content'].'\',
												enabled_sites	=\''.$web_sites_id.'\'';
		$result = mysql_query($insert_query);
		if($result){
		/*print"<script>alert('Inserted successfully')</script>";
		
		print"<script>location.href='viewAwardDetail.php?msg=2'</script>";*/
		header('location:viewAwardDetail.php?msg=2');
		}
	}

	if(isset($_REQUEST['webId']) != '')
	{
		$category_id = $_REQUEST['webId'];
		$cat_query = 'select * from awards_tbl where award_id ='.$category_id;
		$rs = mysql_query($cat_query);
		$row = mysql_fetch_array($rs);
		
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		$category_id = $_REQUEST['webId'];
		$viewQuery = 'SELECT * FROM awards_tbl WHERE award_id =' .$category_id;
		$exViewQuery = mysql_query($viewQuery);
		$row = mysql_fetch_array($exViewQuery);

				
		$fname = $_FILES['modImg']['name'];
		if($fname!='')
		{
			$numValue = $category_id;
			$category = 'award';
			$storedId = $numValue.'-'.$category;
			
			$tmpname = $_FILES['modImg']['tmp_name'];
			//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-houston/admin/user_images/";
			
			//$path = $_SERVER['DOCUMENT_ROOT']."/cms/admin/user_images/";
			
			//$path = $_SERVER['DOCUMENT_ROOT']."/webdesign-houston/admin/user_images/";
			
			$path = $_SERVER['DOCUMENT_ROOT']."\admin\user_images\\";
				
			$p_small = $path.$storedId.'-'.$fname;
			$file_name_img=$storedId.'-'.$fname;
			move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			 $file_name_img=$row['award_image'];
		}
		
		$web_sites_id = '';
		if(!empty($_POST['SiteName']))
		{
			$web_sites_id = implode(',', $_POST['SiteName']);
		}	

		
		$insert_query = 'UPDATE awards_tbl 
										SET
											award_name 		= \''.$_POST['modAwd'].'\',
											award_image		= \''.$file_name_img.'\',
											award_content	=\''.$_POST['modContent'].'\',
											enabled_sites	= \''.$web_sites_id.'\'
											WHERE award_id ='.$category_id;
										
		$result = mysql_query($insert_query);
		if($result){
		/*print"<script>alert('Inserted successfully')</script>";
		
		print"<script>location.href='viewAwardDetail.php?msg=3'</script>";*/
		header('location:viewAwardDetail.php?msg=3');
		}
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		/*print"<script>location.href='viewAwardDetail.php'</script>";*/
		header('location:viewAwardDetail.php');
	}

	$cat_query2 = "select * from websites_list_tbl";
	$rs2 = mysql_query($cat_query2);

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
    Awards Name
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
<?php if(isset($_REQUEST['webId']) != '')
{ ?>
<br>
<table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Awards</span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Awards Name</span>:</td>
                    <td align="left"><input name="modAwd" type="text" id="modAwd" size="50" value="<?php echo $row['award_name']; ?>" class="login-texbox1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Images Upload</span>:</td>
                    <td align="left"><input name="modImg" type="file" id="modImg" class="calender"/>
					<a href="#" onMouseOver="return overlay(this, 'subcontent4', 'bottomleft')" onMouseOut="overlayclose('subcontent4'); return false">
                        <input value="preview"  type="button"  class="submit"/>
                  </a>
					  <div id="subcontent4" style="border: 1px solid black;  position: absolute; display: none; background-color: rgb(255, 255, 255); "><img src="user_images/<?php echo $row['award_image'];?>"  width="180" height="135"/> </div>			  </td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><span class="style3">Website Names:</span></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php $k=1; while($item2 = mysql_fetch_array($rs2))
			  {	
			     $arrwebsites = explode(',',$row['enabled_sites']);
      
				if($k%2==1)
				{?>
                      <tr>
                        <?php }?>
                        <td height="25"><input name="SiteName[]" type="checkbox" id="SiteName[]" value="<?=$item2['id']?>"<?php if(in_array($item2['id'],$arrwebsites)) { echo 'checked'; } ?>/></td>
                        <td><?=$item2['site_name']?></td>
                        <?php if($k%2==0){?>
                      </tr>
                      <?php } $k++; }?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Content</span></td>
                    <td align=""><textarea name="modContent" id="modContent" class="login-textarea1"><?php echo $row['award_content']; ?></textarea>
<script type="text/javascript">
    CKEDITOR.replace('modContent');
 </script></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input name="Modify" type="submit" id="Modify" value="Modify" class="addmenu2" />
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                    </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td valign="top" class="welcome-admin" id="title_name"><?php echo $obj->error_msg;?></td>
                  </tr>
              </table></td>
            </tr>
          </table>
            <?php } else { ?>
            <br>
            <table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add Awards</span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Awards Name</span>:</td>
                    <td align="left"><input name="awdName" type="text" id="awdName" size="50" class="login-texbox1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Images Upload</span>:</td>
                    <td align="left"><input name="awdImg" type="file" id="awdImg" class="calender"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><span class="style3">Website Names:</span></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php $k=1; while($item2 = mysql_fetch_array($rs2))
			  {	
			     $arrwebsites = explode(',',$row['enabled_sites']);
      
				if($k%2==1)
				{?>
                      <tr>
                        <?php }?>
                        <td height="25"><input name="SiteName[]2" type="checkbox" id="SiteName[]2" value="<?=$item2['id']?>"<?php if(in_array($item2['id'],$arrwebsites)) { echo 'checked'; } ?>/></td>
                        <td><?=$item2['site_name']?></td>
                        <?php if($k%2==0){?>
                      </tr>
                      <?php } $k++; }?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Content</span></td>
                    <td align=""><textarea name="content" class="login-textarea1"></textarea>
                        <script type="text/javascript">
    CKEDITOR.replace('modContent');
            </script></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input type="submit" name="Submit"  id="Submit" value="Add" class="addmenu2"/>
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2"/></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td valign="top" class="welcome-admin" id="title_name"><?php echo $obj->error_msg;?></td>
                  </tr>
              </table></td>
            </tr>
          </table>
            <?php } ?>
			<br>
</div>
<!--welcome admin end here-->
</div>
<!--footer start here-->
<?php include('common/footer.php'); ?>
<!--footer end here--></td>
  </tr>
  <tr>
    <td align="center" class="top"><p>&nbsp;</p>
     </td>
  </tr>
</table>
</form>


</div>
</center>
</body>
</html>


