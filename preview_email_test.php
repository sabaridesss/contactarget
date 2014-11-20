<?php 
session_start();
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
unset($_SESSION['content_desc']);
unset($_SESSION['select_email']);
unset($_SESSION['template']);
unset($_SESSION['mail_from']);
unset($_SESSION['camp_name']);
 unset($_SESSION['preview_banner']); 

header("location:mail_subscribers.php");


}


if($_REQUEST['submit_send'] == "Send")
{
 $content_desc    =      $_SESSION['content_desc'];
 $template        =     $_SESSION['template'];
 $subject         =     $_SESSION['subject'];
 $mail_from       =     $_SESSION['mail_from'];
//$new_file_name   =     $_SESSION['mail_from'];
 $camp_name       =     $_SESSION['camp_name']; 
 $preview_banner       =     $_SESSION['preview_banner']; 
	  if($preview_banner!='No' || $preview_banner!="")
	  {
	$viewSelect_banner = "SELECT * FROM  home_page_banner WHERE company_admin=$company_admin and image_id=$preview_banner ";
$exViewQuery_banner = mysql_query($viewSelect_banner);
$num_fetch_banner= mysql_fetch_array($exViewQuery_banner);
if($num_fetch_banner['image_name']=="")
{
 $image_banner="";
 }else
 {
 
  $image_banner="<div style='clear:both'></div><img src='http://www.contacttarget.com/uploads/banner/".$num_fetch_banner['image_name']."' height='200px' width='100%'/>";
 }
 
  }
  else
  $image_banner="";
  




         foreach ($_SESSION['select_email'] as $name)
        {
            $select_email[] = $name;
        }

    $to_count =  count($select_email);








//Mail File Upload
/*if($new_file_name!="")
{

$eventfileTmp      =     $_FILES["mailattach"]["tmp_name"];
 $file1Path        =     "upload/";
 $banPathNme       =     $file1Path.$new_file_name;
 $upload           =     move_uploaded_file($eventfileTmp,$banPathNme);
}*/	
   //Get Multiple To Address
	if(in_array('All', $select_email, true))
	{
	$cond = "";
	}
	else
	{
	  for($i=0;$i<$to_count;$i++)
	  {
	    $real = $to_count - 1;
	    if($i == 0 )
		{
		 $cond.= " and";
		}
	  $cond.= "`user_type` = '".$select_email[$i]."'";
	    if($i != $real )
		{
		$cond.= " or";
		}
	  
	  }
	}
		
				$templates_data = $php_mail->gettemplates($template,$company_admin);
          
				  $logo     = $templates_data['logo'];
				  $phone    = $templates_data['phone'];
				  $content  = $templates_data['content'];
				  $template_color  = $templates_data['template_color'];
				  $content  = $templates_data['content'];
				  $fb       = $templates_data['fb'];
				  $tw       = $templates_data['tw'];
				  $gplus    = $templates_data['gplus'];
				  $utube    = $templates_data['utube'];
				  $st       = $templates_data['st'];
				  $lin       = $templates_data['lin'];
				   $phone_color1       = $templates_data['phone_color'];
				  if($phone_color1!="")
				   $phone_color       = $templates_data['phone_color'];
				   else
				   $phone_color='f85601';
				  


     	$campaign_id       =   $camp_name;
		
		
		$query_camp =  "select * from campaign_list where company_admin='$company_admin' AND `id`=".$campaign_id;
		$query_result2_camp = mysql_query($query_camp);
		$fet_camp = mysql_fetch_array($query_result2_camp);
		
		
		$send_id           =   $php_mail->insert_campaign($company_admin,$subject,$campaign_id);
		
 $template_header           =   $php_mail->templateheader($campaign_id,$template_color);  

 $template_content          =   $php_mail->template_content($phone,$phone_color,$content_desc); 
	
 $template_footer           =   $php_mail->template_footer($logo,$fb,$tw,$gplus,$st,$lin,$content);

	if($send_id)
	{
	
	$email_query = $php_mail->user_record($company_admin,$cond);
	foreach($email_query as $array_k)
	{
  $template_midheader =	"<a style='text-decoration:none;'  href='http://www.contacttarget.com/count_url.php?crypt_url=".$fet_camp['crypt_url']."&campid=".$campaign_id."&user=".$array_k['id']."&sendlist=".$send_id."&company_users=".$company_admin."'><img class='img_cls' width='202' height='91' src='http://www.contacttarget.com/get_count.php?sent_id=". $array_k['id']."&id=".$campaign_id."&sendlist=".$send_id."&templateid=".$template."' align='left' style='position:absolute; left:10px; top:0px;'  /></a>";

    $template_midfooter=	'
    <div class="spacer"></div>
    <a style="color:#FD600B;text-decoration:none;"  href="http://www.contacttarget.com/count_url.php?crypt_url='.$fet_camp['crypt_url'].'&campid='.$campaign_id.'&user='.$array_k['id'].'&sendlist='.$send_id.'&company_users='.$company_admin.'">Click here </a>if this email does not display correctly<div class="spacer"></div>';
   $template_unsub=	' <div class="spacer"></div>
    To stop receiving these emails, you may<a target="_blank" style="color:#FD600B;text-decoration:none;"  href="http://www.contacttarget.com/manage.php?user='.strtr(base64_encode(addslashes(gzcompress(serialize($array_k['id']),9))), '+/=', '-_,').'"> unsubscribe now. </a> <div class="spacer"></div>';
$template_contname = '<h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Hello '.$array_k['firstname'].'</span></h1>
    '.$image_banner.stripslashes($content_desc);
       $send = $template_midfooter.$template_header.$template_midheader.$template_content.$template_contname.$template_unsub.$template_footer;
        // $mail->IsSMTP();
	      // $mail->IsSendmail(); 
	 $mail->IsMail();
	      $mail->SetLanguage( 'en', 'mailer/language/' );                                    // send via SMTP
          $mail->Host = "smtp.local-listing.us";	
		  $mail->Port     = 25;	
    	   $mail->SMTPAuth = true;     // turn on SMTP authentication
		//	$mail->Username = "bounce@contacttarget.com";  // SMTP username
			//$mail->Password = "1234567"; // SMTP password*/
		  $mail->Username = "rajan@local-listing.us";  // SMTP username
          $mail->Password = "1234567"; // SMTP password*/
    	  $mail->From     = "contact@mailtides.com";
		  $mail->FromName = "Desss";
		  $mail->SMTPKeepAlive = true;
		  $mail->addAttachment($banPathNme);
           $mail->AddReplyTo("rajan@local-listing.us",$campaign_id."+15#".$send_id."+15#".$company_admin); 
		  $mail->AddAddress($array_k['email']);	
          $mail->IsHTML(true);                              
          $mail->Subject  =  $subject;
          $mail->Body     =  $send;
          if($mail->Send())
          {
	      $no_send[]    = $array_k['id'];
          }
	      else
	      {
	      $no_failure[] = $array_k['id'] ;
	      echo "Mailer Error: " . $mail->ErrorInfo;
		  }
          $mail->ClearAddresses();
          $mail->ClearReplyTos();
          $banPathNme = '';
		  $mail->SmtpClose();
          }
		 
       foreach($no_send as $value_key)
	   {
	  $insert_query  = "insert into comp_user_tbl(`company_admin`,`user_id`,`content`,`campaign_name`,`send_id`,`no_of_sent`) values('".$company_admin."','".$value_key."','".$content_desc."','".$campaign_id."','".$send_id."',1)";
         $impl_query    =  mysql_query($insert_query);

	   }
	       if($no_failure != "")
			 {
			  foreach($no_failure as $value_key1)
	   {
	            $insert_query1  = "insert into comp_user_tbl(`company_admin`,`user_id`,`content`,`campaign_name`,`send_id`,`no_of_fail`) values('".$company_admin."','".$value_key1."','".$content_desc."','".$campaign_id."','".$send_id."',1)";
         $impl_query1    =  mysql_query($insert_query1);
	   }
	          }
			unset($_SESSION['content_desc']);
unset($_SESSION['select_email']);
unset($_SESSION['template']);
unset($_SESSION['mail_from']);
unset($_SESSION['camp_name']);
 unset($_SESSION['preview_banner']); 
	   header("Location:campaign.php?msg=1");
	   exit;
}
 }
 
		
	$displaySite = $php_mail->gettemplates($_SESSION['template'],$company_admin);	
	
	
	 $preview_banner       =     $_SESSION['preview_banner']; 
	  if($preview_banner!='No' || $preview_banner!="")
	  {
	$viewSelect_banner = "SELECT * FROM  home_page_banner WHERE company_admin=$company_admin and image_id=$preview_banner ";
$exViewQuery_banner = mysql_query($viewSelect_banner);
$num_fetch_banner= mysql_fetch_array($exViewQuery_banner);
if($num_fetch_banner['image_name']=="")
{
 $image_banner="";
 }else
 {
 
  $image_banner="<div style='clear:both'></div><img src='http://www.contacttarget.com/uploads/banner/".$num_fetch_banner['image_name']."' height='200px' width='100%'/>";
 }
  }
  else
  $image_banner="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Contact Target</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript" >
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
</script>
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
</head>
<body>
<div>

<div class="cont_right" style="background-color:#00CCFF; margin:20px auto; padding:10px 0;">
<h3 align="center">Do You Want To Proceed With Sending Mails?</h3>
  <form action="" method="post" style="padding:0 10px; text-align:center;">
  
  <input type="hidden" value="sendconfirm" name="sendconfirm" />
    <input type="hidden" value="<?=$content_desc?>" name="content_desc" />
    <input type="hidden" value="<?=$template?>" name="template" />
    <input type="hidden" value="<?=$subject?>" name="subject" />
    <input type="hidden" value="<?=$mail_from?>" name="mail_from" />
    <input type="hidden" value="<?=$camp_name?>" name="camp_name" />
    <input type="submit" name="Cancel" value="Cancel" class="addmenu2"  />
    <a style="text-decoration:none"  rel="popuprel" class="popup"><input type="submit" name="submit_send" value="Send" class="addmenu2"  /></a>
  </form>
</div>
<div class="cont_right" style="margin:20px auto;">

  <div style="background:#<?=$displaySite['template_color']?>; padding:15px 15px 15px 15px; position:relative; border:1px solid #c0c0c0; " id="whole_div"  >
    <div id="preview" class="prod_content" style="position:absolute; left:10px; top:20px; width:202px; height:91px;"> <a href=''>
      <?php if($displaySite['logo']!="") {?>
      <img src='uploads/<?=$displaySite['logo']?>' align='left' class="img_cls" style='position:absolute; left:10px; top:0px;' width='202' height='91' >
      <?php } else { ?>
      <img src="desss_logo.png" alt="DESSS LOGO" title="DESSS LOGO" class="img_cls" align="left" style="position:absolute; left:10px; top:0px;" width="202" height="91" />
      <?php } ?>
      </a>
      <div style="clear:both;"></div>
    </div>
    <div style="clear:both;"></div>
    <p style="font:bold 18px/60px Verdana, Geneva, sans-serif; color:#<?=$displaySite['phone_color']?>; height:60" align="right"><span id="phone_replace">
      <?=$displaySite['phone']?>
      </span></p>
    <div style="clear:both;"></div>
    <div style="background:#fff; padding:10px; margin-top:30px; border:1px solid #C0C0C0;" class="content">
      <h1 style=" margin:0px 0px 0px 0px;"><span  style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Hello </span></h1>
      <?=$image_banner?>
      <div style="min-height:300px" id="myDoc_length1">
        <p >
          <?=stripslashes ($_SESSION['content_desc'])?>
        </p>
      </div>
    </div>
    <div align="center">
      <!--<div id="preview1" class="prod_content" style="margin-top:15px;width:202px; height:91px;"> <a href=''>
        <?php if($displaySite['logo']!="") {?>
        <img src='uploads/<?=$displaySite['logo']?>' class="img_cls" >
        <?php } else { ?>
        <img src="desss_logo.png" class="img_cls"   />
        <?php } ?>
        </a></div>-->
      <div class="spacer"></div>
      <div style="display:inline-block; margin-top:10px;"> <span <?php if($displaySite['fb']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?>  id="fb_img_div"> <a href="#"><img src="facebook.png"></a></span> <span <?php if($displaySite['tw']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?>   id="twitter_img_div"> <a href="#"><img src="twitter.png"></a> </span> <span <?php if($displaySite['lin']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?>  id="linkedin_img_div"> <a href="#"><img src="linkin.png"></a> </span> <span <?php if($displaySite['gplus']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?>   id="google_img_div"> <a href="#"><img src="google.png"></a></span> <span <?php if($displaySite['st']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?>   id="stumbleupon_img_div"> <a href="#"><img src="stumb.png"></a></span> <span <?php if($displaySite['utube']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?>  id="youtube_img_div"> <a href="#"><img src="youtube.png"></a> </span> </div>
      <p style="font:normal 12px/24px Verdana, Geneva, sans-serif; color:#515151;	margin:10px 0px 0px 0px;"><span  id="bottom_replace" > </span></p>
    </div>
  </div>
</div>
</div>


<div id="fade"  style="padding:10px 10px" align="center">
              <div style="height:50px;">&nbsp;</div>
              <img src="ajax_load.gif" width="120" height="120"> <span style="color:#FFFFFF">Progressing....</span></div>
              </body></html>
