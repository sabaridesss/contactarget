<?php 
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{



$_SESSION['camp_id'] =  $_REQUEST['camp_id'];
$_SESSION['tid']=  $_REQUEST['id'];

   $query2= "select * from  compaign_name where company_admin='$company_admin' and id=".$_REQUEST['camp_id']." order by id desc";
 
	$query_result = mysql_query($query2);
	$fetch_val=mysql_fetch_array($query_result);
	$count_save_mail=mysql_num_rows($query_result);

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = " Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Sucessfully deleted";	
	}
	
	}

if(isset($_REQUEST['next']))
{

ob_start();
$val_sel			  = "SELECT  * FROM compaign_name where id = ".$_REQUEST["camp_id"];
$query_result_val_sel = mysql_query($val_sel);
$fetch_val_val_sel	  = mysql_fetch_array($query_result_val_sel);
$content_desc 		  = addslashes($fetch_val_val_sel['org_content']);
$camp_id       		  = $fetch_val_val_sel['id'];
$email_subject        = $camp_id."-".preg_replace('/\s+/', '', strtolower($fetch_val_val_sel['email_subject']));
$pdfname              = $camp_id."-".preg_replace('/\s+/', '', strtolower($fetch_val_val_sel['email_subject'])).".doc";

preg_match_all('/<a href="(.*?)"/s',stripslashes($content_desc), $matches);
$org_content 		  = stripslashes($content_desc);
$delete_url 		  = $php_mail->delete_subject_campaign($company_admin,$camp_id); 
$org_content 		  = stripslashes($content_desc);

foreach($matches[1]  as $key => $value)
{
		  $org_url    =  $value;
 		  $crypt_url  =  md5($org_url).time(); 
		 $insert_url  =  $php_mail->click_subject_campaign($company_admin,$org_url,$crypt_url,$camp_id); 
		 $org_content =  str_replace($org_url, $fullpath."click_url_count.php?crypturl=".$crypt_url."&subid=".$camp_id, $org_content);

}

$sqluser = "Update  compaign_name 
 			set	mail_content ='" .addslashes($org_content). "',pdfname     ='" .$pdfname. "'
            WHERE id=".$camp_id;

$comp_impl_query      =  mysql_query($sqluser);







chmod("$pdfname",0777);
$fh = fopen('pdf/' .$pdfname, 'w') or die("can't open file");
fwrite($fh, $org_content);
fclose($fh);







	
if($comp_impl_query)
{
	header("location:preview_blast.php?camp_id=".$camp_id);
}
else{
echo mysql_error();
exit;
}
}	

if(isset($_REQUEST['save']))
{


 $val_sel="SELECT  id,org_content,camp_id FROM compaign_name where id = ".$_REQUEST["camp_id"];
$query_result_val_sel = mysql_query($val_sel);
$fetch_val_val_sel	=mysql_fetch_array($query_result_val_sel);


 $content_desc  =     addslashes($fetch_val_val_sel['org_content']);
 
 $camp_id        =     $fetch_val_val_sel['id'];
preg_match_all('/<a href="(.*?)"/s',stripslashes($content_desc), $matches);
 $org_content = stripslashes($content_desc);
$delete_url = $php_mail->delete_subject_campaign($company_admin,$camp_id); 
$org_content = stripslashes($content_desc);
foreach($matches[1]  as $key => $value)
{
echo $org_url    =  $value;
echo $crypt_url  =  md5($org_url).time(); 

$insert_url =$php_mail->click_subject_campaign($company_admin,$org_url,$crypt_url,$camp_id); 

$org_content = str_replace($org_url, $fullpath."click_url_count.php?crypturl=".$crypt_url."&subid=".$camp_id, $org_content);

}

 echo $sqluser = "Update  compaign_name set
										mail_content ='" .addslashes($org_content). "'
										
										WHERE id=".$camp_id;

    $comp_impl_query      =  mysql_query($sqluser);
if($comp_impl_query)
{
	header("location:savedmail_list.php?msg=2");
}
else{
echo mysql_error();
exit;
}
}	
//http://192.168.1.233:230/eblastnew/
	
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{

$("#banner_custom").click(function(){
on_sub_val();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select.php?banner=banner_custom',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});

$("#banner_full").click(function(){
on_sub_val();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select.php?banner=banner_full',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});


$("#banner_footer").click(function(){
on_sub_val();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select.php?banner=banner_footer',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});


$("#banner_left").click(function(){
on_sub_val();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select.php?banner=banner_left',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});

$("#banner_right").click(function(){
on_sub_val();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select.php?banner=banner_right',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});


$("#template_color").change(function(){

$('.templateHeader').css('background-color','#'+$("#template_color").val());
$('#templateHeader').css('background-color','#'+$("#template_color").val());
$('.templateFooter').css('background-color','#'+$("#template_color").val());
$('#templateFooter').css('background-color','#'+$("#template_color").val());
on_sub_val();

});



});
</script>
<link rel="stylesheet" href="css/tinypopup_style.css" />
<style>
			*{}
ul{list-style:none}
#status-page{margin:0;padding:0;position:relative;top:19px;list-style:none;overflow:hidden}#status-page li:first-child{z-index:10;margin-left:0}
#status-page li:nth-child(2){z-index:9}
#status-page li:nth-child(3){z-index:8}
#status-page li:nth-child(4){z-index:7}
#status-page li:nth-child(5){z-index:6}
#status-page li{display:inline-block;margin-left:-4px;position:relative}
#status-page li a{display:inline-block;position:relative;min-width:110px;height:30px;font-height:15px;padding-left:40px;font-size:15px;padding-right:5px;padding-top:9px;font-weight:500;text-align:center;text-decoration:none;color:#737373;background:#e0e0e0;-webkit-transition:none 0 linear .0001s;-ms-transition:none 0 linear .0001s;transition:none 0 linear .0001s}#status-page li a:before{z-index:-1;content:"";display:block;position:absolute;top:-3px;width:44px;height:44px;background:#e0e0e0;-webkit-border-radius:0 3px;-moz-border-radius:0 3px;border-radius:0 3px;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:rotate(45deg);transform:rotate(45deg);left:auto;right:-16px;border:4px solid #fff;border-bottom:none;border-left:none}
#status-page li a:hover,#status-page li a:hover:before{background:#d8d8d8}
#status-page li.current a,#status-page li.current a:before{background-color:#52bad5;color:#fff}
#status-page li:first-child a{padding-left:10px;-webkit-border-top-left-radius:3px;-webkit-border-bottom-left-radius:3px;-moz-border-radius-topleft:3px;-moz-border-radius-bottomleft:3px;border-top-left-radius:3px;border-bottom-left-radius:3px}
#status-page li:last-child a{padding-right:20px;-webkit-border-top-right-radius:3px;-webkit-border-bottom-right-radius:3px;-moz-border-radius-topright:3px;-moz-border-radius-bottomright:3px;border-top-right-radius:3px;border-bottom-right-radius:3px}
#status-page li:last-child a:before{content:'';display:none}
</style>
<style>
# img:hover {
border:dashed !important;
}
.icon {
	float: right !important;
	margin: 0;
	padding: 200px 0 0;
	position: fixed;
	z-index: 9999;
}
.icon_bg {
	background: none repeat scroll 0 0 #FFFFFF;
	border: 2px solid #000000;
	border-radius: 5px;
	margin: 0;
	padding: 6px 10px;
	width: 29px;
}
.icon_img {
	margin: 0;
	padding: 0;
}
.icon_img ul {
	margin: 0;
	padding: 0;
	width: 33px;
}
.icon_img ul li {
	list-style: none outside none;
	margin: 5px 0;
	padding: 0;
}
</style>
<script type="text/javascript" src="javascript/tinybox.js"></script>
<script type="text/javascript" src="javascript/jscolor.js"></script>
<script type="text/javascript" src="javascript/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "#title",

	  plugins: [
               
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor anchor link"
        ],

    inline: true,
    toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify link   fontselect fontsizeselect",
    menubar: false,
	entity_encoding : "named"
});

tinymce.init({
    selector: "#slogan",
		  plugins: [
               
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor anchor link"
        ],
    inline: true,
    toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify link   fontselect fontsizeselect",
	 menubar: false,
	entity_encoding : "named"
});


tinymce.init({
    selector: "#txtval",
    inline: true,
		  plugins: [
               
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor anchor link"
        ],
    toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify link   fontselect fontsizeselect",
	 menubar: false,
	entity_encoding : "named"
});

tinymce.init({
    selector: "#left_cap",
		  plugins: [
                
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor anchor link"
        ],
    inline: true,
     toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify link   fontselect fontsizeselect",
	 menubar: false,
	entity_encoding : "named"
});

tinymce.init({
    selector: "#right_cap",
	
		  plugins: [
                
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor anchor link"
        ],
    inline: true,
    toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify link   fontselect fontsizeselect",
	 menubar: false,
	entity_encoding : "named"
});

tinymce.init({
    selector: "#copyfoot",
	
		  plugins: [
                
                "table contextmenu directionality emoticons template textcolor paste fullpage textcolor anchor link"
        ],
    inline: true,
    toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify link fontselect fontsizeselect ",
	 menubar: false,
	entity_encoding : "named",
        paste_auto_cleanup_on_paste : true,
        paste_preprocess : function(pl, o) {
            // Content string containing the HTML from the clipboard
            alert(o.content);
            o.content = "-: CLEANED :-\n" + o.content;
        },
        paste_postprocess : function(pl, o) {
            // Content DOM node containing the DOM structure of the clipboard
            alert(o.node.innerHTML);
            o.node.innerHTML = o.node.innerHTML + "\n-: CLEANED :-";
        }
});




</script>
<script type="text/javascript">
function on_sub_val()
{


var pagevalue1 = document.getElementById("myDiv");
var pagevalue  = encodeURIComponent($( "#myDiv" ).html());
$.ajax({
type: "POST",
url: "ajax_auo_save.php",
data: "&uval="+pagevalue,
success: function(html){
//Calling the ajax process php url

//Calling the responce IDs
}
});

}

function saveandcont ()
{

var pagevalue1 = document.getElementById("myDiv");
var pagevalue  = encodeURIComponent($( "#myDiv" ).html());


 var regexp1=new RegExp("(--ClientFirstName--|---ClientAddress--|--YourFirstName--|--YourAddress--|--YourDesignation--|-YourOfficeNumber--|--YourMobileNumber--|--YourEmail--)");
if(regexp1.test(pagevalue))
{
alert("Oops, looks like you missed entering something. Look for words that you are suppose to replace that with your own.");

	return false; 
	 
 }
 else
 {


$.ajax({
type: "POST",
url: "ajax_auo_save.php",
data: "&uval="+pagevalue,
success: function(html){
//Calling the ajax process php url

window.location.replace("<?=$fullpath?>edit_dynamic_template.php?id=<?=$_REQUEST['id']?>&camp_id=<?=$_REQUEST['camp_id']?>&next=next");
//Calling the responce IDs
}
});


}

}


function saveandsave()
{
var pagevalue1 = document.getElementById("myDiv");
var pagevalue  = encodeURIComponent($( "#myDiv" ).html());



$.ajax({
type: "POST",
url: "ajax_auo_save.php",
data: "&uval="+pagevalue,
dataType: "html",
success: function(html){
//Calling the ajax process php url
window.location.replace("<?=$fullpath?>edit_dynamic_template.php?id=<?=$_REQUEST['id']?>&camp_id=<?=$_REQUEST['camp_id']?>&save=save");
//Calling the responce IDs
}
});


}

function onconfirmdel()
{

var r=confirm("You may lose your current changes while changing template.. Continue ? ");
if (r==true)
  {
  return true;
  }
else
  {
   return false;
  } 

}



</script>
<script  type="text/javascript">
function openJS(){alert('loaded')}
function closeJS(){ location.reload()}
</script>

<div class="icon">
  <div class="icon_bg">
    <div class="icon_img">
      <ul>
        <li><a onClick="return onconfirmdel();" href="template_list_dynamic.php?camp_id=<?=$_REQUEST['camp_id']?>"   title="Change Template" ><img src="https://cdn1.iconfinder.com/data/icons/prettyoffice8/32/Arrow-turn-left.png" width="32px" height="32px" alt="Change Template" title="Change Template" /> </a></li>
        <li><a onClick="return saveandsave();" href="javascript:void(0);"  title="Save" ><img src="https://cdn1.iconfinder.com/data/icons/customicondesign-office7-shadow-png/128/Save.png" width="32px" height="32px" alt="Save" title="Save" /></a></li>
        <li><a href="javascript:void(0);" title="Change Template Color" >
          <input type="image" src="https://cdn1.iconfinder.com/data/icons/crystalproject/32x32/apps/colors.png" style="width:32px; height:32px"  value="" class="text_email_blast color" id="template_color" name="template_color" />
          </a></li>
        <li><a onClick="return saveandcont();" href="javascript:void(0);"   title="Save And Send Mail" ><img src="https://cdn1.iconfinder.com/data/icons/iconslandarrow/PNG/32x32/Right3Green.png" width="32px" height="32px" alt="Save And Send Mail" title="Save And Send Mail" /> </a></li>
      </ul>
    </div>
    <br class="spacer">
  </div>
</div>
<br class="spacer">
<article class="content" id="myDiv" style="min-height:500px;" ><center>
  <?php 
		 	if($count_save_mail>0)
			{
			
			
			echo  stripslashes($fetch_val['org_content']);
			
			}
		else {

		  
		   echo "temporarily unavailable";
		  }
          
          
          ?>
  </center>      
</article>
<?php
			$camp_id = $_REQUEST['camp_id'];
			if($camp_id != "")
			{
			?>
<div align="center">
  <ul id="status-page"  class="status-page">
    <li class="step step1 "> <a onClick="return on_sub_val();" href="select_campaign.php?camp_id=<?=$camp_id;?>" class="" id="step1">Campaigns</a> </li>
    <li class="step step2 "> <a onClick="return on_sub_val();" href="select_template.php?camp_id=<?=$camp_id;?>" class="" id="step1">Template Selection</a> </li>
    <?php 
               if($template_type != "")
			   {
             
                  if($template_type == 'static')
				  {
				  ?>
    <li class="step step3 current "><a onClick="return on_sub_val();"  href="edit_dynamic_template.php?camp_id=<?=$camp_id;?>" class="" id="step3">Design</a> </li>
    <?php
				}
				else
				{
			?>
    <li class="step step3  current "><a onClick="return on_sub_val();"  href="dynamic_template.php?camp_id=<?=$camp_id;?>" class="" id="step3">Design</a> </li>
    <?php
			    }
			?>
    <?php
			  } else {  ?>
    <li class="step step3  current "><a onClick="return on_sub_val();" href="javascript:void(0);" class="" id="step3">Design</a> </li>
    <?php  }   if(trim($fetch_val['org_content'])!="") {  ?>
  <li class="step step5  last"> <a onClick="return saveandcont();" class="" style="cursor:pointer;" id="step5">Preview</a> </li>
    <?php } else {  ?>
  <li class="step step5  last"> <a onClick="return saveandcont();" href="javascript:void(0);"  style="cursor:pointer;"  class="" id="step5">Preview</a> </li>
    <?php } ?>
  </ul>
</div>
<?php
			}
			?>
<style>
			*{}
ul{list-style:none}
#status-page{margin:0;padding:0;position:relative;top:19px;list-style:none;overflow:hidden}#status-page li:first-child{z-index:10;margin-left:0}
#status-page li:nth-child(2){z-index:9}
#status-page li:nth-child(3){z-index:8}
#status-page li:nth-child(4){z-index:7}
#status-page li:nth-child(5){z-index:6}
#status-page li{display:inline-block;margin-left:-4px;position:relative}
#status-page li a{display:inline-block;position:relative;min-width:110px;height:30px;font-height:15px;padding-left:40px;font-size:15px;padding-right:5px;padding-top:9px;font-weight:500;text-align:center;text-decoration:none;color:#737373;background:#e0e0e0;-webkit-transition:none 0 linear .0001s;-ms-transition:none 0 linear .0001s;transition:none 0 linear .0001s}#status-page li a:before{z-index:-1;content:"";display:block;position:absolute;top:-3px;width:44px;height:44px;background:#e0e0e0;-webkit-border-radius:0 3px;-moz-border-radius:0 3px;border-radius:0 3px;-webkit-transform:rotate(45deg);-moz-transform:rotate(45deg);-ms-transform:rotate(45deg);-o-transform:rotate(45deg);transform:rotate(45deg);left:auto;right:-16px;border:4px solid #fff;border-bottom:none;border-left:none}
#status-page li a:hover,#status-page li a:hover:before{background:#d8d8d8}
#status-page li.current a,#status-page li.current a:before{background-color:#52bad5;color:#fff}
#status-page li:first-child a{padding-left:10px;-webkit-border-top-left-radius:3px;-webkit-border-bottom-left-radius:3px;-moz-border-radius-topleft:3px;-moz-border-radius-bottomleft:3px;border-top-left-radius:3px;border-bottom-left-radius:3px}
#status-page li:last-child a{padding-right:20px;-webkit-border-top-right-radius:3px;-webkit-border-bottom-right-radius:3px;-moz-border-radius-topright:3px;-moz-border-radius-bottomright:3px;border-top-right-radius:3px;border-bottom-right-radius:3px}
#status-page li:last-child a:before{content:'';display:none}
</style>
<div  style="clear:both;"></div>
<br />
</body></html>

