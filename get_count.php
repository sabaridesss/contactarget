<?php
 session_start(); 
include("smarty_config.php");
header("Cache-Control: no-cache, must-revalidate"); 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 

$id            =     $_REQUEST['id']; 
$sendlist      =     $_REQUEST['sendlist']; 
$email         =     $_REQUEST['sent_id']; 
$template_id   =     $_REQUEST['templateid'];
$check         =     "SELECT * FROM comp_user_tbl WHERE email='".$sent_id."' AND campaign_name = '".$id."'";
$check_record  =     mysql_query($check); 
 $insert       =     "update comp_user_tbl set no_of_read='1' where send_id='".$sendlist."' and campaign_name = '".$id."' and user_id ='".$email."'" ;
$rows_affected = mysql_query($insert); 



$path = "http://www.contacttarget.com/uploads/";	

		
		$query2 =  "SELECT * FROM emailnl_template_tbl WHERE id =".$template_id;
		$query_result2 = mysql_query($query2);
		$articalRow = mysql_fetch_array($query_result2);
/*		echo $path.$articalRow['logo'];
		exit;*/
	?>

<?php
$imgPath = "http://www.contacttarget.com/desss_logo.png";
/*function LoadJpeg($imgname)
{

     $im = @imagecreatefrompng($imgname);

    return $im;
}*/
ob_clean();
header('Content-type: image/png');
if($articalRow['logo'] != "")
{
echo file_get_contents($path.$articalRow['logo']);
}
else
{
echo file_get_contents("http://www.contacttarget.com/test_image.png");
}

?>
