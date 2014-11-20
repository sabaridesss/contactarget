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
$attachment_file_fetch = 0;
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
 $attachment_file_fetch   =   $item_save['attachment_file'];
 $want_pdf_fetch 		  =   $item_save['want_pdf'];
 
if(isset($_REQUEST['Submit']))
{

$mailsubject      =     $_REQUEST['mailsubject'];
$campaignid       =     $_REQUEST['compaignname']; 
$name             =     $_REQUEST['name'];
$mailfrom         =     $_REQUEST['mailfrom'];
$select_email1    =     $_REQUEST['select_email'];
$select_email     =     mysql_escape_string(serialize($select_email1));
$attachment_file  =     $_REQUEST['attachment_file'];
$want_pdf 		  =     $_REQUEST['want_pdf'];

if(trim($want_pdf)!="")
$want_pdf =$want_pdf ;
else
$want_pdf =0;

$fname = $_FILES['up_attachment_file']['name'];
		if($fname != '')
		{
		$fname = $_FILES['up_attachment_file']['name'];
		$tmpname = $_FILES['up_attachment_file']['tmp_name'];
		$path = "pdf/";
		$p_small = $path.$fname;
		$file_name=$fname;
		move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name = $attachment_file_fetch;
			
		}   






if(isset($_REQUEST['camp_id']))
{
	 $field_types    =     array('email_subject'        =>  $mailsubject,
								 'camp_id'              =>  $campaignid,
								 'from_name'        	=>  $name,
								 'to_address'        	=>  $select_email,
								 'want_pdf'        	    =>  $want_pdf,
								 'attachment_file'      =>  $file_name,
								 'from_email' 	        =>  $mailfrom  );

	$Update_campaign  = $php_mail->Update_Blast_single('compaign_name',$_REQUEST['camp_id'],'id',$field_types);
	   if(trim($template_type) != "")
			   {
     if($template_type == 'static')
				  {
				 
             header("location:edit_dynamic_template.php?camp_id=".$_REQUEST['camp_id']);
			 exit;
              
				}
				else
				{
				 header("location:dynamic_template.php?camp_id=".$_REQUEST['camp_id']);  exit;
				}
				
				}
				else {   header("location:select_template.php?camp_id=".$_REQUEST['camp_id']);  }
				
				
				

	

}
else
{
$sqluser = $php_mail->insert_email_subject($company_admin,$mailsubject,$campaignid,$name,$mailfrom,$select_email,$file_name,$want_pdf);
      if($sqluser)
     {
	 header("location:select_template.php?camp_id=".$sqluser);
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

<script type="text/javascript" >


function valid_mail_subscribe()
{

var mailsubject=document.getElementById("mailsubject").value;
var compaignname=document.getElementById("compaignname").value;
var name=document.getElementById("name").value;
var mailfrom=document.getElementById("mailfrom").value;
var select_email=document.getElementById("select_email").value;
var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;


 if(compaignname == 0) {
   	document.getElementById("compaignname_error").innerHTML="&larr; Please Select Compaign "; 
   		
	document.getElementById("compaignname").focus();
       return false;
   }
   else if((mailsubject.length == 0)) {
   	document.getElementById("mailsubject_error").innerHTML="&larr; Please Enter Subject"; 
   		
		document.getElementById("mailsubject").focus();
        return false;
   }
   
  else if(name == 0) {
   	document.getElementById("mailname_error").innerHTML="&larr; Please Enter Name "; 
   		
	document.getElementById("name").focus();
       return false;
   }

 else if(mailfrom == 0) {
   	document.getElementById("mailfrom_error").innerHTML="&larr; Please Enter From Email address ";    		
	document.getElementById("mailfrom").focus();
       return false;
   }
   
    else   if(!pattern.test(mailfrom)){         
			document.getElementById("mailfrom_error").innerHTML="&larr; Please Enter valid  Email address ";    		
	document.getElementById("mailfrom").focus();
       return false; 
   
   }
   
    else if(select_email == 0) {
   	document.getElementById("select_email_error").innerHTML="&larr; Please Select target Group "; 
   		
	document.getElementById("select_email").focus();
       return false;
   }

else
{
       return true;

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
          <div  class="content"> <br>
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top">General Setup</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><?php
	if($mail_check != "complete")
	{
	?>
                  <table  border="0" width="100%"  align="center" cellpadding="5" >
                    <tr>
                      <td align="right" valign="top"  width="30%" >Select Your Campaign:</td>
                      <td  width="10%" ><input name="select_from_email" type="hidden" id="select_from_email" value="<?=$subject?>"  size="90" class="input-xlarge focused"/>
                        <select name="compaignname" onChange="Clear_Alert('compaignname_error')" id="compaignname"   style="width:280px"   tabindex="13"  >
                          <option  id="compaignname" value="0" >--Select Names--</option>
                          <?php  $sel_tbl_link_cat="SELECT * FROM campaign_list where company_admin='$company_admin' ";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                          <option <?php if($camp_id==$tbl_link_cat_Fetch['id']) echo 'selected="selected"'; ?>  id="compaignname" value="<?php 
								echo $tbl_link_cat_Fetch['id'];?>" >
                          <?php  echo $tbl_link_cat_Fetch['c_name'];?>
                          </option>
                          <?php }?>
                        </select>
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="compaignname_error"></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Email Subject:</td>
                      <td align=""><input name="mailsubject" onKeyUp="Clear_Alert('mailsubject_error')" type="text" id="mailsubject" value="<?=$email_subject?>"  size="90" class="input-xlarge focused"/>
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="mailsubject_error"></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Name:</td>
                      <td align=""><input name="name" onKeyUp="Clear_Alert('mailname_error')"   type="text" id="name" value="<?=$from_name?>"  size="90" class="input-xlarge focused"/>
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="mailname_error"></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">From Email Address:</td>
                      <td align=""><input name="mailfrom" onKeyUp="Clear_Alert('mailfrom_error')" type="text" id="mailfrom" value="<?=$from_email?>"  size="90" class="input-xlarge focused"/>
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="mailfrom_error"></span></td>
                    </tr>
                    <tr>
                      <td  align="right" valign="top" id="title_name">To:</td>
                      <td  align="left"><?php  $sel_tbl_link_cat="SELECT * FROM camp_categ where company_admin='$company_admin'  order by cat_order ASC";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
				  $count_select_box    = mysql_num_rows($query1_tbl_link_cat);
				  ?>
                        <select onchange="Clear_Alert('select_email_error');" name="select_email[]" id="select_email" multiple="multiple" size="<?php echo $count_select_box + 1;?>" >
                          <!-- <option value="0" >--Select--</option>-->
                          <option <?php if(in_array('All', $select_email_org)=='All') echo 'selected="selected"'; ?> value="All">All</option>
                          <?php
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
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="select_email_error"></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Attachment:</td>
                      <td align=""><input  type="file" name="up_attachment_file"  id="up_attachment_file" />
                        &nbsp; <br />
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="mailfrom_error"></span></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">
                      <?php if(trim($attachment_file_fetch)!="") { ?> 
                      
                      
                      <input name="attachment_file" readonly="readonly"  type="text"  id="attachment_file" value="<?=$attachment_file_fetch?>"  size="90" class="input-xlarge focused"/>
                      
                      <?php } ?>
                      
                      </td>
                    </tr>
                    <tr style="display:none;">
                      <td align="right" valign="top">Do you also want to send as DOC?:</td> 
                      <td align=""><input type="checkbox" name="want_pdf" id="want_pdf" value="1" <?php  if($want_pdf_fetch=='1') echo 'checked="checked"'; ?>   />
                        &nbsp; <br />
                      </td>
                      <td align="left" valign="middle" width="30%" >&nbsp; <span class="alert_msg" id="mailfrom_error"></span></td>
                    </tr><tr>
                      <td align="right">&nbsp;</td>
                      <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;&nbsp;&nbsp;
                        <input onClick="return valid_mail_subscribe()" type="submit" name="Submit" value="Next" class="btn btn-large btn-primary"  />
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
                <li class="step step1 current"> <a  href="select_campaign.php?camp_id=<?=$camp_id;?>" class="" id="step1">Campaigns</a> </li>
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
                <li class="step step5  last"> <a href="preview_blast.php?camp_id=<?=$camp_id;?>" class="" id="step5">Preview</a> </li>
                <?php } else {  ?>
                <li class="step step5  last"> <a href="javascript:void(0);" class="" id="step5">Preview</a> </li>
                <?php } ?>
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