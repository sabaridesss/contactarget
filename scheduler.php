<?php 
 //-------------configuration file--------------
 error_reporting(0);
 ob_start();
 date_default_timezone_set('America/Chicago');
 ini_set('session.gc_maxlifetime', '608800');
 session_start();
 include("fckeditor/fckeditor.php");
 require('dbconnect.php');
 require('MYSQL.php');
 require('common_functions.php');
 $obj_mysql = new mysql_class();
 $obj_mysql->db_connect(DB_HOST,DB_USER,DB_PASS);
 $obj_mysql->db_select_db(DB_NAME);
 $fullpath='http://www.contacttarget.com/';
 include("phpmailfunction.php");
 
 
 ///////////////DATE/////////////////////
$current_date=date('Y-m-d H:i:s');
$mytime = ($start = date("Y-m-d H:i:s", strtotime( "$start + 15 mins")));
 /****************************************/
 echo $sel_blast_templates   =  "
SELECT A.*,B.c_name,B.c_keyword,B.crypt_url FROM compaign_name A, campaign_list B  WHERE  A.status != 'complete' and A.camp_id = B.id and A.schedule_mail BETWEEN '$current_date' and '$mytime'" ;
	$query1_sel_blast_templates  = mysql_query($sel_blast_templates);
	echo $count = mysql_num_rows($sel_blast_templates);
	while($item_save1        =  mysql_fetch_array($query1_sel_blast_templates))
	{
	$content_desc   		 =     stripslashes($item_save1['mail_content']);
 $subject         		 =     $item_save1['email_subject'];
 $fromaddress    		 =     $item_save1['from_email'];
 $fromname       		 =     $item_save1['from_name'];
 $pdfname        		 =     $item_save1['pdfname'];
 $want_pdf       		 =     $item_save1['want_pdf'];
 $attachment_file 		 =     $item_save1['attachment_file'];  
 $pdffilename     		 =     "pdf/".$pdfname;
 $attachment_file_name   =     "pdf/".$attachment_file;
 $company_admin          =     $item_save1['company_admin'];
 $mailid                 =     $item_save1['id'];
 
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
	 

	if($mailid )
	{
	
	//$email_query = $php_mail->user_record($company_admin,$cond);
     	
     $sendemaili = $limit1;

	echo $email_query = "SELECT * FROM user_tbl where company_admin='$company_admin' and subscribe = '0'  ".$cond." order by id ";
	
	$email_result = mysql_query($email_query);
	while($array_k = mysql_fetch_array($email_result))
	
	{

	
	if(trim($item_save1['c_url'])!="")
	{
$crypt_url='<a style="color:#FD600B;text-decoration:none;"  href="http://contacttarget.com/count_url.php?crypt_url='.$item_save1['crypt_url'].'&user='.$array_k['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'">Click here </a>';
	}
	else
	{
$crypt_url='<a style="color:#FD600B;text-decoration:none;"  href="http://contacttarget.com/browse_preview.php?user='.$array_k['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'">View In Browser </a>';
	}
	
$template_midfooter='<div class="spacer"></div>'.$crypt_url.'if this email does not display correctly<div class="spacer"></div>';

$template_unsub=' <div class="spacer"></div>To stop receiving these emails, you may<a target="_blank" style="color:#FD600B;text-decoration:none;"  href="http://contacttarget.com/manage.php?user='.strtr(base64_encode(addslashes(gzcompress(serialize($array_k['id']),9))), '+/=', '-_,').'"> unsubscribe now. </a> <div class="spacer"></div>';

$template_contname = '<h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Hello '.$array_k['firstname'].'</span></h1>';

$final_content  = str_replace("&subid=".$mailid, "&subid=".$mailid."&user=".$array_k['id']."&company_users=".$company_admin, $content_desc);

	
$send = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>'.$subject.'</title></head><body>'.$template_midfooter.$final_content.'<img src="http://contacttarget.com/get_count1.php?sent_id='. $array_k['id'].'&sendlist='.$mailid.'" alt="" title=""  width="1px" height="1px" style="display:none" /></table>'. $template_unsub.'</body></html>';

   


 /*$send = $template_midfooter.$template_header.$template_midheader.$template_content.$template_contname.$template_unsub.$template_footer;
*/
	   
	   
          //  $mail->IsSMTP();
	      // $mail->IsSendmail(); 
 		  $mail->IsMail();
	      $mail->SetLanguage( 'en', 'mailer/language/' );                                    // send via SMTP
          $mail->Host = "smtp.local-listing.us";
		  $mail->Host = "smtp.1and1.com";		
		  $mail->Port     = 25;	
    	  $mail->SMTPAuth = true;     // turn on SMTP authentication
		  $mail->Username = "rajan@local-listing.us";  // SMTP username
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
		  $mail->AddAddress($array_k['email'],$array_k['firstname']);	
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
		  $mail->ClearAttachments();
          $mail->SmtpClose();
          $sendemaili++;
		  }
	
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

			  
$status_value  =  $php_mail->update_status_blast($mailid,$company_admin);


}	
}

?>