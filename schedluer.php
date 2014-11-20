<?php 
 //-------------configuration file--------------
 error_reporting(0);
 ob_start();
 date_default_timezone_set('America/Chicago');
 ini_set('session.gc_maxlifetime', '608800');
 session_start();
 include("fckeditor/fckeditor.php");
 require('dbconnect.php');
 require('MYSQL.php');
 require('common_functions.php');
 $obj_mysql = new mysql_class();
 $obj_mysql->db_connect(DB_HOST,DB_USER,DB_PASS);
 $obj_mysql->db_select_db(DB_NAME);
 $fullpath='http://www.contacttarget.com/';
 include("phpmailfunction.php");
 
 
 ///////////////DATE/////////////////////
 $today_date  = date('Y-m-d h:i:s');
 /****************************************/
 echo $sel_blast_templates   =  "
SELECT A.*,B.c_name,B.c_keyword,B.crypt_url FROM compaign_name A, campaign_list B  WHERE A.schedule_mail <='".$today_date."' and A.status != 'complete' and A.camp_id = B.id" ;
	$query1_sel_blast_templates  = mysql_query($sel_blast_templates);
	$templates_data_blast        =  mysql_fetch_array($query1_sel_blast_templates);	
?>