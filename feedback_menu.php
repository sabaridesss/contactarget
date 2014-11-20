<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$page_id = $_REQUEST['page_id'];
	$action = $_REQUEST['action'];
	
	if($_REQUEST['Submit'])
	{
	
		$del_query = "update `feedback_menu_tbl` set `show`=0";
		$exec_del_query = mysql_query($del_query);
	 	$menu_name =  $_REQUEST['menu_name'];
		
	    for($i=0;$i<=count($menu_name);$i++)
	    {	
		   if($menu_name[$i] != 0)
			{
				 $insert_query = "update `feedback_menu_tbl` set `show`=1 where `id`=".$menu_name[$i];
				 $exec_insert_query = mysql_query($insert_query);
			}
	    }
		
		if($exec_insert_query)
		{
			header("Location:feedback_menu.php?msg=3");
		}
    }
	

	
	$query = "select * from `feedback_menu_tbl` ";	  
	$query_result = mysql_query($query);
	
	 $msg = "";
	 
	if($_REQUEST["msg"] == '2') {
		$msg = "Sucessfully Added";
	}else if($_REQUEST["msg"] == '3') {
		$msg = "Updated Sucessfully";
	}else if($_REQUEST["msg"] == '4') {
		$msg = "Mail Id Deleted Sucessfully";
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
<div class="content">
<table width="100%">
	  <tr>
	  <td>
	  <table width="400" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1"><strong>ID</strong></td>
        <td align="left" class="table1"><strong>Menus Name</strong></td>
<td align="left" class="table1">&nbsp;</td>
        
        
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $bgcolor="#ffffff";
	   if(($i%2)==0)
	     $bgcolor="#f6f6f6";
         $id = $item["id"];
    	 $show = $item["show"];

if($show == 1)
{

$checkbox = "<input type='checkbox' name='menu_name[]' value='$id' checked='checked'/>";

}else if($show == 0)
{
$checkbox = "<input type='checkbox' name='menu_name[]' value='$id' />";

}
		  
	   ?>
      <tr bgcolor="<?=$bgcolor?>" onmouseover="this.className='tableover'" onmouseout="this.className='dataclass'">
        <td width="" height="27" align="left" class="style3"><?=$i?></td>
        <td width="" align="left" class="style3"><a href="feedback_menu_edit.php?id=<?=$item['id']?>"><?=$item["field_name"]?></a></td>
        
        <td width=""><?=$checkbox?></td>
      </tr>
      <? $i++; } ?>
    </table>
	<Br /><div align="center">
     <input type="submit" name="Submit" id="Submit" value="Enable" class="submit"/>&nbsp;&nbsp;&nbsp;
  <!--<input type="button" name="Cancel" value="Cancel" /> -->
  </div>
	  </td>
	  
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
