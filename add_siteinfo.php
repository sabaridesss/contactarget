<?php
include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

	if(isset($_REQUEST['webId']) != '')
	{
		$siteId = $_REQUEST['webId'];
		$viewQuery = 'SELECT * FROM site_tbl WHERE site_id =' .$siteId;
		$exViewQuery = mysql_query($viewQuery);
		$row = mysql_fetch_array($exViewQuery);
	}
	
	$cat_query = "select * from sitecat_tbl order by sitecat_name asc";
	$rs = mysql_query($cat_query);
	
	$cat_query1 = "select * from sitecat_tbl order by sitecat_name asc";
	$rs1 = mysql_query($cat_query1);
	
	$cat_query2 = "select * from websites_list_tbl";
	$rs2 = mysql_query($cat_query2);

	$industry = 'SELECT * FROM industry order by industry_name asc';
	$exIndu = mysql_query($industry); 
	
	$technology = 'SELECT * FROM technology_tbl order by technology_name asc';
	$exTech = mysql_query($technology); 
	

	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Submit')
	{
		$selectQuery = 'SELECT max(site_id)as siteId from site_tbl'; 
		$result = mysql_query($selectQuery);
		$row = mysql_fetch_array($result); 
		$numValue = $row['siteId']+1;
		$category = 'webThumb';
		$storedId = $numValue.'-'.$category;
		
		$fname = $_FILES['userfile']['name'];
		$tmpname = $_FILES['userfile']['tmp_name'];
		//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-houston/admin/user_images/thumb_image/";
		
		//$path = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/admin/user_images/thumb_image/";

		//$path = $_SERVER['DOCUMENT_ROOT']."/cms/admin/user_images/";
		
		$path = $_SERVER['DOCUMENT_ROOT']."/admin/user_images/thumb_image/";
			
		$p_small = $path.$storedId.'-'.$fname;
		$file_name_img=$storedId.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);
	
	
		$category1 = 'webOrg';
		$storedId1 = $numValue.'-'.$category1;
		
		$fname1 = $_FILES['orgImg']['name'];
		$tmpname1 = $_FILES['orgImg']['tmp_name'];
		//$path1 = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-houston/admin/user_images/";
		
		//$path1 = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/admin/user_images/";
		
		//$path1 = $_SERVER['DOCUMENT_ROOT']."/cms/admin/user_images/";
		
		$path1= $_SERVER['DOCUMENT_ROOT']."/admin/user_images/";
			
		$p_small1 = $path1.$storedId1.'-'.$fname1;
		$file_name_img1=$storedId1.'-'.$fname1;
		move_uploaded_file($tmpname1,$p_small1);
		
		$category_type = '';
		if(!empty($_POST['cateName']))
		{
			$category_type = implode(',', $_POST['cateName']);
		}	
		
		$web_sites_id = '';
		if(!empty($_POST['SiteName']))
		{
			$web_sites_id = implode(',', $_POST['SiteName']);
		}	
		

		$siteName = '';
		if(!empty($_POST['site_name']))
		{
			$vowels = array(" ", ".", "-", "_", "&");

			$nameValue = $_POST['site_name'];
			$siteName = str_replace($vowels, "",$nameValue);
		}	

	$selectMeta = 'SELECT * FROM textarea_tbl';
	$exMeta = mysql_query($selectMeta);
	$rowMeta = mysql_fetch_array($exMeta); 
	$metaValue = $rowMeta['field3'];
	
		$insert_query = "insert into site_tbl(sitecat_id,name_field,industry_id,technology_id,site_name,site_url,page_url,site_image,site_org_image,site_desc,title,meta_desc,keyword,h1,h2,city_name,web_category,web_sites,img_order,meta_all_value)values('".$_POST['website_cat']."','".$siteName."','".$_POST["industry"]."','".$_POST["technology"]."','".$_POST["site_name"]."','".$_POST["site_url"]."','".$_POST["page_url"]."','".$file_name_img."','".$file_name_img1."','".$_POST['description']."','".$_POST['mTitle']."','".$_POST['mDes']."','".$_POST['mKey']."','".$_POST['h1']."','".$_POST['h2']."','".$_POST['cityName']."','".$category_type."','".$web_sites_id."','".$_POST['imgOrd']."','".$metaValue."')";
		
		$result = mysql_query($insert_query);
		if($result)
		{
			print"<script>location.href='view_sitedetails.php?msg=2'</script>";
		}
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		$siteId = $_REQUEST['webId'];
		$viewQuery = 'SELECT * FROM site_tbl WHERE site_id =' .$siteId;
		$exViewQuery = mysql_query($viewQuery);
		$row = mysql_fetch_array($exViewQuery);

				
		$fname = $_FILES['modImg']['name'];
		if($fname!='')
		{
			$numValue = $siteId;
			$category = 'webThumb';
			$storedId = $numValue.'-'.$category;
			
			$tmpname = $_FILES['modImg']['tmp_name'];
			//$path = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-houston/admin/user_images/thumb_image/";
			//$path = $_SERVER['DOCUMENT_ROOT']."/cms/admin/user_images/";
			 //$path = $_SERVER['DOCUMENT_ROOT'].'/kumar/webdesign-houston/admin/user_images/thumb_image/';
			 
			$path = $_SERVER['DOCUMENT_ROOT'].'/admin/user_images/thumb_image/';
			
			$p_small = $path.$storedId.'-'.$fname;
			$file_name_img=$storedId.'-'.$fname;
			move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			 $file_name_img=$row['site_image'];
		}


		$fname1 = $_FILES['modOrgImg']['name'];
		if($fname1!='')
		{
			$numValue1 = $siteId;
			$category1 = 'webOrg';
			$storedId1 = $numValue1.'-'.$category1;
			
			$tmpname1 = $_FILES['modOrgImg']['tmp_name'];
			//$path1 = $_SERVER['DOCUMENT_ROOT']."/gopikumar/webdesign-houston/admin/user_images/";
			
			//$path = $_SERVER['DOCUMENT_ROOT']."/cms/admin/user_images/";
			
			//$path1 = $_SERVER['DOCUMENT_ROOT']."/kumar/webdesign-houston/admin/user_images/";	
			
			$path1 = $_SERVER['DOCUMENT_ROOT']."/admin/user_images/";
			
			$p_small1 = $path1.$storedId1.'-'.$fname1;
			$file_name_img1=$storedId1.'-'.$fname1;
			move_uploaded_file($tmpname1,$p_small1);
		}
		else
		{
			 $file_name_img1=$row['site_org_image'];
		}

		
		$category_type = '';
		if(!empty($_POST['cateName']))
		{
			$category_type = implode(',', $_POST['cateName']);
		}	
		
		
		$web_sites_id = '';
		if(!empty($_POST['SiteName']))
		{
			$web_sites_id = implode(',', $_POST['SiteName']);
		}	
		
		
		$siteName = '';
		if(!empty($_POST['modName']))
		{
			$vowels = array(" ", ".", "-", "_", "&");

			$nameValue = $_POST['modName'];
			$siteName = str_replace($vowels, "",$nameValue);
		}	
		
		
		$updateQuery = 'UPDATE site_tbl 
									SET
										site_name		= \''.$_POST['modName'].'\',
										site_url		= \''.$_POST['modUrl'].'\',
										page_url		= \''.$_POST['modpageUrl'].'\',
										sitecat_id		= \''.$_POST['modCate'].'\',
										name_field		= \''.$siteName.'\',
										industry_id		= \''.$_POST['modIndu'].'\',
										technology_id	= \''.$_POST['modTech'].'\',
										site_image		= \''.$file_name_img.'\',
										site_org_image	= \''.$file_name_img1.'\',
										site_desc		= \''.$_POST['modDes'].'\',
										title			= \''.$_POST['mTitle'].'\',
										meta_desc		= \''.$_POST['mDes'].'\',
										keyword			= \''.$_POST['mKey'].'\',
										h1				= \''.$_POST['h1'].'\',
										h2				= \''.$_POST['h2'].'\',
										city_name		= \''.$_POST['cityName'].'\',
										web_category	= \''.$category_type.'\',
										web_sites       = \''.$web_sites_id.'\',
										img_order		= \''.$_POST['imgOrd'].'\',
										meta_all_value  = \''.$_POST['mAllTitle'].'\'
										WHERE site_id 	='.$siteId;
		$exQuery = mysql_query($updateQuery);
		if($exQuery)
		{
			print"<script>location.href='view_sitedetails.php?msg=3'</script>";
		}
								
										
	}
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		print"<script>location.href='view_sitedetails.php'</script>";
	}

}
?>
<?php include ('common/header.php')?>

<form name="content_add" method="post" enctype="multipart/form-data">
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
    <td width="25%" align="left" valign="middle">&nbsp;</td>
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
		  <?php if(isset($_REQUEST['webId']) != '')
		  {
		  ?>
		  <br>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add Website Info </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner_port"><table width="100%" border="0" align="center" cellpadding="0" >
                  <tr>
                    <td width="14%" align="left" valign="top" id="title_name"><span class="style3">Website Name:</span></td>
                    <td width="86%" align="left"><input name="modName" type="text" id="modName" size="100"  value="<?php echo $row['site_name'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Website URL:</span></td>
                    <td align=""><input name="modUrl" type="text" id="modUrl" size="100"  value="<?php echo $row['site_url'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">Page URL: </td>
                    <td align=""><input name="modpageUrl" type="text" id="modpageUrl" size="180" value="<?php echo $row['page_url'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Website Category:</span></td>
                    <td align=""><select name="modCate" id="modCate" class="login-textarea1">
                      <option value="0">--Select--</option>
                      <? while($item1 = mysql_fetch_array($rs1)){?>
                      <option value="<?=$item1['sitecat_id']?>" <?php if($row['sitecat_id'] == $item1['sitecat_id']) { echo 'selected'; }?>>
                      <?=$item1['sitecat_name']?>
                      </option>
                      <? } ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Industry:</span></td>
                    <td align=""><select name="modIndu" id="modIndu" class="login-textarea1">
                      <option value="0">--Select--</option>
                      <? while($rowIndu = mysql_fetch_array($exIndu)){?>
                      <option value="<?=$rowIndu['industry_id']?>" <?php if($row['industry_id'] == $rowIndu['industry_id']) { echo 'selected'; }?>>
                      <?=$rowIndu['industry_name']?>
                      </option>
                      <? } ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Technology:</span></td>
                    <td align=""><select name="modTech" id="modTech" class="login-textarea1">
                      <option value="0">--Select--</option>
                      <? while($rowTech = mysql_fetch_array($exTech)){?>
                      <option value="<?=$rowTech['technology_id']?>" <?php if($row['technology_id'] == $rowTech['technology_id']) { echo 'selected'; }?>>
                      <?=$rowTech['technology_name']?>
                      </option>
                      <? } ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3"> Thumb Image:</span></td>
                    <td align=""><input type="file" id="modImg" name="modImg"  class="login-textarea1"/>
               <a href="#" onMouseOver="return overlay(this, 'subcontent4', 'bottomleft')" onMouseOut="overlayclose('subcontent4'); return false">
                        <input value="preview" class="commentslist" type="button" />
                  </a>
						 <div id="subcontent4" style="border: 1px solid black;  position: absolute; display: none; background-color: rgb(255, 255, 255); "><img src="user_images/thumb_image/<?php echo $row['site_image'];?>"  width="180" height="135"/> </div></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3"> Original Image:</span></td>
                    <td align=""><input name="modOrgImg" type="file" id="modOrgImg"  class="login-textarea1"/>
			  <a href="#" onMouseOver="return overlay(this, 'subcontent5', 'bottomleft')" onMouseOut="overlayclose('subcontent5'); return false">
                        <input value="preview" class="commentslist" type="button" />
                  </a>
						 <div id="subcontent5" style="border: 1px solid black;  position: absolute; display: none; background-color: rgb(255, 255, 255); "><img src="user_images/<?php echo $row['site_org_image'];?>"  width="180" height="135"/> </div></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Profile:</span></td>
                    <td align=""><textarea name="modDes" cols="184" rows="10" id="modDes" class="login-textarea2"><?php echo $row['site_desc'];?></textarea></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Meta:</span></td>
                    <td align=""><textarea name="mAllTitle" cols="184" rows="10" id="mAllTitle" class="login-textarea2"><?php echo $row['meta_all_value'];?></textarea></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">H1:</span></td>
                    <td align=""><input name="h1" type="text" id="h1" size="100"  value="<?php echo $row['h1'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">H2:</span></td>
                    <td align=""><input name="h2" type="text" id="h2" size="100"  value="<?php echo $row['h2'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">City Name:</span></td>
                    <td align=""><input name="cityName" type="text" id="cityName" size="100"  value="<?php echo $row['city_name'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><span class="page_heading">Website Category:</span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php $i=1; while($item = mysql_fetch_array($rs))
			  {	
			     $arrCusType = explode(',',$row['web_category']);
      
				if($i%2==1)
				{?>
                      <tr>
                        <?php }?>
                        <td height="25" align="right"><input name="cateName[]" type="checkbox" id="cateName[]" value="<?=$item['sitecat_id']?>"<?php if(in_array($item['sitecat_id'],$arrCusType)) { echo 'checked'; } ?>/></td>
                        <td align="left"><?=$item['sitecat_name']?></td>
                        <?php if($i%2==0){?>
                      </tr>
                      <?php } $i++; }?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><span class="page_heading">Website Names:</span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php $k=1; while($item2 = mysql_fetch_array($rs2))
			  {	
			     $arrwebsites = explode(',',$row['web_sites']);
      
				if($k%2==1)
				{?>
                      <tr>
                        <?php }?>
                        <td height="25" align="right"><input name="SiteName[]" type="checkbox" id="SiteName[]" value="<?=$item2['id']?>"<?php if(in_array($item2['id'],$arrwebsites)) { echo 'checked'; } ?>/></td>
                        <td><?=$item2['site_name']?></td>
                        <?php if($k%2==0){?>
                      </tr>
                      <?php } $k++; }?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Image  Order:</span></td>
                    <td align=""><input name="imgOrd" type="text" id="imgOrd" size="10" value="<?php echo $row['img_order'];?>" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align="">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><input name="Modify" type="submit" id="Modify" value="Modify" class="addmenu2" />
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2"  /></td>
                  </tr>
              </table></td>
            </tr>
          </table>
		  <br>

		  <?php } else { ?>
		  <br>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add Website Info </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" cellpadding="0" >
                  <tr>
                    <td width="11%" align="left" valign="top" id="title_name"><span class="style3">Website Name:</span></td>
                    <td width="89%" align="left"><input name="site_name" type="text" id="site_name" size="100" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Website URL:</span></td>
                    <td align=""><input name="site_url" type="text" id="site_url" size="100" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">Page URL: </td>
                    <td align=""><input name="page_url" type="text" id="page_url" size="180" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Website Category:</span></td>
                    <td align=""><select name="website_cat" id="website_cat" class="login-textarea1">
                      <option value="0">--Select--</option>
                      <? while($item = mysql_fetch_array($rs)){?>
                      <option value="<?=$item['sitecat_id']?>">
                      <?=$item['sitecat_name']?>
                      </option>
                      <? } ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Industry:</span></td>
                    <td align=""><select name="industry" id="industry" class="login-textarea1">
                      <option value="0">--Select--</option>
                      <? while($rowIndu = mysql_fetch_array($exIndu)){?>
                      <option value="<?=$rowIndu['industry_id']?>">
                      <?=$rowIndu['industry_name']?>
                      </option>
                      <? } ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Technology:</span></td>
                    <td align=""><select name="technology" id="technology" class="login-textarea1">
                      <option value="0">--Select--</option>
                      <? while($rowTech = mysql_fetch_array($exTech)){?>
                      <option value="<?=$rowTech['technology_id']?>">
                      <?=$rowTech['technology_name']?>
                      </option>
                      <? } ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3"> Thumb Image:</span></td>
                    <td align=""><input type="file" id="userfile" name="userfile" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3"> Original Image:</span></td>
                    <td align=""><input name="orgImg" type="file" id="orgImg" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Profile:</span></td>
                    <td align=""><textarea name="description" cols="184" rows="10" id="decription" class="login-textarea2"></textarea></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Meta:</span></td>
                    <td align=""><textarea name="mTitle" cols="184" rows="10" id="mTitle" class="login-textarea2"><?php echo $row['meta_all_value'];?></textarea></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">H1:</span></td>
                    <td align=""><input name="h1" type="text" id="h1" size="100" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">H2:</span></td>
                    <td align=""><input name="h2" type="text" id="h2" size="100" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">City Name:</span></td>
                    <td align=""><input name="cityName" type="text" id="cityName" size="100" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><span class="page_heading">Website Category:</span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php $i=1; while($item1 = mysql_fetch_array($rs1))
			  {	
				if($i%2==1)
				{?>
                      <tr>
                        <?php }?>
                        <td height="25" align="right"><input name="cateName[]" type="checkbox" id="cateName[]" value="<?=$item1['sitecat_id']?>"/></td>
                        <td><?=$item1['sitecat_name']?></td>
                        <?php if($i%2==0){?>
                      </tr>
                      <?php } $i++; }?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><span class="page_heading">Website Names:</span></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <?php $j=1; while($item2 = mysql_fetch_array($rs2))
			  {	
				if($j%2==1)
				{?>
                      <tr>
                        <?php }?>
                        <td height="25" align="right"><input name="SiteName[]" type="checkbox" id="SiteName[]" value="<?=$item2['id']?>"/></td>
                        <td><?=$item2['site_name']?></td>
                        <?php if($j%2==0){?>
                      </tr>
                      <?php } $j++; }?>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><span class="style3">Image  Order:</span></td>
                    <td align=""><input name="imgOrd" type="text" id="imgOrd" size="10" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align="">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td align=""><input type="submit" name="Submit" value="Submit" class="addmenu2"  />
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2"  /></td>
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


