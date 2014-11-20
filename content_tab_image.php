<?php
include("smarty_config.php");
//include("top_menu.php");
if( !isset($_SESSION['username']) ) 
{
	header("Location:index.php");		
}
 else
  {

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = " Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	
if($_REQUEST['delete']=="true")
	 {
	 		$menus_id = $_REQUEST['menus_id'];
			$query = "delete from content_tab_image where id ='".$menus_id."'";
			if(mysql_query($query))
			{
				header("Location:content_tab_image.php?msg=4&page_id=".$_REQUEST['page_id']);		
			}
		
	}
	
	
	$page_id=$_REQUEST['page_id'];

 $select = "SELECT * FROM content_tab_image WHERE page_id =".$_REQUEST['page_id'];
$query_result = mysql_query($select);
if(!$query_result)
echo mysql_error();
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


<script type="text/JavaScript">
 
function confirmDelete(){
var agree=confirm("Are you sure you want to delete?");
if (agree)
     return true;
else
     return false;
}</script>
<body>
<form name="content_add" method="post" action="" >
  <table width="700px" style="margin:0px auto; float:left" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><div class="wholesite-inner">
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
                      <td><div class="addmenu"><a href="content_image_add.php?page_id=<?=$page_id?>">Add content Tab</a></div></td>
                      <td><div class="addmenu"><a href="#" onclick="window.close()">Close</a></div></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
          </div>
          <div class="content">
            <table width="100%" border="0" >
              <tr bgcolor="#cccccc">
                <td height="30" align="left" class="table1">ID</td>
                <td align="left" class="table1">Name</td>
                <td align="left" class="table1">Image View </td>
                <td width="5%" align="left" class="table1">Action</td>
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
                <td width="42%" height="20" align="left" valign="middle" style="padding-left:10px;"><?=$item["name"]?></td>
                <td width="45%" height="20" align="left" valign="middle" style="padding-left:10px;"><img src="../uplodeImage/content/<?=$item["image"]?>" width="120" height="60" /></td>
                <td height="20" align="left" style="padding-left:10px;">&nbsp;&nbsp;<a href="content_image_add.php?menus_id=<?=$item["id"]?>&page_id=<?=$page_id?>" class="style3">Edit </a>&nbsp;&nbsp;<a href="content_tab_image.php?menus_id=<?=$item["id"]?>&page_id=<?=$page_id?>&delete=true" class="style3" onclick="return confirmDelete()">Delete </a> </td>
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
</body></html>