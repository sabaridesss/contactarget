<?php session_start();
 ob_start();
 //-------------configuration file--------------
 error_reporting(0);
/*error_reporting(-1);
ini_set('display_errors', '1');*/

 date_default_timezone_set('America/Chicago');
 ini_set('session.gc_maxlifetime', '608800');

 
// include("fckeditor/fckeditor.php");
 require('dbconnect.php');
 require('MYSQL.php');
 require('common_functions.php');
 $obj_mysql = new mysql_class();
 
 
 $obj_mysql->db_connect(DB_HOST,DB_USER,DB_PASS);
 
 $obj_mysql->db_select_db(DB_NAME);
 
  //db_connect(DB_HOST,DB_USER,DB_PASS);
 
 //db_select_db(DB_NAME);

 if(isset($_REQUEST["campid"]))
{
$campid = $_REQUEST["campid"]; 
$usr = $_REQUEST["user"]; 
$sendlist  = $_REQUEST["sendlist"]; 
 $check_select="SELECT * FROM user_tbl WHERE id=".$usr;
$select_record=mysql_query($check_select);
 mysql_num_rows($select_record);
$select_fetch=mysql_fetch_array($select_record);
if(mysql_num_rows($select_record)>0)
{
 $insert="update comp_user_tbl set clicks='1' where send_id=".$sendlist." and campaign_name = ".$campid." and email='".$select_fetch['email']."'" ;
$rows_affected = mysql_query($insert); 
}
 
}


if(isset($_SESSION['company_admin']))
{

$company_admin=$_SESSION['company_admin'];


}
$fullpath='http://www.mailtides.com/';
?>