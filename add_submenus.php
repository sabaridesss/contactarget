<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {


$cat_id = $_REQUEST['cat_id'];
$sub_title = $_REQUEST['sub_title'];
$page_name = $_REQUEST['page_name'];

$parent_id = $_REQUEST['parent_id'];
$subcat_id = $_REQUEST['subcat_id'];
$menu_order = $_REQUEST['menu_order'];


// Add Contents
if(isset($_POST['Submit']) && ($_POST['Submit']=="Publish")){


if($page_name == ""){
		$page_name = 'Nill';
}

//$query = "update page_contents set sub_title='".$subtitle."', page_name='".$page_name."' where cat_id = '".$cat_id."'";

//$rs = mysql_query($query);


				
				
//  $query = "INSERT INTO menu_page_tbl(title,file_name,is_menu,parent_id,is_show)VALUES('".$sub_title."','".$page_name."',2,'".$parent_id."',1)";

  $isMenu = '2';
  $isSow = '1';
		
				
 	 $query = 'INSERT INTO menu_page_tbl
  								SET
									title   	=\''.$sub_title.'\',
									file_name	=\''.$page_name.'\',
									order_id	=\''.$menu_order.'\',
									is_menu		=\''.$isMenu.'\',
									parent_id	=\''.$parent_id.'\',
									is_show		=\''.$isSow.'\'';

	$rs = mysql_query($query);
		if($rs){
		
			header("location:sub_menus.php?parent_id=$parent_id&msg=add");
		}
}


// Add Contents
if(isset($_POST['Submit']) && ($_POST['Submit']=="Submit")){


if($page_name == ""){
		$page_name = 'Nill';
}

//$query = "update page_contents set sub_title='".$subtitle."', page_name='".$page_name."' where cat_id = '".$cat_id."'";

//$rs = mysql_query($query);


				
				
//  $query = "INSERT INTO menu_page_tbl(title,file_name,is_menu,parent_id,is_show)VALUES('".$sub_title."','".$page_name."',2,'".$parent_id."',0)";

  $isMenu = '2';
  $isSow = '1';
		
				
  $query = 'INSERT INTO menu_page_tbl
  								SET
									title   	=\''.$sub_title.'\',
									file_name	=\''.$page_name.'\',
									order_id	=\''.$menu_order.'\',
									is_menu		=\''.$isMenu.'\',
									parent_id	=\''.$parent_id.'\',
									is_show		=\''.$isSow.'\'';


 $rs = mysql_query($query);
		if($rs){
		
			header("location:sub_menus.php?parent_id=$parent_id&msg=add");
		}
}

$cat_query = "select * from main_category_list";
$cat_result = mysql_query($cat_query);

$subcat_query = "select * from page_contents";
$subcat_result = mysql_query($subcat_query);

	function recursive($id,$link)
	{
		//echo $link;
		$qry = "select * from menu_page_tbl where id=".$id;
		$qry_result = mysql_query($qry);
		$row = mysql_fetch_assoc($qry_result);
		 $title = $row['title'];
		 $par_id = $row['parent_id'];
		
		if($par_id != 0) {
			$link=" >> <a href='sub_menus.php?parent_id=".$id."'>".$title."</a>".$link;
			
			recursive($par_id,$link);
		} else {
			 
			 echo $link="<a href='main_page.php'>Main Menu</a>"." >> <a href='sub_menus.php?parent_id=".$id."'>".$title."</a>".$link;
			
			
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
  <tr>
    <td colspan="3" align="left" valign="middle" class="content1"><?php recursive($parent_id,""); ?></td>
  </tr>
</table>
</div>
<div class="content"><br>
  <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Add Sub Menus</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="210" align="right" valign="top" id="title_name">Sub Menu:</td>
        <td width="482" align="left"><input name="sub_title" type="text" id="sub_title" size="60" class="login-texbox1"/></td>
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
        <td align=""><?php if(isset($_SESSION['sadmin'])) {?> 
		 <input type="submit" name="Submit" value="Publish" class="addmenu2" />
		 
		 <?php } else {?>
		 <input type="submit" name="Submit" value="Submit" class="addmenu2" />
		 <?php } ?>
		 &nbsp;&nbsp;&nbsp;<input type="button" name="Cancel" value="Cancel" class="addmenu2" onclick="return redirect_subPage('<?php echo $_REQUEST['parent_id']; ?>')"/>		 
		</td>
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

