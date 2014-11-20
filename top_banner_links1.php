<?php
include("smarty_config.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$page_id = $_REQUEST['page_id'];

	$action = $_REQUEST['action'];
	
	
	 $query = "select * from `menu_page_tbl` ";
		  
	 $query_result = mysql_query($query);
	
	if($_REQUEST['Submit'])
	{
	
	
		$del_query = "truncate table top_banner";
		$exec_del_query = mysql_query($del_query);
	 $menu_name =  $_REQUEST['menu_name'];
	 for($i=0;$i<=count($menu_name);$i++)
	
	 {
	   if($menu_name[$i] != 0)
		{
	
		 $insert_query = "insert into top_banner(Page_ID) values('$menu_name[$i]')";
		 $exec_insert_query = mysql_query($insert_query);
		}
	 }
	
	if($exec_insert_query)
	{
	
	header("Location:top_banner_links.php?msg=3");
	
	}
	
	 }
	
	 
	 
	 $msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Menus Sucessfully Added";
		
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Updated Sucessfully";
		
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
<script type="text/javascript">
function delete_page_content(page_id)
{
window.location = "page_index.php?page_id="+page_id+"&action=delete_page_content"
}
</script>
<link rel="stylesheet" type="text/css" href="css/cms.css" />



<style type="text/css">
<!--
.style3 {font-size: 12px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
</head>
<form name="content_add" method="post" action="" >
<body>
<table width="950" border="0" cellpadding="5">
  <tr>
    <td>&nbsp;</td>

	<td align="right"><?php include("top_menu.php"); ?></td>
	
  </tr>
  <tr>
    <td width="167" valign="top">Welcome<strong>&nbsp;<? echo $_SESSION['username'];?></td>
    <td height="395" colspan="5" align="left" valign="top"><table width="100%" border="0" cellpadding="5">
      <tr>
        <td width="100%" align="center"><strong><font color="#FF0000">
          <?=$msg?>
          </font></strong>
            <div id="delete_content" style="color:#FF0000;font-weight:bold;margin-left:120px;"></div></td>
      </tr>
    </table>
      <table width="717" border="0" cellpadding="5">
        <tr>
          <td width="672" align="right"></td>
        </tr>
      </table>
      <table width="400" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="style3"><strong>ID</strong></td>
        <td align="left" class="style3"><strong>Menus Name</strong></td>
<td align="left" class="style3">&nbsp;</td>
        
        
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $bgcolor="#ffffff";
	   if(($i%2)==0)
	     $bgcolor="#f6f6f6";
         $id = $item["id"];
        $sel_query = "select * from top_banner where Page_ID = '$id'";
		$exec_sel_query = mysql_query($sel_query);
    	$num_of_prev_records = mysql_num_rows($exec_sel_query);

if($num_of_prev_records == 1)
{

$checkbox = "<input type='checkbox' name='menu_name[]' value='$id' checked='checked'/>";

}else if($num_of_prev_records == 0)
{
$checkbox = "<input type='checkbox' name='menu_name[]' value='$id' />";

}
		  
	   ?>
      <tr bgcolor="<?=$bgcolor?>" onmouseover="this.className='tableover'" onmouseout="this.className='dataclass'">
        <td width="" height="27" align="left" class="style3"><?=$i?></td>
        <td width="" align="left" class="style3"><?=$item["title"]?></td>
        
        <td width=""><?=$checkbox?></td>
      </tr>
      <? $i++; } ?>
    </table><Br /><div align="center">
     <input type="submit" name="Submit" id="Submit" value="Update"/>&nbsp;&nbsp;&nbsp;
  <!--<input type="button" name="Cancel" value="Cancel" /> -->
  </div>
  </td>
  </tr>
</table>
</body>
</form>
</html>

<body>


</body>
