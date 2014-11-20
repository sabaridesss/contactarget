<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	// Add Contents
	if(isset($_POST['Submit'])){
		$company = $_REQUEST['company'];
		$address = $_REQUEST['address'];
		$state = $_REQUEST['state'];
		$city = $_REQUEST['city'];
		$zipcode = $_REQUEST['zipcode'];
		$information = $_REQUEST['information'];
		$id = $_REQUEST['id'];
		
		
		if($id==0) {
		
	$insert_query = 'insert INTO footer_content
											SET
												company 		= \''.$company.'\',
												address		= \''.$address.'\',
												state		= \''.$state.'\',
												city		= \''.$city.'\',
												zipcode		= \''.$zipcode.'\',
												information		= \''.$information.'\',
												company_admin = \''.$company_admin.'\',
												created_date	= now()';
												
												
												}
												
												else
												{
												
							$insert_query = 'update footer_content
											SET
												company 		= \''.$company.'\',
												address		= \''.$address.'\',
												state		= \''.$state.'\',
												city		= \''.$city.'\',
												zipcode		= \''.$zipcode.'\',
												company_admin = \''.$company_admin.'\',
												information		= \''.$information.'\' where id='.$id;
																	
												
												
												}
		$result = mysql_query($insert_query);
		if($result){
						
					header("location:contact_informations.php?msg=1");
					}
			
 
	}
}


$con_query = "select * from footer_content where company_admin=$company_admin order by id DESC";
$rs = mysql_query($con_query);
if(mysql_num_rows($rs)>0)
{
$item=mysql_fetch_array($rs);
$company=$item['company'];
$address=$item['address'];
$state=$item['state'];
$city=$item['city'];
$zipcode=$item['zipcode'];
$information=$item['information'];
$id=$item['id'];
}
else
{
$company="";
$address="";
$state="";
$city="";
$zipcode="";
$information="";
$id=0;


}


?>
<?php include ('common/header.php')?>
<script type="text/javascript" src="javascript/tinybox.js"></script>
<script type="text/javascript" src="javascript/jscolor.js"></script>
<script type="text/javascript" src="javascript/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "#information",
    theme: "modern",
    plugins: [
        "advlist autolink lists link charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor "
    ],
    toolbar1: "code | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	 menubar: false,
    toolbar2: "print preview  | forecolor backcolor emoticons"
});
</script>

<form name="content_add" method="post" action="" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <div>
            <?php if(isset($_REQUEST['msg']))
	{
    echo  '<div class="alert alert-success">

<strong>Success ! </strong>
Updated Successfully.
</div>';
     }  ?>
          </div>
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000"> </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="wholesite-inner">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top">Informations</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="144" align="right" valign="top" id="title_name">Company:</td>
                      <td width="428" colspan="2" align="left"><input name="id" type="hidden" id="id"  class='calender' maxlength="25" size="45" value="<?=$id?>" tabindex="1" />
                        <input name="company" type="text" id="company"  class='calender' maxlength="25" size="45" value="<?=$company?>" tabindex="1" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Address:</td>
                      <td colspan="2" align="left"><textarea cols="30" rows="4" style="width: 302px; height: 118px;" class='calender' id="address" name="address" tabindex="2" ><?=$address?>
</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">City:</td>
                      <td colspan="2" align="left"><input name="city" type="text" id="city"  class='calender' size="45" tabindex="3" value="<?=$city?>" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">State:</td>
                      <td colspan="2" align="left"><input name="state" type="text" id="state"  class='calender' maxlength="20" tabindex="4" size="45" value="<?=$state?>" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Zipcode:</td>
                      <td colspan="2" align="left"><input name="zipcode" type="text" id="zipcode"  class='calender' size="45" tabindex="5" maxlength="6" value="<?=$zipcode?>" /></td>
                    </tr>
                    <tr>
                      <td  colspan="2" align="left" valign="top" id="title_name">Privacy Policy:</td>
                    </tr>
                    <tr>
                      <td colspan="2" align="left"><textarea cols="30" rows="10" style="width: 302px; height: 208px;" class='calender' id="information" name="information" tabindex="6"><?=$information?>
</textarea>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" align="center" valign="top"><input type="submit" name="Submit" value="Update" class="btn btn-large btn-primary" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="button" name="Cancel" value="Cancel" class="btn btn-large btn-primary" /></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
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