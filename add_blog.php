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
	$date = explode("/", $_REQUEST['date']);
		$display = $date[2].'-'.$date[0].'-'.$date[1];
		if($page_name==''){
				$page_name = 'Nill';
		}
		
		
		
		$query = "INSERT INTO blog_tbl(title,file_name,order_id,is_menu,is_show,Created_Date)VALUES('".$title."','".$page_name."','".$menu_order."',45,1,now())";
	
		$rs = mysql_query($query);
		if($rs){
					header("location:blog.php?msg=2");
				}	 
	}
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit")){
	$date = explode("/", $_REQUEST['date']);
		$display = $date[2].'-'.$date[0].'-'.$date[1];
		if($page_name==''){
				$page_name = 'Nill';
		}
		
		
		
		
		$query = "INSERT INTO blog_tbl(title,file_name,order_id,is_menu,is_show,Created_Date)VALUES('".$title."','".$page_name."','".$menu_order."',45,0,now())";
		$rs = mysql_query($query);
		if($rs){
					header("location:blog.php?msg=2");
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
    <td align="left" valign="top" class="login-top">Add Blog</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="210" align="right" valign="top" id="title_name">Blog Title:</td>
        <td width="482" align="left">
        <textarea cols="50" class="login-textarea1" name="title" id="title" style="width: 408px; height: 164px;"></textarea>
        
        
        </td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name"><span class="font">Blog Page Name:</span>:</td>
        <td align="left"><input name="page_name" type="text" id="page_name" size="60" class="login-texbox1"/></td>
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
      <!--<tr>
        <td width="210" align="right" valign="top" id="title_name">Short Description:</td>
        <td width="482" align="left">
        
        <textarea cols="50" class="login-textarea1" name="img_description" id="img_description" style="width: 408px; height: 164px;"></textarea>
        
        </td>
      </tr>-->
      <tr>
        <td align="right" valign="top"><span class="font">Sort Order</span>:</td>
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
          <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" />        </td>
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

