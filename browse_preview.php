<?php
ob_start();
include("smarty_config.php");
include("phpmailfunction.php");
function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
$php_mail = new phpmail_function();



$user               = $_REQUEST['user'];
$sendlist           = $_REQUEST['sendlist'];
$company_admin 		= $_REQUEST['company_users']; 

 $check         =     "SELECT clicks FROM comp_user_tbl WHERE send_id='".$sendlist."' AND user_id = '".$user."'";
$check_record 	    =     mysql_query($check); 
if($check_record)
{
$fetch_check_record =     mysql_fetch_array($check_record);

if($fetch_check_record['clicks']=='0')
{

 $insert       =     "update comp_user_tbl set clicks = '1' where send_id='".$sendlist."'  and user_id ='".$user."'" ;
$rows_affected = mysql_query($insert); 
}

}





$item_save1  =  $php_mail->get_blast_templates($sendlist,$company_admin);

?>
<center>
  <?php 

if(trim($item_save1['org_content']) !="")
echo stripslashes($item_save1['org_content']); 
  else
  {
  
  ?>
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Email Subscription</title>
  </head>
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
</style>
  <body style="margin:0px; padding:0px;">
  <div style="margin:0px auto; width:500px; background:#f2f2f2; padding:15px 15px 15px 15px; position:relative; border:1px solid #c0c0c0; ">
    <div style="background:#fff; padding:10px; margin-top:10px; border:1px solid #C0C0C0;" class="content">
      <h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Sorry</span></h1>
      <p>We Could not Find Your Subscription.</p>
      <div class="spacer"></div>
    </div>
  </div>
  </body>
  </body>
  </html>
  <?php


} ?>
</center>
