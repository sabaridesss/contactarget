<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

	
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit")){
	
		
	
				$insert = 'INSERT INTO careers_main_cat_tbl_job 
							SET
								 cat_name 		= \''.$_REQUEST['cat_name'].'\'';
								 
		$exQuery = mysql_query($insert);
		if($exQuery){
					header("location:categories.php?msg=2");
				}	
				else
				echo mysql_error(); 
		}
	
}

?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" >
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
    <td width="55%" align="center" valign="middle">&nbsp;</td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>
  <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Add Job Category </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
	   <tr>
        <td width="210" align="right" valign="top" id="title_name">&nbsp;</td>
        <td width="482" align="left"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
      </tr>
      <tr>
        <td width="210" align="right" valign="top" id="title_name">Category Name  :</td>
        <td width="482" align="left"><input name="cat_name" type="text" id="cat_name" size="60" class="login-texbox1" value="<?=$cat_name;?>"/></td>
      </tr>
   
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		 <input type="submit" name="Submit" value="Submit"  class="addmenu2"/>
          &nbsp;&nbsp;&nbsp;
          <input type="button" name="Cancel" value="Cancel" class="addmenu2"  onclick="(history.back())"/></td>
        </tr>
    </table></td>
  </tr>
</table>
  <br>
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

