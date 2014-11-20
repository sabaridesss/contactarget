<?php
include("smarty_config.php");
//include("top_menu.php");
$campid  = $_REQUEST['camp_id'];

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 

include("phpmailfunction.php");
$php_mail = new phpmail_function();
 $campaignid = $_REQUEST['camp_id'];
$item_save  =  $php_mail->get_blast_templates($campaignid,$company_admin);

 $mail_check              =  $item_save['status'];
 $camp_id                 =  $item_save['camp_id'];
 $email_subject           =  $item_save['email_subject'];
 $from_name               =  $item_save['from_name'];
 $from_email              =  $item_save['from_email'];
 $template_type           =  $item_save['template_type'];
 $org_content             =  $item_save['org_content']; 
 $select_email_org        = unserialize(stripslashes($item_save['to_address']));
 
 
 if(isset($_REQUEST['update']))
 
 {
 
 echo $sqluser = "Update  compaign_name set
										mail_content = '',
										org_content = '',										
										template_type ='dynamic'
										WHERE id=".$_REQUEST['camp_id'];

    $comp_impl_query      =  mysql_query($sqluser);
	if(!$comp_impl_query) echo mysql_error(); else header("location:dynamic_template.php?camp_id=".$_REQUEST['camp_id']);exit;
 
 
 }

?>
<?php include ('common/header.php')?>
<link rel="stylesheet" href="css/tinypopup_style.css" />
<script type="text/javascript" src="javascript/tinybox.js"></script>
<form name="content_add" method="post" action="" >
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
                <?=$msg?>
                </font></strong></td>
              <td width="25%" align="right" valign="middle"><!--<div class="addmenu"><a href="add_templates_email.php">Add Template</a> </div>--></td>
            </tr>
          </table>
        </div>
        <div class="content" style="min-height:500px;">
          <h1  style="margin-bottom:12px;" >Pick a template to start with</h1>
          <div style="width:33%; float:left"><a href="select_template.php?camp_id=<?=$campid;?>&update=true" > <img title="Dynamic Template"   alt="Dynamic Template" src="images/dynamic.png"> </a></div>
          <?php   $query2_my= "select * from   compaign_name where company_admin='$company_admin' and status='complete' order by id desc";
	$query_result_my = mysql_query($query2_my);
	$count_save_mail_my=mysql_num_rows($query_result_my);      
	if($count_save_mail_my>0)
	{ ?>
          <div style="width:33%; float:left"><a href="mytemplates.php?camp_id=<?=$campid;?>" > <img title="Dynamic Template"   alt="My Template" src="images/newtemp.png"> </a></div>
          <?php } ?>
          <div  style="width:33%; float:left"> <a href="template_list_dynamic.php?camp_id=<?=$campid;?>" ><img  title="Static Template"  alt="Static Template" src="images/static.png"> </a></div>
          <div  style="clear:both;"><br />
          </div>
          <div  style="clear:both;"></div>
          <br />
          <?php
			$camp_id = $_REQUEST['camp_id'];
			if($camp_id != "")
			{
			?>
          <div align="center">
            <ul id="status-page"  class="status-page">
              <li class="step step1 "> <a href="select_campaign.php?camp_id=<?=$camp_id;?>" class="" id="step1">Campaigns</a> </li>
              <li class="step step2 current"> <a href="select_template.php?camp_id=<?=$camp_id;?>" class="" id="step1">Template Selection</a> </li>
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
          </div><table>
              <tr>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table>
          <?php
			}
			?>
          <div  style="clear:both;"><br />     </div>
    
            <!--welcome admin end here-->
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