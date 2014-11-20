<?php
include("smarty_config.php");

$query = "CREATE TABLE IF NOT EXISTS `analitic_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_misc` text NOT NULL,
  `g_analitic` text NOT NULL,
  PRIMARY KEY (`id`)
)";

if(mysql_query($query)) {
echo "true";
} else {
echo "false";
}

?>