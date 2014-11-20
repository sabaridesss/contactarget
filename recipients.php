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

 $campaignid = $_REQUEST['camp_id'];
$item_save  =  $php_mail->get_blast_templates($campaignid,$company_admin);
//print_r($item_save);
 $mail_check        = $item_save['status'];
 $select_email_org        = unserialize(stripslashes($item_save['to_address']));
 
if(isset($_REQUEST['Submit']))
{

$select_email1  =     $_REQUEST['select_email'];
$camp_id        =     $_REQUEST['camp_id'];
$select_email=mysql_escape_string(serialize($select_email1));

$sqluser = $php_mail->update_to_address($camp_id,$select_email);
if($sqluser)
{
	header("location:select_template.php?camp_id=".$sqluser);
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
                <td align="left" valign="top" class="login-top">To which list shall we send?</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><?php
	if($mail_check != "complete")
	{
	?>
                  <table width="100%" border="0" align="center" cellpadding="5" >
                    <input name="camp_id" type="hidden" id="camp_id" value="<?=$_REQUEST['camp_id'];?>"  size="90" class="login-textarea1"/>
              <tr>
                      <td width="17%" align="right" valign="top" id="title_name">To:</td>
                      <td width="83%" align="left"><select onchange="Clear_Alert('select_email_error');" name="select_email[]" id="select_email" multiple="multiple" >
                          <!-- <option value="0" >--Select--</option>-->
                          <option <?php if(in_array('All', $select_email_org)=='All') echo 'selected="selected"'; ?> value="All">All</option>
                          <?php  $sel_tbl_link_cat="SELECT * FROM camp_categ where company_admin='$company_admin'  order by cat_order ASC";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                          <option  value="<?php 
								echo $tbl_link_cat_Fetch['cate_name'];?>" <?php
								
			
       
						$tval=in_array($tbl_link_cat_Fetch['cate_name'], $select_email_org);		
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
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">
                        <input onClick="return valid_mail_subscribe()" type="submit" name="Submit" value="Next" class="btn btn-large btn-primary"  />
                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" name="Cancel_mail" value="Cancel" class="btn btn-large btn-primary" />
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
     <div class="alert alert-error">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>oops sorry!</strong>
You can't use this Email Campaign
</div>
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