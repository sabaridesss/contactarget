<?php 
include("smarty_config.php");
$a="SELECT *
    FROM emailnl_template_tbl order by id desc limit 0,1";
    $b=mysql_query($a);

   while ( $row=mysql_fetch_array($b)) {
    	# code...
    	echo $row['content'];

    } ;

    ?>