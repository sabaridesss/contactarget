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
			$package_id	= $_POST['package_id'];
			$description	= $_POST['description'];
			$platinum		= $_POST['platinum'];
			$gold		= $_POST['gold'];
			$silver		= $_POST['silver'];
			$sort_order		= $_POST['sort_order'];
			$silver_des= $_POST['silver_des'];
			$gold_des= $_POST['gold_des'];
			$plat_des= $_POST['plat_des'];

		$fname = $_FILES['imgName']['name'];
		$tmpname = $_FILES['imgName']['tmp_name'];
		$path = "../uplodeImage/packages/";
		$file_name_img=basename($fname);
		$p_small = $path.$fname;
		move_uploaded_file($tmpname,$p_small);

		
		 $insert = 'INSERT INTO pkg_tbl 
										SET package_id 	= \''.$package_id.'\',
											description 	= \''.$description.'\',
											platinum 		= \''.$platinum.'\',
											silver_des 		= \''.$silver_des.'\',
											gold_des 		= \''.$gold_des.'\',
											plat_des 		= \''.$plat_des.'\',
											media_image 	= \''.$file_name_img.'\',
											gold 		= \''.$gold.'\',
											silver 			= \''.$silver.'\',
											sort_order 	= \''.$sort_order.'\'';

		$query = mysql_query($insert);
		header('location:packages.php?msg=2');									

	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		$query2 =  'select * from pkg_tbl where id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
			$id	= $_POST['id'];
			$package_id	= $_POST['package_id'];
			$description	= $_POST['description'];
			$platinum		= $_POST['platinum'];
			$gold		= $_POST['gold'];
			$silver		= $_POST['silver'];
			$sort_order		= $_POST['sort_order'];
			$silver_des= $_POST['silver_des'];
			$gold_des= $_POST['gold_des'];
			$plat_des= $_POST['plat_des'];

		$fname = $_FILES['imgName']['name'];
		if($fname != '')
		{
			$tmpname = $_FILES['imgName']['tmp_name'];
			$path = "../uplodeImage/packages/";
			$file_name_img=basename($fname);
			$p_small = $path.$fname;
			move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img = $displaySite['media_image'];
		}	

		
		$insert = 'UPDATE pkg_tbl
										SET
											package_id 	= \''.$package_id.'\',
											description 	= \''.$description.'\',
											silver_des 		= \''.$silver_des.'\',
											gold_des 		= \''.$gold_des.'\',
											plat_des 		= \''.$plat_des.'\',
											platinum 		= \''.$platinum.'\',
											media_image 	= \''.$file_name_img.'\',
											gold 		= \''.$gold.'\',
											silver 			= \''.$silver.'\',
											sort_order 	= \''.$sort_order.'\'
											WHERE id ='.$id;
		$query = mysql_query($insert);
		header('location:packages.php?msg=3');
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location: packages.php");
	}

	
}	
?>
<?php include ('common/header.php')?>
<script type="application/javascript">function showpasswordbox()
   {
      if(document.content_add.platinum.checked)
      {
         document.getElementById("mydiv").style.display='inline';
		
		 return false;
      }
      else
      {
         document.getElementById("mydiv").style.display='none';
		 document.getElementById("plat_des").value="";
return false;
      }

   } </script>

<script type="application/javascript">function showpasswordbox1()
   {
      if(document.content_add.gold.checked)
      {
         document.getElementById("mydiv1").style.display='inline';
		
		 return false;
      }
      else
      {
         document.getElementById("mydiv1").style.display='none';
		 document.getElementById("gold_des").value="";
return false;
      }

   } </script>
<script type="application/javascript">function showpasswordbox2()
   {
      if(document.content_add.silver.checked)
      {
         document.getElementById("mydiv2").style.display='inline';
		
		 return false;
      }
      else
      {
         document.getElementById("mydiv2").style.display='none';
		 document.getElementById("silver_des").value="";
return false;
      }

   } </script>
<form name="content_add" method="post" action="" enctype="multipart/form-data">
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle">&nbsp;</td>
                <td colspan="2" align="center" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="content">
            <?php if($_REQUEST['id'] != '')
			  {
			   ?>
            <br>
            <table width="60%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top"><span class="style4">Edit Packages </span></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="18%" align="right" valign="top" id="title_name">Package Type</td>
                      <td colspan="2" align="left"><input type="hidden" value="<?=$_REQUEST['id']?>" name="id" id="id" />
                        <select   name="package_id" id="package_id"  style="width:50%"    >
                          <option  id="package_id"  value="0" >--Select Package Type--</option>
                          <?php  $sel_tbl_main_cat="SELECT * FROM pakage_categories order by cat_order ASC";
				  
				  $query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat);
		 
		  while($tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat)) {?>
                          <option id="package_id"    value="<?php 
								echo $tbl_main_cat_Fetch['id'];?>"
                                
                                 <?php
                    if($displaySite['package_id'] == $tbl_main_cat_Fetch['id'])
					{
					echo 'selected="selected"';
					}
					?> >
                          <?php  echo $tbl_main_cat_Fetch['cat_name'];?>
                          </option>
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Image :</td>
                      <td width="49%" align="" valign="top"><input name="imgName" type="file" class="login-textarea1" id="imgName"/></td>
                      <td width="33%" align="left"><img src="../uplodeImage/packages/<?php echo $displaySite['media_image']; ?>" width="70" height="60" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Description  : </td>
                      <td colspan="2" align=""><textarea name="description" cols="60" rows="7" class="login-textarea2" id="description"><?php echo $displaySite['description']; ?></textarea></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Platinum : </td>
                      <td colspan="2" align=""><input name="platinum" type="checkbox" id="platinum" value="1" <?php if($displaySite['platinum'] == '1' ){?>checked="checked"<?php } ?> onchange='return showpasswordbox()' />
                        &nbsp;&nbsp;
                        <div  id="mydiv" <?php if($displaySite['platinum'] == '1' )
			
			
			echo "style='display:inline'";
		 else
			echo "style='display:none'";
			 ?>>
                          <input type="text" value="<?=$displaySite['plat_des']?>"  class="login-textarea1" name="plat_des" id="plat_des" />
                        </div></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Gold : </td>
                      <td colspan="2" align=""><input name="gold" type="checkbox" id="gold" value="1" <?php if($displaySite['gold'] == '1' ){?>checked="checked"<?php } ?> onchange='return showpasswordbox1()' />
                        &nbsp;&nbsp; <div  id="mydiv1" <?php if($displaySite['gold'] == '1' )
			
			
			echo "style='display:inline'";
		 else
			echo "style='display:none'";
			 ?>>
                          <input type="text" value="<?=$displaySite['gold_des']?>"  class="login-textarea1" name="gold_des" id="gold_des" />
                        </div>
                        </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Silver : </td>
                      <td colspan="2" align=""><input name="silver" type="checkbox" id="silver" value="1" <?php if($displaySite['silver'] == '1' ){?>checked="checked"<?php } ?> onchange='return showpasswordbox2()' />
                        &nbsp;&nbsp;<div  id="mydiv2" <?php if($displaySite['silver'] == '1' )
			
			
			echo "style='display:inline'";
		 else
			echo "style='display:none'";
			 ?>>
                          <input type="text" value="<?=$displaySite['silver_des']?>"  class="login-textarea1" name="silver_des" id="silver_des" />
                        </div>
                        </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Sort Order : </td>
                      <td colspan="2" align=""><input name="sort_order" type="text" class="login-textarea1" id="sort_order" value="<?php echo $displaySite['sort_order']; ?>"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td colspan="2" align="">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td colspan="2" align=""><input name="Modify" type="submit" id="Modify" value="Modify" class="addmenu2"/>
                        <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br>
            <?php } else { ?>
            <br>
            <table width="70%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top"><span class="style4">Add Packages </span></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="16%" align="right" valign="top" id="title_name">Packages Types</td>
                      <td width="84%" align="left"><select   name="package_id" id="package_id"  style="width:50%"    >
                          <option  id="package_id"  value="0" >--Select Package Type--</option>
                          <?php  $sel_tbl_main_cat="SELECT * FROM pakage_categories order by cat_order ASC";
				  
				  $query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat);
		 
		  while($tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat)) {?>
                          <option id="package_id"    value="<?php 
								echo $tbl_main_cat_Fetch['id'];?>">
                          <?php  echo $tbl_main_cat_Fetch['cat_name'];?>
                          </option>
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Image :</td>
                      <td align=""><input name="imgName" type="file" class="login-textarea1" id="imgName"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Description  : </td>
                      <td colspan="2" align=""><textarea name="description" cols="60" rows="7" class="login-textarea2" id="description"></textarea></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Platinum :
                        </td>
                      <td colspan="2" align=""><input name="platinum" type="checkbox" id="platinum" value="1"  onchange='return showpasswordbox()'  />
                        &nbsp;&nbsp;&nbsp;
                        <div id="mydiv" style="display:none">
                          <input type="text"  class="login-textarea1" name="plat_des" id="plat_des" />
                        </div></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Gold :
                        
                      </td>
                      <td colspan="2" align=""><input name="gold" type="checkbox" id="gold" value="1"  onchange='return showpasswordbox1()'  />
                        &nbsp;&nbsp;&nbsp;
                        <div id="mydiv1" style="display:none">
                          <input type="text"  class="login-textarea1" name="gold_des" id="gold_des" />
                        </div></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Silver :
                        
                      </td>
                      <td colspan="2" align=""><input name="silver" type="checkbox" id="silver" value="1"  onchange='return showpasswordbox2()'  />
                        &nbsp;&nbsp;&nbsp;
                        <div id="mydiv2" style="display:none">
                          <input type="text"  class="login-textarea1" name="silver_des" id="silver_des" />
                        </div></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Sort Order : </td>
                      <td colspan="2" align=""><input name="sort_order" type="text" class="login-textarea1" id="sort_order" value=""/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><input type="submit" name="Submit" value="Add" class="addmenu2" />
                        <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br>
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
</body></html>