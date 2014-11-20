<?php
include("smarty_config.php");
//include("top_menu.php");
if( !isset($_SESSION['username']) ) 
{
	header("Location:index.php");		
}
 else
  {
 $tab_id=$_REQUEST["tab_id"];
 $page_id=$_REQUEST["page_id"];
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = " Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	

	
	if($_REQUEST['del_id'])
	{
	$del_id=$_REQUEST['del_id'];
	 $del_query = "delete from  featured_table1 where id = $del_id";
		  
	 $del_query_result = mysql_query($del_query);
	 
	 if($del_query_result)
	 {
	 
	 header("location:featured_description1.php?msg=4&page_id=".$_REQUEST['page_id']);	
	 
	 }
	
	
	}
	
 $select = 'SELECT * FROM  featured_table1 WHERE page_id='.$page_id.' ORDER BY id DESC';
$query_result = mysql_query($select);
}	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
function close_window()
{
 window.close();

}
</script>
<script type="text/JavaScript">
 
function confirmDelete(){
var agree=confirm("Do You Wish To Delete?");
if (agree)
     return true;
else
     return false;
}
</script>
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="clear:both"></div>

<form name="content_add" method="post" action="" >
<table width="700" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
      <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
        <?=$msg?>
      </font></strong></td>
      <td width="25%" align="right" valign="middle"></td>
    </tr>
    <tr>
      <td align="left" valign="middle">&nbsp;</td>
      <td colspan="2" align="right" valign="middle"><table width="35%" border="0" cellspacing="0" cellpadding="0">
          <tr>
           <!-- <td><div class="addmenu"><a href="video_gallery_view.php">Video Gallery</a></div></td>-->
            <td><div class="addmenu"><a href="add_feature1.php?page_id=<?=$page_id?>">Add Title</a></div></td>
          </tr>
      </table></td>
    </tr>
  </table>
</div>
<div class="content">
<table width="100%" border="0" >
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1">ID</td>
        
         <td align="left" class="table1">Title </td>
      <td align="left" class="table1"> List Style</td>
          
       	<td width="5%" align="left" class="table1">Action</td>
		<td class="table1">Delete</td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";
	   ?>
      <tr class="<?= $class ?>" >
        <td width="3%" height="20" style="padding-left:10px; height:15px;"><?=$i?></td>
        <td width="42%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["tab_title"]?></td>
         <td width="42%" height="20" align="left" valign="middle" style="padding-left:10px;"><img width="50px" height="50px" src="../Images/listicon/<?=$item["image"]?>" /></td>
       
		<td height="20" align="left" style="padding-left:10px;">&nbsp;&nbsp;<a href="edit_feature1.php?id=<?=$item["id"]?>&page_id=<?=$page_id?>" class="style3">Edit </a></td>
		<td width="5%" style="padding-left:10px;"><a onClick="return confirmDelete();" href="featured_description1.php?del_id=<?=$item["id"]?>&page_id=<?=$page_id?>" class="style3" > Delete</a> </td>
      </tr>
      <? $i++; } ?>
    </table>
</div>
<!--welcome admin end here-->
</div>
<!--footer start here-->

<!--footer end here--></td>
  </tr>
</table>
</form>


</div>
</center>
</body>
</html>
