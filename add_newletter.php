<?php
include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Add')
	{
		$date = explode("/", $_REQUEST['date']);
		$display = $date[2].'-'.$date[0].'-'.$date[1];
		
		echo $insert = 'INSERT INTO newletter_tbl
										SET
											newletter_name 		= \''.$_REQUEST['name'].'\',
											newletter_company 	= \''.$_REQUEST['company'].'\',
											newletter_date		= \''.$display.'\',
											newletter_viewmore	= \''.$_REQUEST['view_more'].'\',
											news_comment		= \''.$_REQUEST['news_lettercomment'].'\'';
			exit();								
		$query = mysql_query($insert);
		header('location:newletter.php?msg=2');									

	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		$query2 =  'select * from newletter_tbl where new_id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		$date = explode("/",$_REQUEST['date']);
		$display = $date[2].'-'.$date[0].'-'.$date[1];
		
		$insert = 'UPDATE newletter_tbl
										SET
											newletter_name 		= \''.$_REQUEST['name'].'\',
											newletter_company 	= \''.$_REQUEST['company'].'\',
											newletter_date		= \''.$display.'\',
											newletter_viewmore	= \''.$_REQUEST['view_more'].'\',
											news_comment	= \''.$_REQUEST['news_lettercomment'].'\'
											WHERE new_id ='.$id;
										
		$query = mysql_query($insert);
		header('location:newletter.php?msg=3');
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location: newletter.php");
	}

	
}	
?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" enctype="multipart/form-data">
<table width="1200px" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	<?php include('common/top_menu.php') ?>
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td colspan="2" align="center" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
		    <?php if($_REQUEST['id'] != '')
			  {
			   ?><br>

		  <table width="60%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit News letter </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Name </span>:</td>
                    <td align="left"><input name="name" type="text" id="name" value="<?php echo $displaySite['newletter_name']; ?>" size="60" class="login-textarea1"/></td>
                  </tr>

                  <tr>
                    <td align="right" valign="top">Company :</td>
                    <td align=""><input name="company" type="text" id="company" value="<?php echo $displaySite['newletter_company']?>" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">View More :</td>
                    <td align=""><input name="view_more" type="text" id="view_more" value="<?php echo $displaySite['newletter_viewmore']?>" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Date</span> :</td>
                    <td align=""><input name="date" type="text" id="date" value="<?php echo date("m/d/Y",strtotime($displaySite['newletter_date']))?>" size="20" class="login-textarea1"/>
					<script language='JavaScript'>
						new tcal ({
							// form name
							'formname': 'content_add',
							// input name
							'controlname': 'date'
						});
					
					</script>
</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">News Letter Comment : </td>
                    <td align=""><textarea name="news_lettercomment" cols="80" rows="8" class="login-textarea2" id="news_lettercomment"><?php echo $displaySite['news_comment']?></textarea></td>
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
              <td align="left" valign="top" class="login-top"><span class="style4">Add Newsletter</span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Name</span> :</td>
                    <td align="left"><input name="name" type="text" id="name" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Company :</td>
                    <td align=""><input name="company" type="text" id="company" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">View More :</td>
                    <td align=""><input name="view_more" type="text" id="view_more" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Date </span>:</td>
                    <td align=""><input name="date" type="text" id="date" value="" size="20" class="login-textarea1"/>
					<script language='JavaScript'>
						new tcal ({
							// form name
							'formname': 'content_add',
							// input name
							'controlname': 'date'
						});
					
						</script>
					</td>
                  </tr>
                   
                  <tr>
                    <td align="right" valign="top">News Letter comments : </td>
                    <td align=""><textarea name="news_lettercomment" cols="80" rows="8" class="login-textarea2" id="news_lettercomment"></textarea></td>
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
<?php include('common/footer.php'); ?>
<!--footer end here--></td>
  </tr>
</table>
</form>


</div>
</center>
</body>
</html>

