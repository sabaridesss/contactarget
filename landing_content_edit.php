<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
		
		$uri = urlencode($_SERVER['REQUEST_URI']);
		
	   $page_id = $_REQUEST['page_id'];
	   $parent_id = $_REQUEST['parent_id'];
	   $edit_query = "select * from `menu_page_tbl` where `id` ='$page_id'";
	   $edit_query_result = mysql_query($edit_query);
	   $num_rows = mysql_num_rows($edit_query_result);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
	   
				$id = $edit_item["id"];
				$page_name = $edit_item["file_name"];
				$title = $edit_item["title"];
				$content = $edit_item["img_description"];
				$meta_name = $edit_item["meta_name"];
				$meta_content = $edit_item["meta_content"];
				$meta_title = $edit_item['meta_title'];
				$meta_keyword = $edit_item['meta_keyword'];
				$header_title1 = $edit_item['h1_title'];
				$header_title2 = $edit_item['h2_title'];
				$meta_misc = $edit_item["meta_misc"];
				$google = $edit_item["google_analytics"];
				$pNumber = $edit_item["phone_number"];
		}
	 
	 
	
	if(isset($_POST['Update'])){
	
		if(isset($_POST['Update']) && ($_POST['Update'] == "Publish")) {
			if($id = $_REQUEST['page_id']) {
				$parent_id = $_REQUEST['parent_id'];
				$content =  $_REQUEST['content'];
				$meta_name = $_REQUEST['meta_name'];
				$meta_content = $_REQUEST['meta_content'];
				$page_name = $_REQUEST['page_name'];
				$meta_title = $_REQUEST['meta_title'];
				$meta_keyword = $_REQUEST['meta_keyword'];
				$header_title1 = $_REQUEST['header_title1'];
				$header_title2 = $_REQUEST['header_title2'];
				$meta_misc = $_REQUEST['meta_misc'];
				$google = $_REQUEST['googleCode'];
				$phoneNumber = $_REQUEST['phoneNumber'];
				$page_id = $_REQUEST['page_id'];
				
				
				
		
				 $query = "update `menu_page_tbl` set `real_description` ='".($content)."',
												`img_description` ='".($content)."',
												`meta_name` =  '".($meta_name)."',
												 `meta_content` =  '".($meta_content)."',
												 `file_name` = '".($page_name)."',
												 `meta_title` ='".($meta_title)."',
												  `meta_keyword` ='".($meta_keyword)."',
												 `h1_title` ='".($header_title1)."',
												 `h2_title` ='".($header_title2)."',
												 `is_show` ='1',
												  `meta_misc` ='".($meta_misc)."',
												  `google_analytics` ='".($google)."',
												  `phone_number` ='".($phoneNumber)."'
												 where `id` = '".($id)."'";
												 
				if(mysql_query($query)) {
					if(isset($_REQUEST['parent_id'])) {
						header("location:sub_menus.php?parent_id=".$_REQUEST['parent_id']."&msg=3");
					} else {
						if($_REQUEST['action'] == "edit_page_contents") {
						
							header("location:landingpage_index.php?msg=3");
						} else {
						
							header("location:landingpage_index.php?msg=3");
						}
					}	
				}
			}
		}
		
		if(isset($_POST['Update']) && ($_POST['Update'] == "Update")) {
			if($id = $_REQUEST['page_id']) {
				$parent_id = $_REQUEST['parent_id'];
				$content =  $_REQUEST['content'];
				$meta_name = $_REQUEST['meta_name'];
				$meta_content = $_REQUEST['meta_content'];
				$page_name = $_REQUEST['page_name'];
				$meta_title = $_REQUEST['meta_title'];
				$meta_keyword = $_REQUEST['meta_keyword'];
				$header_title1 = $_REQUEST['header_title1'];
				$header_title2 = $_REQUEST['header_title2'];
				$meta_misc = $_REQUEST['meta_misc'];
				$google = $_REQUEST['googleCode'];
				$phoneNumber = $_REQUEST['phoneNumber'];
				$page_id = $_REQUEST['page_id'];
				
				
				
		
				$query = "update `menu_page_tbl` set `img_description` ='".($content)."',
												`meta_name` =  '".($meta_name)."',
												 `meta_content` =  '".($meta_content)."',
												 `file_name` = '".($page_name)."',
												 `meta_title` ='".($meta_title)."',
												  `meta_keyword` ='".($meta_keyword)."',
												 `h1_title` ='".($header_title1)."',
												 `h2_title` ='".($header_title2)."',
												 `is_show` ='0',
												  `meta_misc` ='".($meta_misc)."',
												  `google_analytics` ='".($google)."',
												  `phone_number` ='".($phoneNumber)."'
												 where `id` = '".($id)."'";
												 
				if(mysql_query($query)) {
					if(isset($_REQUEST['parent_id'])) {
						header("location:sub_menus.php?parent_id=".$_REQUEST['parent_id']."&msg=3");
					} else {
						
						if($_REQUEST['action'] == "edit_page_contents") {
						
							header("location:landingpage_index.php?msg=3");
						} else {
						
							header("location:landingpage_index.php?msg=3");
						}
						
					}	
				}
			}
		}
	}
	
	if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
	{
		header("location: landingpage_index.php");
	}
			
}




?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" enctype="multipart/form-data">
<input type="hidden" value="<?=$content_id?>" id="sub_catid" />
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
      <?php echo $obj->error_msg;?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Link Names</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="17%" align="right" valign="top" id="title_name"><span class="font">&nbsp;Meta-Title</span>:</td>
        <td width="83%" align="left"><textarea name="meta_title" cols="145" rows="2" id="meta_title" class="login-textarea2"><?=$meta_title?>
        </textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name"><span class="font">&nbsp;Meta-Description</span>:</td>
        <td align="left"><textarea name="meta_content" cols="145" rows="3" id="meta_content" class="login-textarea2"><?=$meta_content?>
        </textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">&nbsp;Meta-Keyword:</span></td>
        <td align=""><textarea name="meta_keyword" cols="145" rows="8" id="meta_keyword" class="login-textarea2"><?=$meta_keyword?>
        </textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">H1:</span></td>
        <td align=""><input name="header_title1" type="text" id="header_title1" value="<?=$header_title1?>" class="login-textarea1" size="135"></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">H2:</span></td>
        <td align=""><input name="header_title2" type="text" id="header_title2" value="<?=$header_title2?>" class="login-textarea1" size="135" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">&nbsp;Meta-Misc:</span></td>
        <td align=""><textarea name="meta_misc"  cols="145" rows="8" id="meta_misc" class="login-textarea2"><?=$meta_misc?>
        </textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">Google Code:</td>
        <td align=""><textarea name="googleCode"  cols="145" rows="8" id="googleCode" class="login-textarea2"><?=$google?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">Phone Number:</td>
        <td align=""><input name="phoneNumber" type="text" id="phoneNumber" value="<?=$pNumber?>" size="135" class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">&nbsp;Page Name:</span></td>
        <td align=""><input name="page_name" type="text" id="page_name" value="<?=$page_name?>" size="135" class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">&nbsp;Navigation Contents:</span></td>
        <td align=""><a href="javascript:void(0)" onClick="window.open('navi_each_page.php?page_id=<?=$_REQUEST['page_id']?>',
'mywindow','width=550,height=410,top=200,left=300,scrollbars=yes'); ">Sidebar Links</a></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">&nbsp;Images & Videos:</span></td>
        <td align=""><a href="javascript:void(0)" onClick="window.open('img_upload.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=750,height=400,top=200,left=300,scrollbars=yes'); ">Upload Images</a>
            <div id="mainbody" style="display:none; margin-top:10px;" >
              <div id="upload" ><span>Upload File<span></div>
              <span id="status" ></span>
              <ul id="files" >
              </ul>
            </div>      &nbsp;| &nbsp;<a href="javascript:void(0)" onClick="window.open('video_upload.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=700,height=400,top=200,left=300,scrollbars=yes'); ">Upload Videos</a>
            <div id="mainbody" style="display:none; margin-top:10px;" >
              <div id="upload" ><span>Upload File<span></div>
              <span id="status" ></span>
              <ul id="files" >
              </ul>
            </div></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">Content:</span></td>
        <td align=""><textarea name="content" class="login-textarea1"><?=$content?></textarea>
<script type="text/javascript">
    CKEDITOR.replace('content');
 </script></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		 <?php if(isset($_SESSION['sadmin'])) {?> 
		 <input type="submit" name="Update" value="Publish" class="addmenu2" />
		
		 <?php } else {?>
		  <input type="submit" name="Update" value="Update" class="addmenu2" />
		 
		 <?php } ?>
		 &nbsp;&nbsp;&nbsp;
		  <?php if(isset($_REQUEST['parent_id'])) { ?>
		  <input type="submit" name="Cancel" value="Cancel" class="addmenu2" />
		   <?php } else {?>
		   <input type="submit" name="Cancel" value="Cancel" class="addmenu2" /> 		   
		   <?php } ?>        </td>
        </tr>
		<tr>
        <td align="right">&nbsp;</td>
		<td align="left"> <a href="javascript:void(0)" onclick="window.open('original_content.php?id=<?=$id?>&url=<?=$uri?>',
'mywindow','width=650,height=400,top=200,left=300,scrollbars=yes'); ">view last published</a></td>
        <td >&nbsp;</td>
		</tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td valign="top" class="welcome-admin" id="title_name"><?php echo $obj->error_msg;?></td>
      </tr>
    </table></td>
  </tr>
</table><br>

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
