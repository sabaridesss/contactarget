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
$final=$properCampaign['c_url'];

$track_url='?subid='.$campid.'&company_user_id='.$company_users.'&user='.$user;
 
 
 
 
$org_url    =  $crypt_url;
$crypt_url_new  =  md5($org_url).time(); 


		echo $select_Blast = "SELECT * from template_urls where url_subject='".$final."' and email_subject_id=".$sendlist." and company_admin=".$company_users;   
	    $execute_query_Blast = mysql_query($select_Blast);	
		echo mysql_num_rows($execute_query_Blast);
		if(mysql_num_rows($execute_query_Blast)==0)
		 {


$insert_url  =  $php_mail->click_subject_campaign($company_users,$properCampaign['c_url'],$crypt_url_new,$sendlist); 
$Template_URLs 		= $php_mail->get_template_urls($sendlist,$crypt_url_new);

echo $Template_URLs;
if(isset($Template_URLs) && $Template_URLs!=""){

	 $click_id   		 = $Template_URLs['click_id'];
	 $email_subject_id   = $Template_URLs['email_subject_id']; 
	 $company_admin   	 = $Template_URLs['company_admin'];
	 $redirecturl   	 = $Template_URLs['url_subject'];
	 
	 /*comp_user_tabl update for no of read start*/
	 if(isset($user) && $user !=""){
		 $up_field_types    = array('no_of_read'         => 1);
		 $Update_Clicks  = $php_mail->Update_Blast('comp_user_tbl',$email_subject_id,$user,'send_id','user_id',$up_field_types);
	 }	
	 /*comp_user_tabl update for no of read end*/
	 
	 $Select_Blasts 	 = $php_mail->Select_Blast_two('click_rate','click_id','user_id',$click_id,$user);
	 $Blasts_values		 = mysql_fetch_assoc($Select_Blasts);
	 
	 if(isset($Blasts_values) && $Blasts_values ==""){
		 $field_types    = array('click_id'         => $click_id,
								 'email_subject_id' => $email_subject_id,
								 'user_id'        	=> $user,
								 'company_user_id'  => $company_users,
								 'no_of_counts' 	=> '1',
								 'click_time' 		=> date('m-d-Y H:i:s')
								 );
								 
		print_r($field_types);
		
						 
		 $Insert_Clicks  = $php_mail->Insert_click('click_rate',$field_types);	
		 
		 
		  
	 }}
	 
	 }
	 
  //$redirecturl = $properCampaign['c_url'].'?campaign_name='.$org_campaign.'&comp_users='.$org_users.'&user='.$user.'&sendlist='.$sendlist;
  $redirecturl = $properCampaign['c_url'].$track_url;

  
if($rows_affected)
{
header('Location:'.$redirecturl);
}
else
{
echo "Thanks For Visiting Our Page";
}
?>
