<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

	if($_REQUEST['id'] != '')
	{
		$id=$_REQUEST['id'];
		$query2 =  "select * from press_tbl where id=".$id;
		$query_result2 = mysql_query($query2);
		$aName = mysql_fetch_array($query_result2);
		if($aName['news_date'] == '0000-00-00')
		{
			$newsDate = '';
		}
		else
		{	
			$newsDate = date("m/d/Y",strtotime($aName['news_date']));
		}	
		
	}	
	
	if(isset($_REQUEST['Save']) && $_REQUEST['Save'] == 'Save')
	{
				$article_name = $_REQUEST['article_name'];
				$article_author = $_REQUEST['article_author'];
				//$article_date = $_REQUEST['article_date'];
				$content = $_REQUEST['content'];
				$date = explode("/", $_REQUEST['date']);
				$newsDate = $date[2].'-'.$date[0].'-'.$date[1];

				$query1 = "insert into press_tbl(`press_name`,`press_author`,`press_content`,`news_date`,`created_date`)                           values ('".$article_name."','".$article_author."','".$content."','".$newsDate."',now())";
				mysql_query($query1);
				header("location:press_list.php?msg=2");
				
				}
	
	if(isset($_REQUEST['Update']) && $_REQUEST['Update'] == 'Update')
	{
				$article_name = $_REQUEST['article_name'];
				$article_author = $_REQUEST['article_author'];
				//$article_date = $_REQUEST['article_date'];
				$content = $_REQUEST['content'];
				$date = explode("/", $_REQUEST['date']);
				$newsDate = $date[2].'-'.$date[0].'-'.$date[1];
				
				$query = "update `press_tbl` set `press_name` ='".($article_name)."',
												`press_author` =  '".($article_author)."',
												 `press_content` =  '".($content)."',
												 `news_date` =  '".($newsDate)."',
												 `created_date` = now()
												 where `id` = '".($id)."'";
				
				mysql_query($query);
				header("location:press_list.php?msg=3");								 
												 
												 
	}
	
	if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
	{
		header('location:press_list.php');
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
</table>
</div>
<div class="content"><br>
  <table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Press Page</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td align="right" valign="top" id="title_name">Press-Name:</td>
        <td align="left"><input name="article_name" type="text" id="article_name" value="<?php echo $aName['press_name']?>" size="60" class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Press-Author:</td>
        <td align="left"><input name="article_author" type="text" id="article_author" value="<?=$aName['press_author']?>" size="60" class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">Published Date</td>
        <td align=""><input name="date" type="text" id="date" value="<?php echo $newsDate; ?>" size="20" class="login-textarea1"/>
					<script language='JavaScript'>
						new tcal ({
							// form name
							'formname': 'content_add',
							// input name
							'controlname': 'date'
						});
					
					</script></td>
      </tr>
      <tr>
        <td align="right" valign="top">Press-Content:</td>
        <td align=""><textarea name="content" class="login-textarea1"><?=$aName['press_content']?></textarea>
<script type="text/javascript">
    CKEDITOR.replace('content');
 </script></td>
        </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<input type="hidden" name="hid_id" value="<?=$row2['id']?>" />
		<?php if($_REQUEST['id'] == '')
		{?>
		<input type="submit" name="Save" value="Save" class="addmenu2" />&nbsp;&nbsp;&nbsp;
		<?php } else { ?>
		<input name="Update" type="submit" class="addmenu2" id="Update" value="Update" />
		<?php } ?>
		&nbsp;&nbsp;&nbsp;
		  <input type="submit" name="Cancel" value="Cancel" class="addmenu2" /></td>
        </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<p>&nbsp;</p>
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
