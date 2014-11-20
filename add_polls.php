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
		
		$insert = 'INSERT INTO user_pollos  
										SET
											qustion 	= \''.$_REQUEST['quest'].'\',
											ans_a 		= \''.$_REQUEST['ans_a'].'\',
											ans_b		= \''.$_REQUEST['ans_b'].'\',
											ans_c		= \''.$_REQUEST['ans_c'].'\'';
		$query = mysql_query($insert);
		header('location:userPolls_view.php?msg=2');									

	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		$query2 =  'select * from user_pollos where polls_id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		
		$insert = 'UPDATE user_pollos
		   						SET
											qustion 	= \''.$_REQUEST['quest'].'\',
											ans_a 		= \''.$_REQUEST['ans_a'].'\',
											ans_b		= \''.$_REQUEST['ans_b'].'\',
											ans_c		= \''.$_REQUEST['ans_c'].'\'
											WHERE polls_id ='.$id;
		$query = mysql_query($insert);
		header('location:userPolls_view.php?msg=3');
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location:userPolls_view.php");
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

		  <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit  Polls </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td width="30%" align="right" valign="top" id="title_name">Question:</td>
                    <td width="70%" align="left"><input name="quest" type="text" id="quest" value="<?php echo $displaySite['qustion']; ?>" size="110" class="login-textarea1"/></td>
                  </tr>

                  <tr>
                    <td align="right" valign="top">Answer A :</td>
                    <td align=""><input name="ans_a" type="text" id="ans_a" value="<?php echo $displaySite['ans_a']; ?>" size="80" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Answer B :</td>
                    <td align=""><input name="ans_b" type="text" id="ans_b" value="<?php echo $displaySite['ans_b']; ?>" size="80" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Answer C  : </td>
                    <td align=""><input name="ans_c" type="text" id="ans_c" value="<?php echo $displaySite['ans_c']; ?>" size="80" class="login-textarea1"/></td>
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

            <table width="90%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add Polls </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td width="30%" align="right" valign="top" id="title_name">Question:</td>
                    <td width="70%" align="left"><input name="quest" type="text" id="quest" value="" size="110" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Answer A  :</td>
                    <td align=""><input name="ans_a" type="text" id="ans_a" value="" size="80" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Answer B :</td>
                    <td align=""><input name="ans_b" type="text" id="ans_b" value="" size="80" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Answer C  :</td>
                    <td align=""><input name="ans_c" type="text" id="ans_c" value="" size="80" class="login-textarea1"/></td>
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

