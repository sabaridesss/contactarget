<?php
include("smarty_config.php");


if(isset($_REQUEST['value']))
{

$url1_value =  $_REQUEST['value'];
if($url1_value != "")
{
$url1_query      =  "select * from projects where url = '$url1_value'";
$url1_implement  =  mysql_query($url1_query);
$url1_rows       =  mysql_num_rows($url1_implement);

if($url1_rows == 0)
{ 
?>
<div id="url1_avail"><span style="color:#FF0000"> New URl</span></div>
<?php
}

if($url1_rows > 0)
{ 
?>
<div id="url1_avail"><span style="color:#FF0000">URl already exists</span></div>
<?php 
}
}
}


   ?>