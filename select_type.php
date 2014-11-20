<?php
include("smarty_config.php");
//include("top_menu.php");
$campid  = $_REQUEST['camp_id'];

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 

$Pdfid 			   =     $_REQUEST['pdfid'];
 
 //SETTING PDF TYPE
if(isset($_REQUEST['template_type']))
{
$Template_type     =     $_REQUEST['template_type'];

$sqluser 		   =  "Update  file_attach 
									set template_type      = '" .$Template_type. "' WHERE id=".$Pdfid;
$comp_impl_query  =  mysql_query($sqluser);

if($Template_type=='dynamic')
{
	header("location:dynamic_template_pdf.php?pdfid=".$Pdfid."&update=true");
}
else
{
	header("location:template_list_dynamic_pdf.php?pdfid=".$Pdfid."&update=true");
}
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
          <div style="width:50%; float:left"><a href="select_type.php?pdfid=<?=$Pdfid;?>&template_type=dynamic" > <img title="Dynamic Template"   alt="Dynamic Template" src="images/dynamic.png"> </a></div>
    
          <div  style="width:50%; float:left"> <a href="select_type.php?pdfid=<?=$Pdfid;?>&template_type=static" ><img  title="Static Template"  alt="Static Template" src="images/static.png"> </a></div>
          <div  style="clear:both;"><br />
          </div>
          <div  style="clear:both;"></div>
          <br />
        
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