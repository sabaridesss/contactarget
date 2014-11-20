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
require_once "json/JSON.php";
$json = new Services_JSON();
$INCLUDE_DIR = "mailer/";
    require($INCLUDE_DIR . "class.phpmailer.php");
	$mail = new PHPMailer();	
	
 $limit1          = $_REQUEST['limit1'];	
 $limit2          = $_REQUEST['limit2'];
 $mailid          = $_REQUEST['mailid'];
 $company_admin   = $_REQUEST['campanyname'];
 $statussend          = $_REQUEST['sendid1'];
 
 $query2_saved1= "select * from  save_mail_list where company_admin='$company_admin' and id = $mailid";
$query_result_saved1 = mysql_query($query2_saved1);
$item_save1=mysql_fetch_array($query_result_saved1);

 $content_desc    =     $item_save1['content_desc'];
 $template        =     $item_save1['template'];
 $subject         =     $item_save1['mailsubject'];
 $mail_from       =     $item_save1['mail_from'];
//$new_file_name   =     $_SESSION['mail_from'];
 $camp_name       =     $item_save1['compaignname']; 
 $fromaddress       =     $item_save1['from_mail'];
 $fromname       =     $item_save1['from_name'];
 
$preview_banner       =     $item_save1['preview_banner']; 

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
  




         foreach (unserialize($item_save1['select_email']) as $name)
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
	
  $email_query_count    = "SELECT * FROM user_tbl where company_admin='$company_admin' and subscribe = '0'  ".$cond." order by id  ";
	$email_display_count  =  mysql_query($email_query_count);
  $email_count          =  mysql_num_rows($email_display_count);
	 

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
/*		
echo $company_admin;
echo "<br/>";
echo $subject;
echo "<br/>";
echo $campaign_id	;	
echo "<br/>";*/
	 	if($statussend   == 0)
	{
		$send_id           =   $php_mail->insert_campaign($company_admin,$subject,$campaign_id);
	
	}	
	else
	{
	$send_id   = $statussend;
	}

 $template_header           =   $php_mail->templateheader($campaign_id,$template_color);  

 $template_content          =   $php_mail->template_content($phone,$phone_color,$content_desc); 
	
 $template_footer           =   $php_mail->template_footer($logo,$fb,$tw,$gplus,$st,$lin,$content);

	if($send_id)
	{
	
	//$email_query = $php_mail->user_record($company_admin,$cond);
     	
      	$sendemaili = $limit1;

	$email_query = "SELECT * FROM user_tbl where company_admin='$company_admin' and subscribe = '0'  ".$cond." order by id limit $limit1,$limit2 ";
	$email_result = mysql_query($email_query);
	while($array_k = mysql_fetch_array($email_result))
	//foreach($email_query as $array_k)
	{
	/*if(($sendemaili % 1000)==0)
	{
	sleep(1);
	}*/
  $template_midheader =	"<a style='text-decoration:none;'  href='http://www.contacttarget.com/count_url.php?crypt_url=".$fet_camp['crypt_url']."&campid=".$campaign_id."&user=".$array_k['id']."&sendlist=".$send_id."&company_users=".$company_admin."'><img class='img_cls' width='202' height='91' src='http://www.contacttarget.com/get_count.php?sent_id=". $array_k['id']."&id=".$campaign_id."&sendlist=".$send_id."&templateid=".$template."' align='left' style='position:absolute; left:10px; top:0px;'  /></a>";

    $template_midfooter=	'
    <div class="spacer"></div>
    <a style="color:#FD600B;text-decoration:none;"  href="http://www.contacttarget.com/count_url.php?crypt_url='.$fet_camp['crypt_url'].'&campid='.$campaign_id.'&user='.$array_k['id'].'&sendlist='.$send_id.'&company_users='.$company_admin.'">Click here </a>if this email does not display correctly<div class="spacer"></div>';
   $template_unsub=	' <div class="spacer"></div>
    To stop receiving these emails, you may<a target="_blank" style="color:#FD600B;text-decoration:none;"  href="http://www.contacttarget.com/manage.php?user='.strtr(base64_encode(addslashes(gzcompress(serialize($array_k['id']),9))), '+/=', '-_,').'"> unsubscribe now. </a> <div class="spacer"></div>';
$template_contname = '<h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Hello '.$array_k['firstname'].'</span></h1>
    '.$image_banner.stripslashes($content_desc);
	
echo $templates_data['template']; exit;
if($templates_data['template']==27)
{

	
       $send = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html;charset=utf-8"/><title>Katy Tamil Friends</title><style>
* {
	margin:0;
	padding:0
}
body {
	padding:0px;
	margin:0px;
}
td {
	padding:0px;
	margin:0px;
	border:none !important;
}
tr {
	padding:0px;
	margin:0px;
	border:none !important;
}
img {
	padding:0px;
	margin:0px;
	border:none !important;
	width:100%;
}
</style></head><body>'.$template_midfooter.$content_desc.'<img src="http://www.contacttarget.com/get_count2.php?sent_id='. $array_k['id'].'&id='.$campaign_id.'&sendlist='.$send_id.'&templateid='.$template.'" alt="" title=""  width="0" height="0" /></table></body></html>';
	   
	}
	else
	 {
	 $send = $template_midfooter.$template_header.$template_midheader.$template_content.$template_contname.$template_unsub.$template_footer;
	 
	 }  
	   
	   
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
    	  $mail->From     = $fromaddress;
		  $mail->FromName = $fromname;
		  $mail->SMTPKeepAlive = true;
		  $mail->addAttachment($banPathNme);
           $mail->AddReplyTo($fromaddress,$campaign_id."+15#".$send_id."+15#".$company_admin); 
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
		  }
          $mail->ClearAddresses();
          $mail->ClearReplyTos();
          $banPathNme = '';
		  $mail->SmtpClose();
          $sendemaili++;
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
			  $total_count = $email_count -  $sendemaili; 
if($total_count <= 0)
{			  
unset($_SESSION['content_desc']);
unset($_SESSION['select_email']);
unset($_SESSION['template']);
unset($_SESSION['mail_from']);
unset($_SESSION['camp_name']);
unset($_SESSION['preview_banner']); 
unset($_SESSION['mailcnt']);
unset($_SESSION['mail_count']);
unset($_SESSION['sendid']);
$variable = "no";
/*header("Location:campaign.php?msg=1");
exit;*/
}
else
{
$variable = "yes";
}

}
$value = array('totalcount' => $total_count, 'lastlimit' => $sendemaili, 'status' => $variable, 'statussendid' => $send_id, 'mailid' => $mailid, 'company_admin' => $company_admin);
$output = $json->encode($value);

print($output);

 ?>