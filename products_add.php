<?php
session_start();
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

	//Fetch Category
	$category_result = $obj_mysql->get_prod_category_query();
	
	// Add products
	if(isset($_POST['submit']) && ($_POST['submit'] == "add")){
		$prod_name = $_REQUEST['p_name'];
		$prod_price = $_REQUEST['p_price'];
		$prod_manuf = $_REQUEST['p_manu'];
		$prod_type = $_REQUEST['p_type'];
		$prod_color = $_REQUEST['p_color'];
		$category_id = $_REQUEST['category'];
		$prod_warenty = $_REQUEST['p_warenty'];
		$ebay_link = $_REQUEST['ebay_link'];
		$prod_desc = $_REQUEST['prod_desc'];
		
		 $query = "INSERT INTO products(prod_name,prod_price,prod_manufacture,prod_type,prod_color,prod_warrenty,ebay_link,prod_desc,prod_category,created_at)VALUES('".$prod_name."','".$prod_price."','".$prod_manuf."','".$prod_type."','".$prod_color."','".$prod_warenty."','".$ebay_link."','".$prod_desc."','".$category_id."',now())";
		 
		
		if(mysql_query($query)) {
		
		    $query_result = $obj_mysql->get_max_prod_id();
			$item=mysql_fetch_array($query_result);
		    $max_prod_id = $item["max_id"];
			$current_dir = "Main_Menu/products/";
			mkdir($current_dir);
			$current_dir.= $max_prod_id."/";
			mkdir($current_dir);
			$current_dir .= "Thumbs/";
			mkdir($current_dir);
			copy("Main_Menu/noimg.jpg",$current_dir."/main.jpg");
			header("location:products_list.php?add=true");
		}	 
	}
	
	//Fetch product records for edit and show 
	if( (isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "true")) or (isset($_REQUEST['show']) && ($_REQUEST['show'] == "true")) ){
	
		$prod_id = $_REQUEST['prod_id'];
		$query_result = $obj_mysql->get_products_for_edit($prod_id);
		$item=mysql_fetch_array($query_result);
		$prod_name = $item["prod_name"];
		$prod_price = $item["prod_price"];
		$prod_manufacture = $item["prod_manufacture"];
		$prod_type = $item["prod_type"];
		$prod_color = $item["prod_color"];
		$category_id = $item["prod_category"];
		$prod_warrenty = $item["prod_warrenty"];
		$ebay_link = $item["ebay_link"];
		$prod_desc = $item["prod_desc"];
	}
	
	//Edit product
	if(isset($_REQUEST['edit']) && ($_REQUEST['edit'] == "edit")){
		$prod_name = $_REQUEST['p_name'];
		$prod_price = $_REQUEST['p_price'];
		$prod_manuf = $_REQUEST['p_manu'];
		$prod_type = $_REQUEST['p_type'];
		$prod_color = $_REQUEST['p_color'];
		$category_id = $_REQUEST['category'];
		$prod_warenty = $_REQUEST['p_warenty'];
		$prod_desc = $_REQUEST['prod_desc'];
		$ebay_link = $_REQUEST['ebay_link'];
		$prod_id = $_REQUEST['hid_prod_id'];
		$check_special = $_REQUEST['check_special'];
		if($check_special != 1) {
			$check_special = 0;
		}
		
		
		 $query = "update products set prod_name='".$prod_name."',prod_price='".$prod_price."',prod_manufacture='".$prod_manuf."',prod_type='".$prod_type."',prod_color='".$prod_color."',prod_warrenty='".$prod_warenty."',ebay_link='".$ebay_link."',prod_desc='".$prod_desc."',is_special='".$check_special."',prod_category='".$category_id."' where prod_id='".$prod_id."'";
		
		if(mysql_query($query)) {
			header("location:products_list.php?update=true");	
		}
		
	}
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
</table>
</div>
<div class="content"><br>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td align="left" valign="top" class="login-top"><?php if(isset($_REQUEST['edit'])) {?>Edit Product<?php } else {?>Add Product <?php }?></td>
    </tr>
    <tr>
      <td align="left" valign="top" class="login-inner">
	  <table width="100%" border="0" align="center" cellpadding="0">
        <tr>
          <td width="1%" align="right" valign="top" id="title_name">&nbsp;</td>
          <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td height="20" colspan="3" align="left" valign="top" id="title_name">Product Name</td>
          <td colspan="2" align="left"></td>
          <td colspan="2" align="left"></td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <?php if(isset($_REQUEST['edit'])) {?>
          <td colspan="2" align="left"><input name="p_name" type="text" id="p_name" value="<?php echo $prod_name;?>" size="70" class="login-textarea1"/></td>
          <?php } elseif(isset($_REQUEST['show'])) {?>
          <td colspan="2" align="left"><input name="p_name2" type="text" disabled="disabled" id="p_name" value="<?php echo $prod_name;?>" size="70" class="login-textarea1"/></td>
          <?php } else {?>
          <td width="31%" colspan="2" align="left"><input name="p_name2" type="text" id="p_name" size="70" class="login-textarea1"/></td>
          <?php }?>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" id="title_name">Product Price</td>
          <td colspan="2" align="left">&nbsp;</td>
          <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <?php if(isset($_REQUEST['edit'])) {?>
          <td colspan="2" align="left"><input name="p_price" type="text" id="p_price" value="<?php echo $prod_price;?>" size="70" class="login-textarea1"/></td>
          <?php } elseif(isset($_REQUEST['show'])) {?>
          <td colspan="2" align="left"><input name="p_price" type="text" disabled="disabled" id="p_price" value="<?php echo $prod_price;?>" size="70" class="login-textarea1"/></td>
          <?php } else {?>
          <td colspan="2" align="left"><input name="p_price" type="text" id="p_price" size="70" class="login-textarea1"/></td>
          <?php }?>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" id="title_name">Product Manufacture</td>
          <td colspan="2" align="left">&nbsp;</td>
          <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <?php if(isset($_REQUEST['edit'])) {?>
          <td colspan="2" align="left"><input name="p_manu" type="text" id="p_manu" value="<?php echo $prod_manufacture;?>" size="70" class="login-textarea1"/></td>
          <?php } elseif(isset($_REQUEST['show'])) {?>
          <td colspan="2" align="left"><input name="p_manu" type="text" disabled="disabled" id="p_manu" value="<?php echo $prod_manufacture;?>" size="70" class="login-textarea1"/></td>
          <?php } else {?>
          <td colspan="2" align="left"><input name="p_manu" type="text" id="p_manu" size="70"  class="login-textarea1"/></td>
          <?php }?>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" id="title_name">Product Type</td>
          <td colspan="2" align="left">&nbsp;</td>
          <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <?php if(isset($_REQUEST['edit'])) {?>
          <td colspan="2" align="left"><input name="p_type" type="text" id="p_type" value="<?php echo $prod_type;?>" size="70" class="login-textarea1"/></td>
          <?php } elseif(isset($_REQUEST['show'])) {?>
          <td colspan="2" align="left"><input name="p_type" type="text" disabled="disabled" id="p_type" value="<?php echo $prod_type;?>" size="70" class="login-textarea1"/></td>
          <?php } else {?>
          <td colspan="2" align="left"><input name="p_type" type="text" id="p_type" size="70" class="login-textarea1"/></td>
          <?php }?>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" id="title_name">Product category</td>
          </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <td colspan="2" align="left"><select name="category" class="login-textarea1" style="width:180px;">
              <option value="none">select</option>
              <? 
	    $i=1;
	   while($item=mysql_fetch_array($category_result)){
		?>
              <option value="<?php echo $item["id"]; ?>" <?php if((isset($_REQUEST['edit'])) or (isset($_REQUEST['show']))) { if($item["id"] == $category_id) {?> selected="selected" <?php } }?> > <?php echo $item["cate_name"]; ?> </option>
              <? $i++; } ?>
          </select></td>
        </tr>
        <tr>
          <td colspan="3" align="left" valign="top" id="title_name">Product warrenty(in months)<br /></td>
          <td colspan="2" align="left">&nbsp;</td>
          <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <?php if(isset($_REQUEST['edit'])) {?>
          <td colspan="2" align="left"><input name="p_warenty" type="text" id="p_warenty" value="<?php echo $prod_warrenty;?>" size="70" class="login-textarea1"/></td>
          <?php } elseif(isset($_REQUEST['show'])) {?>
          <td colspan="2" align="left"><input name="p_warenty" type="text" disabled="disabled" id="p_warenty" value="<?php echo $prod_warrenty;?>" size="70" class="login-textarea1"/></td>
          <?php } else {?>
          <td colspan="2" align="left"><input name="p_warenty" type="text" id="p_warenty" size="70" class="login-textarea1"/></td>
          <?php }?>
        </tr>
        <?php if(isset($_REQUEST['edit'])) {?>
        <tr>
          <td height="35" align="left" valign="top" id="title_name">&nbsp;</td>
          <td colspan="2" align="left" id="title_name"><a href="javascript:void(0)" onclick="window.open('prod_img_upload.php?folder=products&prod_id=<?php echo $prod_id;?>&img_type=main_img',
'mywindow','width=500,height=400,top=200,left=300,scrollbars=yes'); ">Upload Images</a>&nbsp;&nbsp; <a href="javascript:void(0)" onclick="window.open('prod_img_upload.php?folder=products&prod_id=<?php echo $prod_id;?>&img_type=thumb_nail',
'mywindow','width=500,height=400,top=200,left=300,scrollbars=yes'); ">Upload Thumbnail Images</a>
              <div id="mainbody" style="display:none; margin-top:10px;" >
                <div id="upload" ><span>Upload File<span></div>
                <span id="status" ></span>
                <ul id="files" >
                </ul>
              </div></td>
          </tr>
        <tr>
          <td colspan="3" align="left" valign="top" id="title_name">is Special</td>
          </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <td colspan="2" align="left"><input type="checkbox" value="1" name="check_special"/></td>
        </tr>
        <?php }?>
        <tr>
          <td colspan="3" align="left" valign="top" id="title_name">E-bay link</td>
          <td colspan="2" align="left">&nbsp;</td>
          <td colspan="2" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="right" valign="top" id="title_name">&nbsp;</td>
          <?php if(isset($_REQUEST['edit'])) {?>
          <td colspan="2" align="left"><input name="ebay_link" type="text" id="ebay_link" value="<?php echo $ebay_link;?>" size="70" class="login-textarea1"/></td>
          <?php } elseif(isset($_REQUEST['show'])) {?>
          <td colspan="2" align="left"><input name="ebay_link" type="text" disabled="disabled" id="ebay_link" value="<?php echo $ebay_link;?>" size="70" class="login-textarea1"/></td>
          <?php } else {?>
          <td colspan="2" align="left"><input name="ebay_link" type="text" id="ebay_link" size="70"  class="login-textarea1"/></td>
          <?php }?>
        </tr>
        <tr>
          <td colspan="2" align="left">Content<td colspan="2">        
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
			<?php if(isset($_REQUEST['edit'])) {?>
              <td align="left"><textarea name="prod_desc" cols="130" class="login-textarea1" ><?php echo $prod_desc; ?></textarea>
			  <script type="text/javascript">
    	CKEDITOR.replace('prod_desc');
 		</script></td>
			   <?php } elseif(isset($_REQUEST['show'])) {?> 
              <td align="left"><textarea name="prod_desc" cols="130" disabled="disabled" class="login-textarea1" ><?php echo $prod_desc; ?></textarea>
			  <script type="text/javascript">
    	CKEDITOR.replace('prod_desc');
 		</script></td>
			   <?php } else {?>
              <td align="left"><textarea name="prod_desc" cols="130" class="login-textarea1" ></textarea>
              <script type="text/javascript">
    	CKEDITOR.replace('prod_desc');
 		</script></td>
		<?php }?>
            </tr>
          </table>        </tr>
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <?php if(isset($_REQUEST['edit'])) {?>
          <td colspan="2" align="center"><input type="submit" name="edit" value="edit"  class="submit"/>
            &nbsp;&nbsp;
            <input type="reset" name="reset" value="Reset" class="submit"/></td>
          <input type="hidden" name="hid_prod_id" value="<?php echo $prod_id;?>" />
          <?php } elseif(isset($_REQUEST['show'])) {?>
          <?php } else {?>
          <td colspan="2" align="center"><input type="submit" name="submit" value="add" class="submit"/>
            &nbsp;&nbsp;
            <input type="reset" name="reset" value="Reset" class="submit"/></td>
          <?php }?>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
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


