<?php
include("smarty_config.php");

//$fullpath="http://www.socialevening.com/";
//$fullpath="http://192.168.1.233:230/socialevening_new/";
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
			$msg = "Deleted Sucessfully";
		}
		
		
if(isset($_POST['Update']) && $_POST['Update'] == 'Update')
		{
		
			$del_pro=$_POST['up_eve_gal'];	
			$title=addslashes($_POST['title']);	
					
			  $update_qry1 =   "update `home_page_banner` set h1_title ='$title' where image_id = $del_pro";
			$exupdate1 = mysql_query($update_qry1);
			$msg = "Updated Sucessfully";
		}





if(isset($_FILES['files'])){
    $errors= array();
	
   $groupid = $_REQUEST['groups'];
   $eventid = $_REQUEST['events'];
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
		 echo  $query = 'INSERT INTO  home_page_banner	SET	company_admin		= \''.$company_admin.'\',
		  							image_type	= \'banner\',
									Posted_Date = "now()",
									image_name	= \''.$file_name.'\''; 
			
        exit;
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
		header('location:add_banner_image.php?msg=2');		
	}
}


$editImg = "SELECT * FROM  home_page_banner WHERE company_admin=$company_admin ";
$exViewQuery = mysql_query($editImg);
$num = mysql_num_rows($exViewQuery);

?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Multiple - Image Upload</title>
<link rel="stylesheet" type="text/css" href="<?=$fullpath?>css/styles.css" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.min.js"></script>
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
	margin: 0;
	padding: 0;
}
.group_add_officer_main li {
	display: inline-block;
	width: 162px;
}
.group_officer {
	height: 190px;
	margin: 10px auto;
	position: relative;
	width: 120px;
}
.group_officer .remove {
	position: absolute;
	right: 8px;
	top: -5px;
}
.group_officer .officer_img {
	height: 125px;
	margin: 10px 0 0;
	width: 118px;
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
</head>
<body>
<!--whole site starts here-->
<div >
  <div id="light" class="white_content"> </div>
  <div class="r-content"> <br />
    <div style="min-height:350px;"> <font color="#FF0000" style="font-family:Verdana; font-size:12px; font-weight:bold"> </font>
      <div  style="margin:2% 44%">
        <form action="add_banner_image.php" method="POST" name="eve_upload_new" id="eve_upload_new" enctype="multipart/form-data">
          <input type="file" name="files[]" multiple/>
          <input type="button"  id="addimg" name="Add Photos" value="Add Photos"/>
        </form>
      </div>
      <br />
      <?php if($num != 0)
{
?>
      <form id="form_eve_gal" name="form_eve_gal" method="post" action="add_banner_image.php">
        <div id="request_met_eve"></div>
        <h2 class="welcome-admin">Image's List</h2>
        <div class="content">
          <ul class="group_add_officer_main">
            <?php 	while ($row = mysql_fetch_array($exViewQuery))
	{  
	
if($row['h1_title']!="")
						{

$name_val1='<span class="name_cls"  >'. $row['h1_title'].' </span>';
}
else {
$name_val1='<span class="sel_name_cls">Add Image Title</span>';  

}	
	if($row['image_name']!="")
{
$mage_default1= "<img src='".$fullpath.$path.$row['image_name']."'  class='officer_img' alt='' title=''>";

}
else
{
$mage_default1= "<img src='".$fullpath."images/noimg.jpg' class='officer_img' alt='' title=''>";
}
	   ?>
            <li>
              <div class="group_officer"> <a style="text-decoration:none;cursor:pointer" class="remove" onClick="return on_confirm_delete_eve_gal('<?=$row['image_id']?>')"> <img src="<?=$fullpath?>images/group_remove.png" alt="Remove" /></a>
                <?=$mage_default1?>
                <p><a style="text-decoration:none;cursor:pointer" onClick="return on_confirm_updatetitle_eve_gal('<?=$row['image_id']?>')"> <img class="penclass" src="<?=$fullpath?>images/group_pen.jpg" alt="" /> </a><span >&nbsp;&nbsp;&nbsp;&nbsp;
                  <?=$name_val1?>
                  </span> <br />
                </p>
                <div class="group_social"> </div>
              </div>
            </li>
            <?php } ?>
          </ul>
        </div>
      </form>
      <?php } ?>
    </div>
    <br />
  </div>
  <br />
</div>
</div>
</body>
</html>