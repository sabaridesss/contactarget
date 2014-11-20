<?php include("smarty_config.php");

 
 if(isset($_REQUEST["campid"]))
{
$campid = $_REQUEST["campid"]; 
$usr = $_REQUEST["user"]; 
$sendlist  = $_REQUEST["sendlist"]; 
 $check_select="SELECT * FROM user_tbl WHERE id=".$usr;
$select_record=mysql_query($check_select);
 mysql_num_rows($select_record);
$select_fetch=mysql_fetch_array($select_record);
if(mysql_num_rows($select_record)>0)
{
 $insert="update comp_user_tbl set clicks='1' where send_id=".$sendlist." and campaign_name = ".$campid." and email='".$select_fetch['email']."'" ;
$rows_affected = mysql_query($insert); 
}
 
} 
 
 
?>