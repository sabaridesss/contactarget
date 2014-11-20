<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

	
		$id=$_REQUEST['id'];
		$query2 =  "select * from article_tbl where `id`=".$id;
		$query_result2 = mysql_query($query2);
		$articalRow = mysql_fetch_array($query_result2);
		
	
	if(isset($_POST['Add'])) {
		
				$article_name = $_REQUEST['article_name'];
				$article_author = $_REQUEST['article_author'];
				//$article_date = $_REQUEST['article_date'];
				$content = $_REQUEST['content'];
				$mDesc = $_REQUEST['meta_content'];
				$mKey = $_REQUEST['meta_keyword'];

				$query1 = "insert into article_tbl(`article_name`,`article_author`,`article_content`,`m_desc`,`mkey`,`created_date`)values ('".$article_name."','".$article_author."','".$content."','".$mDesc."','".$mKey."',now())";
				mysql_query($query1);
				header("location:article_list.php?msg=2");
				
				}
	
	if(isset($_POST['Save'])){
				$article_name = $_REQUEST['article_name'];
				$article_author = $_REQUEST['article_author'];
				//$article_date = $_REQUEST['article_date'];
				$content = $_REQUEST['content'];
				$hid_id = $_REQUEST['hid_id'];
				$mDesc = $_REQUEST['meta_content'];
				$mKey = $_REQUEST['meta_keyword'];

				$query = "update `article_tbl` set `article_name` ='".($article_name)."',
												`article_author` =  '".($article_author)."',
												 `article_content` =  '".($content)."',
												 `m_desc` =  '".($mDesc)."',
												 `mkey` =  '".($mKey)."',
												 `created_date` = now()
												 where `id` = '".($hid_id)."'";
				
				mysql_query($query);
				header("location:article_list.php?msg=3");								 
												 
												 
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
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Article Page</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="17%" align="right" valign="top" id="title_name">Title:</td>
        <td width="83%" align="left"><input name="article_name" type="text" id="article_name" value="<?php echo $articalRow['article_name'];?>" size="90" class="login-textarea1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Author:</td>
        <td align="left"><input name="article_author" type="text" id="article_author" value="<?=$articalRow['article_author']?>" size="90" class="login-textarea1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">Meta-Description:</td>
        <td align=""><textarea name="meta_content" cols="135" rows="5" id="meta_content" class="login-textarea1"><?=$articalRow['m_desc']?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">Meta-Keyword:</td>
        <td align=""><textarea name="meta_keyword" cols="135" rows="5" id="meta_keyword" class="login-textarea1"><?=$articalRow['mkey'];?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">Article-Content:</td>
        <td align=""></td>
        </tr>
      <tr>
        <td colspan="2" valign="top"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><textarea name="content" class="login-textarea1" cols="175"><?=$articalRow['article_content']?></textarea>
          <script type="text/javascript">
    CKEDITOR.replace('content');
 </script></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<input type="hidden" name="hid_id" value="<?=$row2['id']?>" />
		<?php if($_REQUEST['id'] != '' ) {?>
		<input type="submit" name="Save" value="Save" class="addmenu2" />&nbsp;&nbsp;&nbsp;
		<?php } else {?>
		<input type="submit" name="Add" value="Add" class="addmenu2" />&nbsp;&nbsp;&nbsp;
		<?php }?>
		  <input type="button" name="Cancel" value="Cancel" class="addmenu2" onClick="return redirect_article();"/></td>
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
