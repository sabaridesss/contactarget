<?php
ini_set('max_execution_time', 5000);
ini_set('display_errors',"1");
include("smarty_config.php");
//include("top_menu.php");


$INCLUDE_DIR = "mailer/";
    require($INCLUDE_DIR . "class.phpmailer.php");
	$mail = new PHPMailer();

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} 

else 

{
if(isset($_REQUEST['Cancel_mail']) && $_REQUEST['Cancel_mail'] == 'Cancel' )
{

unset($_SESSION['content_desc']);
unset($_SESSION['subject']);
unset($_SESSION['mail_from']);
unset($_SESSION['new_file_name']);
unset($_SESSION['camp_name']);
unset($_SESSION['send_id']);
unset($_SESSION['mail_count']);
header("location:mail_subscribers.php");
exit;
}





if(isset($_REQUEST['filter_mail']) && $_REQUEST['filter_mail'] == 'Check Spam' )
{

  $subject          =     $_REQUEST['mailsubject'];
  $mail_from        =     $_REQUEST['select_from_email'];
  $new_file_name    =     $_FILES["mailattach"]["name"];
  $camp_name        =     $_REQUEST['compaignname'];
  $select_email     =     $_REQUEST['select_email'];
  $template         =     $_REQUEST['template'];
  
  
 
$content_desc     =     $_REQUEST['content_desc'];
 
 
 $keywords = array('100% satisfied','4U','Accept credit cards','Act Now!','Additional Income','Affordable','All natural','All new','Amazing','Free','
Apply online','Bargain','Best price','Billing address','Buy direct','Call','Call free','Can�t live without','Cards Accepted','
Cents on the dollar','Check','Claims','Click','Click Here', 'Click Below','Click to remove','Compare','rates','Congratulations','Cost',' No cost','Dear friend','Do it today','Extra income','For free','Form','Free and FREE','
Free installation','Free leads','Free membership','Free offer','Free preview','Free website','Full refund','Get it now','Giving away','Guarantee','Here','Hidden','Increase sales','Increase traffic','Information you requested','Insurance','Investment ','no investment ','Investment decision','Legal','Lose','Marketing','Marketing solutions','Message contains','Money','Month trial offer','Name brand','Never','No gimmicks','No Hidden Costs','No-obligation','Now','Offer','One time ','one-time','Opportunity','Order ',' Order Now ',' Order today ',' Order status','Orders shipped by priority mail','Performance','Phone','Please read','Potential earnings','Pre-approved','Price','Print out and fax','Profits','Real thing','Removal instructions','Remove','Risk free','Sales','Satisfaction guaranteed','Save up to','Search engines','See for yourself','Serious cash','Solution','Special promotion','Success','The following form','Unsolicited','Unsubscribe','Urgent','US dollars','Wife','Win','Winner','Work at home');

 $found = false;
$msg= "Spam Content Found :";
foreach ($keywords as $keyword) {
    if (stripos($content_desc, $keyword) !== false) {
        $found = true;
		$msg.= "-".$keyword;
     
    }
}

if (!$found) {
$msg="No Spam Content Found";
break;

}
}
if(((isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Send')) || isset($_SESSION['mail_count']))
{

/* $content_desc     =     $_REQUEST['content_desc'];
 $subject          =     $_REQUEST['mailsubject'];
 $mail_from        =     $_REQUEST['select_from_email'];
 $new_file_name    =     $_FILES["mailattach"]["name"];
 $camp_name        =     $_REQUEST['compaignname'];*/ 
  $template        =     $_REQUEST['template'];
 if($_SESSION['content_desc'] == "")
{
 $_SESSION['content_desc']    =     $_REQUEST['content_desc'];
}
if($_SESSION['subject'] == "")
{
 $_SESSION['subject']          =     $_REQUEST['mailsubject'];
}
if($_SESSION['mail_from'] == "")
{
 $_SESSION['mail_from']        =     $_REQUEST['select_from_email'];
}
if($_SESSION['new_file_name'] == "")
{
 $_SESSION['new_file_name']    =     $_FILES["mailattach"]["name"];
}
if($_SESSION['camp_name'] == "")
{
 $_SESSION['camp_name']        =     $_REQUEST['compaignname']; 
}
if($_SESSION['select_email'] == "")
{
 $_SESSION['select_email']        =     $_REQUEST['select_email']; 
}
if($new_file_name!="")
{

$eventfileTmp      =     $_FILES["mailattach"]["tmp_name"];
 $file1Path        =     "upload/";
 $banPathNme       =     $file1Path.$new_file_name;
 $upload           =     move_uploaded_file($eventfileTmp,$banPathNme);
}	
	if($_SESSION['select_email'] == 'All')
	{
	$cond = "";
	}
	else
	{
	$cond = $_SESSION['select_email'];
	}
	 //$email_query_count    = "SELECT * FROM user_tbl where status = '0' ".$cond." order by id";
	 $email_display_count  =  mysql_query("call Get_User_List ('FIRST','".$cond ."')");
	echo $email_count          =  mysql_num_rows($email_display_count);
	
	$campaign_id = $_SESSION['camp_name'];
	if($_SESSION['send_id'] == "")
	{
	$query_camp  = "select * from campaign_list where id = ".$_SESSION['camp_name'];
	$camp_result = mysql_query($query_camp);
	$fet_camp    =   mysql_fetch_array($camp_result);
	$phone=$fet_camp['phone'];
	
    $comp_insert_query    =   "insert into compaign_name(compaign_name,camp_id) values('".$_SESSION['subject']."','".$campaign_id."')";
    $comp_impl_query      =  mysql_query($comp_insert_query);
	$_SESSION['send_id']    =  mysql_insert_id();
	}
	else
	{
	$camp_result = 1;
	}

	if($camp_result)
	{
	
	//$email_query  = "SELECT * FROM user_tbl where status = '0' AND subscribe = '0'  ".$cond." order by id limit 0,40";
	$email_result = mysql_query("call Get_User_List ('SECOND','$cond')");
	echo mysql_num_rows($email_result);
	exit;
	$counti = 0;
	
	while($email_data = mysql_fetch_array($email_result))
	{
	
/*	if($i == 30)
	{
	sleep(10);
	}*/
	$email_address = "";
	$f_name        = $email_data["firstname"];
	$l_name        = $email_data["lastname"];
	$userid        = $email_data["id"];
	 
	
	$email_address .= $email_data["email"];
	$headers1      = $_REQUEST['select_from_email'];

	 
    $name_bounce   =  'eblast@desss.com';
	
		  $send ='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$_SESSION['camp_name'].'</title>
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
</head>
<body style="margin:0px; padding:0px;">
<div style="margin:0px auto; width:500px; background:#f2f2f2; padding:15px 15px 15px 15px; position:relative; border:1px solid #c0c0c0; ">';
$send.=	"<img width='1px' height='1px' src='http://www.desss.com/admin/get_count.php?sent_id=".$email_address."&id=".$campaign_id."&sendlist=".$_SESSION['send_id']."' align='left' style='position:absolute; left:10px; top:0px;'  />"; 
  $send.='<img src="http://www.desss.com/admin/mail_logo/services_many.png" style=" float:right;">
  <div style="clear:both;"></div>
  <p style="font:bold 18px/25px Verdana, Geneva, sans-serif; color:#f85601;" align="right">'.$phone.'</p>
  <div style="clear:both;"></div>
  <div style="background:#fff; padding:10px; margin-top:10px; border:1px solid #C0C0C0;" class="content">
    <h1 style=" margin:0px 0px 0px 0px;"><span style="font:normal 18px/24px Verdana, Geneva, sans-serif; color:#f85601; margin:0px 0px 0px 0px;">Hello '.$f_name.'</span></h1>';
	
 $send.=$_SESSION['content_desc'];

$send .= '<div class="spacer"></div><div align="center"> <a href="#"><img src="http://www.desss.com/admin/mail_logo/desss-logo_footer.png" alt="" title="" style="margin-top:15px;" /></a>
    <div class="spacer"></div>
    <div style="display:inline-block; margin-top:10px;"> <font color="#909c9f" size="2" face="Arial"> <span style="font-size:12px;"> <a style="color:#FD600B;text-decoration:none;"  href="'.$fet_camp['c_url'].'?campid='.$campaign_id.'&user='.$userid.'&sendlist='.$_SESSION['send_id'].'">Click here </a>if this email does not display correctly </span> </font> </div>
	<div style="display:inline-block; margin-top:10px;"> <font color="#909c9f" size="2" face="Arial"> <span style="font-size:12px;"> To stop receiving these emails, you may<a target="_blank" style="color:#FD600B;text-decoration:none;"  href="http://www.desss.com/newsletter/manage.php?user='.$userid.'"> unsubscribe now. </a> </span> </font> </div>
    <p style="font:normal 12px/24px Verdana, Geneva, sans-serif; color:#515151;	margin:10px 0px 0px 0px;">CopyRight &copy; All rights reserved | Powered by <a href="http://www.desss.com" style="color:#f85601;">Desss Inc</a></p>
  </div>
</div>
</body>
</html>';

			$mail->IsSMTP();                                   // send via SMTP
			$mail->Host = "smtp.1and1.com";
			//$mail->Host     = "smtp.gmail.com"; // SMTP servers
			$mail->Port     = 587; // SMTP Port
			$mail->SMTPAuth = true;     // turn on SMTP authentication
			$mail->Username = "eblast@desss.com";  // SMTP username
			$mail->Password = "1234567"; // SMTP password
			$mail->From     = "eblast@desss.com";
			//$mail->FromName = $fet_qual['company_name'];
			$mail->FromName = "Desss";
			$mail->addAttachment($banPathNme);
            $mail->AddReplyTo($headers1,$campaign_id."+15#".$_SESSION['send_id']);	
			$mail->AddAddress($email_address);	

$mail->IsHTML(true);                              
$mail->Subject  =  $_SESSION['subject'];
$mail->Body     =  $send;
    if($mail->Send())
    {
  $insert_query  = "insert into comp_user_tbl(firstname,lastname,email,content,campaign_name,send_id,no_of_sent) values('".$f_name."','".$l_name."','".$email_address."','".$_SESSION['content_desc']."','".$campaign_id."','".$_SESSION['send_id']."',1)";
     $impl_query    =  mysql_query($insert_query);
	 $del_query    =  "update user_tbl set status ='1' where id=".$userid;
	 $del1_query   =   mysql_query($del_query);
    }
	else
	{
	$insert_query  = "insert into comp_user_tbl(firstname,lastname,email,content,campaign_name,send_id,no_of_fail) values('".$f_name."','".$l_name."','".$email_address."','".$_SESSION['content_desc']."','".$campaign_id."','".$_SESSION['send_id']."',1)";
    $impl_query    =  mysql_query($insert_query);
	}
$mail->ClearAddresses();
$mail->ClearReplyTos();
$banPathNme = '';
   $counti++;
    }	
$total_count = $email_count -  $counti; 	
if($total_count <= 0)
{
unset($_SESSION['content_desc']);
unset($_SESSION['subject']);
unset($_SESSION['mail_from']);
unset($_SESSION['new_file_name']);
unset($_SESSION['camp_name']);
unset($_SESSION['send_id']);
unset($_SESSION['mail_count']);
unset($_SESSION['select_email']);
$del_query_1    =  "update user_tbl set status ='0'";
$del1_query_2   =   mysql_query($del_query_1);
header("Location:campaign.php?msg=1");	
exit;	
}
else
{
$_SESSION['mail_count']  = 1;
header("Location:mail_subscribers.php");	
exit;
}		
}
 }

}

?>

<?php include ('common/header.php')?>
<link rel="stylesheet" href="css/tinypopup_style.css" />
<script type="text/javascript" src="javascript/tinybox.js"></script>
  <script type="application/javascript">
function pagevalue_type(val_name)
{

$.ajax({
type: "POST",
url: "template_email_preview.php",
data: "&type_page_id="+val_name,
success: function(html){
//Calling the ajax process php url
$("#design_html").html(html);
//Calling the responce IDs
}
});
}
</script>
<form name="content_add" method="post" action="" enctype="multipart/form-data">
<input type="hidden" value="<?=$content_id?>" id="sub_catid" />
<table width="1200px" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	<?php include('common/top_menu.php') ?>
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
    <?php
	if($_REQUEST['msg']==1)
	{
	$msg= "Mail Send Successfully";
	}
	?>
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="usermail_list.php">User List</a></div></td><td width="25%" align="right" valign="middle">&nbsp;</td>
    <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="Campaign.php"> Campaign</a></div></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
    <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="campaign_list.php"> Results</a></div></td>
  </tr>
</table>
</div>
<div class="content"><br>
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Email Tool</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner">
    <?php
	if($_SESSION['mail_count1'] == "")
	{
	?>
    <table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="17%" align="right" valign="top" id="title_name">To:</td>
        <td width="83%" align="left"><select name="select_email" id="select">
                <option selected>--Select--</option>
                <option <?php if($select_email=='all') echo 'selected="selected"'; ?> value="All">All</option>
        <?php  $sel_tbl_link_cat="SELECT * FROM camp_categ order by cat_order ASC";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                              <option  value="<?php 
								echo $tbl_link_cat_Fetch['cate_name'];?>" <?php
                    if($select_email == $tbl_link_cat_Fetch['cate_name'])
					{
					echo 'selected="selected"';
					}
					?> >
                              <?php  echo $tbl_link_cat_Fetch['cate_name'];?>
                              </option>
                              <?php }?></select></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">From:</td>
        <td align="left"><select name="select_from_email" id="select_from_email">
                <option>--Select--</option>
                <option <?php if($mail_from=='info@socialevening.com') echo 'selected="selected"'; ?>  value="info@socialevening.com">info@socialevening.com</option>
                <?php 
/*				$sel_user =  "select * from mail_address";
				$sel_imp  =  mysql_query($sel_user);
				while($sel_fet  =  mysql_fetch_array($sel_imp))
				{
				?>
                <option value="<?=$sel_fet['mail'];?>"><?=$sel_fet['company_name'];?></option>
              <?php
			  }*/
			  ?>
              </select></td>
      </tr>
      <tr>
        <td align="right" valign="top">Subject:</td>
        <td align=""><input name="mailsubject" type="text" id="mailsubject" value="<?=$subject?>"  size="90" class="login-textarea1"/></td>
      </tr>
       <tr>
        <td align="right" valign="top">Compaign Name:</td>
        <td align="">
        <select name="compaignname" id="compaignname" class="login-textarea1"  style="width:50%"   tabindex="13"  >
                              <option  id="compaignname" value="0" >--Select Names--</option>
                              <?php  $sel_tbl_link_cat="SELECT * FROM campaign_list";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                              <option <?php if($camp_name==$tbl_link_cat_Fetch['id']) echo 'selected="selected"'; ?>  id="compaignname" value="<?php 
								echo $tbl_link_cat_Fetch['id'];?>" >
                              <?php  echo $tbl_link_cat_Fetch['c_name'];?>
                              </option>
                              <?php }?>
                            </select>
        
        
        
        
        </td>
      </tr>
      <tr>
        <td align="right" valign="top">Template:</td>
        <td align="">
        <select name="template" id="template" class="login-textarea1"  style="width:50%"   tabindex="13" onChange="return pagevalue_type(this.value);"  >
                              <option  id="template" value="0" >--Select Template--</option>
                              <?php  $sel_tbl_link_cat="SELECT * FROM emailnl_template_tbl";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                              <option <?php if($template==$tbl_link_cat_Fetch['id']) echo 'selected="selected"'; ?>  id="template" value="<?php 
								echo $tbl_link_cat_Fetch['id'];?>" >
                              <?php  echo $tbl_link_cat_Fetch['title'];?>
                              </option>
                              <?php }?>
                            </select>
        
        
        <div id="design_html"></div>
        
        </td>
      </tr>
      <tr>
        <td align="right" valign="top">Attachment:</td>
        <td align=""><input type="file" id="mailattach" name="mailattach" value="<?=$new_file_name?>" class="login-textarea1"></td>
      </tr>
      <tr>
        <td align="right" valign="top">Description:</td>
        <td align=""></td>
        </tr>
      <tr>
        <td colspan="2" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><textarea name="content_desc" class="login-textarea1" cols="175"><?=$content_desc?></textarea>
          <script type="text/javascript">
    CKEDITOR.replace('content_desc');
 </script></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<input type="hidden" name="hid_id" value="<?=$row2['id']?>" />
		<?php if($_REQUEST['id'] != '' ) {?>
		<input type="submit" name="Submit" value="Send" class="addmenu2" />&nbsp;&nbsp;&nbsp;
		<?php } else {?>
		<input type="submit" name="Submit" value="Send" class="addmenu2" />&nbsp;&nbsp;&nbsp;
		<?php }?>
    
        
		 <input type="submit" name="filter_mail" value="Check Spam" class="addmenu2" />     &nbsp;&nbsp;&nbsp; <input type="submit" name="Cancel_mail" value="Cancel" class="addmenu2" /> </td>
        </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
      </tr>
    </table>
    <?php
	}
	else
	{
	?>
	You have <?=$total_count;?> subscribers in  user List. Can you want to  send the same campaign to all of them.
    <input type="submit" name="Submit" value="Send" class="addmenu2" />
    &nbsp;&nbsp;&nbsp;
     <input type="submit" name="Submit" value="Spam Filter" class="addmenu2" />
    <?php
    }
	?>
    </td>
  </tr>
</table>
<p>&nbsp;</p>
</div>
<!--welcome admin end here-->
</div>
<!--footer start here-->
<?php include('common/footer.php'); ?>
<!--footer end here--></td>
  </tr>
</table>
</form>


</div>
</center>
</body>
</html>
