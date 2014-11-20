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
				$article_name = $_REQUEST['article_name'];
				$article_author = $_REQUEST['article_author'];
				//$article_date = $_REQUEST['article_date'];
				$content = $_REQUEST['content'];
				
				$query1 = "insert into request_list_tbl(`quote_name`,`quote_url`) values ('".$article_name."','".$article_author."')";
				mysql_query($query1);
				header("location: Requestlink_list.php?msg=2");
	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		$query2 =  'select * from request_list_tbl where id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
				$article_name = $_REQUEST['article_name'];
				$article_author = $_REQUEST['article_author'];
				//$article_date = $_REQUEST['article_date'];
				//$content = $_REQUEST['content'];
				$hid_id = $_REQUEST['id'];
				
				$query = "update `request_list_tbl` set `quote_name` ='".$article_name."',
												`quote_url` =  '".$article_author."'
												 where `id` = '".$hid_id."'";
				
				mysql_query($query);
				
				header("location: Requestlink_list.php?msg=3");								 
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location: Requestlink_list.php");
	}

	
}	
?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" enctype="multipart/form-data">
<input type="hidden" value="<?=$content_id?>" id="sub_catid" />
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
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Website </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Quote Name </span>:</td>
                    <td align="left"><input name="article_name" type="text" id="article_name" value="<?php echo $displaySite['quote_name']; ?>" size="60" class="login-textarea1"/></td>
                  </tr>

                  <tr>
                    <td align="right" valign="top"><span class="style3">Quote Url </span>:</td>
                    <td align=""><input name="article_author" type="text" id="article_author" value="<?php echo $displaySite['quote_url']?>" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <!--<td align="right" valign="top"><span class="style3">City </span>:</td>
                    <td align=""><input name="content" type="text" id="article_author" value="<?php echo $displaySite['site_city']?>" size="60" class="login-textarea1"/></td>-->
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
              <td align="left" valign="top" class="login-top"><span class="style4">Add Website </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Quote Name </span>:</td>
                    <td align="left"><input name="article_name" type="text" id="article_name" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Quote Url </span>:</td>
                    <td align=""><input name="article_author" type="text" id="article_author" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <!--<td align="right" valign="top"><span class="style3">City </span>:</td>
                    <td align=""><input name="content" type="text" id="article_author" value="" size="60" class="login-textarea1"/></td>-->
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

