<?php
session_start();
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
 $statussend      = $_REQUEST['sendid1'];

 //fetch template content
 $item_save1  	  =  $php_mail->get_blast_templates($mailid,$company_admin);
 $content_desc    =     stripslashes($item_save1['mail_content']);
 $subject         =     $item_save1['email_subject'];
 $fromaddress     =     $item_save1['from_email'];
 $fromname        =     $item_save1['from_name'];
 $pdfname         =     $item_save1['pdfname'];
 $want_pdf        =     $item_save1['want_pdf'];
 $attachment_file =     $item_save1['attachment_file'];  
 $pdffilename     =     "pdf/".$pdfname;
 $attachment_file_name   =     "pdf/".$attachment_file;
 
    
// To Resend MAils   
$no_of_resend_Blasts_new 	 = $php_mail->Select_Blast_three('comp_user_tbl','send_id','no_of_read','company_admin',$mailid,0,$company_admin);
$email_count	 			 = mysql_num_rows($no_of_resend_Blasts_new);

	$query_curl =  "select c_url from campaign_list where company_admin='$company_admin' AND `id`=".$item_save1['camp_id'];
	$query_result_curl = mysql_query($query_curl);
	$item_save_curl = mysql_fetch_array($query_result_curl);

	 

	if($mailid)
	{
	
	     	
	 $sendemaili = $limit1;
	$no_of_resend_Blasts_new_page 	 = $php_mail->Select_Blast_three_page('comp_user_tbl','send_id','no_of_read','company_admin',$mailid,0,$company_admin, $limit1, $limit2);
	$no_of_failed_page	 		 = mysql_num_rows($no_of_resend_Blasts_new_page);	
 

	while($array_k = mysql_fetch_array($no_of_resend_Blasts_new_page))
	{

$Select_Blasts 	 = $php_mail->Select_Blast('user_tbl','id',$array_k['user_id']);
$item1=mysql_fetch_array($Select_Blasts);



	if(trim($item_save_curl['c_url'])!="")
	{
$crypt_url='<a style="color:#FD600B;text-decoration:none;"  href="http://mailtides.com/count_url.php?crypt_url='.$item_save1['crypt_url'].'&user='.$item1['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'&campid='.$item_save1['camp_id'].'">Click here </a>';
	}
	else
	{
$crypt_url='<a style="color:#FD600B;text-decoration:none;"  href="http://mailtides.com/browse_preview.php?user='.$array_k['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'&campid='.$item_save1['camp_id'].'">View In Browser </a>';
	}
	
$template_midfooter='<div class="spacer"></div>'.$crypt_url.'if this email does not display correctly<div class="spacer"></div>';

$template_unsub=' <div class="spacer"></div>To stop receiving these emails, you may<a target="_blank" style="color:#FD600B;text-decoration:none;"  href="http://mailtides.com/manage.php?user='.strtr(base64_encode(addslashes(gzcompress(serialize($item1['id']),9))), '+/=', '-_,').'"> unsubscribe now. </a> <div class="spacer"></div>';

$template_contname = '<h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Hello '.$array_k['firstname'].'</span></h1>';

$final_content  = str_replace("&subid=".$mailid, "&subid=".$mailid."&user=".$item1['id']."&company_users=".$company_admin, $content_desc);

	
$send = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>'.$subject.'</title></head><body>'.$final_content.'<img src="http://mailtides.com/get_count1.php?sent_id='. $item1['id'].'&sendlist='.$mailid.'" alt="" title=""  width="1px" height="1px" style="display:none" /></table><table align="center"><tr><td colspan="2"> '.$template_midfooter.$template_unsub.' <p><font size="1">To unsubscribe via postal mail, please contact us at:</font></p><p><font size="1">Mail Tides, Inc.<br>Attn: Newsletter Subscription Dept.<br>Jawaharlal Nehru Rd, Geetanjali Colony, Anna Nagar West Chennai, TN 600040 </font></p><p><font size="1">Please include the email address which you have been contacted with.</font></p></td></tr></table></body></html>';

   


 /*$send = $template_midfooter.$template_header.$template_midheader.$template_content.$template_contname.$template_unsub.$template_footer;
*/
	   
          //  $mail->IsSMTP();
	   $mail->IsSendmail(); 
 		// $mail->IsMail();
	      $mail->SetLanguage( 'en', 'mailer/language/' );                                    // send via SMTP
        //  $mail->Host = "smtp.local-listing.us";
		  $mail->Host = "smtp.1and1.com";		
		  $mail->Port     = 587;	
    	  $mail->SMTPAuth = true;     // turn on SMTP authentication
		  $mail->Username = "jayaraj@desss.com";  // SMTP username
          $mail->Password = "1234567"; // SMTP password*/
    	  $mail->From     = $fromaddress;
		  $mail->FromName = $fromname;		  
		  $mail->SMTPKeepAlive = true;
		  	  if($want_pdf=='1')
		  {		  
		  $mail->addAttachment($pdffilename);
		  }
		  if(trim($attachment_file)!="")
		  {
		  $mail->addAttachment($attachment_file_name);		  
		  }
          $mail->AddReplyTo($fromaddress,$fromname); 
		  $mail->AddAddress($item1['email'],$item1['firstname']);	
          $mail->IsHTML(true);                              
          $mail->Subject  =  $subject;
          $mail->Body     =  $send;
          if($mail->Send())
          {
	      $no_send[]    = $item1['id'];
          }
	      else
	      {
	      $no_failure[] = $item1['id'];
		  }
          $mail->ClearAddresses();
          $mail->ClearReplyTos();
		  $mail->ClearAttachments();
          $mail->SmtpClose();
          $sendemaili++;
		  }
	
		 

		
       foreach($no_send as $value_key)
	   {
	 	       $insert       =     "update comp_user_tbl set resent_status = '1' where send_id='".$mailid."' and user_id='".$value_key."' and company_admin ='".$company_admin."'" ;
	 	
		$rows_affected = mysql_query($insert);   	

 }
	       if($no_failure != "")
			 {
			  foreach($no_failure as $value_key1)
	   {

 $insert       =     "update comp_user_tbl set resent_status = '404' where send_id='".$mailid."' and user_id='".$value_key1."' and company_admin ='".$company_admin."'" ;
 
		$rows_affected = mysql_query($insert); 


	            
	   }
	          }
			  $total_count = $email_count -  $sendemaili; 
if($total_count <= 0)
{			  
$status_value  =  $php_mail->update_status_blast($mailid,$company_admin);
$variable = "no";
/*header("Location:campaign.php?msg=1");
exit;*/
}
else
{
$variable = "yes";
}

}
$value = array('totalcount' => $total_count, 'lastlimit' => $sendemaili, 'status' => $variable, 'statussendid' => $mailid, 'mailid' => $mailid, 'company_admin' => $company_admin);
$output = $json->encode($value);

print($output);

 ?>