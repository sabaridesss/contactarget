<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{
 $page_id = $_REQUEST['page_id'];
    $query2= "select * from ourwork_tbl where page_id=".$page_id;
	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = " Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		$page_id = $_REQUEST['page_id'];
		$query = "delete from ourwork_tbl where ourwork_id =".$id;
		if(mysql_query($query)) {
					header("Location:ourworks.php?msg=4&page_id=".$page_id);		
				}
	}
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
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<form name="content_add" method="post" action="" >

<table width="700" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_ourwork.php?page_id=<?=$page_id?>">Add OurWork</a> </div></td>
    <td><div class="addmenu" ><a onclick="return close_window() "  href="#">Close</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0" align="center" >
      <tr class="table1">
        <td height="30" align="center" class="style6"><strong>ID</strong></td>
        <td align="left" class="style6"><strong> Title </strong></td>
        <td align="left" class="style6"><strong>View More </strong></td>
             <td align="left" class="style6"><strong>Our Work Image</strong></td>
             <td align="left" class="style6"><strong>Action</strong></td>
 
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";


		  
	   ?>
      <tr class="<?=$class?>">
        <td width="4%" height="27" align="center" class="style6"><?=$i?></td>
        <td width="20%" align="left" class="style6"><?=$item["alt_text"]?></td>
        <td width="25%" align="left" class="style6"><?=$item["view_more"]?></td>
         <td width="19%" height="20" align="left" valign="middle" class="style6" style="padding-left:10px;">
         <img src="../images/ourworkimage/<?=$item["ourwork_image"]?>" width="120" height="60" />
         </td>
        <td width="17%">
		<table width="100%"  border="0">
            <tr>
              <td width="21%" align="center"><a href=" add_ourwork.php?id=<?=$item["ourwork_id"]?>&page_id=<?=$page_id?>" class="style6">Edit </a> </td>
              <td width="31%" align="center"><a href="ourworks.php?id=<?=$item["ourwork_id"]?>&page_id=<?=$page_id?>&delete=true" class="style6" onclick='return deleteContent1(<?=$item["ourwork_id"]?>,"delete_menus","")'> Delete</a> </td>
            </tr>
        </table></td>
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
