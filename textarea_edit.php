<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

	 if(isset($_REQUEST['Add'])) {
	 
	 	$field1 = $_REQUEST['Field1'];
		$field2 = $_REQUEST['Field2'];
		$field3 = $_REQUEST['Field3'];
		$field4 = $_REQUEST['Field4'];
		$field5 = $_REQUEST['Field5'];
		$field6 = $_REQUEST['Field6'];
		$field7 = $_REQUEST['Field7'];
		$field8 = $_REQUEST['Field8'];
		$field9 = $_REQUEST['Field9'];
		$query = "";
		$query = "insert into textarea_tbl (`field1`,`field2`,`field3`,`field4`,`field5`,`field6`,`field7`,`field8`,`field9`) values                 ('$field1','$field2','$field3','$field4','$field5','$field6','$field7','$field8','$field9')";
		if(mysql_query($query)){
			header("location:textarea.php?msg=1");
		}
	 }
	
	 if(isset($_REQUEST['edit_id'])) {
	 
	   $id = $_REQUEST['edit_id'];
	   $edit_query = "select * from `textarea_tbl` where `id` ='$id'";
	   $edit_query_result = mysql_query($edit_query);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
				$id = $edit_item["id"];
				$field1 = $edit_item["field1"];
				$field2 = $edit_item["field2"];
				$field3 = $edit_item["field3"];
				$field4 = $edit_item["field4"];
				$field5 = $edit_item['field5'];
				$field6 = $edit_item['field6'];
				$field7 = $edit_item['field7'];
				$field8 = $edit_item['field8'];
				$field9 = $edit_item['field9'];
		}
	 }
	 
	
	if(isset($_POST['Update'])){
			
				$field1 =  $_REQUEST['Field1'];
				$field2 = $_REQUEST['Field2'];
				$field3 = $_REQUEST['Field3'];
				$field4 = $_REQUEST['Field4'];
				$field5 = $_REQUEST['Field5'];
				$field6 = $_REQUEST['Field6'];
				$field7 = $_REQUEST['Field7'];
				$field8 = $_REQUEST['Field8'];
				$field9 = $_REQUEST['Field9'];
				$hid_id = $_REQUEST['hid_id'];
				
				$query = "";
				$query = "update `textarea_tbl` set `field1` ='".($field1)."',
												`field2` =  '".($field2)."',
												 `field3` =  '".($field3)."',
												 `field4` = '".($field4)."',
												 `field5` ='".($field5)."',
												 `field6` ='".($field6)."',
												 `field7` ='".($field7)."',  
												 `field8` ='".($field8)."',
												 `field9` ='".($field9)."'
												 where `id` = '".($hid_id)."'";
												 
												 
				if(mysql_query($query)) {
						header("location:textarea.php?msg=3");
				}
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
    <td width="55%" align="center" valign="middle">&nbsp;</td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
  <table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Text Areas</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td colspan="2" align="left" valign="top" id="title_name"><input type="hidden" name="hid_id" value="<?=$id?>" />          &nbsp;reserved Keywords:<span style="color:#FF0000;">&lt;category&gt;,&lt;industry&gt;,&lt;technology&gt;</span></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top" id="title_name">On Category:</td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><textarea name="Field1" cols="130" rows="15" id="Field1" ><?=$field1?>
        </textarea></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top">On Industry:</td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><textarea name="Field6" cols="130" rows="15" id="Field6" ><?=$field6?>
        </textarea></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top">On Technology:</td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><textarea name="Field7" cols="130" rows="15" id="Field7" ><?=$field7?>
        </textarea></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top">On Category And Industry:</td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><textarea name="Field2" cols="130" rows="15" id="Field2" ><?=$field2?>
        </textarea></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top">On Category And Technology:</td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><textarea name="Field8" cols="130" rows="15" id="Field8" ><?=$field8?>
        </textarea></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top">On Technology And Industry:</td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><textarea name="Field9" cols="130" rows="15" id="Field9" ><?=$field9?>
        </textarea></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top">&nbsp;On Category, Industry And Technology:</td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><textarea name="Field3" cols="130" rows="15" id="Field3" ><?=$field3?>
        </textarea></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top">On Website:</td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top"><textarea name="Field4" cols="130" rows="15" id="Field4" ><?=$field4?>
        </textarea></td>
        </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><?php if(isset($_REQUEST['edit_id'])){?>
		<input type="submit" name="Update" value="Update" class="addmenu2"/>
		<?php }else{?>
		<input type="submit" name="Add" value="Add" class="addmenu2" />
		<?php }?>
          &nbsp;&nbsp;&nbsp;
		   <input type="button" name="Cancel" value="Cancel" class="addmenu2" onClick="return redirect_textarea()"/></td>
        </tr>
    </table></td>
  </tr>
</table>
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
