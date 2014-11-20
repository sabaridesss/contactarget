<?php
ini_set('max_execution_time', 5000);
	 if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
{
    @set_time_limit(5000);
}
ini_set('display_errors',"1");
include("smarty_config.php");


//include("top_menu.php");

$pdfid        =     $_REQUEST['pdfid'];


if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} 

else 

{
if(isset($_REQUEST['Submit']))
{
$content_name  =     $_REQUEST['name_file'];
$content_desc  =     $_REQUEST['content_desc'];

$pdfname   = $pdfid."-".preg_replace('/\s+/', '', strtolower($content_name)).".pdf";

 $sqluser = "Update  file_attach set org_content ='" .$content_desc. "' , pdf_name      ='" .$pdfname. "' WHERE id=".$pdfid;
 $comp_impl_query      =  mysql_query($sqluser);
include('html2fpdf.php');
$pdf=new HTML2FPDF();	
$pdf->AddPage();
$strContent=stripslashes($_REQUEST['content_desc']);
$pdf->WriteHTML($strContent);
$pdf->Output("pdf/".$pdfname);
if($comp_impl_query)
{
	header("location:preview_pdf.php?pdfid=".$pdfid);
}

}


//For Get and SET pdf values
$sel_files			    ="SELECT name_file,org_content from  file_attach where id =".$_REQUEST['pdfid'];
$ex_sel_files			=mysql_query($sel_files);
$get_description        =mysql_fetch_array($ex_sel_files);





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
                <td align="left" valign="top" class="login-top">Dynamic Pdf</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner">
                  <table width="100%" border="0" align="center" cellpadding="5" >
                    <input name="pdfid" type="hidden" id="pdfid" value="<?=$_REQUEST['pdfid'];?>"  size="90" class="login-textarea1"/>
                    <input name="name_file" type="hidden" id="name_file" value="<?=$get_description['name_file'];?>"  size="90" class="login-textarea1"/>
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
                      <td align=""><input  type="submit" name="Submit" value="Next" class="btn btn-large btn-primary"  />
                        &nbsp;&nbsp;&nbsp; <a href="preview_pdf.php">
                        <input type="button" name="Cancel_mail" value="Cancel" class="btn btn-large btn-primary" />
                        </a> </td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <!--welcome admin end here-->
          </div>
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