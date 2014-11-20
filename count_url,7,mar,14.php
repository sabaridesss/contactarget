<?php
ob_start();
include("smarty_config.php");
include("phpmailfunction.php");
function base64url_encode($data) {
  return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
$php_mail = new phpmail_function();

$crypt_url          = $_REQUEST['crypt_url'];
$campid             = $_REQUEST['campid'];
$user               = $_REQUEST['user'];
$sendlist           = $_REQUEST['sendlist'];
$company_users      = $_REQUEST['company_users'];

$properCampaign = $php_mail->getcrypturl($crypt_url,$company_users);
$GetUserName = $php_mail->getusername($company_users);

$insert       =     "update comp_user_tbl set clicks = '1' where send_id='".$sendlist."' and campaign_name = '".$campid."' and user_id ='".$user."'" ;
$rows_affected = mysql_query($insert); 

 $org_campaign  =  rtrim(strtr(base64_encode($properCampaign['c_name']), '+/', '-_'), '=');
$org_users     =  rtrim(strtr(base64_encode($GetUserName['username']), '+/', '-_'), '=');
 $properCampaign['c_url'];
  //$redirecturl = $properCampaign['c_url'].'?campaign_name='.$org_campaign.'&comp_users='.$org_users.'&user='.$user.'&sendlist='.$sendlist;
  $redirecturl = $properCampaign['c_url'];
if($rows_affected)
{
header('Location:'.$redirecturl);
}
else
{
echo "Thanks For Visiting Our Page";
}
?>

