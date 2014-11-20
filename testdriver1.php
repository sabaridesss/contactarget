<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<body>

<?php
include("smarty_config.php");
//error_reporting(E_ALL);
require_once("bounce_driver.class.php");
$bouncehandler = new Bouncehandler();
$i=1;
if(!empty($_GET['testall'])){
    $files = get_sorted_file_list('eml55');
    if (is_array($files)) {
     //  echo "<P>File Tests:</P>\n";
       foreach($files as $file) {
          //  echo "<a href=\"".$_SERVER['PHP_SELF']."?eml=".urlencode($file)."\">$file</a> ";
            $bounce = file_get_contents("eml55/".$file);
            $multiArray = $bouncehandler->get_the_facts($bounce);
            if(   !empty($multiArray[0]['action'])
               && !empty($multiArray[0]['status'])
               && !empty($multiArray[0]['recipient']) ){
              $bounce = file_get_contents("eml55/".$file);
							$domain_company = strstr($bounce, 'Reply-to:');
$domain_company1 = explode('Subject:',$domain_company); 
$domain_company2 = str_replace('Reply-to:','',$domain_company1); 
$variable = str_replace(' ','',$domain_company2[0]);
$string = rtrim($variable);

//print_r($string);
$pieces = explode("+15#", $string);


echo $campaign_name = (int)$pieces[0];
echo "<br/>";
echo $send_id = (int)$pieces[1];
echo "<br/>";
echo $company_admin1 = (int)$pieces[2];
echo "<br/>";
echo $userid_bounce_val = (int)$pieces[3];
echo "<br/>";



$sel_tbl_main_cat="SELECT email,id FROM user_tbl WHERE company_admin='$company_admin' AND  email='".$multiArray[0][recipient]."'";
  $query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat);
  
  
  if(mysql_num_rows($query1_tbl_main_cat)>0)
  {
  $tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat);


 echo $sql_update = "update  comp_user_tbl SET  `no_of_bounce` = '1' where company_admin='".$company_admin1."' AND send_id='".$send_id."' AND  `user_id` = '".$tbl_main_cat_Fetch['id']."' and `campaign_name` = ".$campaign_name;
 
 $query1_tbl_main  = mysql_query($sql_update);

}
    //  $multiArray = $bouncehandler->get_the_facts($bounce);
	  
   // echo "<TEXTAREA COLS=100 ROWS=".(count($multiArray)*8).">";
//print_r($bouncehandler); exit;

    print_r($multiArray[0][recipient]);
 echo "<br>\n";

    $bounce = $bouncehandler->init_bouncehandler($bounce, 'string');
    list($head, $body) = preg_split("/\r\n\r\n/", $bounce, 2);
				
				
            }
            else{
              
                print_r($multiArray[0][recipient]);
             
            }
			
			$i++;
       }
    }
}
echo $i;
?>

<?

// a perl regular expression to find a web beacon in the email body
$bouncehandler->web_beacon_preg_1 = "/u=([0-9a-fA-F]{32})/";
$bouncehandler->web_beacon_preg_2 = "/m=(\d*)/";

// find a web beacon in an X-header field (in the head section)
$bouncehandler->x_header_search_1 = "X-ctnlist-suid";
//$bouncehandler->x_header_search_2 = "X-sumthin-sumpin";







/*
                $status_code = $bouncehandler->format_status_code($rpt_hash['per_recipient'][$i]['Status']);
                $status_code_msg = $bouncehandler->fetch_status_messages($status_code['code']);
                $status_code_remote_msg = $status_code['text'];
                $diag_code = $bouncehandler->format_status_code($rpt_hash['per_recipient'][$i]['Diagnostic-code']['text']);
                $diag_code_msg = $bouncehandler->fetch_status_messages($diag_code['code']);
                $diag_code_remote_msg = $diag_code['text'];
*/

function get_sorted_file_list($d){
    $fs = array();
    if ($h = opendir($d)) {
        while (false !== ($f = readdir($h))) {
            if($f=='.' || $f=='..') continue;
            $fs[] = $f;
        }
        closedir($h);
        sort($fs, SORT_STRING);//
    }
    return $fs;
}

?>
