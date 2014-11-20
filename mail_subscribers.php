<?php
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
unset($_SESSION['select_email']);
header("location:campaign.php");
exit;
}




if($_REQUEST['savedmail'])
{
$savedmail=$_REQUEST['savedmail'];
$query2_saved= "select * from  save_mail_list where company_admin='$company_admin' and id = $savedmail";
$query_result_saved = mysql_query($query2_saved);
$item_save=mysql_fetch_array($query_result_saved);
	
$content_desc  =     $item_save['content_desc'];
$template      =     $item_save['template'];
$subject      =     $item_save['mailsubject'];
$mail_from     =     $item_save['select_from_email'];
$mailattach =     $item_save["mailattach"]["name"];
$camp_name    =     $item_save['compaignname']; 
$name           =     $item_save['from_name'];
$mailfrom       =     $item_save['from_mail'];
$banner= $item_save['banner']; 
$select_email= unserialize($item_save['select_email']);


}

if(isset($_REQUEST['Save']) && $_REQUEST['Save'] == 'Save' || $_REQUEST['Save'] == 'Save As' )
{

$content_desc  =     $_REQUEST['content_desc'];
$template      =     $_REQUEST['template'];
$mailsubject      =     $_REQUEST['mailsubject'];
$mail_from     =     $_REQUEST['select_from_email'];
$mailattach =     $_FILES["mailattach"]["name"];
$compaignname    =     $_REQUEST['compaignname']; 
$select_email1  =     $_REQUEST['select_email'];
$name           =     $_REQUEST['name'];
$mailfrom       =     $_REQUEST['mailfrom'];
$banner= $_SESSION['preview_banner'];
$to_count =  count($select_email1);
$select_email=mysql_escape_string(serialize($select_email1));



$sqluser = "insert into save_mail_list set
										content_desc='" . $content_desc . "',
										template='" . $template . "',
										mailsubject='" . $mailsubject . "',
										mail_from='" . $mail_from . "',
										banner='" . $banner . "',
										mailattach='" . $mailattach . "',
										compaignname='" . $compaignname . "',
										company_admin='" . $company_admin . "',
	                        			from_mail='" . $mailfrom . "',
										from_name='" . $name . "',
										select_email='" . $select_email . "'";
	
	if(!mysql_query ( $sqluser ))
	echo mysql_error();
	else
	header("location:savedmail_list.php?msg=2");
	


}
if(isset($_REQUEST['Update']) && $_REQUEST['Update'] == 'Update'  )
{
$updateid  =     $_REQUEST['updateid'];
$content_desc  =     $_REQUEST['content_desc'];
$template      =     $_REQUEST['template'];
$mailsubject      =     $_REQUEST['mailsubject'];
$mail_from     =     $_REQUEST['select_from_email'];
$mailattach =     $_FILES["mailattach"]["name"];
$compaignname    =     $_REQUEST['compaignname']; 
$select_email1  =     $_REQUEST['select_email'];
$name           =     $_REQUEST['name'];
$mailfrom       =     $_REQUEST['mailfrom'];
$banner= $_SESSION['preview_banner'];
$to_count =  count($select_email1);
$select_email=mysql_escape_string(serialize($select_email1));



$sqluser = "Update  save_mail_list set
										content_desc='" . $content_desc . "',
										template='" . $template . "',
										mailsubject='" . $mailsubject . "',
										mail_from='" . $mail_from . "',
										banner='" . $banner . "',
										mailattach='" . $mailattach . "',
										compaignname='" . $compaignname . "',
										company_admin='" . $company_admin . "',
		                       			from_mail='" . $mailfrom . "',
										from_name='" . $name . "',
										select_email='" . $select_email . "' 
										WHERE id=".$updateid;
	
	if(!mysql_query ( $sqluser ))
	echo mysql_error();
	else
	header("location:savedmail_list.php?msg=3");
	


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





if(((isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Send')) || isset($_SESSION['mail_count']))
{
$content_desc  =     $_REQUEST['content_desc'];
$template      =     $_REQUEST['template'];
$mailsubject      =     $_REQUEST['mailsubject'];
$mail_from     =     $_REQUEST['select_from_email'];
$mailattach =     $_FILES["mailattach"]["name"];
$compaignname    =     $_REQUEST['compaignname']; 
$select_email1  =     $_REQUEST['select_email'];
$name           =     $_REQUEST['name'];
$mailfrom       =     $_REQUEST['mailfrom'];
$banner= $_SESSION['preview_banner'];
$to_count =  count($select_email1);
$select_email=mysql_escape_string(serialize($select_email1));



$sqluser = "insert into save_mail_list set
										content_desc='" . $content_desc . "',
										template='" . $template . "',
										mailsubject='" . $mailsubject . "',
										mail_from='" . $mail_from . "',
										banner='" . $banner . "',
										mailattach='" . $mailattach . "',
										compaignname='" . $compaignname . "',
										company_admin='" . $company_admin . "',
										from_mail='" . $mailfrom . "',
										from_name='" . $name . "',
										select_email='" . $select_email . "'";
	
mysql_query($sqluser);
$last_insert_id   =   mysql_insert_id();
	header("location:preview_email.php?mailid=".$last_insert_id);
exit;
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
.alert_msg {
	color:#FF0000;
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

function valid_mail_subscribe()
{

var select_email=document.getElementById("select_email").value;
var mailsubject=document.getElementById("mailsubject").value;
var compaignname=document.getElementById("compaignname").value;
var template=document.getElementById("template").value;
var content_desc=CKEDITOR.instances.content_desc.getData();
if(select_email.length == 0) 
    {
		document.getElementById("select_email_error").innerHTML="Please Select To Address ";
		document.getElementById("select_email").focus();
		return false;
		}
		


   else if((mailsubject.length == 0)) {
   	document.getElementById("mailsubject_error").innerHTML="Please Enter Subject"; 
   		
		document.getElementById("mailsubject").focus();
        return false;
   }
   
  else if(compaignname == 0) {
   	document.getElementById("compaignname_error").innerHTML="Please Select Compaign "; 
   		
	document.getElementById("compaignname").focus();
       return false;
   }
	 else if(template == "")
	 {
   	
			document.getElementById("template_error").innerHTML="Please Select Template"; 
		document.getElementById("template").focus();
        return false;
   }
   
   else if(content_desc.length == 0 ){
         alert( 'Please Enter Content' );
    	
        return false;
}
	
	
}

function Clear_Alert(error){
	document.getElementById(error).innerHTML = "";	
}
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
                      <td width="83%" align="left"><select onchange="Clear_Alert('select_email_error');" name="select_email[]" id="select_email" multiple="multiple" >
                          <!-- <option value="0" >--Select--</option>-->
                          <option <?php if(in_array('All', $select_email)=='All') echo 'selected="selected"'; ?> value="All">All</option>
                          <?php  $sel_tbl_link_cat="SELECT * FROM camp_categ where company_admin='$company_admin'  order by cat_order ASC";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                          <option  value="<?php 
								echo $tbl_link_cat_Fetch['cate_name'];?>" <?php
								
			
       
						$tval=in_array($tbl_link_cat_Fetch['cate_name'], $select_email);		
                    if($tval == $tbl_link_cat_Fetch['cate_name'])
					{
					echo 'selected="selected"';
					}  
					?> 
                    
                    
                    >
                          <?php  echo $tbl_link_cat_Fetch['cate_name'];?>
                          </option>
                          <?php }?>
                        </select>
                        <span class="alert_msg" id="select_email_error"></span></td>
                    </tr>
                   <!-- <tr>
                      <td align="right" valign="top" id="title_name">From:</td>
                      <td align="left"><!--<select onchange="Clear_Alert('select_from_email_error')" name="select_from_email" id="select_from_email">
                          <option value="0">--Select--</option>
                          <?php 	$sel_user =  "select * from admin where id=$company_admin ";
				$sel_imp  =  mysql_query($sel_user);
				while($sel_fet  =  mysql_fetch_array($sel_imp))
				{
				?>
                          <option <?php
                    if($select_from_email == $tbl_link_cat_Fetch['cate_name'])
					{
					echo 'selected="selected"';
					}
					?>  value="<?=$sel_fet['bounce_email'];?>">
                          <?=$sel_fet['bounce_email'];?>
                          </option>
                          <?php
			  }
			  ?>
                        </select>
                        <span class="alert_msg" id="select_from_email_error"></span></td>
                    </tr>-->
                    <input name="select_from_email" type="hidden" id="select_from_email" value="<?=$subject?>"  size="90" class="login-textarea1"/>
                    <tr>
                      <td align="right" valign="top">Subject:</td>
                      <td align=""><input name="mailsubject" onkeyup="Clear_Alert('mailsubject_error')" type="text" id="mailsubject" value="<?=$subject?>"  size="90" class="login-textarea1"/>
                        <span class="alert_msg" id="mailsubject_error"></span></td>
                    </tr>
                       <tr>
                      <td align="right" valign="top">Name:</td>
                      <td align=""><input name="name"  type="text" id="name" value="<?=$name?>"  size="90" class="login-textarea1"/>
                        <span class="alert_msg" id="mailsubject_error"></span></td>
                    </tr>
                       <tr>
                      <td align="right" valign="top">Mail From:</td>
                      <td align=""><input name="mailfrom" onkeyup="Clear_Alert('mailsubject_error')" type="mailfrom" id="mailsubject" value="<?=$mailfrom?>"  size="90" class="login-textarea1"/>
                        <span class="alert_msg" id="mailsubject_error"></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Compaign Name:</td>
                      <td align=""><select name="compaignname" onchange="Clear_Alert('compaignname_error')" id="compaignname" class="login-textarea1"  style="width:50%"   tabindex="13"  >
                          <option  id="compaignname" value="0" >--Select Names--</option>
                          <?php  $sel_tbl_link_cat="SELECT * FROM campaign_list where company_admin='$company_admin' ";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                          <option <?php if($camp_name==$tbl_link_cat_Fetch['id']) echo 'selected="selected"'; ?>  id="compaignname" value="<?php 
								echo $tbl_link_cat_Fetch['id'];?>" >
                          <?php  echo $tbl_link_cat_Fetch['c_name'];?>
                          </option>
                          <?php }?>
                        </select>
                        <span class="alert_msg" id="compaignname_error"></span> </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Template:</td>
                      <td align=""><select name="template"  id="template" class="login-textarea1"  style="width:50%"   tabindex="13" onChange="return pagevalue_type(this.value),Clear_Alert('template_error')"  >
                          <option  id="template" value="" >--Select Template--</option>
                           <option  id="template" value="0" >Static Source</option>
                          <?php  $sel_tbl_link_cat="SELECT * FROM emailnl_template_tbl where company_admin='$company_admin' ";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                          <option <?php if($template==$tbl_link_cat_Fetch['id']) echo 'selected="selected"'; ?>  id="template" value="<?php 
								echo $tbl_link_cat_Fetch['id'];?>" >
                          <?php  echo $tbl_link_cat_Fetch['title'];?>
                          </option>
                          <?php }?>
                        </select>
                        <div id="design_html"></div>
                        <span class="alert_msg" id="template_error"></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Attachment:</td>
                      <td align=""><input type="file" id="mailattach" name="mailattach" value="<?=$new_file_name?>" class="login-textarea1"></td>
                    </tr>
                    
                    <tr>
                      <td align="right" valign="top">Banner Image   <input type="hidden" name="banner" value="<?=$banner?>" /></td>
                      <td align=""><a href="javascript:void(0)" onClick="window.open('email_banner_image.php?banner=<?=$banner?>',
'mywindow','width=550,height=410,top=200,left=300,scrollbars=yes'); ">Banner Images</a></td>
                    </tr>
                    
                    
                    <tr>
                      <td align="right" valign="top">Description:</td>
                      <td align=""></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="center">
                            
                            
                         
                            <textarea id="content_desc" name="content_desc" class="login-textarea1" cols="175"><?=$content_desc?>
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
                        <input type="submit" name="filter_mail" value="Check Spam" class="addmenu2" />
                        <?php if($_REQUEST['savedmail'])
						{?>
                        <input type="hidden" value="<?=$savedmail?>" name="updateid" id="updateid" />
                        &nbsp;&nbsp;&nbsp;
                        <input onclick="return valid_mail_subscribe()" type="submit" name="Save" value="Save As" class="addmenu2" />
                        &nbsp;&nbsp;&nbsp;
                        <input onclick="return valid_mail_subscribe()" type="submit" name="Update" value="Update" class="addmenu2" />
                        <?php } else {  ?>
                        <input onclick="return valid_mail_subscribe()" type="submit" name="Save" value="Save" class="addmenu2" />
                        <?php  } ?>
                        <input onclick="return valid_mail_subscribe()" type="submit" name="Submit" value="Send" class="addmenu2"  />
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
            <div id="fade"  style="padding:10px 10px" align="center">
              <div style="height:50px;">&nbsp;</div>
              <img src="ajax_load.gif" width="120" height="120"> <span style="color:#FFFFFF">Progressing....</span></div>
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