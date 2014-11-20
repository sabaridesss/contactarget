<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

	   if($_REQUEST['msg']=="1"){
	   		$msg = '<span style="color:#FF0000; font-weight:bold;">Added Successfully</span>';
	   }elseif($_REQUEST['msg']=="2"){
	   		$msg = '<span style="color:#FF0000; font-weight:bold;">Deleted Successfully</span>';
	   }elseif($_REQUEST['msg']=="3"){
	   		$msg = '<span style="color:#FF0000; font-weight:bold;">Updated Successfully</span>';
	   }

	   $edit_query = "select * from `analitic_tbl`";
	   $edit_query_result = mysql_query($edit_query);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
				$id = $edit_item["id"];
				$field1 = $edit_item["meta_misc"];
				$field2 = $edit_item["g_analitic"];
		}
	 

	 if(isset($_REQUEST['Add'])) {
	 
	 	$field1 = $_REQUEST['Field1'];
		$field2 = $_REQUEST['Field2'];
	
		$query = "";
		$query = "insert into analitic_tbl (`meta_misc`,`g_analitic`) values ('$field1','$field2')";
		if(mysql_query($query)){
			header("location:analitic_code.php?msg=1");
		}
	 }
	
	if(isset($_POST['Update'])){
			
				$field1 =  $_REQUEST['Field1'];
				$field2 = $_REQUEST['Field2'];
				$hid_id = $_REQUEST['hid_id'];
				
				$query = "";
				$query = "update `analitic_tbl` set `meta_misc` ='".($field1)."',
												`g_analitic` =  '".($field2)."'
												 where `id` = '".($hid_id)."'";
												 
												 
				if(mysql_query($query)) {
						header("location:analitic_code.php?msg=3");
				}
	}	
	
	
	if(isset($_REQUEST['Delete'])) {
	 
	 	$field1 = $_REQUEST['Field1'];
		$field2 = $_REQUEST['Field2'];
	
		$query = "";
		$query = "delete from analitic_tbl";
		if(mysql_query($query)){
			header("location:analitic_code.php?msg=2");
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
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000"><?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br />
  <table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Analitic Code 
      <input type="hidden" name="hid_id" value="<?=$id?>" /></td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="227" align="right" valign="top" id="title_name">&nbsp;Meta-Misc:</td>
        <td colspan="2" align="left"><textarea name="Field1" cols="100" rows="7" id="Field1" class="ogin-textarea1" ><?=$field1?>
        </textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name">Google Analytics:</td>
        <td colspan="2" align="left"><textarea name="Field2" cols="100" rows="7" id="Field2" class="ogin-textarea1"><?=$field2?>
        </textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td width="306" align="center"><?php if($id !=""){?>
            <input type="submit" name="Update" value="Save" class="addmenu2" />
          &nbsp;&nbsp;&nbsp;
          <input type="submit" name="Delete" value="Delete" class="addmenu2" />
          <?php }else{?>
          <input type="submit" name="Add" value="Add" class="addmenu2"/>
          <?php }?>        </td>
        <td width="565" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td colspan="2" valign="top" class="welcome-admin" id="title_name"><?php echo $obj->error_msg;?></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
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

