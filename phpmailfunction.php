<?php
class phpmail_function
{
  /////////////////////////////////////////////Old Get templates Details/////////////////////////////////////////////////////////////////////////////
    function gettemplates($template,$company_admin)
    {
    $sel_templates   =  "SELECT * FROM emailnl_template_tbl  WHERE company_admin='".$company_admin."' and id =".$template ;
	$query1_sel_templates  = mysql_query($sel_templates);
	$templates_data        =  mysql_fetch_array($query1_sel_templates);	
	return $templates_data;
	}
	/*******************************************************************************************************************************************/
	  /////////////////////////////////////////////COUNT CLICK RATE/////////////////////////////////////////////////////////////////////////////
    function count_click_rate($company_admin,$camp_id)
    {
    $sel_templates   =  "SELECT COUNT(*) FROM emailnl_template_tbl  WHERE company_admin='".$company_admin."' and send_id =".$camp_id." and no_of_read = 1" ;
	$query1_sel_templates  = mysql_query($sel_templates);
	$templates_data        =  mysql_fetch_array($query1_sel_templates);	
	return $templates_data;
	}
	/*******************************************************************************************************************************************/
	  /////////////////////////////////////////////COUNT Opened RATE/////////////////////////////////////////////////////////////////////////////
    function count_open_rate($company_admin,$camp_id)
    {
    $sel_templates   =  "SELECT COUNT(*) FROM emailnl_template_tbl  WHERE company_admin='".$company_admin."' and email_subject_id =".$camp_id ;
	$query1_sel_templates  = mysql_query($sel_templates);
	$templates_data        =  mysql_fetch_array($query1_sel_templates);	
	return $templates_data;
	}
	/*******************************************************************************************************************************************/
		
	/////////////////////////////////////////////Get templates Details/////////////////////////////////////////////////////////////////////////////
	    function get_blast_templates($campaignid,$company_admin)
    {
$sel_blast_templates   =  "
SELECT A.*,B.c_name,B.c_keyword,B.crypt_url FROM compaign_name A, campaign_list B  WHERE A.company_admin='".$company_admin."' and A.id =".$campaignid." and A.camp_id = B.id" ;
	$query1_sel_blast_templates  = mysql_query($sel_blast_templates);
	$templates_data_blast        =  mysql_fetch_array($query1_sel_blast_templates);	
	return $templates_data_blast;
	}
	/*******************************************************************************************************************************************/
		/////////////////////////////////////////////Staus Of Mail BLast/////////////////////////////////////////////////////////////////////////////
	    function update_status_blast($campaignid,$company_admin)
    {
 $sqluser = "Update  compaign_name set
										status ='complete'
										WHERE id=".$campaignid;
	$query1_sel_blast_templates  = mysql_query($sqluser);
	$templates_data_blast        =  mysql_fetch_array($query1_sel_blast_templates);	
	return $templates_data_blast;
	}
	/*******************************************************************************************************************************************/
	
		    function get_field_templates($campaignid,$company_admin,$fieldname)
    {
 $sel_blast_templates   =  "SELECT `".$fieldname."` FROM compaign_name   WHERE company_admin='".$company_admin."' and id =".$campaignid ;
	$query1_sel_blast_templates  = mysql_query($sel_blast_templates);
	$templates_data_blast        =  mysql_fetch_array($query1_sel_blast_templates);	
	return $templates_data_blast;
	}
       function insert_campaign($company_admin,$subject,$campaign_id)
    {
    $comp_insert_query    =   "insert into compaign_name(company_admin,compaign_name,camp_id) values('".$company_admin."','".$subject."','".$campaign_id."')";
    $comp_impl_query      =  mysql_query($comp_insert_query);
	$send_id              =  mysql_insert_id();
	return $send_id;
	}
	
	
	function insert_email_subject($company_admin,$subject,$campaign_id,$fromname,$fromemail,$select_email,$file_name,$want_pdf)
    {
$comp_insert_query    =   "insert into compaign_name(company_admin,email_subject,camp_id,from_name,from_email,to_address,attachment_file,want_pdf) values('".$company_admin."','".$subject."','".$campaign_id."','".$fromname."','".$fromemail."','".$select_email."','".$file_name."','".$want_pdf."')";

    $comp_impl_query      =  mysql_query($comp_insert_query);


	$send_id              =  mysql_insert_id();
	return $send_id;
	}
	
	
	 /*function insert_email_subject($company_admin,$subject,$campaign_id,$fromname,$fromemail,$select_email)
    {
 echo $comp_insert_query    =   "insert into compaign_name(company_admin,email_subject,camp_id,from_name,from_email,to_address) values('".$company_admin."','".$subject."','".$campaign_id."','".$fromname."','".$fromemail."','".$select_email."')";

    $comp_impl_query      =  mysql_query($comp_insert_query);
	$send_id              =  mysql_insert_id();
	return $send_id;
	}*/
		 function update_to_address($camp_id,$select_email1)
    {
 $sqluser = "Update  compaign_name set
										to_address='" . addslashes($select_email1) . "'
										WHERE id=".$camp_id;
 
    $comp_impl_query      =  mysql_query($sqluser);
	 if($comp_impl_query)
	 {
	 $campaign_id = $camp_id;
	 }
	 else
	 {
	 $campaign_id = mysql_error();
	 }
	return  $campaign_id;
	}
			 function update_mail_content($camp_id,$content_desc,$template_type)
    {
 $sqluser = "Update  compaign_name set
										mail_content ='" . $content_desc. "',
										template_type ='".$template_type."'
										WHERE id=".$camp_id;

    $comp_impl_query      =  mysql_query($sqluser);
	 if($comp_impl_query)
	 {
	 $campaign_id = $camp_id;
	 }
	 else
	 {
	 $campaign_id = mysql_error();
	 }
	return  $campaign_id;
	}
    function user_record($company_admin,$cond)
	{
	 $email_query = "SELECT firstname,lastname,id,email FROM user_tbl where company_admin='".$company_admin."' and subscribe = '0'  ".$cond." order by id";
	$email_result = mysql_query($email_query);
	while($email_data = mysql_fetch_array($email_result))
	{
	 $record_row[] = $email_data;
	}
	return $record_row;
	}
	function get_fetch_record($result)
	{	

		$data = 0 ;
		while ($row = mysql_fetch_assoc($result)) 
		{
			$result_set[$data] = $row;
			$data++ ;
		}
		
		mysql_free_result($result);	
	 return $result_set;
	}
		function get_num_record($result)
	{
	
		$num_result = mysql_num_rows($result);
		
		return $num_result;
	}	
        function templateheader($campaign_id,$template_color)
	{
   $template_header ='<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>'.$campaign_id.'</title>
<style type="text/css">
.content {
	background:#fff;
	padding:10px;
	margin-top:10px;
	border:1px solid #C0C0C0;
}
.content p {
	font:normal 12px/24px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
}
.content span {
	font:bold 14px/24px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
	display:block;
}
.content ul {
	list-style:circle;
}
.content ul li {
	font:normal 12px/18px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
}
.spacer {
	clear:both;
}
</style>
</head>
<body style="margin:0px; padding:0px;">
<div style="margin:0px auto; width:500px; background:#'.$template_color.'; padding:15px 15px 15px 15px; position:relative; border:1px solid #c0c0c0; ">'; 
	return $template_header;
	}
	 function template_content($phone,$phone_color,$content_desc)
	{
 $template_content=	'
  <div style="clear:both;"></div>
  <p style="font:bold 18px/25px Verdana, Geneva, sans-serif; color:#'.$phone_color.';height:60px; align="right">'.$phone.'</p>
  <div style="clear:both;"></div>
  <div style="background:#fff; padding:10px; margin-top:10px; border:1px solid #C0C0C0;" class="content">'
   ;
	return $template_content;
	}
   	 function template_footer($logo,$fb,$tw,$gplus,$st,$lin,$content)
	{
 $template_footer = '<div class="spacer"></div>
  </div>
  <div align="center"> 
    <div class="spacer"></div>
    <div style="display:inline-block; margin-top:10px;">';
      
      if($fb!="")
      {
      $template_footer .='<a href="'.$fb.'"><img src="http://www.contacttarget.com/facebook.png"></a>';
      }
      if($tw!="")
      {
      $template_footer .='<a href="'.$tw.'"><img src="http://www.contacttarget.com/twitter.png"></a>';
      }
      if($gplus!="")
      {
      $template_footer .='<a href="'.$gplus.'"><img src="http://www.contacttarget.com/google.png"></a>';
      }
      if($utube!="")
      {
      $template_footer .='<a href="'.$utube.'"><img src="http://www.contacttarget.com/youtube.png"></a>';
      }
      if($st!="")
      {
      $template_footer .='<a href="'.$st.'"><img src="http://www.contacttarget.com/stumb.png"></a>';
      }
      if($lin!="")
      {
      $template_footer .='<a href="'.$lin.'"><img src="http://www.contacttarget.com/linkin.png"></a>';
      } 
      $template_footer.=	'</div>
    <p style="font:normal 12px/24px Verdana, Geneva, sans-serif; color:#515151;	margin:10px 0px 0px 0px;">'.$content.'</p>
  </div>
</div>
</body>
</html>
';
	return $template_footer;
	}
		function insert_no_of_send($company_admin,$value_key,$content_desc,$campaign_id,$send_id)
	{	

	  echo  $insert_query  = "insert into comp_user_tbl(`company_admin`,`user_id`,`content`,`campaign_name`,`send_id`,`no_of_sent`) values('".$company_admin."','".$value_key."','".$content_desc."','".$campaign_id."','".$send_id."',1)";
         $impl_query    =  mysql_query($insert_query);
		 exit;
	 return $impl_query;
	}
			function insert_no_of_fail($company_admin,$value_key1,$content_desc,$campaign_id,$send_id)
	{	

	    $insert_query  = "insert into comp_user_tbl(`company_admin`,`user_id`,`content`,`campaign_name`,`send_id`,`no_of_fail`) values('".$company_admin."','".$value_key1."','".$content_desc."','".$campaign_id."','".$send_id."',1)";
         $impl_query    =  mysql_query($insert_query);
	 return $impl_query;
	}
	
	/////////////////////////////////////////////INSERT CAMPAIGN URLS/////////////////////////////////////////////////////////////////////////////
				function click_subject_campaign($company_admin,$org_url,$crypt_url,$campaign_id)
	{	

	    $insert_query  = "insert into template_urls(`company_admin`,`url_subject`,`crypt_url`,`email_subject_id`) values('".$company_admin."','".$org_url."','".$crypt_url."','".$campaign_id."')";
         $impl_query    =  mysql_query($insert_query);
	 return $impl_query;
	}
	/*******************************************************************************************************************************************/
		
	/////////////////////////////////////////////Delete CAMPAIGN URLS/////////////////////////////////////////////////////////////////////////////
				function delete_subject_campaign($company_admin,$campaign_id)
	{	

	    $insert_query  = "DELETE FROM template_urls WHERE email_subject_id= ".$campaign_id."  AND company_admin = ".$company_admin;
         $impl_query    =  mysql_query($insert_query);
	 return $impl_query;
	}
	/*******************************************************************************************************************************************/
		////////////////////////////////////////////////Get_user_records_count/////////////////////////////////////////////////////////////////////////
	    function get_user_total_records_count($company_users)
    {
   $sel_crypturl   =  "SELECT * FROM  user_tbl  WHERE company_admin=".$company_users ;
	$query1_sel_crypturl  = mysql_query($sel_crypturl);
	 $subscribers        =  mysql_num_rows($query1_sel_crypturl);	
	return $subscribers;
	}
		/*******************************************************************************************************************************************/
		////////////////////////////////////////////////Get_user_BOunce_count/////////////////////////////////////////////////////////////////////////
	    function get_bounce_user_total_records_count($company_users)
    {
   $bounce_sel_crypturl   =  "SELECT * FROM  user_tbl  WHERE company_admin=".$company_users." and Bounced = 1 and subscribe = 1" ;
	$bounce_query1_sel_crypturl  = mysql_query($bounce_sel_crypturl);
	$bounce_subscribers        =  mysql_num_rows($bounce_query1_sel_crypturl);	
	return $bounce_subscribers;
	}
		/*******************************************************************************************************************************************/
				////////////////////////////////////////////////Get_user_Deactive_count/////////////////////////////////////////////////////////////////////////
	    function get_active_user_total_records_count($company_users)
    {
   $active_sel_crypturl   =  "SELECT * FROM  user_tbl  WHERE company_admin=".$company_users." and  subscribe = 0" ;
	$active_query1_sel_crypturl  = mysql_query($active_sel_crypturl);
	$active_subscribers        =  mysql_num_rows($active_query1_sel_crypturl);	
	return $active_subscribers;
	}
		/*******************************************************************************************************************************************/
					////////////////////////////////////////////////Get_user_Deactive_count/////////////////////////////////////////////////////////////////////////
	    function get_deactive_user_total_records_count($company_users)
    {
   $deactive_sel_crypturl   =  "SELECT * FROM  user_tbl  WHERE company_admin=".$company_users." and  subscribe = 1 and Bounced != 1" ;
	$deactive_query1_sel_crypturl  = mysql_query($deactive_sel_crypturl);
	$deactive_subscribers        =  mysql_num_rows($deactive_query1_sel_crypturl);	
	return $deactive_subscribers;
	}
		/*******************************************************************************************************************************************/
	    function getcrypturl($crypt_url,$company_users)
    {
   $sel_crypturl   =  "SELECT * FROM  campaign_list  WHERE company_admin='".$company_users."' and crypt_url ='".$crypt_url."'" ;
	$query1_sel_crypturl  = mysql_query($sel_crypturl);
	$properCampaign        =  mysql_fetch_array($query1_sel_crypturl);	
	return $properCampaign;
	}
		    function getusername($company_users)
    {
   $sel_crypturl   =  "SELECT * FROM  admin  WHERE id ='".$company_users."'" ;
	$query1_sel_crypturl  = mysql_query($sel_crypturl);
	$properCampaign        =  mysql_fetch_array($query1_sel_crypturl);	
	return $properCampaign;
	}
	
	function get_template_urls($subid,$crypturl)
    {
    $sel_crypturl   =  "SELECT * FROM template_urls WHERE email_subject_id='".$subid."' and crypt_url='".$crypturl."'";
	$query1_sel_crypturl  = mysql_query($sel_crypturl);
	$properCampaign        =  mysql_fetch_array($query1_sel_crypturl);	
	return $properCampaign;
	}
	
	public function Insert_click($Tablename,$FieldTypes)
	{
	$insert_click = "INSERT ".$Tablename." SET ";
	$count_click  = count($FieldTypes);
	$i = 1;
	foreach($FieldTypes as $key=>$value) {
		$insert_click .= "`".$key."`   = '".$value."'";
		if($count_click != $i)
		{
			$insert_click .=",";
		}
	$i++;
    }
	$execute_query_click = mysql_query($insert_click);	
	   if($execute_query_click)
		{
			$success_insert_click = mysql_insert_id();
		}else{
			$success_insert_click = mysql_error();
		}	  
           return $success_insert_click;
    }
	
	public function Select_Blast($Tablename,$FieldName,$pid){
		$select_Blast = "SELECT * from ".$Tablename." where ".$FieldName."=".$pid;  
	    $execute_query_Blast = mysql_query($select_Blast);	
        return $execute_query_Blast;
	}
	
	public function Select_Blast_two($Tablename,$FFieldName,$SFieldName,$fid,$sid){
		$select_Blast = "SELECT * from ".$Tablename." where ".$FFieldName."=".$fid." and ".$SFieldName."=".$sid;   
	    $execute_query_Blast = mysql_query($select_Blast);	
        return $execute_query_Blast;
	}
	
	public function Select_Blast_three($Tablename,$FFieldName,$SFieldName,$TFieldName,$fid,$sid,$tid){
		$select_Blast = "SELECT * from ".$Tablename." where ".$FFieldName."=".$fid." and ".$SFieldName."=".$sid." and ".$TFieldName."=".$tid;   
	    $execute_query_Blast = mysql_query($select_Blast);	
        return $execute_query_Blast;
	}
	
	public function Update_Blast($Tablename,$fid,$sid,$FFieldName,$SFieldName,$FieldTypes){
		$update_Blast = "UPDATE ".$Tablename." SET ";
	    $count_Blast  = count($FieldTypes);
		$i = 1;
	    foreach($FieldTypes as $key=>$value) {
			   $update_Blast .= "`".$key."`   = '".$value."'";
			 if($count_Blast != $i){
				   $update_Blast .=",";
			 }
		 $i++;
         }
		$update_Blast .=" where ".$FFieldName."=".$fid." and ".$SFieldName."=".$sid;  
	    $execute_query_Blast = mysql_query($update_Blast);	
        return $success_update_Blast;
	}
	public function Update_Blast_single($Tablename,$fid,$FFieldName,$FieldTypes){
		$update_Blast = "UPDATE ".$Tablename." SET ";
	    $count_Blast  = count($FieldTypes);
		$i = 1;
	    foreach($FieldTypes as $key=>$value) {
			   $update_Blast .= "`".$key."`   = '".$value."'";
			 if($count_Blast != $i){
				   $update_Blast .=",";
			 }
		 $i++;
         }
		$update_Blast .=" where ".$FFieldName."=".$fid;  

	    $execute_query_Blast = mysql_query($update_Blast);	
        return $success_update_Blast;
	}
	
	function Campaign_Details_JOIN($campaignid,$company_admin){
		  $sel_blast_templates   =  "
		SELECT A.id,A.camp_id,A.email_subject,A.from_name,A.from_email,A.to_address,A.mail_content,A.template_type,B.c_name,B.c_keyword,B.crypt_url FROM compaign_name A, campaign_list B  WHERE A.company_admin='".$company_admin."' and A.id =".$campaignid." and A.camp_id = B.id" ; 
		$templates_data_blast  = mysql_query($sel_blast_templates);
		return $templates_data_blast;
	}
	
	function clicked_Blasts_JOIN($id){
		 $sel_blast_templates   ="SELECT distinct B.click_id,B.url_subject FROM click_rate A, template_urls B  WHERE A.click_id=B.click_id and A.email_subject_id =".$id; 
		$templates_data_blast  = mysql_query($sel_blast_templates);
		return $templates_data_blast;
	}
	
	function Click_View_JOIN($click_id){
		 $sel_blast_templates   ="SELECT A.click_time,B.email,B.firstname,B.lastname FROM click_rate A, user_tbl B  WHERE A.user_id=B.id and A.click_id =".$click_id; 
		$templates_data_blast  = mysql_query($sel_blast_templates);
		return $templates_data_blast;
	}
	
	
	
	
	public function Select_Blast_three_page($Tablename,$FFieldName,$SFieldName,$TFieldName,$fid,$sid,$tid, $start, $limit){
	 	$select_Blast = "SELECT * from ".$Tablename." where ".$FFieldName."=".$fid." and ".$SFieldName."=".$sid." and ".$TFieldName."=".$tid." LIMIT ". $start ."," . $limit;   
	    $execute_query_Blast = mysql_query($select_Blast);	
        return $execute_query_Blast;
		
	}
	
	
}


?>