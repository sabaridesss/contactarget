<?php
ob_start();
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();

$crypturl          = $_REQUEST['crypturl'];
$subid             = $_REQUEST['subid'];
$user              = $_REQUEST['user'];
$company_users     = $_REQUEST['company_users'];

$Template_URLs 		= $php_mail->get_template_urls($subid,$crypturl);

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
								 'company_user_id'  => $company_admin,
								 'no_of_counts' 	=> '1',
								 'click_time' 		=> date('m-d-Y H:i:s')
								 );
		 $Insert_Clicks  = $php_mail->Insert_click('click_rate',$field_types);	 
	 }
}


if(isset($Template_URLs) && $Template_URLs!=""){
	header('Location:'.$redirecturl.'?subid='.$subid.'&user='.$user.'&company_user_id='.$company_admin);
}else{
	echo "Thanks For Visiting Our Page";
}
?>

