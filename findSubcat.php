<?
//include("connect.php");
	include("../smarty_config.php");

$cat_id =intval($_GET['cat_id']);

$query="SELECT * FROM page_contents WHERE cat_id ='$cat_id'";
$result=mysql_query($query);

?>
<select name="sub_cat" id="sub_cat" >
<option>Select Submenus</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['id']?>><?=$row['sub_title']?></option>
<? } ?>
</select>
