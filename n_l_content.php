<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

		$id=$_REQUEST['id'];
		$query2 =  "select * from news_letter_tbl where `id`=".$id;
		$query_result2 = mysql_query($query2);
		$newsRow = mysql_fetch_array($query_result2);
		
	
	if(isset($_POST['Add'])) {
		
				$article_name = $_REQUEST['article_name'];
				$content = $_REQUEST['content'];
				$mDesc = $_REQUEST['meta_content'];
				$mKey = $_REQUEST['meta_keyword'];

				$article_name1 = $article_name.".txt";
				$myFile = $article_name1;
				$fh = fopen($myFile, 'w') or die("can't open file");
				$stringData = $content;
				fwrite($fh, $stringData);
				fclose($fh);
				
				
				$query1 = "insert into news_letter_tbl(`title`,`content`,`m_desc`,`mkey`,`created_date`) values ('".$article_name."','".$content."','".$mDesc."','".$mKey."',now())";
				mysql_query($query1);
				header("location:news_letter.php?msg=2");
				
				}
	
	if(isset($_POST['Save'])){
				$article_name = $_REQUEST['article_name'];
				$content = $_REQUEST['content'];
				$hid_id = $_REQUEST['hid_id'];
				$mDesc = $_REQUEST['meta_content'];
				$mKey = $_REQUEST['meta_keyword'];
				
				$myFile = $article_name.".txt";
				$fh = fopen($myFile, 'w') or die("can't open file");
				$stringData = $content;
				fwrite($fh, $stringData);
				fclose($fh);

				
				$query = "update `news_letter_tbl` set `title` ='".($article_name)."',
												  `content` =  '".($content)."',
												  `m_desc` =  '".($mDesc)."',
												  `mkey` =  '".($mKey)."',
												 `created_date` = now()
												 where `id` = '".($id)."'";
				
				mysql_query($query);
				header("location:news_letter.php?msg=3");								 
												 
												 
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
    <td align="left" valign="top" class="login-top">News Letter</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="14%" align="right" valign="top" id="title_name">&nbsp;Title:</td>
        <td width="86%" align="left"><input name="article_name" type="text" id="article_name" value="<?=$newsRow['title']?>" size="90" class="login-textarea1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Meta-Description:</td>
        <td align="left"><textarea name="meta_content" cols="135" rows="5" id="meta_content" class="login-textarea1"><?=$newsRow['m_desc']?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Meta-Keyword:</td>
        <td align="left"><textarea name="meta_keyword" cols="135" rows="5" id="meta_keyword" class="login-textarea1"><?=$newsRow['mkey']?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Content:</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" valign="top" id="title_name"><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><textarea name="content" cols="175" class="login-textarea1"><?=$newsRow['content']?></textarea>
              <script type="text/javascript">
    CKEDITOR.replace('content');
 </script></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td align="left"></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<input type="hidden" name="hid_id" value="<?=$row2['id']?>" />
		<?php if($_REQUEST['id'] != '') {?>
		<input type="submit" name="Save" value="Save" class="addmenu2" />&nbsp;&nbsp;&nbsp;
		<?php } else {?>
		<input type="submit" name="Add" value="Add" class="addmenu2" />&nbsp;&nbsp;&nbsp;
		<?php }?>
		  <input type="button" name="Cancel" value="Cancel" class="addmenu2" onClick="return redirect_news()"/></td>
        </tr>
    </table></td>
  </tr>
</table><br>

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
