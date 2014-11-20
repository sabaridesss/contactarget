<?php
session_start();
include("smarty_config.php");
include("phpmailfunction.php");
$api_key	=	'Y96qalVWeEJbNAAUq8ecQl4UhBtP1Z1M';
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
 
$item_save1  =  $php_mail->get_blast_templates($mailid,$company_admin);

 $content_desc   		 =     stripslashes($item_save1['mail_content']);
 $subject         		 =     $item_save1['email_subject'];
 $fromaddress    		 =     $item_save1['from_email'];
 $fromname       		 =     $item_save1['from_name'];
 $pdfname        		 =     $item_save1['pdfname'];
 $want_pdf       		 =     $item_save1['want_pdf'];
 $attachment_file 		 =     $item_save1['attachment_file'];  
 $pdffilename     		 =     "pdf/".$pdfname;
 $attachment_file_name   =     "pdf/".$attachment_file;
 
         foreach (unserialize(stripslashes($item_save1['to_address'])) as $name)
        {
            $select_email[] = $name;
        }
    $to_count =  count($select_email);


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
	
	$query_curl =  "select c_url from campaign_list where company_admin='$company_admin' AND `id`=".$item_save1['camp_id'];
	$query_result_curl = mysql_query($query_curl);
	$item_save_curl = mysql_fetch_array($query_result_curl);
	
	
	 

	if($mailid )
	{
	
	//$email_query = $php_mail->user_record($company_admin,$cond);
     	
     $sendemaili = $limit1;

	 $email_query = "SELECT * FROM user_tbl where company_admin='$company_admin' and subscribe = '0'  ".$cond." order by id limit $limit1,$limit2 ";
	
	$email_result = mysql_query($email_query);
	while($array_k = mysql_fetch_array($email_result))
	
	{

		if(filter_var($array_k['email'], FILTER_VALIDATE_EMAIL))
  	  {
 	 $value_email_list  .=  '"'.$array_k['firstname'].'" <'.$array_k['email'].'>';
	 
	 if($total_count!=$value_count)
	 	 {
	 $value_email_list  .= ',';
	 }
	 
   	  }
	  
	if(trim($item_save_curl['c_url'])!="")
	{
$crypt_url='<a style="color:#FD600B;text-decoration:none;"  href="http://mailtides.com/count_url.php?crypt_url='.$item_save1['crypt_url'].'&user='.$array_k['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'&campid='.$item_save1['camp_id'].'">Click here </a>';
	}
	else
	{
$crypt_url='<a style="color:#FD600B;text-decoration:none;"  href="http://mailtides.com/browse_preview.php?user='.$array_k['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'&campid='.$item_save1['camp_id'].'">View In Browser </a>';
	}
	
$template_midfooter='<div class="spacer"></div>'.$crypt_url.'if this email does not display correctly<div class="spacer"></div><br>';

$template_unsub=' <div class="spacer"></div>To stop receiving these emails, you may<a target="_blank" style="color:#FD600B;text-decoration:none;"  href="http://mailtides.com/manage.php?user='.strtr(base64_encode(addslashes(gzcompress(serialize($array_k['id']),9))), '+/=', '-_,').'"> unsubscribe now. </a> <div class="spacer"></div>';

$template_contname = '<h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Hello '.$array_k['firstname'].'</span></h1>';

$final_content  = str_replace("&subid=".$mailid, "&subid=".$mailid."&user=".$array_k['id']."&company_users=".$company_admin, $content_desc);

	
$send = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>'.$subject.'</title></head><body>'.$final_content.'<img src="http://mailtides.com/get_count1.php?sent_id='. $array_k['id'].'&sendlist='.$mailid.'" alt="" title=""  width="1px" height="1px" style="display:none" /></table><table align="center"><tr><td colspan="2"> '.$template_midfooter.$template_unsub.' <p><font size="1">To unsubscribe via postal mail, please contact us at:</font></p><p><font size="1">MailTides, Inc.<br>Attn: Newsletter Subscription Dept.<br>Jawaharlal Nehru Rd, Geetanjali Colony, Anna Nagar West Chennai, TN 600040 </font></p><p><font size="1">Please include the email address which you have been contacted with.</font></p></td></tr></table></body></html>';

   


 /*$send = $template_midfooter.$template_header.$template_midheader.$template_content.$template_contname.$template_unsub.$template_footer;
*/
	   
	   
      //   $mail->IsSMTP();
	 //   $mail->IsSendmail(); 
 // $mail->IsMail();
	 //     $mail->SetLanguage( 'en', 'mailer/language/' );                                    // send via SMTP
        //  $mail->Host = "smtp.local-listing.us";
		 // $mail->Host = "smtp.1and1.com";		
		//  $mail->Port     = 587;	
    	//  $mail->SMTPAuth = true;     // turn on SMTP authentication
		//  $mail->Username = "jayaraj@desss.com";  // SMTP username
        //  $mail->Password = "1234567"; // SMTP password*/
    	//  $mail->From     = $fromaddress;
		//  $mail->FromName = $fromname;		  
	/*	  $mail->SMTPKeepAlive = true;
		  
		  if($want_pdf=='1')
		  {		  
		  $mail->addAttachment($pdffilename);
		  }
		  if(trim($attachment_file)!="")
		  {
		  $mail->addAttachment($attachment_file_name);		  
		  }
		  
		  
          $mail->AddReplyTo($fromaddress,$fromname); 
		  $mail->AddAddress($array_k['email'],$array_k['firstname']);	
          $mail->IsHTML(true);                              
          $mail->Subject  =  $subject;
          $mail->Body     =  $send;
          if($mail->Send())
          {*/
	      $no_send[]    = $array_k['id'];
         /* }
	      else
	      {
	      $no_failure[] = $array_k['id'] ;
		  }
          $mail->ClearAddresses();
          $mail->ClearReplyTos();
		  $mail->ClearAttachments();
          $mail->SmtpClose();*/
		  
		  $postvalues = array(
						'apiKey' => $api_key,
						'qualifiedFromAddress' => 'Nagendhiran',
						'fromAddress' =>  'nathan@desss.com',
						'subjectLine' => $subject,
						'emailContent' => $send,
						'toAddresses' => $value_email_list,
						'attachment' => 'Simple content'
				);
				
				
				
$total_json=json_encode($postvalues);
  
		  
	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $status_url1);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $total_json);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	 
$result = curl_exec($ch);
if(curl_exec($ch)){
{

print_r($result); 
curl_close($ch);
unset($ch);

}
else
{
die;

}
		  
		  
		  
          $sendemaili++;
		  }
	exit;
		 foreach($no_send as $value_key)
	   {
	  $insert_query  = "insert into comp_user_tbl(`company_admin`,`user_id`,`send_id`,`no_of_sent`) values('".$company_admin."','".$value_key."','".$mailid."',1)";
         $impl_query    =  mysql_query($insert_query);

	   }
	       if($no_failure != "")
			 {
			  foreach($no_failure as $value_key1)
	   {
	          $insert_query1  = "insert into comp_user_tbl(`company_admin`,`user_id`,`send_id`,`no_of_fail`) values('".$company_admin."','".$value_key1."','".$mailid."',1)";
       $impl_query1    =  mysql_query($insert_query1);
	   }
	          }
			  $total_count = $email_count -  $sendemaili; 
if($total_count <= 0)
{			  
$status_value  =  $php_mail->update_status_blast($mailid,$company_admin);
$variable = "no";
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