<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	 $query = "select * from `nl_subscribers_tbl` ";
		  
	 $query_result = mysql_query($query);
	
	if($_REQUEST['Submit'] && $_REQUEST['Submit']=="Enable")
	{
	
			 $menu_name =  $_REQUEST['menu_name'];
			 
			 $insert_query = "update nl_subscribers_tbl set enable_id=0";
			 $exec_insert_query = mysql_query($insert_query);
				 
			 for($i=0;$i<=count($menu_name);$i++)
			
			 {
			 	
			   if($menu_name[$i] != 0)
				{
								
				 $insert_query = "update nl_subscribers_tbl set enable_id=1 where id=".$menu_name[$i];
				 $exec_insert_query = mysql_query($insert_query);
				
				}
			 }
			
			if($exec_insert_query)
			{
			
			header("Location:subscribers_list.php?msg=3");
			
			}
	
	 }
	 
	 if($_REQUEST['delete'] && $_REQUEST['delete']=="Delete")
	{
	
			 $menu_name =  $_REQUEST['menu_name'];
			
			 for($i=0;$i<=count($menu_name);$i++)
			 {
			 	
			   if($menu_name[$i] != 0)
				{
								
				 $del_query = "delete from nl_subscribers_tbl where id=".$menu_name[$i];
				 $exec_del_query = mysql_query($del_query);
				
				}
			 }
			
			if($exec_del_query)
			{
			
			header("Location:subscribers_list.php?msg=4");
			
			}
	
	 }
	
	 
	 
	 $msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Sucessfully Added";
		
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Updated Sucessfully";
		
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Deleted Sucessfully";
		
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
    <td width="46%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="18%" align="right" valign="middle"><div class="addmenu"><a href="news_letter.php">News Letter</a></div></td>
    <td width="14%" align="right" valign="middle"><div class="addmenu"><a href="add_subscriber.php">Add Subscriber</a></div></td>
    <td width="2%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>
<table width="400" border="0" align="center" >
	 
      <tr class="table1">
        <td height="30" align="left" ><strong>ID</strong></td>
        <td align="left" ><strong>Subscribers Mail Id </strong></td>
        <td align="left" >&nbsp;</td>
        
        
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";
         $id = $item["id"];
		 $enable_id = $item["enable_id"];
    	
if($enable_id == 1)
{

$checkbox = "<input type='checkbox' name='menu_name[]' value='$id' checked='checked'/>";

}else if($enable_id == 0)
{
$checkbox = "<input type='checkbox' name='menu_name[]' value='$id' />";

}
		  
	   ?>
      <tr class="<?= $class ?>">
        <td width="" height="27" align="left" class="font2" ><?=$i?></td>
        <td width="" align="left" class="font2"><?=$item["mail"]?></td>
        
        <td width=""><?=$checkbox?></td>
      </tr>
      <? $i++; } ?>
    </table><Br /><div align="center">
     <input type="submit" name="Submit" id="Submit" value="Enable" class="addmenu2"/>&nbsp;&nbsp;&nbsp;
	 <input type="submit" name="delete" id="delete" value="Delete" class="addmenu2"/>
  <!--<input type="button" name="Cancel" value="Cancel" /> -->
  </div><br>

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
