<?php 

ini_set('max_execution_time', 5000);
	 if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
{
  
    @set_time_limit(5000);
}
ini_set('display_errors',"1");
include("smarty_config.php");
include("phpmailfunction.php");
$php_mail = new phpmail_function();
//include("top_menu.php");

$INCLUDE_DIR = "mailer/";
    require($INCLUDE_DIR . "class.phpmailer.php");
	$mail = new PHPMailer();	
	
	
	if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel' )
{
 $campaignid = $_REQUEST['camp_id'];
$item_save  =  $php_mail->get_blast_templates($campaignid,$company_admin);
//print_r($item_save);
 $mail_template_type        = $item_save['template_type']; 
 $template_id = $item_save['template_id'];
if($mail_template_type == 'dynamic')
{
header("location:dynamic_template.php?camp_id=".$campaignid );
}
else
{

header("location:edit_dynamic_template.php?id=".$template_id."&camp_id=".$campaignid);

}

}


if(isset($_REQUEST['Schedule']) && $_REQUEST['Schedule'] == 'Schedule' )
{
 $campaignid = $_REQUEST['camp_id'];

header("location:schedule_mails.php?camp_id=".$campaignid);

}



$campaignid = $_REQUEST['camp_id'];
$item_save  =  $php_mail->get_blast_templates($campaignid,$company_admin);
$mail_id = $item_save['id'];
 
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Target</title>
<!--<script type="text/javascript" >
$(document).ready(function() {
						   
// Here we will write a function when link click under class popup				   
$('a.popup').click(function() {
									
									
// Here we will describe a variable popupid which gets the
// rel attribute from the clicked link							
var popupid = $(this).attr('rel');


// Now we need to popup the marked which belongs to the rel attribute
// Suppose the rel attribute of click link is popuprel then here in below code
// #popuprel will fadein
$('#' + popupid).fadeIn();


// append div with id fade into the bottom of body tag
// and we allready styled it in our step 2 : CSS
$('body').append('<div id="fade"></div>');
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();


// Now here we need to have our popup box in center of 
// webpage when its fadein. so we add 10px to height and width 
var popuptopmargin = ($('#' + popupid).height() + 10) / 2;
var popupleftmargin = ($('#' + popupid).width() + 10) / 2;


// Then using .css function style our popup box for center allignment
$('#' + popupid).css({
'margin-top' : -popuptopmargin,
'margin-left' : -popupleftmargin
});
});


// Now define one more function which is used to fadeout the 
// fade layer and popup window as soon as we click on fade layer
$('#fade').click(function() {


// Add markup ids of all custom popup box here 						  
$('#fade , #popuprel , #popuprel2 , #popuprel3').fadeOut()
return false;
});
});
</script>-->
<script src="ajax.js"></script>
<style>
/* CSS Document */
#trigger {
	text-align:center;
}
/* Style you custom popupbox according to your requirement */
.popupbox {
	width:500px;
	height:300px;
	background-image:url(/edit_media/2010/201010/20101009/custompopup/images/pop-up_03.png);
	background-repeat:no-repeat;
	display: none; /* Hidden as default */
	float: left;
	position: fixed;
	top: 50%;
	left: 50%;
	z-index: 99999;
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
}
.popupbox2 {
	width:454px;
	height:307px;
	background-image:url(/edit_media/2010/201010/20101009/custompopup/images/pu_03.png);
	background-repeat:no-repeat;
	display: none;
	float: left;
	position: fixed;
	top: 50%;
	left: 50%;
	z-index: 99999;
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
}
.popupbox3 {
	width:502px;
	height:302px;
	background-image:url(/edit_media/2010/201010/20101009/custompopup/images/3_03.png);
	background-repeat:no-repeat;
	display: none;
	float: left;
	position: fixed;
	top: 50%;
	left: 50%;
	z-index: 99999;
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
}
#fade {
	display: none; /* Hidden as default */
	background: #000;
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	opacity: .80;
	z-index: 9999;
}
#intabdiv {
	text-align:center;
}
#close img {
	text-decoration:none;
}
#close {
	width:50px;
	height:50px;
	position: absolute;
	float:right;
}
#intabdiv2 {
	padding:70px;
}
#intabdiv2 h2 {
	font-size:24px;
	color:#696868;
	font-family:Verdana, Geneva, sans-serif;
}
#intabdiv2 p {
	font-size:12px;
	color:#696868;
	font-family:Verdana, Geneva, sans-serif;
	line-height:20px;
}
#intabdiv3 {
	padding:70px;
}
#intabdiv3 h2 {
	font-size:24px;
	color:#fff;
	font-family:Verdana, Geneva, sans-serif;
}
#intabdiv3 p {
	font-size:12px;
	color:#fff;
	font-family:Verdana, Geneva, sans-serif;
	line-height:20px;
}
</style>
<style type="text/css">
.content {
	background:#fff;
	padding:10px;
	margin-top:10px;
	border:1px solid #C0C0C0;
}
.content p {
	font:normal 12px/24px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
}
.content span {
	font:bold 14px/24px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
	display:block;
}
.content ul {
	list-style:circle;
}
.content ul li {
	font:normal 12px/18px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
}
.spacer {
	clear:both;
}
.fleft {
	float:left;
}
.fright {
	float:right;
}
.img_cls {
	width:202px;
	height:91px;
}
.cont_left {
	width:450px;
	background:#F2F2F2;
	border:1px solid #C0C0C0;
	padding:15px;
}
.cont_right {
	width:654px;
}
.container_ner_email_blast {
	width:950px;
	margin:0px auto;
	padding:0px;
}
.cont_left p {
	color: #515151;
	font: 12px/24px Verdana, Geneva, sans-serif;
	margin: 10px 0 0;
	display:inline-block;
	padding-right:15px;
	width:100px;
	text-align:right;
}
.cont_left span {
	color: #515151;
	font: 12px/24px Verdana, Geneva, sans-serif;
	margin: 10px 0 0;
	display:inline-block;
	padding-left:15px;
}
.text_email_blast {
	width:190px;
	height:28px;
	padding:0px 4px;
	color: #515151;
	font: 12px/24px Verdana, Geneva, sans-serif;
	margin-bottom:15px;
	background:#fff;
	border:1px solid #CCC;
}
.tool {
	width:100%;
	margin-top:10px;
	margin-bottom:10px;
}
.tool img {
	max-width:100%;
}
.text_email_blast_check {
	margin-right:15px;
}
</style>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
<style>
.backdrop {
	position:absolute;
	top:0px;
	left:0px;
	width:100%;
	height:100%;
	background:#000;
	opacity:0;
	filter:alpha(opacity=0);
	z-index:50;
	display:none;
}
.box {
	position:absolute;
	top:20%;
	left:46%;
	z-index:9999;
	padding:10px;
	-webkit-border-radius:4px;
	-moz-border-radius:4px;
	border-radius:4px;
	-moz-box-shadow:0px 0px 20px #000;
	-webkit-box-shadow:0px 0px 20px #000;
	display:none;
}
.close {
	float:right;
	margin-right:6px;
	cursor:pointer;
}
</style>
<script type="text/javascript">
$(document).ready(function(){


$(' *').attr('contenteditable','false');


	$('.lightbox').click(function(){
$('.backdrop, .box').animate({'opacity':'.50'}, 300, 'linear');
$('.box').animate({'opacity':'1.00'},300,'linear');
$('.backdrop, .box').css('display','block');
});

$('.close').click(function(){
close_box();

});
});

function close_box()
{
$('.backdrop, .box').animate({'opacity':'0'}, 300, 'linear',function(){
$('.backdrop,.box').css('display','none');
});
}
</script>
<script type="text/javascript">


/**Ajax Request (Submits the form below through AJAX
 *               and then calls the ajax_response function)
 */
function ajax_request(limit1val,limit2val,sendid1,mailid,campanyname) {

  var submitTo = 'mail-send-call-api.php?limit1='+limit1val+'&limit2='+limit2val+'&sendid1='+sendid1+'&mailid='+mailid+'&campanyname='+campanyname;
 //location.href = submitTo; //uncomment if you need for debugging
  http('POST', submitTo, ajax_response, document.form1);
  
}

/**Ajax Response (Called when ajax data has been retrieved)
 *
 * @param   object  data   Javascript (JSON) data object received
 *                         through ajax call
 */
function ajax_response(data) {

if(data['status'] == 'yes')
{
total1 = parseInt( data['lastlimit']);
sendid1 = parseInt( data['statussendid']);
mailid = parseInt( data['mailid']);
campanyname = parseInt( data['company_admin']);
sum1 = total1;
sum2 = 10;
ajax_request(sum1,sum2,sendid1,mailid,campanyname);
}
else
{
//window.location.replace("http://www.contacttarget.com/campaign.php?msg=1");
window.location.replace("<?=$fullpath?>campaign.php?msg=1");

}
}


function ajax_request1(limit1val,limit2val,sendid1,mailid,campanyname) {

 $.ajax({
  type: "POST",
  url: "mail-send-call-api.php",
  data: { mailid: mailid, campanyname: campanyname }
})
  .done(function( msg ) {
 // alert(msg);
 window.location.replace("<?=$fullpath?>campaign.php?msg=1");
  });
  
}



</script>
<style>
.alert-danger, .alert-error {
	background-color: #EDDBE3;
	border-color: #E8D1DF;
	color: #BD4247;
}
.box-content {
	padding: 10px;
}
.alert {
	background-color: #8BC5E8;
	border: 1px solid #7ED0E5;
	border-radius: 4px;
	color: #1C628B;
	margin-bottom: 18px;
	padding: 8px 35px 8px 14px;
	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
}
</style>
</head>
<div>
  <div class="alert alert-block ">
    <h4 class="alert-heading">From address &nbsp;:&nbsp;
      <?=$item_save['from_name'].'&nbsp; < '.$item_save['from_email'].' >';?>
    </h4>
    <h4 class="alert-heading">Subject &nbsp; :&nbsp;
      <?=$item_save['email_subject']?>
    </h4>
    <h4 class="alert-heading">Sending Group &nbsp;:&nbsp;
      <?php 
			 
			 $name_to_val=count(unserialize($item_save["to_address"]));
			 if($name_to_val!=0) { 
			 $i_val=1;
			 foreach(unserialize($item_save["to_address"]) as $value_counte)
			 {
			 print_r($value_counte);
			 if($i_val!=$name_to_val)
			 echo ",";
			  $i_val++;
			 
			 } }
			 ?>
    </h4>
     <h4 class="alert-heading">Request For PDF Attachment &nbsp;:&nbsp;
     <?php	 if($item_save["want_pdf"]==1) {  echo "Yes"; } else { echo "No"; } ?>
  </div>
  <div  style="background-color:#00CCFF; margin:20px auto; padding:10px 0;">
    <h3 align="center">Do You Want To Proceed With Sending Mails?</h3>
    <form name="form1"  id="form1" style="padding:0 10px; text-align:center;">
      <input type="hidden" value="<?=$_REQUEST['camp_id']?>" name="camp_id" id="camp_id" readonly="readonly" />
      <input type="hidden" value="sendconfirm" name="sendconfirm" />
      <input type="hidden" value="<?=$content_desc?>" name="content_desc" />
      <input type="hidden" value="<?=$template?>" name="template" />
      <input type="hidden" value="<?=$subject?>" name="subject" />
      <input type="hidden" value="<?=$mail_from?>" name="mail_from" />
      <input type="hidden" value="<?=$camp_name?>" name="camp_name" />
      <input type="submit" name="Cancel" value="Cancel" class="addmenu2"  />
      
      
       <a style="text-decoration:none" class="lightbox" onclick="ajax_request(0,10,0,<?php echo $mail_id;?>,<?php echo $company_admin;?>)">
      <input type="button" name="submit_send" value="Send" class="addmenu2"  />
      
      </a>
      
     <!-- <a style="text-decoration:none" class="lightbox" onclick="ajax_request(0,600,0,<?php echo $mail_id;?>,<?php echo $company_admin;?>)">
      <input type="button" name="submit_send" value="Send" class="addmenu2"  />
      
      </a>-->
       <input type="submit" name="Schedule" value="Schedule" class="addmenu2"  />
      <div class="backdrop"></div>
      <div class="box">
        <div class="close">
          <input type="submit" name="Cancel" value="Cancel" class="addmenu2"  />
        </div>
        <div style="height:50px;">&nbsp;</div>
        <img src="ajax_load.gif" width="120" height="120"> <span style="color:#FFFFFF">Progressing....</span> </div>
    </form>
  </div>
  <div style="clear:both"></div>
  <div style="margin:20px auto;   "  >
    <?php 


echo stripslashes($item_save['mail_content']);



?>
  </div>
</div>
<?php
			$camp_id = $_REQUEST['camp_id'];
			if($camp_id != "")
			{
			$item_save  =  $php_mail->get_blast_templates($camp_id,$company_admin);
//print_r($item_save);
 $mail_template_type        = $item_save['template_type']; 
 $template_id = $item_save['template_id'];
			?> <div style="clear:both"></div>
<div align="center">
  <ul id="status-page"  class="status-page">
    <li class="step step1 "> <a href="select_campaign.php?camp_id=<?=$camp_id;?>" class="" id="step1">Campaigns</a> </li>
    <li class="step step2 "> <a href="select_template.php?camp_id=<?=$camp_id;?>" class="" id="step1">Template Selection</a> </li>
    <?php 
               if($mail_template_type != "")
			   {
             
                  if($mail_template_type == 'static')
				  {
				  ?>
    <li class="step step3  "><a   href="edit_dynamic_template.php?camp_id=<?=$camp_id;?>" class="" id="step3">Design</a> </li>
    <?php
				}
				else
				{
			?>
    <li class="step step3  "><a   href="dynamic_template.php?camp_id=<?=$camp_id;?>" class="" id="step3">Design</a> </li>
    <?php
			    }
			?>
    <?php
			  } else {  ?>
    <li class="step step3  "><a  href="javascript:void(0);" class="" id="step3">Design</a> </li>
    <?php  }   if(trim($org_content)!="") {  ?>
    <li class="step step5  last"> <a href="preview_blast.php?camp_id=<?=$camp_id;?>" class="" id="step5">Preview</a> </li>
    <?php } else {  ?>
    <li class="step step5 current  last"> <a href="javascript:void(0);" class="" id="step5">Preview</a> </li>
    <?php } ?>
  </ul>
</div>
<?php
			}
			?>
<div  style="clear:both;"></div>
<br />
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
<div style="clear:both"></div>
<div id="fade"  style="padding:10px 10px" align="center">
  <div style="height:50px;">&nbsp;</div>
  <img src="ajax_load.gif" width="120" height="120"> <span style="color:#FFFFFF">Progressing....</span></div>
</body></html>
