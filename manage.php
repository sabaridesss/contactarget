<?php
include("smarty_config.php");
if(isset($_REQUEST['user']))
{
$encoded=$_REQUEST['user'];
$del_query    =  "SELECT * FROM user_tbl where subscribe='0' AND  id=".unserialize(gzuncompress(stripslashes(base64_decode(strtr($encoded, '-_,', '+/=')))));
$del1_query   =   mysql_query($del_query);
$email_count          =  mysql_num_rows($del1_query);

}
$msg="";
if($_REQUEST['receive'])
{
$id=unserialize(gzuncompress(stripslashes(base64_decode(strtr($_REQUEST['receive'], '-_,', '+/=')))));
$del_query    =  "update user_tbl set subscribe ='1' where id=".$id;
$del1_query   =   mysql_query($del_query);
$email_count="Dactive";
if(!$del1_query)
$msg='<div style="background:#fff; padding:10px; margin-top:10px; border:1px solid #C0C0C0;" class="content"><h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">We Could not find Your Subscription</span></h1></div>';
else
$msg='<div style="background:#fff; padding:10px; margin-top:10px; border:1px solid #C0C0C0;" class="content"><h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Your Subscription Deactivated Successfully</span></h1><div>';

}



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

  <?php if($email_count>0 && $email_count!="Dactive") {  ?>
  <div style="background:#fff; padding:10px; margin-top:10px; border:1px solid #C0C0C0;" class="content">
    <h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Cancel Email Subscription</span></h1>
    <p>Are you sure you wish to end your email subscription .</p>
    <div class="spacer"></div>
  </div>
  <div align="center">
    <div class="spacer"></div>
    <div style="display:inline-block; margin-top:10px;">
      <form action="" method="post">
        <input type="hidden"  value="<?=$encoded?>" name="receive" id="receive">
        <input type="submit" value="Yes, unsubscribe me now" >
      </form>
    </div>
    
  </div>
  <?php } else if($email_count==0 && $email_count!="Dactive") { ?>
  <div style="background:#fff; padding:10px; margin-top:10px; border:1px solid #C0C0C0;" class="content">
    <h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Email Subscription</span></h1>
    <p>We Could not Find Your Subscription.</p>
    <div class="spacer"></div>
  </div>
  
  <?php } else if($email_count==0 && $msg=="") {
  
  
?>
 <div style="background:#fff; padding:10px; margin-top:10px; border:1px solid #C0C0C0;" class="content">
    <h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Email Subscription</span></h1>
    <p>We Could not Find Your Subscription.</p>
    <div class="spacer"></div>
  </div>

<?php 
 } 
  else { 
  
  
  echo $msg;
 } 
 ?>
</div>
</body>
</body>
</html>
