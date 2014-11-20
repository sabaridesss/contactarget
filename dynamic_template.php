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

$camp_id        =     $_REQUEST['camp_id'];
$fieldname      =     "org_content"; 
$get_description = $php_mail->get_field_templates($camp_id,$company_admin,$fieldname);
$item_save  =  $php_mail->get_blast_templates($camp_id,$company_admin);
//print_r($item_save);
 $mail_check        = $item_save['status'];
 $email_subject     = $item_save['email_subject']; 

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} 

else 

{
if(isset($_REQUEST['Submit']))
{
$content_desc  =     $_REQUEST['content_desc'];

$template_type =     "dynamic";
$camp_id        =     $_REQUEST['camp_id'];

preg_match_all('/<a href="(.*?)"/s',stripslashes($content_desc), $matches);
$org_content = stripslashes($content_desc);

$delete_url = $php_mail->delete_subject_campaign($company_admin,$camp_id); 
foreach($matches[1]  as $key => $value)
{
$org_url    =  $value;
$crypt_url  =  md5($org_url).time(); 

$insert_url =$php_mail->click_subject_campaign($company_admin,$org_url,$crypt_url,$camp_id); 

$org_content = str_replace($org_url, $fullpath."click_url_count.php?crypturl=".$crypt_url."&subid=".$camp_id, $org_content);

}
$pdfname   = $camp_id."-".preg_replace('/\s+/', '', strtolower($email_subject)).".pdf";
$htmlfiles = $camp_id."-".preg_replace('/\s+/', '', $email_subject).".html";
/*$fh = fopen("html/".$htmlfiles,'w') or die("can't open file");
fwrite($fh,stripslashes($content_desc));
fclose($fh);*/
 $sqluser = "Update  compaign_name set
										mail_content ='" .$org_content. "',
										org_content ='" .$content_desc. "',
										pdfname     ='" .$pdfname. "',
										template_type ='".$template_type."'
										WHERE id=".$camp_id;

    $comp_impl_query      =  mysql_query($sqluser);
	

	
/*include('html2fpdf.php');
$pdf=new HTML2FPDF();	
$pdf->AddPage();
 $strContent=stripslashes($_REQUEST['content_desc']);
$pdf->WriteHTML($strContent);
$pdf->Output("pdf/".$pdfname);*/

chmod("$pdfname",0777);
$fh = fopen('pdf/' .$pdfname, 'w') or die("can't open file");
fwrite($fh, $org_content);
fclose($fh);





if($comp_impl_query)
{
	header("location:preview_blast.php?camp_id=".$camp_id);
}
else{
echo mysql_error();
exit;
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
                <td align="left" valign="top" class="login-top">Dynamic Templates</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><?php
	if($mail_check != "complete")
	{
	?>
                  <table width="100%" border="0" align="center" cellpadding="5" >
                    <input name="camp_id" type="hidden" id="camp_id" value="<?=$_REQUEST['camp_id'];?>"  size="90" class="login-textarea1"/>
                    <tr>
                      <td align="right" valign="top">Code Your Own:</td>
                      <td align=""></td>
                    </tr>
                    <tr>
                      <td colspan="2" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="center"><textarea id="content_desc" name="content_desc" class="login-textarea1" cols="175"><?=stripslashes($get_description['org_content'])?>
</textarea>
                              <script type="text/javascript">
    CKEDITOR.replace('content_desc');
 </script></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><input onClick="return valid_mail_subscribe()" type="submit" name="Submit" value="Next" class="btn btn-large btn-primary"  />
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
                    <strong>oops sorry!</strong> You can't use this Email Campaign </div>
                  <?php
	}
	?>
                </td>
              </tr>
            </table>
            <!--welcome admin end here-->
          </div>
          <?php
			$camp_id = $_REQUEST['camp_id'];
			if($camp_id != "")
			{
			?>
          <div align="center">
            <ul id="status-page"  class="status-page">
              <li class="step step1 "> <a href="select_campaign.php?camp_id=<?=$camp_id;?>" class="" id="step1">Campaigns</a> </li>
              <li class="step step2 "> <a href="select_template.php?camp_id=<?=$camp_id;?>" class="" id="step1">Template Selection</a> </li>
              <?php 
               if($item_save['template_type']!= "")
			   {
             
                  if($item_save['template_type'] == 'static')
				  {
				  ?>
              <li class="step step3 current "><a   href="javascript:void(0);" class="" id="step3">Design</a> </li>
              <?php
				}
				else
				{
			?>
              <li class="step step3  current"><a   href="javascript:void(0);" class="" id="step3">Design</a> </li>
              <?php
			    }
			?>
              <?php
			  } else {  ?>
              <li class="step step3  current"><a  href="javascript:void(0);" class="" id="step3">Design</a> </li>
              <?php  }   if(trim($item_save['mail_content'])!="") {  ?>
              <li class="step step5  last"> <a href="preview_blast.php?camp_id=<?=$camp_id;?>" class="" id="step5">Preview</a> </li>
              <?php } else {  ?>
              <li class="step step5  last"> <a href="javascript:void(0);" class="" id="step5">Preview</a> </li>
              <?php } ?>
            </ul>
          </div>
          <?php
			}
			?>
          <div  style="clear:both;"></div>
          <br />
          <table>
            <tr>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td>&nbsp;</td>
            </tr>
          </table>
          <!--footer start here-->
          <?php include('common/footer.php'); ?>
          <!--footer end here-->
        </div></td>
    </tr>
  </table>
</form>
</center>
</body></html>