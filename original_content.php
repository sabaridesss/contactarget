<?php
	include("smarty_config.php");
	error_reporting(0);
	
	$qry = "select * from menu_page_tbl where `id`=".$_REQUEST['id'];
	$qry_result  = mysql_query($qry);
	$row = mysql_fetch_assoc($qry_result);
	if($row['real_description'] == "") {
		$data = "There is no data present";
	} else {
		$data = $row['real_description'];
	}
	
	if(isset($_REQUEST['restore']) && $_REQUEST['restore']=="Restore") {
		
		 $qry1 = "update menu_page_tbl set `img_description`='".$_REQUEST['content']."' where id=".$_REQUEST['id'];
		
		if(mysql_query($qry1)) {
		
			//header("location:http://localhost".$_REQUEST['url']);
			
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

<script type="text/javascript">
function close_window()
{
 
 window.parent.location.reload();
 window.close();

}

function refreshParent(){
       window.parent.location.reload();
}

</script>
</head>

<body>
<font color="#FF0000" style="font-family:Verdana; font-size:12px; font-weight:bold">
          <?=$msg?>
</font>
<div align="">
<form enctype="multipart/form-data" method="post" name="form1">
  <table width="100%" border="0">
   <tr>
        <td align="right" valign="top" id="title_name" class="font">Content:</td>
        <td colspan="2"><textarea name="content"><?=$data?></textarea>
<script type="text/javascript">
    CKEDITOR.replace('content');
 </script></td>
      </tr>
	  <tr>
	  <td align="right" valign="top" id="title_name" class="font">&nbsp;</td>
	  <td colspan="2" align="left">
	  <input type="submit" name="restore" value="Restore" />
	  <input type="button" name="cancel" onClick="return close_window()" value="Cancel" />
	  </td>
	  </tr>
	 
  </table>
</form>
</div>
</body>
</html>
