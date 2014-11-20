<?php
include("smarty_config.php");
include("top_menu.php");

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
	
	
	 $query = "update feedback_menu_tbl set `value`='".$page_name."', `order`='".$menu_order."', `field_type`='".$field_type."',              `mandatry`='".$mandatory."' where `id`='".$menus_id."'";
	
	$rs = mysql_query($query);
			if($rs)
			{		
				header("location:feedback_menu.php?msg=3");
			}
			
	}
	
	if($_REQUEST['field_type']) {
	
			
	 $query1 = "update feedback_menu_tbl set `field_type`='".$field_type."' where `id`='".$_REQUEST["id"]."'";
	 
	
	$rs1 = mysql_query($query1);
			if($rs1)
			{		
				header("location:feedback_menu_edit.php?id=".$_REQUEST["id"]);
			} 
	}
	
	
	$edit_query = "select * from `feedback_menu_tbl` where id='".$_REQUEST["id"]."'";
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Home page</title>
<style type="text/css">
<!--
#link_title {font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:20px;
font-weight:bold;
margin-left:32px;
color:#003333;
}
#title_name {font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
font-weight:bold;
margin-left:32px;
color:#006666;
}
-->
</style>

<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/cms.css" />
<script type="text/javascript" >
function redirect()
{

window.location = "feedback_menu.php";
}


function redirect1()
{

var i = document.getElementById("field_type").value;

window.location = "feedback_menu_edit.php?id="+<?= $field_id ?>+"&field_type="+i;	

}

</script>
</head>

<body>
<form name="content_add" method="post" action="" >
<input type="hidden" name="menus_id" value="<?=$_REQUEST['id']?>" />
<table width="950" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>
<td align="right"><?php include("top_menu.php"); ?></td>
  </tr>
  <tr>
    <td width="178" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" valign="top"><table width="650" border="0" align="center" cellpadding="5" bgcolor="#F5F5F5" >
      <tr>
        <td height="50" align="right">&nbsp;</td>
            <td width="232" id="link_title"><strong>Feedback Menu Edit  </strong></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">&nbsp;</td>
        <td colspan="2" align="left">&nbsp;</td>
      </tr>
      <tr>
        <td width="145" align="right" valign="top" id="title_name">Field Menu :</td>
        <td colspan="2" align="left"><input name="title" type="text" id="title" value="<?=$field_name?>" size="50"   readonly=""/></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Field Name:</td>
        <td colspan="2" align="left"><input name="page_name" type="text" id="page_name" value="<?=$value?>" size="50" /></td>
      </tr>
	  
	  <?php if($field_id != 12) {?>
	  
	  <tr>
        <td align="right" valign="top" id="title_name">Field Type:</td>
        <td colspan="2" align="left">
		<select name="field_type" id="field_type" onchange="return redirect1()" >
		<option value="" selected="selected">- - -</option>
		<option value="1" <?php if($field_type1 == 1){ ?> selected="selected" <?php } ?> >Text</option>
		<option value="2" <?php if($field_type1 == 2){ ?> selected="selected" <?php } ?> >Textarea</option>
		<option value="3" <?php if($field_type1 == 3){ ?> selected="selected" <?php } ?> >Radio</option>
		<option value="4" <?php if($field_type1 == 4){ ?> selected="selected" <?php } ?> >Select</option>
		</select>
		&nbsp;&nbsp;
		<?php if($field_type1 == 3 || $field_type1 == 4){?>
		<a href="feedback_menu_support.php?id=<?= $_REQUEST["id"];?>">options</a>
		<?php }?>
		
	   </td>
      </tr>
	   <tr>
        <td align="right" valign="top" id="title_name">Mandatory:</td>
        <td colspan="2" align="left">
		<select name="mandatory" id="mandatory">
		<option value="" selected="selected">Select</option>
		<option value="1" <?php if($mandatry1 == 1){ ?> selected="selected" <?php } ?> >Yes</option>
		<option value="2" <?php if($mandatry1 == 2){ ?> selected="selected" <?php } ?> >No</option>
		</select>
	   </td>
      </tr>
	  <tr>
        <td align="right" valign="top" id="title_name">Field Order:</td>
        <td colspan="2" align="left"><input type="text" name="menu_order" id="menu_order" value="<?=$order?>" /></td>
      </tr>
	  
	  <?php }?>
	   
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
          <input type="submit" name="Submit" value="Update" />&nbsp;&nbsp;&nbsp;

		  <input type="button" name="Cancel" value="Cancel" onclick="return redirect()"/>        </td>
        <td width="235" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
</body>

</html>


