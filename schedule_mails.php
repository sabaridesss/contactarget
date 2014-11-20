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

 $mail_check              =  $item_save['status'];
 $camp_id                 =  $item_save['camp_id'];
 $email_subject           =  $item_save['email_subject'];
 $from_name               =  $item_save['from_name'];
 $from_email              =  $item_save['from_email'];
 $template_type           =  $item_save['template_type'];
 $select_email_org        = unserialize(stripslashes($item_save['to_address']));
if(isset($_REQUEST['Submit']))
{

$datepicker       =     $_REQUEST['datepicker'];
$schedule_hour    =     $_REQUEST['schedule_hour']; 
$schedule_min     =     $_REQUEST['schedule_min'];


	$sPieces = explode("/", $datepicker);
	$schedule_date = $sPieces[2].'-'.$sPieces[0].'-'.$sPieces[1]." ".$schedule_hour.":".$schedule_min.":00";


if(isset($_REQUEST['camp_id']))
{
$field_types    =     array('schedule_mail'         => $schedule_date);

$Update_campaign  = $php_mail->Update_Blast_single('compaign_name',$_REQUEST['camp_id'],'id',$field_types);
header("location:savedmail_list.php?msg=5&camp_id=".$_REQUEST['camp_id']);
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


function Clear_Alert(error){
	document.getElementById(error).innerHTML = "";	
}
</script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/resources/demos/style.css">
<script>
  $(function() {
 $('#datepicker').datepicker({ minDate: 0, });
    
  });
  
  
  
  
   
function checkdate(){
//02/04/2014
var EnteredDate   = document.getElementById("datepicker").value; //for javascript
var schedule_hour = document.getElementById("schedule_hour").value; //for javascript
var schedule_min  = document.getElementById("schedule_min").value; //for javascript
var month         = EnteredDate.substring(0, 2);
var date 		  = EnteredDate.substring(3, 5);
var year 		  = EnteredDate.substring(6, 10);
var myDate 		  = new Date(year, month - 1, date , schedule_hour , schedule_min , "00");

var d = new Date();
var utc = d.getTime() + (d.getTimezoneOffset() * 60000);
var today 		  = new Date(utc + (3600000*(-6)));
if(EnteredDate=="") {
 alert("Please Select Valid Date and Time");
 return false;
}
else if (myDate > today) {
return true;
}
else {
alert("Please Enter Future Date and Time");
return false;
}
}
  
  
  </script>
<form name="content_add" method="post" action=""  onsubmit="return checkdate()" enctype="multipart/form-data">
 
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
          <div  class="content"> <br>
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top"><span style="float:left">Schedule Mail</span><span style="float:right">Time Now: <?php echo date("m/d/Y");?> &nbsp;<script type="text/javascript">
<!--
	//var currentTime = new Date()
	
	 var d = new Date();
     var utc = d.getTime() + (d.getTimezoneOffset() * 60000);
     var nd = new Date(utc + (3600000*(-6)));
	 var hours = nd.getHours()
	 var minutes = nd.getMinutes()

	if (minutes < 10)
	minutes = "0" + minutes

	document.write("<b>" + hours + ":" + minutes + " " + "</b>")
//-->
</script>&nbsp;</span></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><?php
	if($mail_check != "complete")
	{
	?>
                  <table  border="0" width="100%"  align="center" cellpadding="5" >
                    <tr>
                      <td align="right" valign="top"  width="30%" >Delivery date:</td>
                      <td  width="10%" ><input name="datepicker" type="text" id="datepicker" value=""  size="90" class="input-xlarge focused"/>
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="compaignname_error"></span></td>
                    </tr>
                    <tr>
                      <td  align="right" valign="top" id="title_name">Time:</td>
                      <td  align="left"><?php $date_now_schedule=date("H");
						 
						  $date_now_schedule;?>
                        <select style="width:100px;"  name="schedule_hour" id="schedule_hour" >
                          <option  <?php if($date_now_schedule=="0") echo 'selected="selected"'; ?> value="00">00</option>
                          <option  <?php if($date_now_schedule=="1") echo 'selected="selected"'; ?>  value="01">01</option>
                          <option   <?php if($date_now_schedule=="2") echo 'selected="selected"'; ?>  value="02">02</option>
                          <option   <?php if($date_now_schedule=="3") echo 'selected="selected"'; ?>  value="03">03</option>
                          <option   <?php if($date_now_schedule=="4") echo 'selected="selected"'; ?>  value="04">04</option>
                          <option   <?php if($date_now_schedule=="5") echo 'selected="selected"'; ?>  value="05">05</option>
                          <option  <?php if($date_now_schedule=="6") echo 'selected="selected"'; ?>   value="06">06</option>
                          <option   <?php if($date_now_schedule=="7") echo 'selected="selected"'; ?>  value="07">07</option>
                          <option  <?php if($date_now_schedule=="8") echo 'selected="selected"'; ?>   value="08">08</option>
                          <option  <?php if($date_now_schedule=="9") echo 'selected="selected"'; ?>   value="09">09</option>
                          <option  <?php if($date_now_schedule=="10") echo 'selected="selected"'; ?>   value="10">10</option>
                          <option  <?php if($date_now_schedule=="11") echo 'selected="selected"'; ?>   value="11">11</option>
                          <option  <?php if($date_now_schedule=="12") echo 'selected="selected"'; ?>   value="12">12</option>
                          <option  <?php if($date_now_schedule=="13") echo 'selected="selected"'; ?>   value="13">13</option>
                          <option  <?php if($date_now_schedule=="14") echo 'selected="selected"'; ?>   value="14">14</option>
                          <option  <?php if($date_now_schedule=="15") echo 'selected="selected"'; ?>   value="15">15</option>
                          <option  <?php if($date_now_schedule=="16") echo 'selected="selected"'; ?>   value="16">16</option>
                          <option  <?php if($date_now_schedule=="17") echo 'selected="selected"'; ?>   value="17">17</option>
                          <option  <?php if($date_now_schedule=="18") echo 'selected="selected"'; ?>   value="18">18</option>
                          <option  <?php if($date_now_schedule=="19") echo 'selected="selected"'; ?>   value="19">19</option>
                          <option  <?php if($date_now_schedule=="20") echo 'selected="selected"'; ?>   value="20">20</option>
                          <option  <?php if($date_now_schedule=="21") echo 'selected="selected"'; ?>   value="21">21</option>
                          <option  <?php if($date_now_schedule=="22") echo 'selected="selected"'; ?>   value="22">22</option>
                          <option  <?php if($date_now_schedule=="23") echo 'selected="selected"'; ?>   value="23">23</option>
                        </select>
                        <select style="width:100px;" name="schedule_min" id="schedule_min" >
                          <!-- <option value="0" >--Select--</option>-->
                          <option  value="00">00</option>
                          <option  value="15">15</option>
                          <option  value="30">30</option>
                          <option  value="45">45</option>
                        </select>
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="select_email_error"></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;&nbsp;&nbsp;
                        <input  type="submit" name="Submit" value="Schedule" class="btn btn-large btn-primary"  />
                        <!-- <input type="submit" name="Cancel_mail" value="Cancel" class="btn btn-large btn-primary" />-->
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
                    <strong>oops sorry!</strong> You can't use this Email Campaign </div>
                  <?php
	}
	?>
                </td>
              </tr>
            </table>
            <?php
			$camp_id = $_REQUEST['camp_id'];
			if($camp_id != "")
			{
			?>
            <div align="center">
              <ul id="status-page"  class="status-page">
                <li class="step step1 "> <a  href="select_campaign.php?camp_id=<?=$camp_id;?>" class="" id="step1">Campaigns</a> </li>
                <li class="step step2 "> <a href="select_template.php?camp_id=<?=$camp_id;?>" class="" id="step1">Template Selection</a> </li>
                <?php 
               if($template_type != "")
			   {
             
                  if($template_type == 'static')
				  {
				  ?>
                <li class="step step3  "><a   href="edit_dynamic_template.php?camp_id=<?=$camp_id;?>" class="" id="step3">Design</a> </li>
                <?php
				}
				else
				{
			?>
                <li class="step step3  "><a   href="dynamic_template.php?camp_id=<?=$camp_id;?>" class="" id="step3">Design</a> </li>
                <?php
			    }
			?>
                <?php
			  } else {  ?>
                <li class="step step3  "><a  href="javascript:void(0);" class="" id="step3">Design</a> </li>
                <?php  }   if(trim($org_content)!="") {  ?>
                <li class="step step5  "> <a href="preview_blast.php?camp_id=<?=$camp_id;?>" class="" id="step5">Preview</a> </li>
                <?php } else {  ?>
                <li class="step step5  "> <a href="javascript:void(0);" class="" id="step5">Preview</a> </li>
                <?php } ?>
                <li class="step step5  current last"> <a href="javascript:void(0);" class="" id="step5">Schedule</a> </li>
              </ul>
              <div style="clear:both;"></div>
            </div>
            <?php
			}
			?>
            <div style="clear:both;"></div>
            <!--welcome admin end here-->
            <div style="clear:both;"></div>
            <table>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
          </div>
          <!--footer start here-->
          <?php include('common/footer.php'); ?>
          <!--footer end here-->
        </div></td>
    </tr>
  </table>
</form>
</center>
</body></html>