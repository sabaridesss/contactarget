<?php
ini_set('max_execution_time', 5000);
set_time_limit(0);
ini_set('display_errors',"1");
include("smarty_config.php");
//include("top_menu.php");

$INCLUDE_DIR = "mailer/";
    require($INCLUDE_DIR . "class.phpmailer.php");
	$mail = new PHPMailer();



if(isset($_REQUEST['Cancel_mail']) && $_REQUEST['Cancel_mail'] == 'Cancel' )
{

unset($_SESSION['content_desc']);
unset($_SESSION['subject']);
unset($_SESSION['mail_from']);
unset($_SESSION['new_file_name']);
unset($_SESSION['camp_name']);
unset($_SESSION['send_id']);
unset($_SESSION['mail_count']);
unset($_SESSION['select_email']);
header("location:mail_subscribers.php");
exit;
}

if(isset($_REQUEST['filter_mail']) && $_REQUEST['filter_mail'] == 'Check Spam' )
{

 $subject          =     $_REQUEST['mailsubject'];
 $mail_from        =     $_REQUEST['select_from_email'];
 $new_file_name    =     $_FILES["mailattach"]["name"];
 $camp_name        =     $_REQUEST['compaignname'];
  $select_email        =     $_REQUEST['select_email'];
  $template        =     $_REQUEST['template'];
  
  
 
	$content_desc     =     $_REQUEST['content_desc']; 
   
	
	$query_spam  = "select * from email_spam";
	$spam_result = mysql_query($query_spam);	
	$spam_content_count=mysql_num_rows($spam_result);
	$spam_count_start=1;
	$found = false;
    $msg= "Spam Content Found :";
	while($email_spam_data = mysql_fetch_array($spam_result))
	{

		if (stripos($content_desc, $email_spam_data['cate_name']) !== false) {
        $found = true;
		$msg.= "-".$email_spam_data['cate_name'];
     
    }
  }
	


if (!$found) {
$msg="No Spam Content Found";

}
}

$template_header ='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
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
<div style="margin:0px auto; width:500px; padding:15px 15px 15px 15px; position:relative; border:1px solid #c0c0c0; ">

  </div>
  <div align="center"> <img class="img_cls" src="http://www.contacttarget.com/uploads/'.$logo.'" alt="" title="" style="margin-top:15px;"  />
    <div class="spacer"></div>
   
</div>
</body>
</html>
';
	


       $send = $template_header;
          $mail->IsSMTP();	     
	      $mail->SetLanguage( 'en', 'mailer/language/' );                                    // send via SMTP
          $mail->Host = "smtp.1and1.com";	
		  $mail->Port     = 587;	
		 // $mail->Port     = 2525; // SMTP Port
		//	$mail->SMTPAuth = false;     // turn on SMTP authentication
		//	$mail->Username = "bounce@contacttarget.com";  // SMTP username
			//$mail->Password = "1234567"; // SMTP password*/
			$mail->Username = "rajan@local-listing.us";  // SMTP username
            $mail->Password = "1234567"; // SMTP password*/
			$mail->From     = "rajan@local-listing.us";
			
			//$mail->FromName = $fet_qual['company_name'];
			$mail->FromName = "Desss";
			//$mail->addAttachment($banPathNme);
           // $mail->AddReplyTo("info@antiquesmallonline.com",$campaign_id."+15#".$send_id);	
			$mail->AddAddress("sabari@desss.com");	

$mail->IsHTML(true);                              
$mail->Subject  =  $subject;
$mail->Body     =  $send;
    if($mail->Send())
    {
	 $no_send[]    = $userid;
	 echo "Mail Sent Successfully";
    }
	else
	{
	$no_failure[] = $userid ;
	 echo "Mailer Error: " . $mail->ErrorInfo;
	 
	}
$mail->ClearAddresses();
$mail->ClearReplyTos();
$banPathNme = '';

exit;

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
<form name="content_add" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" value="<?=$content_id?>" id="sub_catid" />
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
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
                <!-- <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="usermail_list.php">User List</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="Campaign.php"> Campaign</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="campaign_list.php"> Results</a></div></td>-->
              </tr>
            </table>
          </div>
          <div class="content"><br>
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top">Blast </td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><?php
	if($_SESSION['mail_count1'] == "")
	{
	?>
                  <table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="17%" align="right" valign="top" id="title_name">To:</td>
                      <td width="83%" align="left"><select name="select_email[]" id="select" multiple="multiple" >
                          <!--   <option selected>--Select--</option>-->
                          <option <?php if($select_email=='all') echo 'selected="selected"'; ?> value="All">All</option>
                          <?php  $sel_tbl_link_cat="SELECT * FROM camp_categ where company_admin='$company_admin'  order by cat_order ASC";
				  
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
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">From:</td>
                      <td align="left"><select name="select_from_email" id="select_from_email">
                          <!-- <option>--Select--</option>-->
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
                      <td align=""><select name="compaignname" id="compaignname" class="login-textarea1"  style="width:50%"   tabindex="13"  >
                          <!-- <option  id="compaignname" value="0" >--Select Names--</option>-->
                          <?php  $sel_tbl_link_cat="SELECT * FROM campaign_list where company_admin='$company_admin' ";
				  
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
                      <td align=""><select name="template" id="template" class="login-textarea1"  style="width:50%"   tabindex="13" >
                          <option  id="template" value="0" >--Select Template--</option>
                          <?php  $sel_tbl_link_cat="SELECT * FROM emailnl_template_tbl where company_admin='$company_admin' ";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                          <option <?php if($template==$tbl_link_cat_Fetch['id']) echo 'selected="selected"'; ?>  id="template" value="<?php 
								echo $tbl_link_cat_Fetch['id'];?>" >
                          <?php  echo $tbl_link_cat_Fetch['title'];?>
                          </option>
                          <?php }?>
                        </select>
                        <div id="design_html"></div></td>
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
                            <td align="center"><textarea name="content_desc" class="login-textarea1" cols="175"><?=$content_desc?>
</textarea>
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
                      <td align=""><input type="hidden" name="hid_id" value="<?=$row2['id']?>" />
                        <?php if($_REQUEST['id'] != '' ) {?>
                        <a  rel="popuprel" class="popup"><input type="submit" name="Submit" value="Send" class="addmenu2"  /></a>
                        &nbsp;&nbsp;&nbsp;
                        <?php } else {?>
                        <a  rel="popuprel" class="popup"> <input type="submit" name="Submit" value="Send" class="addmenu2"  /></a>
                        &nbsp;&nbsp;&nbsp;
                        <?php }?>
                        <input type="submit" name="filter_mail" value="Check Spam" class="addmenu2" />
                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" name="Cancel_mail" value="Cancel" class="addmenu2" />
                      </td>
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
                  You have
                  <?=$total_count;?>
                  subscribers in  user List. Can you want to  send the same campaign to all of them.
                  <input type="submit" name="Submit" value="Send" class="addmenu2" />
                  &nbsp;&nbsp;&nbsp;
                  <input type="submit" name="Submit" value="Spam Filter" class="addmenu2" />
                  <?php
    }
	?>
                </td>
              </tr>
            </table>
            <div id="fade"  style="padding:10px 10px" align="center"> <div style="height:50px;">&nbsp;</div><img src="ajax_load.gif" width="120" height="120"> <span style="color:#FFFFFF">Progressing....</span></div>
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
</body></html>