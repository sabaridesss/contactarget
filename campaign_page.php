<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

$path = "mail_logo/";	
         if(isset($_REQUEST['id']))
		 {
		$id=$_REQUEST['id'];
		$query2 =  "select * from campaign_list where company_admin='$company_admin' AND `id`=".$id;
		$query_result2 = mysql_query($query2);
		$articalRow = mysql_fetch_array($query_result2);
		}

	if(isset($_POST['Add'])) {
		
				$c_name =htmlspecialchars($_REQUEST['c_name'], ENT_QUOTES); 
				$c_url =htmlspecialchars( $_REQUEST['c_url'], ENT_QUOTES);
				$crypt_url = md5($c_url).time();
				$c_keyword =htmlspecialchars($_REQUEST['c_keyword'], ENT_QUOTES); 
				$c_type =htmlspecialchars($_REQUEST['campaign_type'], ENT_QUOTES); 
				$phone=htmlspecialchars($_REQUEST['phone'], ENT_QUOTES); 
		
				
        $fname = $_FILES['imgName']['name'];
		$tmpname = $_FILES['imgName']['tmp_name'];
		$file_name_img=basename($fname);
		$p_small = $path.$fname;
		move_uploaded_file($tmpname,$p_small);
				
				
				

				 $query1 = "insert into campaign_list(`company_admin`,`logo`,`phone`,`c_name`,`c_url`,`c_keyword`,`c_type`,`crypt_url`)values ('".$company_admin."','".$file_name_img."','".$phone."','".$c_name."','".$c_url."','".$c_keyword."','".$c_type."','".$crypt_url."')";
			
				if(mysql_query($query1))
				header("location:campaign.php?msg=2");
				else
				echo mysql_error();
				
				}
	
	if(isset($_POST['Save'])){
	
	
	
	$hid_id=$_REQUEST['hid_id'];
	$c_name =htmlspecialchars($_REQUEST['c_name'], ENT_QUOTES); 
				$c_url =htmlspecialchars( $_REQUEST['c_url'], ENT_QUOTES);
				$crypt_url = md5($c_url).time();
				$c_keyword =htmlspecialchars($_REQUEST['c_keyword'], ENT_QUOTES); 
				$c_type =htmlspecialchars($_REQUEST['campaign_type'], ENT_QUOTES); 
				$phone=htmlspecialchars($_REQUEST['phone'], ENT_QUOTES); 
	
	
								
				$fname = $_FILES['imgName']['name'];
		if($fname != '')
		{
			$tmpname = $_FILES['imgName']['tmp_name'];
			$file_name_img=basename($fname);
			$p_small = $path.$fname;
			move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img = $articalRow['logo'];
		}	

				
				
				

				 $query = "update `campaign_list` set `c_name` ='".($c_name)."',
												 `c_url` =  '".($c_url)."',
												 `c_keyword` =  '".($c_keyword)."',
												   `company_admin`	= '".($company_admin)."',
												 `phone`	= '".($phone)."',
												 `logo` 	= '".($file_name_img)."',
												 `c_type` =  '".($c_type)."',
												 `crypt_url` =  '".($crypt_url)."'
												  where `id` = '".($hid_id)."'";
												  
									
				
				if(mysql_query($query))
				header("location:campaign.php?msg=3");
				else
				echo mysql_error();							 
												 
												 
	}		
}




?>

<?php include ('common/header.php')?>

<form name="c_keyword_add" method="post" action="" enctype="multipart/form-data">
<input type="hidden" value="<?=$id?>" id="hid_id" />
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
<div class="c_keyword"><br>
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Campaign Page</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="17%" align="right" valign="top" id="title_name">Campaign Name:</td>
        <td width="83%" align="left"><input name="c_name" type="text" id="c_name" value="<?php echo $articalRow['c_name'];?>" size="90" class="input-xlarge focused"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Campaign URL:</td>
        <td align="left">
        <textarea name="c_url" cols="135" rows="5" id="c_url" style="width: 580px; height: 105px;" ><?=$articalRow['c_url']?></textarea>
        
        </td>
      </tr>
      <tr>
        <td align="right" valign="top">Campaign Keyword:</td>
        <td align=""><textarea name="c_keyword" cols="135" style="width: 580px; height: 105px;" rows="5" id="c_keyword" class="input-xlarge focused"><?=$articalRow['c_keyword']?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">Campaign Type:</td>
        <td align=""><select name="campaign_type" id="campaign_type" class="input-xlarge focused" style="width:50%"   tabindex="13"  >
                             <!-- <option  id="campaign_type" value="0" >--Select Types--</option>-->
                              <?php  $sel_tbl_link_cat="SELECT * FROM camp_category where company_admin='$company_admin'";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                              <option id="c_type" value="<?php 
								echo $tbl_link_cat_Fetch['id'];?>" <?php
                    if($articalRow['c_type'] == $tbl_link_cat_Fetch['id'])
					{
					echo 'selected="selected"';
					}
					?> >
                              <?php  echo $tbl_link_cat_Fetch['cate_name'];?>
                              </option>
                              <?php }?>
                            </select></td>
      </tr>

      
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<input type="hidden" name="hid_id" value="<?=$articalRow['id']?>" />
		<?php if($_REQUEST['id'] != '' ) {?>
		<input type="submit" name="Save" value="Save" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
		<?php } else {?>
		<input type="submit" name="Add" value="Add" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
		<?php }?>
		 <a style='text-decoration: none;color:#FF0000'; href="campaign.php" >
                      <input type="button" name="cancel" value="Cancel"  class="btn btn-large btn-primary">
                      </a></td>
        </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
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
