<?php
  $dbh2 = mysql_connect('localhost', 'contactdbnameuse', 'desss@123S', true); 
  mysql_select_db('contactdbname', $dbh2);

 $ip_address    =  $_SERVER['REMOTE_ADDR'];
 $campid 		=  34;
 
 if(isset($campid)){
   		$sel_tbl_main_cat="SELECT c_name FROM campaign_list WHERE  id=".$campid;
		
  		$query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat, $dbh2);
  		$tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat);
  		if(!$query1_tbl_main_cat)
			mysql_error();
			$camp_count=mysql_num_rows($query1_tbl_main_cat);
			$camp_count;
  				if($camp_count>0)
  					$camp_name		= $tbl_main_cat_Fetch['c_name'];
  					$camp_id 		= $campid; 
					//$camp_user 		= $_REQUEST["user"]; 
					//$camp_sendlist  = $_REQUEST["sendlist"]; 
					$camp_user 		= "test"; 
					$camp_sendlist  = "test1";
 }else{
					$camp_count		= 0;
					$camp_id 		= ""; 
					$camp_user 		= ""; 
					$camp_sendlist  = ""; 
 }
 function get_keyword($referer){
 	
    $search_phrase = '';
    $engines = array('dmoz'     => 'q=',
                     'aol'      => 'q=',
                     'ask'      => 'q=',
                     'google'   => 'q=',
                     'bing'     => 'q=',
                     'hotbot'   => 'q=',
                     'teoma'    => 'q=',
                     'yahoo'    => 'p=',
                     'altavista'=> 'p=',
                     'lycos'    => 'query=',
                     'kanoodle' => 'query='
                     );
 
    foreach($engines as $engine => $query_param) {
        // Check if the referer is a search engine from our list.
        // Also check if the query parameter is valid.
        if (strpos($referer, $engine.".") !==  false && 
            strpos($referer, $query_param) !==  false) {
 
            // Grab the keyword from the referer url
            $referer .= "&";
            $pattern = "/[?&]{$query_param}(.*?)&/si";
            preg_match($pattern, $referer, $matches);
            $search_phrase = urldecode($matches[1]);
            return array($engine, $search_phrase);
        }   
    }
    return;
}
 $http_referer  = $_SERVER['HTTP_REFERER'];
 $data          = get_keyword($http_referer);
 $engine        = $data[0];
if($data){
  include('browser_type.php');
  $search_keyword = $data[1];
  $browser_name        = $browser->getBrowser();
  $browser_type        = $browser->getVersion();
  $browser        = $browser_name .'('.$browser_type.')';
  $keyword_query  = "insert into track_keywords (ip_address,search_engine,keywords,browser,created_date) values ('".$ip_address."','".$engine."','".$search_keyword."','".$browser."',now())";
	
	mysql_query($keyword_query, $dbh2);
  

}
 
 $php_sess_id    = session_id(); 
 $dest_url       = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
 $today_date  	 = date('Y-m-d');

 $select_ip     = "select * from tracking_tbl where ip_address = '".$ip_address."' and track_date = '$today_date'";
 $implem_ip     =  mysql_query($select_ip, $dbh2);
 $ip_rows       =  mysql_num_rows($implem_ip);
 $fetch_id_ip   =  mysql_fetch_array($implem_ip);
	
 if($ip_rows == 1){
		 if($fetch_id_ip['d2'] == ""){
		 	$column_id = 'd2';
		 }
		 else if($fetch_id_ip['d3'] == "")
		 {
		 $column_id = 'd3';
		 }
		 else if($fetch_id_ip['d4'] == "")
		 {
		  $column_id = 'd4';
		 }
		 else if($fetch_id_ip['d5'] == "")
		 {
		   $column_id = 'd5';
		 }
		 	 else if($fetch_id_ip['d6'] == "")
		 {
		   $column_id = 'd6';
		 }
		 	 else if($fetch_id_ip['d7'] == "")
		 {
		   $column_id = 'd7';
		 }
		 	 else if($fetch_id_ip['d8'] == "")
		 {
		   $column_id = 'd8';
		 }
		 	 else if($fetch_id_ip['d9'] == "")
		 {
		   $column_id = 'd9';
		 }
		 	 	 else if($fetch_id_ip['d10'] == "")
		 {
		   $column_id = 'd10';
		 }
		 	 	 	 else if($fetch_id_ip['d11'] == "")
		 {
		   $column_id = 'd11';
		 }
		 	 	 	 else if($fetch_id_ip['d12'] == "")
		 {
		   $column_id = 'd12';
		 }
		  else if($fetch_id_ip['d13'] == "")
		 {
		   $column_id = 'd13';
		 }
		  else if($fetch_id_ip['d14'] == "")
		 {
		   $column_id = 'd14';
		 }
		 	  else if($fetch_id_ip['d15'] == "")
		 {
		   $column_id = 'd15';
		 }
		 else if($fetch_id_ip['d16'] == "")
		 {
		   $column_id = 'd16';
		 }
		 	 else if($fetch_id_ip['d17'] == "")
		 {
		   $column_id = 'd17';
		 }
		 	 else if($fetch_id_ip['d18'] == "")
		 {
		   $column_id = 'd18';
		 }
		 	 else if($fetch_id_ip['d19'] == "")
		 {
		   $column_id = 'd19';
		 }
		 	 else if($fetch_id_ip['d20'] == "")
		 {
		   $column_id = 'd20';
		 }

	     if($camp_name == "")
		 {
		   $camp_name = $fetch_id_ip['campaign_list'];
		 }

	   $query = "update tracking_tbl set ".$column_id."='".$dest_url."',campaign_list = '".$camp_name."',php_sess_id='".$php_sess_id."',created_date_time=now() where id='".$fetch_id_ip['id']."'";
			mysql_query($query, $dbh2);
	}else if($ip_rows == 0){
	
	  if($ip_address != ""){
	 $query = "insert into tracking_tbl (ip_address,source_url,campaign_list,d1,php_sess_id,browser_type,keyword,created_date,created_date_time,track_date,camp_id, 	camp_user,camp_sendlist) values ('".$ip_address."','".$engine."','".$camp_name."','".$dest_url."','".$php_sess_id."','".$browser."','".$search_keyword."',now(),now(),'".$today_date."','".$camp_id."','".$camp_user."','".$camp_sendlist."')";
	mysql_query($query, $dbh2);
	  }
	
	}
mysql_close($dbh2);

?>


