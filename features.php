<?php
include("smarty_config.php");
include("top_menu.php");
	error_reporting(0);
   $page_id = $_REQUEST['page_id'];
   $img = $_REQUEST['img'];
 
 	

		
		if($_REQUEST['del'])
		{
			
			 $del_pro=$_REQUEST['del'];
			
		$update_qry1 =   "UPDATE  featuresrest_tbl
										 SET status = '0' WHERE image_id = '$del_pro'";
			
			if(mysql_query($update_qry1))
			$msg = "Deleted Sucessfully";
		}
		
		

$viewSelect = 'SELECT * FROM  featuresrest_tbl WHERE page_id = '.$page_id.' AND status = \'1\' order by image_id ASC';
$exViewQuery = mysql_query($viewSelect);
$num=mysql_num_rows($exViewQuery);

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
<div style="clear:both"></div>
<form id="form2" name="form2" method="post" action="">
  <h2 class="welcome-admin">Image List</h2>
  <div class="content">
    <table width="100%" border="0">
      <tr>
        <td></td>
        <td  style="border:none;"><font color="#FF0000" style="font-family:Verdana; font-size:12px; font-weight:bold">
          <?=$msg?>
          </font></td>
        <td></td>
        <td style="border:none" align="center" ><div class="submit "><a style="text-decoration:none" href="addfeatures.php?page_id=<?=$_REQUEST['page_id']?>&img=<?=$_REQUEST['img']?>">Add Images</a></div></td>
        <td><div class="submit"> <a href="#" style="text-decoration:none" onclick="return close_window()" >Close</a></div></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td align="left" class="table1">Image</td>
        <td align="left" class="table1">Title </td>
        <td align="left" class="table1">Image Type </td>
        <td align="left" class="table1">Action</td>
        <td align="left" class="table1">Delete</td>
      </tr>
      <?php if($num != 0)
{
?>
      <?php while ($row = mysql_fetch_array($exViewQuery))
	{ 
	   $class="table2";
	   if(($i%2)==0)
	   $class="table3";
	?>
      <tr class="<?= $class ?>">
        <td><img src="../images/banner/<?php echo $row['image_name']; ?>" width="115" height="115" /> </td>
        <td align="center"><?php echo $row['title']; ?></td>
       
        <td align="center"><?php echo $row['image_type']; ?></td>
        <td align="center"><a href="addfeatures.php?page_id=<?=$_REQUEST['page_id']?>&image_id=<?php echo $row['image_id']; ?>">Edit</a> </td>
        <td align="center"><a href="features.php?page_id=<?=$_REQUEST['page_id']?>&del=<?php echo $row['image_id']; ?>">Delete</a></td>
        <!--<td align="center"><input name="del[]" type="checkbox" id="del[]"  value="<?php echo $row['image_id']; ?>"/></td>-->
      </tr>
      <?php $i++; } ?>
      <!--<tr>
        <td colspan="5" bgcolor="#FFFFFF">&nbsp;</td>
        <td align="center" bgcolor="#FFFFFF"><input name="Delete" type="submit" id="Delete" value="Delete"  class="submit"/></td>
      </tr>-->
      <?php } ?>
    </table>
  </div>
</form>
</body>
</html>
