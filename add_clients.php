<?php
include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

	if(isset($_REQUEST['id']) != '')
	{
		$siteId = $_REQUEST['id'];
		$viewQuery = 'SELECT * FROM clients_tbl WHERE id =' .$siteId;
		$exViewQuery = mysql_query($viewQuery);
		$row = mysql_fetch_array($exViewQuery);
	}
	
	
	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Submit')
	{
		$selectQuery = 'SELECT max(id)as siteId from clients_tbl'; 
		$result = mysql_query($selectQuery);
		$row = mysql_fetch_array($result); 
		$numValue = $row['siteId']+1;
		$category = 'client';
		$storedId = $numValue.'-'.$category;
		
		$fname = $_FILES['userfile']['name'];
		$tmpname = $_FILES['userfile']['tmp_name'];
		//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-houston/admin/user_images/logo/";

		//$path = $_SERVER['DOCUMENT_ROOT']."/cms/admin/user_images/logo/";
		
		//$path = $_SERVER['DOCUMENT_ROOT']."/webdesign-houston/admin/user_images/logo/";
		
		$path = $_SERVER['DOCUMENT_ROOT'].'\admin\user_images\logo\\';
		
		$p_small = $path.$storedId.'-'.$fname;
		$file_name_img=$storedId.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);
		
		
		$web_sites_id = '';
		if(!empty($_POST['SiteName']))
		{
			$web_sites_id = implode(',', $_POST['SiteName']);
		}	
	
		$insert_query = "insert into clients_tbl(client_name,client_desc,client_url,client_logo,enabled_sites)values('".$_POST["site_name"]."','".$_POST["description"]."','".$_POST["site_url"]."','".$file_name_img."','".$web_sites_id."')";
		$result = mysql_query($insert_query);
		if($result)
		{
			print"<script>location.href='clients_list.php?msg=2'</script>";
		}
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		$siteId = $_REQUEST['id'];
		$viewQuery = 'SELECT * FROM clients_tbl WHERE id =' .$siteId;
		$exViewQuery = mysql_query($viewQuery);
		$row = mysql_fetch_array($exViewQuery);

				
		$fname = $_FILES['modImg']['name'];
		if($fname!='')
		{
			$numValue = $siteId;
			$category = 'client';
			$storedId = $numValue.'-'.$category;
			
			$tmpname = $_FILES['modImg']['tmp_name'];
			//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-houston/admin/user_images/logo/";
			//$path = $_SERVER['DOCUMENT_ROOT']."/cms/admin/user_images/logo/";
			//$path = $_SERVER['DOCUMENT_ROOT']."/webdesign-houston/admin/user_images/logo/";
			
			$path = $_SERVER['DOCUMENT_ROOT'].'\admin\user_images\logo\\';
				
			$p_small = $path.$storedId.'-'.$fname;
			$file_name_img=$storedId.'-'.$fname;
			move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			 $file_name_img=$row['client_logo'];
		}
		
		
		$web_sites_id = '';
		if(!empty($_POST['SiteName']))
		{
			$web_sites_id = implode(',', $_POST['SiteName']);
		}	
		
		
		$updateQuery = 'UPDATE clients_tbl 
									SET
										client_name		= \''.$_POST['modName'].'\',
										client_desc		= \''.$_POST['modDes'].'\',
										client_url		= \''.$_POST['modUrl'].'\',	
										client_logo		= \''.$file_name_img.'\',
										enabled_sites	= \''.$web_sites_id.'\'
										WHERE id 	='.$siteId;
										
		$exQuery = mysql_query($updateQuery);
		if($exQuery)
		{
			print"<script>location.href='clients_list.php?msg=3'</script>";
		}
								
										
	}
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		print"<script>location.href='clients_list.php'</script>";
	}
	
	$cat_query2 = "select * from websites_list_tbl";
	$rs2 = mysql_query($cat_query2);

}
?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" >
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
    <td colspan="2" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="addmenu"><a href="view_siteinfo.php" class="style5">View Category </a></div></td>
        <td><div class="addmenu"><a href="view_sitedetails.php"  class="style5">View Site Details</a></div></td>
        <td><div class="addmenu"><a href="view_technology.php" class="style5">View Technologys</a></div></td>
        <td><div class="addmenu"><a href="clients_list.php"  class="style5">View Clients</a></div></td>
        <td><div class="addmenu"><a href="view_industry.php"  class="style5">View Industry</a></div></td>
      </tr>
    </table></td>
    </tr>
</table>
</div>
<div class="content">
		  <?php if(isset($_REQUEST['id']) != '')
		  {
		  ?>
		  <br>
<table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Clients Info </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td width="23%" align="right" valign="top" id="title_name"><span class="style3">Client Name:</span></td>
                    <td width="77%" align="left"><input name="modName" type="text" id="modName" size="50"  value="<?php echo $row['client_name'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Client URL:</span></td>
                    <td align=""><input name="modUrl" type="text" id="modUrl" size="50"  value="<?php echo $row['client_url'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Client Logo Image:</span></td>
                    <td align=""><input type="file" id="modImg" name="modImg"  class="login-textarea1"/>
                <a href="#" onMouseOver="return overlay(this, 'subcontent4', 'bottomleft')" onMouseOut="overlayclose('subcontent4'); return false">
                <input name="button" type="button" class="commentslist" value="preview" />
                </a>
                <div id="subcontent4" style="border: 1px solid black;  position: absolute; display: none; background-color: rgb(255, 255, 255); "><img src="user_images/logo/<?php echo $row['client_logo'];?>"  width="180" height="135"/> </div></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Description:</span></td>
                    <td align=""><textarea name="modDes" cols="34" rows="3" id="modDes" class="login-textarea1"><?php echo $row['client_desc'];?></textarea></td>
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
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input name="Modify" type="submit" id="Modify" value="Modify" class="addmenu2" />
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2"  /></td>
                  </tr>
              </table></td>
            </tr>
          </table><br>

		  <?php } else { ?>
          <br>
          <table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add Clients Info </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td width="23%" align="right" valign="top" id="title_name"><span class="style3">Client Name:</span></td>
                    <td width="77%" align="left"><input name="site_name" type="text" id="site_name" size="50" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Client URL:</span></td>
                    <td align=""><input name="site_url" type="text" id="site_url" size="50" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Client Logo Image:</span></td>
                    <td align=""><input type="file" id="userfile" name="userfile" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Description:</span></td>
                    <td align=""><textarea name="description" cols="34" rows="3" id="decription" class="login-textarea1"></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><span class="style3">Website Names:</span></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php $j=1; while($item2 = mysql_fetch_array($rs2))
			  {	
				if($j%2==1)
				{?>
                      <tr>
                        <?php }?>
                        <td height="25"><input name="SiteName[]" type="checkbox" id="SiteName[]" value="<?=$item2['id']?>"/></td>
                        <td><?=$item2['site_name']?></td>
                        <?php if($j%2==0){?>
                      </tr>
                      <?php } $j++; }?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input type="submit" name="Submit" value="Submit" class="addmenu2" />
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

