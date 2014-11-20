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
	
		$del_query = "update `contactus_menu_tbl` set `show`=0";
		$exec_del_query = mysql_query($del_query);
	 	$menu_name =  $_REQUEST['menu_name'];
		
	    for($i=0;$i<=count($menu_name);$i++)
	    {	
		   if($menu_name[$i] != 0)
			{
				 $insert_query = "update `contactus_menu_tbl` set `show`=1 where `id`=".$menu_name[$i];
				 $exec_insert_query = mysql_query($insert_query);
			}
	    }
		
		if($exec_insert_query)
		{
			header("Location:contact-us-menu.php?msg=3");
		}
    }
	
	if($_REQUEST['Submit1'])
	{
	
	 	$del_mail =  $_REQUEST['del_mail'];
		
	    for($i=0;$i<=count($del_mail);$i++)
	    {	
		   if($del_mail[$i] != 0)
			{
				echo  $delete_query = "delete from req_quote_contact where `id`=".$del_mail[$i];
				 $exec_delete_query = mysql_query($delete_query);
			}
	    }
		
		if($exec_delete_query)
		{
			header("Location:contact-us-menu.php?msg=4");
		}
    }
	
	$query = "select * from `contactus_menu_tbl` ";	  
	$query_result = mysql_query($query);
	
	$query1 = "select * from `req_quote_contact` where mail_rank !=0";	  
	$query_result1 = mysql_query($query1);
	
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
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_mailid.php">Add Mail Id</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%">
	  <tr>
	  <td width="50%">
	  <table width="300" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc" class="table1">
        <td height="30" align="left">ID</td>
        <td align="left">Menus Name</td>
<td align="left">&nbsp;</td>
        
        
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";
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
      <tr class="<?= $class ?>" >
        <td width="" height="27" align="left" class="style3"><?=$i?></td>
        <td width="" align="left" class="style3"><a href="contact-us-menu-edit.php?id=<?=$item['id']?>"><?=$item["field_name"]?></a></td>
        
        <td width=""><?=$checkbox?></td>
      </tr>
      <? $i++; } ?>
    </table>
	<Br /><div align="center">
     <input type="submit" name="Submit" id="Submit" value="Enable" class="submit"/>&nbsp;&nbsp;&nbsp;
  <!--<input type="button" name="Cancel" value="Cancel" /> -->
  </div>
	  </td>
	  <td width="50%" valign="top"> 
	    <table width="300" border="0" align="center" style="border:1px solid #cccccc">
      <tr bgcolor="#cccccc" class="table1">
        <td height="30" align="left">ID</td>
        <td align="left" >Mail Id</td>
<td align="left" >Delete</td>
        
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result1)){
	    $class="table2";
	   if(($i%2)==0)
	     $class="table3";
         $id = $item["id"];
    	 $mail_id = $item["mail_id"];
		  
	   ?>
      <tr class="<?= $class ?>">
        <td width="" height="27" align="left" class="style3"><?=$i?></td>
        <td width="" align="left" class="style3"><?=$item['mail_id']?></td>
        
        <td width=""><input type='checkbox' name='del_mail[]' value='<?=$id?>' /></td>
      </tr>
      <? $i++; } ?>
    </table>
	<Br /><div align="center">
     <input type="submit" name="Submit1" id="Submit1" value="Delete" class="submit"/>&nbsp;&nbsp;&nbsp;
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
