<?php
$imgPath = "http://www.contacttarget.com/desss_logo.png";
header('Content-type: image/jpeg');
echo file_get_contents($imgPath);
?>