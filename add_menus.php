<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	$menu_order = $_REQUEST['menu_order'];
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Publish")){
	
		if($page_name==''){
				$page_name = 'Nill';
		}
		
		
		
		$query = "INSERT INTO menu_page_tbl(title,file_name,order_id,is_menu,is_show,Created_Date)VALUES('".$title."','".$page_name."','".$menu_order."',1,1,now())";
		$rs = mysql_query($query);
		if($rs){
					header("location:main_page.php?msg=2");
				}	 
	}
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit")){
	
		if($page_name==''){
				$page_name = 'Nill';
		}
		
		
		
		
		$query = "INSERT INTO menu_page_tbl(title,file_name,order_id,is_menu,is_show,Created_Date)VALUES('".$title."','".$page_name."','".$menu_order."',1,0,now())";
		$rs = mysql_query($query);
		if($rs){
					header("location:main_page.php?msg=2");
				}	 
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
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>
  <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Add Main Menus</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="210" align="right" valign="top" id="title_name">Main Menu Name:</td>
        <td width="482" align="left"><input name="title" type="text" id="title" size="60" class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name"><span class="font">Page Name</span>:</td>
        <td align="left"><input name="page_name" type="text" id="page_name" size="60" class="login-texbox1"/></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span class="font">Menu Order</span>:</td>
        <td align=""><input type="text" name="menu_order" id="menu_order" class="login-texbox"/></td>
        </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		<?php if(isset($_SESSION['sadmin'])) {?> 
		 <input type="submit" name="Submit" value="Publish"  class="addmenu2"/>
		 <?php } else {?>
		 <input type="submit" name="Submit" value="Submit"  class="addmenu2"/>
		 <?php } ?>
		 
          &nbsp;&nbsp;&nbsp;
          <input type="button" name="Cancel" value="Cancel" class="addmenu2" onClick="return redirect();"/>        </td>
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

