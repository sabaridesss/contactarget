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
	
 $insert = 'INSERT INTO restauran_needs 
										SET
											page_id					= \''.$_REQUEST['page_id'].'\',
											sort_order					= \''.$_REQUEST['sort_order'].'\',
											needs_name					= \''.$_REQUEST['name'].'\'';
											
$query = mysql_query($insert);

	
		header('location:needs.php?msg=2&page_id='.$page_id);									

	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		 $query2 =  'select needs_name,page_id,sort_order from restauran_needs where id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
	
	$imgId = $_REQUEST['id'];
		
			
		$insert = 'UPDATE restauran_needs
										SET
											page_id					= \''.$_REQUEST['page_id'].'\',
											sort_order					= \''.$_REQUEST['sort_order'].'\',
											needs_name					= \''.$_REQUEST['name'].'\'
											
											WHERE id ='.$imgId;
		$query = mysql_query($insert);
		header('location:needs.php?msg=3&page_id='.$page_id);
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location:needs.php?page_id=".$page_id);
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
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Needs </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Need Content</span></td>
                    <td align="left">
                    <textarea style="width: 393px; height: 102px;" name="name" id="name" cols="50" rows="50" ><?php echo $displaySite['needs_name']; ?></textarea>
                    
                    <input type="hidden" name="page_id" id="page_id" value="<?php echo $displaySite['page_id']; ?>" /></td>
                  </tr>
<tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Sort Order</span></td>
                    <td align="left"><input name="sort_order" type="text" id="sort_order" value="<?php echo $displaySite['sort_order']; ?>" size="60" class="login-textarea1"/></td>
                  </tr>
  
                  
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
              <td align="left" valign="top" class="login-top"><span class="style4">Add Needs </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Name</span> </td>
                    <td align="left">
                    <textarea name="name" id="name" cols="50" rows="50" class="login-textarea1" style="width: 393px; height: 102px;"/></textarea>
                    
                    
                    <input type="hidden" name="page_id" id="page_id" value="<?php echo $_REQUEST['page_id']; ?>" /></td>
                  </tr>
          
	<tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Sort Order</span> </td>
                    <td align="left"><input name="sort_order" type="text" id="sort_order" value="" size="60" class="login-textarea1"/>
                    </td>
                  </tr>
                  
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

