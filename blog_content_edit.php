<?php
//include("smarty_config.php");
require("code.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
		
		$uri = urlencode($_SERVER['REQUEST_URI']);
		
	   $page_id = $_REQUEST['page_id'];
	   $parent_id = $_REQUEST['parent_id'];
	   $edit_query = "select * from `blog_tbl` where `id` ='$page_id'";
	   $edit_query_result = mysql_query($edit_query);
	   $num_rows = mysql_num_rows($edit_query_result);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
	   
				$id = $edit_item["id"];
			    $page_name = $edit_item["file_name"];
				$title = $edit_item["title"];
				$img_description = $edit_item["img_description"];
				$real_description = $edit_item["real_description"];
				$meta_name = $edit_item["meta_name"];
				$meta_content = $edit_item["meta_content"];
				$meta_title = $edit_item['meta_title'];
				$meta_keyword = $edit_item['meta_keyword'];
				$header_title1 = $edit_item['h1_title'];
				$header_title2 = $edit_item['h2_title'];
				$meta_misc = $edit_item["meta_misc"];
				$reqQuo = $edit_item["req_quo"];
				$image = $edit_item["image"];
				$img_alt = $edit_item["img_alt"];
				$parent_id=$edit_item["parent_id"];
			 	$is_menu=$edit_item["is_menu"];
				$iconimg=$edit_item["iconimg"];
				$is_restaurant=$edit_item["is_restaurant"];
				
				
				$split_uri_html=explode('.',$page_name);
	            $count_html=count($split_uri_html)-1;
		        $page_name_html=$split_uri_html[$count_html];
				
				
				 $split_uri_folder=explode('/',$page_name);
	             $count_folder=count($split_uri_folder)-2;
		         $page_name_folder=$split_uri_folder[$count_folder];
			 
			  
			  
			  
			  //Main page -	

	$fullPath = 'http://www.desss.com/';
	//$fullPath = 'http://192.168.1.132/sabari/desss_HTML5/';
	
    $query = "select * from blog_tbl where parent_id='$id' order by order_id asc";
    $menu_desc="";
	$exQuery = mysql_query($query);
	$count_menu0= mysql_num_rows($exQuery);
	$i=1;
	while($row = mysql_fetch_array($exQuery))
	{	
	if($i%4==0)
	{
    $class="";
	}
	else 
	{
	$class="MR12";
	}
		            
	             $nme1=$row['file_name'];
	              $split_uri_folder1=explode('/',$nme1);
	                $count_folder1=count($split_uri_folder1)-2;
		             $page_name_folder1=$split_uri_folder[$count_folder1];
				
	$img=$row["image"];
	
    if(!($page_name_folder1==""))
	{	
	$menu_desc.='<li class="'.$class.'">';   
	if($img=="")
	{
	$menu_desc.='<img src="'.$fullPath.'images/sub_page_content_image1.jpg" class="margin_1" width="200" height="92" alt="DESSS" title="DESSS" />';
	}
	else
	{
	$menu_desc.='<img src="'.$fullPath.'uplodeImage/thumbImg/'.$img.'" class="margin_1"  width="200" height="92" alt="'.$img_alt.'" title="'.$img_alt.'" />';
	}
	$menu_desc.='<p class="head4 PT6">'.$row['title'].'</p>';
	$menu_desc.= strip_tags(substr($row['real_description'],0,222));    
	$menu_desc.="...";
	$menu_desc.='<a href="'.$fullPath.''.$row['file_name'].'" class="read_more_bt fright"></a><div class="spacer"></div></li>';
	}
	else
	{
	$menu_desc.='<li class="'.$class.'">';
	if($img=="")
	{
	$menu_desc.='<img src="'.$fullPath.'images/sub_page_content_image1.jpg" class="margin_1" width="200" height="92" alt="DESSS" title="DESSS" >';
	}
	else
	{
	$menu_desc.='<img src="'.$fullPath.'uplodeImage/thumbImg/'.$img.'" class="margin_1"  width="200" height="92" alt="'.$img_alt.'" title="'.$img_alt.'" />';
	}
	$menu_desc.='<p class="head4 PT6">'.$row['title'].'</p>';
	$menu_desc.= strip_tags(substr($row['real_description'],0,222));    
	$menu_desc.="...";
	$menu_desc.='<a href="'.$fullPath.''.$row['file_name'].'" class="read_more_bt fright"></a><div class="spacer"></div></li>';
	}
	$i++;
	}
			  
	//menu 2	

	$fullPath = 'http://www.desss.com/';
//$fullPath = 'http://192.168.1.132/sabari/desss_HTML5/';
$query1 = "select * from blog_tbl where parent_id='$id' order by order_id asc";
$menu_desc1="";
$exQuery1 = mysql_query($query1);
$count_menu= mysql_num_rows($exQuery1);
$i=1;
while($row1 = mysql_fetch_array($exQuery1))
{	
                 
                 $nme2=$row1['file_name'];
	             $split_uri_folder2=explode('/',$nme2);
	             $count_folder2=count($split_uri_folder2)-2;
		         $page_name_folder2=$split_uri_folder[$count_folder2];
	
	$img1=$row1["image"];
    if(!($page_name_folder2==""))
	{	
$menu_desc1.='<li>';
if($img1=="")
	{
$menu_desc1.='<img src="'.$fullPath.'images/sub_pages2_image1.png" class="ffleft MT10 ML10 MB10" width="124" height="127" alt="DESSS" title="DESSS" />';
}
else
{
$menu_desc1.='<img src="'.$fullPath.'uplodeImage/thumbImg/'.$img1.'" class="ffleft MT10 ML10 MB10" width="124" height="127" alt="'.$img_alt.'" title="'.$img_alt.'" />';
}
$menu_desc1.='<div class="fleft div_sub_page ML10">
<p class="head3 PT10">'.$row1['title'].'</p><p class="PT6">';
$menu_desc1.= strip_tags(substr($row1['real_description'],0,300));    
$menu_desc1.="...</p>";
$menu_desc1.='<a href="'.$fullPath.''.$row1['file_name'].'" class="read_more_bt fright"></a><div class="spacer"></div></div>
<div class="spacer"></div></li>';
}
else
{
$menu_desc1.=' <li>';
if($img1=="")
	{
$menu_desc1.='<img src="'.$fullPath.'images/sub_pages2_image1.png" class="ffleft MT10 ML10 MB10" width="124" height="127" alt="DESSS" title="DESSS" />';
}
else
{
$menu_desc1.='<img src="'.$fullPath.'uplodeImage/thumbImg/'.$img1.'" class="ffleft MT10 ML10 MB10" width="124" height="127" alt="'.$img_alt.'" title="'.$img_alt.'" />';
}
$menu_desc1.='<div class="fleft div_sub_page ML10">
<p class="head3 PT10">'.$row1['title'].'</p><p class="PT6">';
$menu_desc1.= strip_tags(substr($row1['real_description'],0,300));    
$menu_desc1.="...</p>";
$menu_desc1.='<a href="'.$fullPath.''.$row1['file_name'].'" class="read_more_bt fright"></a><div class="spacer"></div></div>
<div class="spacer"></div></li>';
}



$i++;
}
}
	 
if(isset($_POST['Close'])){	 
header("location:blog.php");
}

	
	if(isset($_POST['Update'])){
	
		if(isset($_POST['Update']) && ($_POST['Update'] == "Publish")) {
			if($id = $_REQUEST['page_id']) {
			$people=$_REQUEST['page_name'];
				$parent_id = $_REQUEST['parent_id'];
				$content =  $_REQUEST['content'];
				$meta_name = $_REQUEST['meta_name'];
				$meta_content = $_REQUEST['meta_content'];
				$page_name = $_REQUEST['page_name'];
				$meta_title = $_REQUEST['meta_title'];
				$meta_keyword = $_REQUEST['meta_keyword'];
				$is_restaurant = $_REQUEST['is_restaurant'];
				$real_description = $_REQUEST['real_description'];
				$img_description = $_REQUEST['img_description'];
				$header_title1 = $_REQUEST['header_title1'];
				$header_title2 = $_REQUEST['header_title2'];
				$meta_misc = $_REQUEST['meta_misc'];
				$page_id = $_REQUEST['page_id'];
				//$reqQuo = $_REQUEST['reqQuo'];
				$img_alt = $_REQUEST['img_alt'];
				$img_type='Thumb Image';
	     		$eventimage        =    $_FILES["upload_file"]["name"];
				$iconimg_view		   =    $_FILES["iconimg"]["name"];
				
if($eventimage!="")

{
   $eventimageTmp     =  $_FILES["upload_file"]["tmp_name"];
   $file1Path         = "../uplodeImage/thumbImg/";
  $banPathNme       =   $file1Path.$eventimage;
   move_uploaded_file($eventimageTmp,$banPathNme);
 }
   else
   {
  $eventimage=$image;
   }
   
   if($iconimg_view!="")

{
   $iconimg_viewtemp     =  $_FILES["iconimg"]["tmp_name"];
   $file1Pathicon        = "../uplodeImage/iconimg/";
  $banPathNmeicon       =   $file1Pathicon.$iconimg_view;
   move_uploaded_file($iconimg_viewtemp,$banPathNmeicon);
 }
   else
   {
  $iconimg_view=$iconimg;
   }
   
   
   
   
   
				
				if($_REQUEST['reqQuo'] == '')
				{
					$reqQuo = 'contact-us.html';
				}
				else
				{
					$reqQuo = $_REQUEST['reqQuo'];
				}
				
		
			 	$query = "update `blog_tbl` set `real_description` ='".($real_description)."',
												`img_description` ='".($img_description)."',
												`meta_name` =  '".($meta_name)."',
												 `meta_content` =  '".($meta_content)."',
												  `is_restaurant` ='".($is_restaurant)."',
												 `file_name` = '".($page_name)."',
												 `meta_title` ='".($meta_title)."',
												  `meta_keyword` ='".($meta_keyword)."',
												 `h1_title` ='".($header_title1)."',
												 `h2_title` ='".($header_title2)."',
												 `image` ='".($eventimage)."',
												 `img_alt` ='".($img_alt)."',
												 `is_show` ='1',
												  `iconimg` ='".($iconimg_view)."',
												  `meta_misc` ='".($meta_misc)."',
												  `req_quo` ='".($reqQuo)."'
												 where `id` = '".($id)."'";
												 
			
				
				if(mysql_query($query))
				 {
				
			
             
	

					if(isset($_REQUEST['parent_id'])) {
						header("location:sub_menus.php?parent_id=".$_REQUEST['parent_id']."&msg=3");
					} else {
						if($_REQUEST['action'] == "edit_page_contents") {
						
							header("location:page_index.php?msg=3");
						} else if($_REQUEST['action'] == "edit_blog") {
						
							header("location:blog.php?msg=3");
						}else   {
						
							header("location:main_page.php?msg=3");
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
				$is_restaurant = $_REQUEST['is_restaurant'];
				$real_description = $_REQUEST['real_description'];
				$img_description = $_REQUEST['img_description'];
				$page_name = $_REQUEST['page_name'];
				$meta_title = $_REQUEST['meta_title'];
				$meta_keyword = $_REQUEST['meta_keyword'];
				$header_title1 = $_REQUEST['header_title1'];
				$header_title2 = $_REQUEST['header_title2'];
				$meta_misc = $_REQUEST['meta_misc'];
				$page_id = $_REQUEST['page_id'];
				//$reqQuo = $_REQUEST['reqQuo'];
				if($_REQUEST['reqQuo'] == '')
				{
					$reqQuo = 'contact-us.html';
				}
				else
				{
					$reqQuo = $_REQUEST['reqQuo'];
				}

				
		
				$query = "update `blog_tbl` set `img_description` ='".($img_description)."',
												`meta_name` =  '".($meta_name)."',
												 `meta_content` =  '".($meta_content)."',
												 `file_name` = '".($page_name)."',
												 `meta_title` ='".($meta_title)."',
												  `meta_keyword` ='".($meta_keyword)."',
												   `is_restaurant` ='".($is_restaurant)."',
												  
												 `h1_title` ='".($header_title1)."',
												 `h2_title` ='".($header_title2)."',
												 `is_show` ='0',
												  `meta_misc` ='".($meta_misc)."',
												  `req_quo` ='".($reqQuo)."'
												 where `id` = '".($id)."'";
												 
				if(mysql_query($query)) {
					if(isset($_REQUEST['parent_id'])) {
						header("location:sub_menus.php?parent_id=".$_REQUEST['parent_id']."&msg=3");
					} else {
						
						if($_REQUEST['action'] == "edit_page_contents") {
						
							header("location:page_index.php?msg=3");
						} else if($_REQUEST['action'] == "edit_blog") {
						
							header("location:blog.php?msg=3");
						}
						else {
						
							header("location:main_page.php?msg=3");
						}
						
						
					}	
				}
			}
		}
	}		
}

	function recursive($id,$link)
	{
		//echo $link;
		$qry = "select * from blog_tbl where id=".$id;
		$qry_result = mysql_query($qry);
		$row = mysql_fetch_assoc($qry_result);
		 $title = $row['title'];
		 $par_id = $row['parent_id'];
		
		if($par_id != 0) {
			$link=" >> <a href='sub_menus.php?parent_id=".$id."'>".$title."</a>".$link;
			
			recursive($par_id,$link);
		} else {
			 
			 $link="<a href='main_page.php'>Main Menu</a>"." >> <a href='sub_menus.php?parent_id=".$id."'>".$title."</a>".$link;
			
			
		}
		
		
	}



?>
<?php include ('common/header.php')?>
<script lang='javascript'>               
   function showbox_content()
   {
      if(document.content_add.is_restaurant.checked)
      {
         document.getElementById("mydiv_content").style.display='none';
		 document.getElementById("mydiv_content1").style.display='inline';
		 
		 return false;
      }
      else
      {
         document.getElementById("mydiv_content").style.display='inline';
		  document.getElementById("mydiv_content1").style.display='none';
		 
return false;
      }
return true;
   }
   

</script>

<form name="content_add" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" value="<?=$content_id?>" id="sub_catid" />
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
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000"> <?php echo $obj->error_msg;?> </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" align="left" valign="middle" class="content1"><?php recursive($parent_id,""); ?></td>
              </tr>
              <tr>
                <td width="20%" align="left" valign="middle">&nbsp;</td><?php if($_REQUEST['action'] != "edit_blog") {
					?>	
                <td width="55%" align="center" valign="middle"><strong><font color="#8ABD0E"> Is Restaurant Page :
                  <input  type="checkbox" name="is_restaurant" value="Yes" id="is_restaurant"   <?php if($is_restaurant== "Yes") echo 'checked="checked"';?> onchange='return showbox_content()'  >
                  </font></strong></td>
                  <?php } ?>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="content"><br>
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top">Content Editor</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="21%" align="right" valign="top" id="title_name"><span class="font">&nbsp;Meta-Title</span>:</td>
                      <td width="78%" align="left"><textarea name="meta_title" cols="145" rows="2" id="meta_title"  class="login-textarea2"><?=$meta_title?>
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
                      <td align=""><textarea name="meta_misc" cols="145" rows="8" id="meta_misc" class="login-textarea2"><?=$meta_misc?>
        </textarea></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top"><span class="font">&nbsp;Page Name:</span></td>
                      <td align=""><input name="page_name" type="text" id="page_name" value="<?=$page_name?>" size="135" class="login-texbox1"/></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <div  id="mydiv_content" <?php if($is_restaurant=="No" || $is_restaurant=="" )
			
			
			echo "style='display:inline'";
		 else
			echo "style='display:none'";
			 ?>>
              <table width="98%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                      <!--<tr>
                        <td  width="21%"  align="right" valign="top"><span class="font">&nbsp;Request a Quote:</span></td>
                        <?php 
		$QuoteQuery = 'select * from request_list_tbl order by quote_name asc';
		$ExecQuery = mysql_query($QuoteQuery);
		if(mysql_num_rows($ExecQuery) > 0)
		{
		$QuoteDropDown = '<select name="reqQuo" id="reqQuo">';
		while($ResultSet = mysql_fetch_array($ExecQuery))
		{
			if($ResultSet['quote_url'] == $reqQuo)
			{
			$QuoteDropDown .= '<option selected="selected" value="'.$ResultSet['quote_url'].'">'.$ResultSet['quote_name'].'</option>';
			}
			else
			{
			$QuoteDropDown .= '<option value="'.$ResultSet['quote_url'].'">'.$ResultSet['quote_name'].'</option>';
			}
		
		
		}
		$QuoteDropDown .= '</select>';
		
		}
		
		?>
                        <td width="78%" align=""><?php echo $QuoteDropDown;?>
                          <!--<input name="reqQuo" type="text" id="reqQuo" value="<?=$reqQuo?>" size="135" class="login-texbox1"/>
                        </td>
                      </tr>-->
                      <tr>
                        <td align="right" valign="top"><span class="font">&nbsp;Navigation Contents:</span></td>
                        <td align=""><a href="javascript:void(0)" onClick="window.open('navi_each_page.php?page_id=<?=$_REQUEST['page_id']?>',
'mywindow','width=550,height=410,top=200,left=300,scrollbars=yes'); ">Sidebar Links</a> &nbsp;| &nbsp;<a href="javascript:void(0)" onClick="window.open('view_info.php?page_id=<?=$_REQUEST['page_id']?>',
'mywindow','width=850,height=410,top=200,left=300,scrollbars=yes'); ">Add Info</a></td>
                      </tr>
                      <!--<tr>
                        <td align="right" valign="top"><span class="font">&nbsp;Template Selection:</span></td>
                        <td align=""><a href="javascript:void(0)" onClick="window.open('sub_page_banner.php?page_id=<?=$_REQUEST['page_id']?>',
'mywindow','width=550,height=410,top=200,left=300,scrollbars=yes'); ">Page Banner</a></td>
                      </tr>-->
                      <tr>
                        <td align="right" valign="middle"><span class="font">&nbsp;Images & Videos:</span></td>
                        <td align="left" valign="top"><input type="file" name="upload_file"  class="login-textarea1" size="30"/>
                          <!--<a href="javascript:void(0)" onClick="window.open('img_upload.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=750,height=400,top=200,left=300,scrollbars=yes'); ">Upload Images</a>-->
                          <!-- <div id="mainbody" style="display:none; margin-top:10px;" >
                          <div id="upload" ><span>Upload File</span></div>
                          <span id="status" ></span>
                          <ul id="files" >
                          </ul>
                        </div>&nbsp;| &nbsp;<a href="javascript:void(0)" onClick="window.open('video_upload.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=700,height=400,top=200,left=300,scrollbars=yes'); ">Upload Videos</a>
                        <div id="mainbody" style="display:none; margin-top:10px;" >
                          <div id="upload" ><span>Upload File</span></div>
                          <span id="status" ></span>
                          <ul id="files" >
                          </ul>
                        </div>--></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td><?php if($image!=""){?>
                          <img src="../uplodeImage/thumbImg/<?=$image?>" width="115" height="115" />
                          <?php }?>
                        </td>
                      </tr>
                      <?php /*?><tr>
                        <td align="right" valign="middle"><span class="font">Icon Image:</span></td>
                        <td align="left" valign="top"><input type="file" name="iconimg"  class="login-textarea1" size="30"/>
                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle"></td>
                        <td><?php if($iconimg!=""){?>
                          <img src="../uplodeImage/iconimg/<?=$iconimg?>" width="115" height="115" />
                          <?php }?>
                                          </td>
                      </tr><?php */?>
                      <tr>
                        <td align="right" valign="top"><span class="font">Image Alt:</span></td>
                        <td><input type="text" name="img_alt" id="img_alt" class="login-textarea1" size="78" value="<?=$img_alt?>"/></td>
                      </tr>
                       <tr>
        <td width="210" align="right" valign="top" id="title_name">Short Description:</td>
        <td width="482" align="left">
        
        <textarea cols="50" class="login-textarea1" name="img_description" id="img_description" style="width: 408px; height: 164px;"><?=$img_description?></textarea>
        
        </td>
      </tr>
                      <tr>
                        <td align="right" valign="top"><span class="font">Content:</span></td>
                        <td align=""></td>
                      </tr>
                      <tr>
                        <td colspan="2" valign="top"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td align="center"><textarea name="real_description" id="real_description" class="login-textarea1" cols="190"><?=$real_description?>
</textarea>
                                <script type="text/javascript">
    CKEDITOR.replace('real_description');
 </script></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </div>
            <div  id="mydiv_content1" <?php if($is_restaurant=="Yes")
			
			
			echo "style='display:inline'";
		 else
			echo "style='display:none'";
			 ?>>
              <table width="98%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                      <tr>
                        <td align="right" valign="top" id="title_name"><span class="font">&nbsp;Add Banner</span>:</td>
                        <td align="left"><a href="javascript:void(0)" onClick="window.open('restaurant_banner.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=700,height=400,top=200,left=300,scrollbars=yes'); ">Add Banner</a></td>
                      </tr>
                      <tr>
                        <td width="21%" align="right" valign="top" id="title_name"><span class="font">&nbsp;Everything You Need</span>:</td>
                        <td width="78%" align="left"><a href="javascript:void(0)" onClick="window.open('needs.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=700,height=400,top=200,left=300,scrollbars=yes'); ">Add Content</a></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><span class="font">&nbsp;Our Work:</span></td>
                        <td align=""><a href="javascript:void(0)" onClick="window.open('ourworks.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=700,height=400,top=200,left=300,scrollbars=yes'); ">Add Our Work</a></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><span class="font">Add Features Anytime:</span></td>
                        <td align=""><a href="javascript:void(0)" onClick="window.open('features.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=700,height=400,top=200,left=300,scrollbars=yes'); ">Add Features</a></td>
                      </tr>
                      <tr>
                        <td align="right" valign="top"><span class="font">Testimonials:</span></td>
                        <td align=""><a href="javascript:void(0)" onClick="window.open('testimonials_list.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=700,height=400,top=200,left=300,scrollbars=yes'); ">Add Testmonials</a></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </div>
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><?php if(isset($_SESSION['sadmin'])) {?>
                        <input type="submit" name="Update" value="Publish" class="addmenu2" />
                        <?php } else {?>
                        <input type="submit" name="Update" value="Update" class="addmenu2" />
                        <?php } ?>
                        &nbsp;&nbsp;&nbsp;
                        <?php if(isset($_REQUEST['parent_id'])) { ?>
                        <input type="button" name="Cancel2" value="Cancel" class="addmenu2"  <?=$_REQUEST['parent_id']?>/>
                        <?php } else {?>
                       <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" />
                        <?php } ?>                      </td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td align="left"><a href="javascript:void(0)" onClick="window.open('original_content.php?id=<?=$id?>&url=<?=$uri?>',
'mywindow','width=650,height=400,top=200,left=300,scrollbars=yes'); ">view last published</a></td>
                      <td width="1%" >&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td valign="top" class="welcome-admin" id="title_name"><?php echo $obj->error_msg;?></td>
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
</body></html>