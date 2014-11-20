<?php include("smarty_config.php");


 


if($_REQUEST['uval'])
{
$uval =  $_REQUEST['uval'];



 $query = "update compaign_name set org_content='".addslashes($uval)."' where  id = ".$_SESSION['camp_id'];

$exUpdate = mysql_query($query);
if(!$exUpdate)
echo mysql_error();

}





?>