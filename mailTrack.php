<?php
include("smarty_config.php");

$insert = 'INSERT INTO news_tracking_tbl 
								SET
									news_letter_id	= \''.$_REQUEST['newsId'].'\',
									subscriber_id	= \''.$_REQUEST['subId'].'\'';
$exQuery = mysql_query($insert);									

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="250" align="center"><h2> E-Mail  Tracked..</h2></td>
  </tr>
</table>
</body>
</html>
