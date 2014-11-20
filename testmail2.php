<?php
include("smarty_config.php");
include("top_menu.php");


if(isset($_REQUEST['resend']))
{
$selectQuery = 'SELECT * FROM  mailinglist ';
	$query_result = mysql_query($selectQuery);
}
else
{
echo $query = "select * from nl_subscribers_tbl where enable_id=1";
$query_result = mysql_query($query);
}


$sent_info_coubt="select * from  nl_sent_detail_tbl order by id  desc";
			
$sent_count_query = mysql_query($sent_info_coubt); 
$sent_info_total=mysql_num_rows($sent_count_query);
$row_sent=mysql_fetch_array($sent_count_query);
if($sent_info_total>0)
$sent_info_minus=$row_sent['id']+1;
else
$sent_info_minus=1;



$title = $_REQUEST['title'];
$n_l_id = $_REQUEST['id'];
$title = $title.".txt";

$file = fopen($title,'rb');
$data = fread($file,filesize($title));
fclose($file);

$name = "eblast@desss.com";
$message = $data;



$count_news_letter=mysql_num_rows($query_result);

if(mysql_num_rows($query_result)>0){

	$INCLUDE_DIR = "../mailer/";
	require($INCLUDE_DIR . "class.phpmailer.php");
	$mail = new PHPMailer();

}

while($row = mysql_fetch_assoc($query_result)){


$name_bounce="jayaraj@desss.com";


$headers  = 'MIME-Version: 1.0' . "\r\n";

					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From:'. $name . "\r\n";
					$headers .= 'Disposition-Notification-To:'. $name_bounce . "\r\n"; 
					$headers .= 'X-Confirm-Reading-To:'. $name_bounce . "\r\n";				
					$mail->IsSMTP();                                   // send via SMTP
					$mail->Host = "smtp.1and1.com";
					//$mail->Host     = "smtp.gmail.com"; // SMTP servers
					$mail->Port     = 587; // SMTP Port
					$mail->SMTPAuth = true;     // turn on SMTP authentication
					$mail->Username = "eblast@desss.com";  // SMTP username
					$mail->Password = "1234567"; // SMTP password
					$mail->From     = "eblast@desss.com";
					$mail->FromName = $name;
					$mail->AddReplyTo("eblast@desss.com", "3");					    
					$mail->AddAddress($row['mail']); 					
					$subject = $title;
					$mail->IsHTML(true); 			
					$mail->Subject  =  $subject."";
					$send = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$title.'</title>
</head>
<body>';
$send.=	$message;				
$send.=	"<img width='1px' height='1px' src='http://www.desss.com/admin/get_count.php?sent_id=".$sent_info_minus."&id=".$row['id']."&n_l_id=".$n_l_id."' /><iframe  src='http://www.desss.com/admin/get_count.php?sent_id=".$sent_info_minus."&id=".$row['id']."&n_l_id=".$n_l_id."'  width='0px' height='0px'></iframe>";					
$send.=	"</body>
</html>";				
					
					
					$mail->Body     =  $send;
									
					if(!$mail->Send())
					{
					 $Failed_list.="+$#@+id=".$row['id'].' & ERROR info='.$mail->ErrorInfo.";";  
					}
					else
					
					{
					$sent_list.="+$#@+id=".$row['id'].";";						
						   
					}
					$mail->ClearAddresses();
					
}

 $sent_info="insert into nl_sent_detail_tbl 
			set 
			sent_id='".$sent_info_minus."',
			other_refer='".$count_news_letter."',
			total_sent_list='".$sent_list."',
			total_failed_list='".$Failed_list."',	
			nl_id=".$n_l_id;	
$sent_info_query = mysql_query($sent_info); 
if(!$sent_info_query)	
echo mysql_error();
else
header("location:news_letter.php?msg=5");


?> 