<?php 
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

$_SESSION['pdfid'] =  $_REQUEST['pdfid'];
$_SESSION['tid']=  $_REQUEST['id'];

$sel_q				="SELECT * from  file_attach where id =".$_REQUEST['pdfid']; 
$ex_q				= mysql_query($sel_q);
$get_description	= mysql_fetch_array($ex_q);
$pdfid				= $get_description['id'];
$org_content		= $get_description['org_content'];



if(isset($_REQUEST['save']))
{

$sel_q				= "SELECT * from  file_attach where id =".$_REQUEST['pdfid']; 
$ex_q				= mysql_query($sel_q);
$get_description	= mysql_fetch_array($ex_q);
$pdfid				= $get_description['id'];

$email_subject      = $pdfid."-".preg_replace('/\s+/', '', strtolower($get_description['name_file']));
$pdfname            = $pdfid."-".preg_replace('/\s+/', '', strtolower($get_description['name_file'])).".doc";


$org_content 		= stripslashes($get_description['org_content']);
$sqluser 			= "Update  file_attach set pdf_name      ='" .$pdfname. "' WHERE id=".$pdfid;
$comp_impl_query    =  mysql_query($sqluser);



chmod("$pdfname",0777);
$fh = fopen('pdf/' .$pdfname, 'w') or die("can't open file");
fwrite($fh, $org_content);
fclose($fh);

header("location:preview_pdf.php?pdfid=".$pdfid."&msg=2");

}	
}






//http://192.168.1.233:230/eblastnew/
	
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="http://code.jquery.com/resources/demos/style.css">
<script>

$(document).ready(function()
{

$("#banner_full").click(function(){
saveandsave();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select_pdf.php?banner=banner_full',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});


$("#banner_footer").click(function(){
saveandsave();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select_pdf.php?banner=banner_footer',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});


$("#banner_left").click(function(){
saveandsave();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select_pdf.php?banner=banner_left',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});

$("#banner_right").click(function(){
saveandsave();
TINY.box.show({iframe:'<?=$fullpath?>email_banner_select_pdf.php?banner=banner_right',boxid:'frameless',width:750,height:450,fixed:false,maskid:'bluemask',maskopacity:40,closejs:function(){closeJS()}});
});


$("#template_color").change(function(){

$('.templateHeader').css('background-color','#'+$("#template_color").val());
$('#templateHeader').css('background-color','#'+$("#template_color").val());
$('.templateFooter').css('background-color','#'+$("#template_color").val());
$('#templateFooter').css('background-color','#'+$("#template_color").val());
saveandsave();

});







/*$( "#banner_full" ).mouseover(function() {
$(".hideover").css("display","inline");
});
$( "#banner_full" ).mouseout(function() {
$(".hideover").css("display","none");
});


$( "#banner_left" ).mouseover(function() {
$(".hideoverleft").css("display","inline");
});
$( "#banner_left" ).mouseout(function() {
$(".hideoverleft").css("display","none");
});

$( "#banner_right" ).mouseover(function() {
$(".hideoverright").css("display","inline");
});
$( "#banner_right" ).mouseout(function() {
$(".hideoverright").css("display","none");
});*/

});
</script>
<link rel="stylesheet" href="css/tinypopup_style.css" />
<style>
* {
}
ul {
	list-style:none
}
#status-page {
	margin:0;
	padding:0;
	position:relative;
	top:19px;
	list-style:none;
	overflow:hidden
}
#status-page li:first-child {
	z-index:10;
	margin-left:0
}
#status-page li:nth-child(2) {
z-index:9
}
#status-page li:nth-child(3) {
z-index:8
}
#status-page li:nth-child(4) {
z-index:7
}
#status-page li:nth-child(5) {
z-index:6
}
#status-page li {
	display:inline-block;
	margin-left:-4px;
	position:relative
}
#status-page li a {
	display:inline-block;
	position:relative;
	min-width:110px;
	height:30px;
	font-height:15px;
	padding-left:40px;
	font-size:15px;
	padding-right:5px;
	padding-top:9px;
	font-weight:500;
	text-align:center;
	text-decoration:none;
	color:#737373;
	background:#e0e0e0;
-webkit-transition:none 0 linear .0001s;
-ms-transition:none 0 linear .0001s;
transition:none 0 linear .0001s
}
#status-page li a:before {
	z-index:-1;
	content:"";
	display:block;
	position:absolute;
	top:-3px;
	width:44px;
	height:44px;
	background:#e0e0e0;
	-webkit-border-radius:0 3px;
	-moz-border-radius:0 3px;
	border-radius:0 3px;
	-webkit-transform:rotate(45deg);
	-moz-transform:rotate(45deg);
	-ms-transform:rotate(45deg);
	-o-transform:rotate(45deg);
	transform:rotate(45deg);
	left:auto;
	right:-16px;
	border:4px solid #fff;
	border-bottom:none;
	border-left:none
}
#status-page li a:hover, #status-page li a:hover:before {
	background:#d8d8d8
}
#status-page li.current a, #status-page li.current a:before {
	background-color:#52bad5;
	color:#fff
}
#status-page li:first-child a {
	padding-left:10px;
	-webkit-border-top-left-radius:3px;
	-webkit-border-bottom-left-radius:3px;
	-moz-border-radius-topleft:3px;
	-moz-border-radius-bottomleft:3px;
	border-top-left-radius:3px;
	border-bottom-left-radius:3px
}
#status-page li:last-child a {
	padding-right:20px;
	-webkit-border-top-right-radius:3px;
	-webkit-border-bottom-right-radius:3px;
	-moz-border-radius-topright:3px;
	-moz-border-radius-bottomright:3px;
	border-top-right-radius:3px;
	border-bottom-right-radius:3px
}
#status-page li:last-child a:before {
	content:'';
	display:none
}
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
    toolbar: "undo redo | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify link |  numlist outdent indent |   fontselect fontsizeselect",
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
	entity_encoding : "named"
});




</script>
<script type="text/javascript">




function saveandcont_pdf()
{
var pagevalue1 = document.getElementById("myDiv");
var pagevalue  = encodeURIComponent($( "#myDiv" ).html());


var regexp1=new RegExp("(--ClientFirstName--|---ClientAddress--|--YourFirstName--|--YourAddress--|--YourDesignation--|-YourOfficeNumber--|--YourMobileNumber--|--YourEmail--)");

 /*var regexp1=new RegExp("(--ClientFirstName--|---ClientAddress--|--YourFirstName--|--YourAddress--|--YourDesignation--)");*/
if(regexp1.test(pagevalue))
{
alert("Oops, looks like you missed entering something. Look for words that you are suppose to replace that with your own.");

	return false; 
	 
 }
 else
 {

$.ajax({
type: "POST",
url: "ajax_auo_save_pdf.php",
data: "&uval="+pagevalue+"&pdfid=<?=$_REQUEST['pdfid']?>",
dataType: "html",
success: function(html){
//Calling the ajax process php url
window.location.replace("<?=$fullpath?>edit_dynamic_template_pdf.php?pdfid=<?=$_REQUEST['pdfid']?>&save=save");
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
url: "ajax_auo_save_pdf.php",
data: "&uval="+pagevalue+"&pdfid=<?=$_REQUEST['pdfid']?>",
dataType: "html",
success: function(html){
//Calling the ajax process php url
//window.location.replace("<?=$fullpath?>edit_dynamic_template_pdf.php?pdfid=<?=$_REQUEST['pdfid']?>&save=save");
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




function save_as_pdf_prompt()
{
var pagevalue  = encodeURIComponent($( "#myDiv" ).html());
var title;
title		   = prompt('Enter PDF Title');

if (title!="")
{
$.ajax({
type: "POST",
url: "ajax_auo_save_pdf.php",
data: "&ival="+pagevalue+"&new=new&title="+title,
dataType: "html",
success: function(html){

//alert(html);
//Calling the ajax process php url
window.location.replace(html);
//Calling the responce IDs
}
});

}
else
   {
   alert('Please Enter Valid Title');
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
        <li><a onClick="return onconfirmdel();" href="preview_pdf.php"   title="PDF Home" ><img src="https://cdn1.iconfinder.com/data/icons/prettyoffice8/32/Arrow-turn-left.png" width="32px" height="32px" alt="PDF Home" title="PDF Home" /> </a></li>
        <li><a onClick="return saveandsave();" href="javascript:void(0);"  title="Save" ><img src="https://cdn1.iconfinder.com/data/icons/humano2/32x32/actions/document-save-as.png" width="32px" height="32px" alt="Save" title="Save" /></a></li>
       <!-- <li><a onClick="return save_as_pdf_prompt();" href="javascript:void(0);"  title="Save AS" ><img src="https://cdn1.iconfinder.com/data/icons/humano2/32x32/actions/document-save-as.png" width="32px" height="32px" alt="Save AS" title="Save AS" /></a></li>-->
       <!--  <li><a href="javascript:void(0);" title="Change Template Color" >
          <input type="image" src="https://cdn1.iconfinder.com/data/icons/crystalproject/32x32/apps/colors.png" style="width:32px; height:32px"  value="" class="text_email_blast color" id="template_color" name="template_color" />
          </a></li>-->
        <li><a onClick="return saveandcont_pdf();" href="javascript:void(0);"   title="Save And Generate PDF " ><img src="https://cdn1.iconfinder.com/data/icons/customicondesign-office7-shadow-png/128/Save.png" width="32px" height="32px" alt="Save And Generate PDF " title="Save And Generate PDF " /> </a></li>
      </ul>
    </div>
    <br class="spacer">
  </div>
</div>
<br class="spacer">

<article class="content"  id="myDiv" style="min-height:500px;" ><center>
 <?=$org_content?> </center>
</article>
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
