<?php
include("smarty_config.php");
//include("top_menu.php");
if( !isset($_SESSION['username']) ) 
{
	header("Location:index.php");		
}
 else
  {

  	$msg = "";
if($_REQUEST["msg"] == '2'){
		$msg = '<div class="alert alert-success">

<strong>Success!</strong>
Your Image Saved Successfully.
</div> ';	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg =  '<div class="alert alert-success">

<strong>Success!</strong>
Your Image Updated Successfully.
</div> ';	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = '<div class="alert alert-info">
<button type="button" data-dismiss="alert" class="close"></button>
<strong>Success!</strong>Your
Image Deleted Successfully.
</div>';	
	}
	

	
	$path = "uploads/banner/";

	error_reporting(0);
	
define ("MAX_SIZE","1024");
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
	




		if(isset($_POST['Delete']) && $_POST['Delete'] == 'Delete')
		{
		
			$del_pro=$_POST['del_eve_gal'];
			
			 $update_qry1 =   "delete from `home_page_banner` where image_id = $del_pro";
			$exupdate1 = mysql_query($update_qry1);
			$msg = '<div class="alert alert-info">
<button type="button" data-dismiss="alert" class="close"></button>
<strong>Success!</strong>Your
Image Deleted Successfully.
</div>';	
		}
		
		
if(isset($_POST['Update']) && $_POST['Update'] == 'Update')
		{
		
			$del_pro=$_POST['up_eve_gal'];	
			$title=addslashes($_POST['title']);	
					
			  $update_qry1 =   "update `home_page_banner` set h1_title ='$title' where image_id = $del_pro";
			$exupdate1 = mysql_query($update_qry1);
			$msg =  '<div class="alert alert-success">

<strong>Success!</strong>
Your Image Updated Successfully.
</div> ';
		}





if(isset($_FILES['files'])){
    $errors= array();
	

   $success=0;
   
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];	
$allowedExts = array("gif", "jpeg", "jpg", "png","GIF", "JPEG", "JPG", "PNG");
$temp = explode(".", $_FILES["files"]["name"][$key]);
$extension = end($temp);
if ((($_FILES["files"]["type"][$key] == "image/gif")
|| ($_FILES["files"]["type"][$key] == "image/jpeg")
|| ($_FILES["files"]["type"][$key] == "image/jpg")
|| ($_FILES["files"]["type"][$key] == "image/pjpeg")
|| ($_FILES["files"]["type"][$key] == "image/x-png")
|| ($_FILES["files"]["type"][$key] == "image/png")) && in_array($extension, $allowedExts))
		{
		   $query = 'INSERT INTO  home_page_banner	SET	company_admin		= \''.$company_admin.'\',
		  							image_type	= \'banner\',
									Posted_Date = "now()",
									image_name	= \''.$file_name.'\''; 
			
      
        $desired_dir="uploads/banner/";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp,"$desired_dir/".$file_name);
            }else{									// rename the file if another one exist
                $new_dir="$desired_dir/".$file_name.time();
                 rename($file_tmp,$new_dir) ;				
            }
		$val= mysql_query($query);
	
		 }			
    $success++;      }else{
              //  print_r($errors);
        }
  }
	if(empty($error)){
		header('location:banner_images.php?msg=2');		
	}
}


$editImg = "SELECT * FROM  home_page_banner WHERE company_admin=$company_admin order by image_id desc ";
$exViewQuery = mysql_query($editImg);
$num = mysql_num_rows($exViewQuery);
}	
?>
<?php include ('common/header.php')?>

<script type="text/javascript">
<!--
function getConfirmation(){
   var retVal = confirm("Do you want to Delete ?");
   if( retVal == true ){
     
	  return true;
   }else{
    
	  return false;
   }
}
//-->
</script>
<script  type="text/javascript">
jQuery( document ).ready(function( $ ) {
  // Code using $ as usual goes here.



$('input[type=button]').click(function() {
    $('input[type=file]').trigger('click');
});

  $('input[type=file]').change(function () {
        $( "#eve_upload_new" ).submit();
     });

});



function on_confirm_delete_eve_gal(delid)

{
var x;
var r=confirm("Are You Sure To Delete?");
if (r==true)
  {
document.getElementById("request_met_eve").innerHTML='<input id="del_eve_gal" name="del_eve_gal" readonly value="'+delid+'"   type="hidden"><input id="Delete" name="Delete" readonly  value="Delete"  type="hidden">';
  document.getElementById("form_eve_gal").submit();
  
 return true;
  }
else
  {
  
 return false;
  }

}



function on_confirm_updatetitle_eve_gal(id)
{

var title=prompt('Enter Image Title');

if (title.length>2)
{
 document.getElementById("request_met_eve").innerHTML='<input id="up_eve_gal" name="up_eve_gal" readonly value="'+id+'"   type="hidden"><input id="title" name="title" readonly value="'+title+'"   type="hidden"><input id="Update" name="Update" readonly  value="Update"  type="hidden">';
 document.getElementById("form_eve_gal").submit();
   return true;
}
else
   {
  on_confirm_updatetitle_eve_gal(id)
   
    }
	
}

</script>
<style type="text/css">
.group_add_officer_main li {
	list-style: none outside none;
	margin: 10px 10px;
	padding: 0;
	display: inline-block;
	width: 300px;
	float:left;
}

.group_officer {
	height: 190px;
	margin: 10px auto;
	position: relative;
	width: 300px;
}
.group_officer .remove {
	position: absolute;
	right: 8px;
	top: -5px;
}
.group_officer .officer_img {
	height: 125px;
	margin: 10px 0 0;
	width: 300px;
}
.group_officer p {
	color: #333333;
	font-size: 11px;
	line-height: 18px;
	margin: 6px 0;
	position: relative;
}
/* For Mozilla only: create rounded corners */
#box {
	-moz-border-radius: 10px 10px 10px 10px;
}
/*home page right side here*/
.peoplegetting {
	width:273px;
	margin:0px auto;
	background-color:#e7f3db;
	padding-bottom:1px;
	-moz-border-radius:5px;/*border:#77c224 solid 1px;*/
}
.peoplegetting-all {
	width:273px;
	font-size:11px;
	color:#000000;
	font-family:Arial, Helvetica, sans-serif;
}
.peoplegetting-con {
	width:110px;
	height:55px;
	margin:auto;
	-moz-border-radius:5px;
	border:#c5dcae solid 1px;
	background-color:#ffffff;
	float:left;
	padding:5px;
}
#news-container1 {
	height:156px !important;
}
#news-container1 ul li {
	float:left;
	list-style:none;
	margin:5px !important;
	padding-bottom:-15px;
}
.peoplegetting-con span {
	font-weight:bold;
	color:#0f96e4;
}
.commentbox {
	padding:0px 3px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
}
.so_icon_bo1 {
	float:left;
	width:70px;
	margin-top:5px;
}
.so_icon_bo2 {
	float:left;
	width:160px;
	padding-left:5px;
}
.so_icon_bo3 {
	float:left;
	width:80px;
	padding-left:5px;
}
a {
	text-decoration:none;
}
.peoplegetting-all {
	width:273px;
	font-size:11px;
	color:#000000;
}
.spacer {
	clear:both;
	padding:0px;
	margin:0px auto;
}
.penclass {
	clear:both;
	padding:0px;
	margin:0px auto;
}
.name_cls {
	color: #3399FF;
	font-style: normal !important;
	font-weight: 600;
	position: relative;
	right: inherit;
	top: inherit;
}
.promoter_wap {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	margin: 0 auto;
	padding: 0 15px;
	width: 970px;
}
/*home page right side ends here*/

 .head_title_text {
	color: #FFFFFF;
	display: inline-block;
	font-size: 20px;
	line-height: 24px;
	margin: 15px 0;
	text-align: center;
}
input[type=file] {
	display:block;
	height:0;
	width:0;
}
</style>

<table width="1200px" border="0" cellpadding="0">
<tr>
  <td></td>
</tr>
<tr>
  <td align="center" class="top"><?php include('common/top_menu.php') ?>
    <div class="wholesite-inner"> <div>     <?=$msg?>
           </div>
    <!--welcome admin start here-->
    <div class="welcome-admin">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
      <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      
        </font></strong></td>
      <td width="25%" align="right" valign="middle"></td>
    </tr>
    <tr>
      <td align="left" valign="middle">&nbsp;</td>
      <td colspan="2" align="right" valign="middle"><table width="35%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <!-- <td><div class="addmenu"><a href="video_gallery_view.php">Video Gallery</a></div></td>-->
          <td>
<form action="banner_images.php" method="POST" name="eve_upload_new" id="eve_upload_new" enctype="multipart/form-data">
  <input type="file" name="files[]" multiple/>
  <input type="button" class="btn btn-large btn-primary"  id="addimg" name="Add Photos" value="Add Photos"/>
</form>
</td>
</tr>
</table>
</td>
</tr>
</table>
</div>




<script  src="js/jquery-1.8.3.min.js"></script>
<link href="css/royalslider.css" rel="stylesheet">
<script src="js/jquery.royalslider.mind3fb.js?v=9.3.4"></script>
<link href="css/rs-defaulte166.css?v=1.0.4" rel="stylesheet">
<style>
#gallery-1 {
	width: 100%;
	-webkit-user-select: none;
	-moz-user-select: none;
	user-select: none;
}
.category_gallary {
	background: url("images/sub_page/category_bg.png") repeat-x scroll left top #FD7217;
	width: 200px;
}
.cont_right_gallary {
	width:715px;
}
.accordsuffix {
	display:none;
}
</style>
<script>
      jQuery(document).ready(function($) {
  $('#gallery-1').royalSlider({
    fullscreen: {
      enabled: true,
      nativeFS: false
    },
    controlNavigation: 'thumbnails',
    autoScaleSlider: false, 
    autoScaleSliderWidth:1500,     
    autoScaleSliderHeight: 1500,
    loop: true,
    imageScaleMode: 'fit-if-smaller',
    navigateByClick: true,
    numImagesToPreload:3,
    arrowsNavAutoHide: true,
    arrowsNavHideOnTouch: true,
    keyboardNavEnabled: true,
    fadeinLoadedSlide: true,
    globalCaption: true,
    globalCaptionInside: false,
    thumbs: {
     appendSpan: true,
     firstMargin: true,
     paddingBottom: 4,
	 orientation: 'vertical'

    }
  });
});

    </script>
<div class="content">
    <div id="light" class="white_content"> </div>
    <div class="r-content"> <br />
     <div style="min-height:350px;"> <font color="#FF0000" style="font-family:Verdana; font-size:12px; font-weight:bold"> </font>
        <div  style="margin:2% 44%"> </div>
        <br />
        <?php if($num != 0){?>
        <form id="form_eve_gal" name="form_eve_gal" method="post" action="banner_images.php">
          <div id="request_met_eve"></div>
           <article class="fright cont_right_gallary MT15">
<div>
  <div id="gallery-1" class="royalSlider rsDefault"> 
<?php 	
	while ($row = mysql_fetch_array($exViewQuery)){  
		
	if($row['h1_title']!=""){
		$name_val1= $row['h1_title'];
	}else{
		$name_val1='Add Image Title';  
	}
		
	if($row['image_name']!="")
	{
		$mage_default1= "<img width='120' height='75' class='rsTmb' src='".$fullpath.$path.$row['image_name']."' />";
	}else{
		$mage_default1= "<img width='120' height='75' class='rsTmb' src='".$fullpath."images/noimg.jpg'>";
	}
?>
  <a class="rsImg"  data-rsBigImg="<?=$fullpath.$path.$row['image_name']?>" href="<?=$fullpath.$path.$row['image_name']?>">
  <?=$name_val1?><?=$mage_default1?></a> 

   <?php } ?>
  
  </div>
</div>
</article>
             
              
             
          
        </form>
        <?php } ?>
      </div>
      <br />
    </div>
    <br />
  <div style="clear:both"></div>
</div>





<!--welcome admin end here-->
</div>
<!--footer start here-->
<?php include('common/footer.php'); ?>
<!--footer end here-->
</td>
</tr>
</table>

</div>
</center>
</body></html>