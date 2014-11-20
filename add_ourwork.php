<?php
include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{
 $page_id = $_REQUEST['page_id'];
	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Add')
	{
	
	$fname = $_FILES['upImg']['name']; 
		$tmpname = $_FILES['upImg']['tmp_name'];
		$path = "../images/ourworkimage/";
		$p_small = $path."ourwork-".$fname;
		$file_name_img1="ourwork-".$fname;
		move_uploaded_file($tmpname,$p_small);
	
		
		
		$insert = 'INSERT INTO ourwork_tbl
										SET
											alt_text 		= \''.$_REQUEST['alt_text'].'\',
											page_id					= \''.$_REQUEST['page_id'].'\',
											view_more 	= \''.$_REQUEST['view_more'].'\',
											ourwork_image		= \''.$file_name_img1.'\'';
											
$query = mysql_query($insert);
	
		header('location:ourworks.php?msg=2&page_id='.$page_id);									

	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		 $page_id = $_REQUEST['page_id'];
		$query2 =  'select * from ourwork_tbl where ourwork_id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
	
	$imgId = $_REQUEST['id'];
		 $fname = $_FILES['upImg']['name'];
		if($fname != '')
		{
		$fname = $_FILES['upImg']['name'];
		$tmpname = $_FILES['upImg']['tmp_name'];
		$path = "../images/ourworkimage/";
		$p_small = $path."ourwork-".$fname;
		$file_name_img1="ourwork-".$fname;
		move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img1 =$displaySite['ourwork_image'];
			
		}  
	
		$insert = 'UPDATE ourwork_tbl
										SET
											page_id			= \''.$_REQUEST['page_id'].'\',
											alt_text 		= \''.$_REQUEST['alt_text'].'\',
											page_id					= \''.$_REQUEST['page_id'].'\',
											view_more 	= \''.$_REQUEST['view_more'].'\',
											ourwork_image		= \''.$file_name_img1.'\'
											WHERE ourwork_id ='.$id;
		$query = mysql_query($insert);
		header('location:ourworks.php?msg=3&page_id='.$page_id);
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location:ourworks.php?page_id=".$page_id);
	}

	
}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
function close_window()
{
 window.close();

}
</script>
<link rel="stylesheet" href="tigra_calendar/calendar.css">
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
<link href="calendar/calendar-win2k-1.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="tigra_calendar/calendar_us.js"></script>
<script type="text/javascript" src="calendar/calendar.js"></script>
<script type="text/javascript" src="calendar/calendar-en.js"></script>
<script type="text/javascript" src="calendar/calendar-setup.js"></script>
</head>

<body>


<form name="content_add" method="post" action="" enctype="multipart/form-data">
<input type="hidden" value="<?=$content_id?>" id="sub_catid" />
<table width="700" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">

<div class="wholesite-inner">
<!--welcome admin start here-->

<div class="content">
		    <?php if($_REQUEST['id'] != '')
			  {
			   ?><br>

		  <table width="60%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Works </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Title </span>:</td>
                    <td align="left"><input name="alt_text" type="text" id="alt_text" value="<?php echo $displaySite['alt_text']; ?>" size="60" class="login-textarea1"/><input type="hidden" name="page_id" id="page_id" value="<?php echo $displaySite['page_id']; ?>" /></td>
                  </tr>

                  <tr>
                    <td align="right" valign="top">View More Link :</td>
                    <td align=""><input name="view_more" type="text" id="view_more" value="<?php echo $displaySite['view_more']?>" size="60" class="login-textarea1"/></td>
                  </tr>
                  
                  
                   <tr>
        <td align="right" valign="top" id="title_name">OurWork Image:</td>
        <td align="left"><input name="upImg" type="file" id="upImg"  size="60" class="login-texbox1"/></td>
      </tr>
        <?php if($_REQUEST['id'] != '')
	  {
	  ?>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><img src="../images/ourworkimage/<?=$displaySite['ourwork_image']?>" width="180" height="130" />
       
        </td>
      </tr>
	 <?php } ?>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align="">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input name="Modify" type="submit" id="Modify" value="Modify" class="addmenu2"/>
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                    </tr>

              </table></td>
            </tr>
          </table><br>

            <?php } else { ?><br>

            <table width="60%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add OurWork  </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Title</span> :</td>
                    <td align="left"><input name="alt_text" type="text" id="alt_text" value="" size="60" class="login-textarea1"/>
                    <input type="hidden" name="page_id" id="page_id" value="<?php echo $_REQUEST['page_id']; ?>" /></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">View More Link:</td>
                    <td align=""><input name="view_more" type="text" id="view_more" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                   <tr>
        <td align="right" valign="top" id="title_name">OurWork Image:</td>
        <td align="left"><input name="upImg" type="file" id="upImg"  size="60" class="login-texbox1"/></td>
      </tr>
        <?php if($_REQUEST['id'] != '')
	  {
	  ?>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><img src="../images/ourworkimage/<?=$ourwork_image?>" width="180" height="130" />
       
        </td>
      </tr>
	 <?php } ?>
                                   <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input type="submit" name="Submit" value="Add" class="addmenu2" />
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                  </tr>
              </table></td>
            </tr>
          </table><br>

<?php } ?>
</div>
<!--welcome admin end here-->
</div>
<!--footer start here-->

<!--footer end here--></td>
  </tr>
</table>
</form>
</form>

</div>
</center>
</body>
</html>

