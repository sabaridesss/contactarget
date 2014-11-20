<?php
include("smarty_config.php");
if(isset($_REQUEST['submit']) && $_REQUEST['submit'] == 'submit')
{
	$_SESSION['preview_banner']="";							
$_SESSION['preview_banner']=$_REQUEST['image'];	
echo  '<script type="text/javascript">
function close_window()
{
 window.close();

}
</script>';



}


if($_REQUEST['banner'])
{
	if($_REQUEST['banner']!="")
	{
	$_SESSION['preview_banner']="";
	$_SESSION['preview_banner']=$_REQUEST['banner'];
	}


}






$viewSelect = "SELECT * FROM  home_page_banner WHERE company_admin=$company_admin";
$exViewQuery = mysql_query($viewSelect);
$num = mysql_num_rows($exViewQuery);

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
<font color="#FF0000" style="font-family:Verdana; font-size:12px; font-weight:bold">
<?=$msg?>
</font> <br />
<?php if($num != 0)
{
?>
<form id="form2" name="form2" method="post" action="">
  <h2 class="welcome-admin">Image List</h2>
  <div class="content">
    <table width="100%" border="1">
      <tr>
        <td align="left" class="table1">Name</td>
        <td align="left" class="table1">Image</td>
          <td align="left" class="table1">Option</td>
      </tr>
      <tr >
        <td align="center">No Image</td>
        <td>No image </td>
        <td align="center"><input name="image" type="radio" id="image"
          value="<?php echo 'No'; ?>"
           <?php if($_SESSION['preview_banner']=='No' || $_SESSION['preview_banner']=="") echo 'checked="checked"';?> /></td>
      </tr>
      <?php while ($row = mysql_fetch_array($exViewQuery))
	{ 
	   $class="table2";
	   if(($i%2)==0)
	   $class="table3";
	?>
      <tr class="<?= $class ?>">
        <td align="center"><?php echo $row['h1_title']; ?></td>
        <td><img src="uploads/banner/<?=$row["image_name"]?>" width="180" height="130" /> </td>
        <td align="center"><input name="image" type="radio" id="image"  value="<?php echo $row['image_id']; ?>" <?php if($row['image_id']==$_SESSION['preview_banner'] && $_SESSION['preview_banner']!='No') echo 'checked="checked"';?> /></td>
      </tr>
      <?php $i++; } ?>
      <tr>
      <td colspan="2" bgcolor="#FFFFFF">&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF"><input name="submit" type="submit" id="submit" value="submit"  class="submit"/></td>
    </tr>
    </table>
  </div>
</form>
<?php } ?>
</body>
</html>
