<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	$title = $_REQUEST['title'];
	$page_name = $_REQUEST['page_name'];
	$menus_id = $_REQUEST['menus_id'];
	$menu_order = $_REQUEST['menu_order'];
	$field_type = $_REQUEST['field_type'];
	$mandatory = $_REQUEST['mandatory'];
	
	// Add Contents
	if($_POST['Submit']){
	
	if($page_name==''){
			$page_name = 'Nill';
	}
	
	
	$query = "update contactus_menu_tbl set `value`='".$page_name."', `order`='".$menu_order."', `field_type`='".$field_type."',              `mandatry`='".$mandatory."' where `id`='".$menus_id."'";
	
	$rs = mysql_query($query);
			if($rs)
			{		
				header("location:contact-us-menu.php?msg=3");
			}
			
	}
	
	
	$edit_query = "select * from `contactus_menu_tbl` where id='".$_REQUEST["id"]."'";
	$edit_query_result = mysql_query($edit_query);
	while($edit_item = mysql_fetch_array($edit_query_result)){
				$field_id = $edit_item["id"];
				$field_name = $edit_item["field_name"];
				$value = $edit_item["value"];
				$order = $edit_item["order"];
				$field_type1 = $edit_item["field_type"];
				$mandatry1 = $edit_item["mandatry"];
			
		 }
}


?>
<?php include ('common/header.php')?>
<form name="content_add" method="post" action="" >
<input type="hidden" name="menus_id" value="<?=$_REQUEST['id']?>" />
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
<table width="40%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Edit Contact Field </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td align="right" valign="top" id="title_name">Field Menu:</td>
        <td align="left"><input type="text" name="title" id="title"   readonly="" value="<?=$field_name?>" class="login-texbox"/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Field Name:</td>
        <td align="left"><input type="text" name="page_name" id="page_name" value="<?=$value?>" class="login-texbox"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">Field Type:</td>
        <td align=""><select name="field_type" id="field_type" class="login-texbox">
          <option value="" selected="selected">Select</option>
          <option value="1" <?php if($field_type1 == 1){ ?> selected="selected" <?php } ?> >Text</option>
          <option value="2" <?php if($field_type1 == 2){ ?> selected="selected" <?php } ?> >Textarea</option>
        </select></td>
      </tr>
      <tr>
        <td align="right" valign="top">Mandatory:</td>
        <td align=""><select name="mandatory" id="mandatory" class="login-texbox">
          <option value="" selected="selected">Select</option>
          <option value="1" <?php if($mandatry1 == 1){ ?> selected="selected" <?php } ?> >Yes</option>
          <option value="2" <?php if($mandatry1 == 2){ ?> selected="selected" <?php } ?> >No</option>
        </select></td>
      </tr>
      <tr>
        <td align="right" valign="top">Field Order:</td>
        <td align=""><input type="text" name="menu_order" id="menu_order" value="<?=$order?>" class="login-texbox"/></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><input type="submit" name="Submit" value="Update"  class="submit"/>&nbsp;&nbsp;&nbsp;

		  <input type="button" name="Cancel" value="Cancel" onClick="return redirect_menu()" class="submit"/></td>
        </tr>
    </table></td>
  </tr>
</table>
<p><br>
</p>
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


