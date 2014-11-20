<?php
session_start(); 
include("smarty_config.php");
header("Cache-Control: no-cache, must-revalidate"); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

$opentime = date( 'Y-m-d H:i:s');
$sendlist      =     $_REQUEST['sendlist']; 
$email         =     $_REQUEST['sent_id']; 


 $check         =     "SELECT no_of_read,opentime FROM comp_user_tbl WHERE send_id='".$sendlist."' AND user_id = '".$email."'";
$check_record  =     mysql_query($check); 
if($check_record)
{
$fetch_check_record=mysql_fetch_array($check_record);
if($fetch_check_record['no_of_read']=='0')
{

 $insert        =     "update comp_user_tbl set opentime='".$opentime."' , no_of_read='1' where send_id='".$sendlist."'  and user_id ='".$email."'" ;
$rows_affected = mysql_query($insert); 
}

}




ob_clean();
header('Content-type: image/png');
echo file_get_contents($fullpath."images/ws.jpg");

?>
