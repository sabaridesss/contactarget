<?php
set_time_limit (600);
include("smarty_config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="robots" content="noindex, nofollow" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />

<title>Barra progreso PHP, Progress bar PHP</title>
</head>

<body>
<?php
//$server = mysql_connect($host, $usr, $pwd) or die ();
//$log = mysql_select_db($ddbb,$server) or die ();
    $email_query = "SELECT * FROM user_tbl where  subscribe = '0'  order by id";
	$email_result = mysql_query($email_query);
	$test_count = mysql_num_rows($email_result);
echo "<div id='progress' style='position:relative;padding:0px;width:450px;height:60px;left:25px;'>";
	while($email_data = mysql_fetch_array($email_result))
	{
    sleep(1); //no bbdd... ;)
    //$ins = "INSERT ...";
    //$doins = mysql_query($ins) or die(mysql_error()); 
    echo "<div style='float:left;margin:5px 0px 0px 1px;width:2px;height:12px;background:red;color:red;'> </div>";
    flush();
    ob_flush();
}
echo "</div>";
echo "<script>document.getElementById('progress').style.display = 'none'</script>";

?>

<p>Si no has encontrado mensajes de error todo ha ido perfectamente<p>
<p>If you havent found any errors the process has been successful<p>

</body>
</html>