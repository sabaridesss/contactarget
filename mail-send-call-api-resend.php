<?php

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

 
$item_save1  =  $php_mail->get_blast_templates($mailid,$company_admin);

 $content_desc   		 =     stripslashes($item_save1['mail_content']);
 $subject         		 =     $item_save1['email_subject'];
 $fromaddress    		 =     $item_save1['from_email'];
 $fromname       		 =     $item_save1['from_name'];
 $pdfname        		 =     $item_save1['pdfname'];
 $want_pdf       		 =     $item_save1['want_pdf'];
 $attachment_file 		 =     $item_save1['attachment_file'];  
/* $pdffilename     		 =     "pdf/".$pdfname;
 $attachment_file_name   =     "pdf/".$attachment_file;*/
 
 
  $pdffilename     		 =     $pdfname;
 $attachment_file_name   =     $attachment_file;
 
 
 if(trim($attachment_file)!="")
		  {
		   $attachment_two= $attachment_file_name;		  
		  }
		  else
		  {
		   $attachment_two= $pdffilename;	
		  
		  }
		  
		  
 
 
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
	
// To Resend MAils   
$no_of_resend_Blasts_new 	 = $php_mail->Select_Blast_three('comp_user_tbl','send_id','no_of_read','company_admin',$mailid,0,$company_admin);
$email_count	 			 = mysql_num_rows($no_of_resend_Blasts_new);

	 $query_curl =  "select c_url from campaign_list where company_admin='$company_admin' AND `id`=".$item_save1['camp_id'];
	$query_result_curl = mysql_query($query_curl);
	$item_save_curl = mysql_fetch_array($query_result_curl);
	

	$value_email_list=''; 

	if($mailid)
	{
    $sendemaili = $limit1;
	$no_of_resend_Blasts_new_page 	 = $php_mail->Select_Blast_three_page('comp_user_tbl','send_id','no_of_read','company_admin',$mailid,0,$company_admin, $limit1, $limit2);
	
	
	
	 $no_of_failed_page	 		 = mysql_num_rows($no_of_resend_Blasts_new_page);	
	 
	
 $total_count=1;
 
while($array_k = mysql_fetch_array($no_of_resend_Blasts_new_page))
	{
$Select_Blasts 	 = $php_mail->Select_Blast('user_tbl','id',$array_k['user_id']);
$item1=mysql_fetch_array($Select_Blasts);


 	  $value_email_list  =  '"'.$item1['firstname'].'" <'.$item1['email'].'>';
	 

if(trim($item_save_curl['c_url'])!="")
	{
$crypt_url='<a style="color:#FD600B;text-decoration:none;"  href="http://www.mailtides.com/count_url.php?crypt_url='.$item_save1['crypt_url'].'&user='.$item1['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'&campid='.$item_save1['camp_id'].'">Click here </a>';
	}
	else
	{
$crypt_url='<a style="color:#FD600B;text-decoration:none;"  href="http://www.mailtides.com/browse_preview.php?user='.$array_k['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'&campid='.$item_save1['camp_id'].'">View In Browser </a>';
	}
	
	if(trim($item_save_curl['c_url'])!="" && $item_save1['template_id']=='42')
	{
$template_url='<a style="color:#FD600B;text-decoration:none;"  href="http://www.mailtides.com/count_url.php?crypt_url='.$item_save1['crypt_url'].'&user='.$array_k['id'].'&sendlist='.$mailid.'&company_users='.$company_admin.'&campid='.$item_save1['camp_id'].'">';
$template_url_end='</a>';
	}
	else
	{
$template_url='';
$template_url_end='';

	}
	
	
	
$template_midfooter='<div class="spacer"></div>'.$crypt_url.'if this email does not display correctly<div class="spacer"></div>';

$template_unsub=' <div class="spacer"></div>To stop receiving these emails, you may<a target="_blank" style="color:#FD600B;text-decoration:none;"  href="http://www.mailtides.com/manage.php?user='.strtr(base64_encode(addslashes(gzcompress(serialize($item1['id']),9))), '+/=', '-_,').'"> unsubscribe now. </a> <div class="spacer"></div>';

$template_contname = '<h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Hello '.$array_k['firstname'].'</span></h1>';

$final_content  = str_replace("&subid=".$mailid, "&subid=".$mailid."&user=".$item1['id']."&company_users=".$company_admin, $content_desc);

	
$send = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><meta http-equiv="Content-Type" content="text/html;charset=UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>'.$subject.'</title></head><body>'.$template_url.$final_content.$template_url_end.'<img src="http://mailtides.com/get_count1.php?sent_id='. $item1['id'].'&sendlist='.$mailid.'" alt="" title=""  width="1px" height="1px" style="display:none" /></table><table align="center"><tr><td colspan="2"> '.$template_midfooter.$template_unsub.'</td></tr></table></body></html>';


     $no_send[]    = $array_k['id'];
	
	    
		     if($want_pdf=='1' && trim($attachment_file)=="")
		  {		  
			 $postvalues[] = array('qualifiedFromAddress' =>  $fromname,
						'fromAddress' =>  'mailer@mailtides.com',
						'subjectLine' => $subject,
						'emailContent' => $send,
						'toAddresses' => $value_email_list,'attachment' => $pdffilename );
		  }
		 else if($want_pdf!='1' && trim($attachment_file)!="")
		  {
		  	 $postvalues[] = array('qualifiedFromAddress' =>  $fromname,
						'fromAddress' => 'mailer@mailtides.com',
						'subjectLine' => $subject,
						'emailContent' => $send,
						'toAddresses' => $value_email_list,'fileAttachment' => $attachment_two);
		  }
	 	else if($want_pdf=='1' && trim($attachment_file)!="")
	 
	  { 	 $postvalues[] = array('qualifiedFromAddress' =>  $fromname,
						'fromAddress' =>  'mailer@mailtides.com',
						'subjectLine' => $subject,
						'emailContent' => $send,
						'toAddresses' => $value_email_list ,'attachment' => $pdffilename ,'fileAttachment' => $attachment_two);  
		  }
		 else 
	 
	  {		 	 $postvalues[] = array('qualifiedFromAddress' =>  $fromname,
						'fromAddress' =>  'mailer@mailtides.com',
						'subjectLine' => $subject,
						'emailContent' => $send,
						'toAddresses' => $value_email_list);  
		  }
		  
		  
		  
		
	 
	
	 
	 
	 
	 
	 
	 

				
  $sendemaili++; 	$total_count++;  
		  }
		  


$total_json=json_encode($postvalues);

//encoding post data
$postJson = array('apiKey' => 'Y96qalVWeEJbNAAUq8ecQl4UhBtP1Z1M','emailJson' =>$total_json);
$encodedPostJson=json_encode($postJson);

//Service api url
/*$apiServiceUrl ='https://198.71.58.231:5889/getemailer';
$apiPostServiceUrl ='https://198.71.58.231:6889/api/blastEmails';*/

$apiServiceUrl ='https://178.62.37.196:6889/getemailer';
$apiPostServiceUrl ='https://178.62.37.196:6889/api/blastEmails';


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiPostServiceUrl);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, $encodedPostJson);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Accept: application/json'));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);		 
$result = curl_exec($ch);



$obj   = json_decode($result);
  $status= $obj->message;
  

  
if($status=='successfully sent'){

 foreach($no_send as $value_key)
	   {
	        $insert       =     "update comp_user_tbl set resent_status = '1' where send_id='".$mailid."' and user_id='".$value_key."' and company_admin ='".$company_admin."'" ;
	  	
		$rows_affected = mysql_query($insert);   
		

}}
else
{

 foreach($no_send as $value_key)
	   {
	      $insert       =     "update comp_user_tbl set resent_status = '404' where send_id='".$mailid."' and user_id='".$value_key."' and company_admin ='".$company_admin."'" ;
 
		$rows_affected = mysql_query($insert); 




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
