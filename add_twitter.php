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
		
		$insert = 'INSERT INTO twitter_tbl  
										SET
											api_key 	= \''.$_REQUEST['api_key'].'\',
											show_feed 	= \''.$_REQUEST['show_feed'].'\'';
		$query = mysql_query($insert);
		header('location:twitter_list.php?msg=2');									
	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		$query2 =  'select * from twitter_tbl where twitter_id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		
		$insert = 'UPDATE twitter_tbl
								SET
									api_key 	= \''.$_REQUEST['api_key'].'\',
									show_feed 	= \''.$_REQUEST['show_feed'].'\'
									WHERE twitter_id ='.$id;
		$query = mysql_query($insert);
		header('location:twitter_list.php?msg=3');
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location:twitter_list.php");
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

		  <table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Twitter </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td width="17%" align="right" valign="top" id="title_name"><span class="style3">API Key</span> :</td>
                    <td width="83%" align="left"><textarea name="api_key" cols="80" rows="7" class="login-textarea2" id="api_key"><?php echo $displaySite['api_key']; ?></textarea></td>
                  </tr>

                  <tr>
                    <td align="right" valign="top">Show Feed :</td>
                    <td align=""><input name="show_feed" type="checkbox" id="show_feed" value="1" <?php if($displaySite['show_feed'] == '1'){?> checked="checked" <?php } ?>/></td>
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

            <table width="80%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add Twitter </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td width="17%" align="right" valign="top" id="title_name"><span class="style3">API Key </span> :</td>
                    <td width="83%" align="left"><textarea name="api_key" cols="80" rows="7" class="login-textarea2" id="api_key"></textarea></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Show Feed :</td>
                    <td align=""><input name="show_feed" type="checkbox" id="show_feed" value="1" /></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align="">&nbsp;</td>
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

