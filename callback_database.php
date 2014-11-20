<?php
 
/* This is a sample callback function for PHPMailer-BMH (Bounce Mail Handler).
 * This callback function will echo the results of the BMH processing.
 */

/* Callback (action) function
 * @param int     $msgnum        the message number returned by Bounce Mail Handler
 * @param string  $bounce_type   the bounce type: 'antispam','autoreply','concurrent','content_reject','command_reject','internal_error','defer','delayed'        => array('remove'=>0,'bounce_type'=>'temporary'),'dns_loop','dns_unknown','full','inactive','latin_only','other','oversize','outofoffice','unknown','unrecognized','user_reject','warning'
 * @param string  $email         the target email address
 * @param string  $subject       the subject, ignore now
 * @param string  $xheader       the XBounceHeader from the mail
 * @param boolean $remove        remove status, 1 means removed, 0 means not removed
 * @param string  $rule_no       Bounce Mail Handler detect rule no.
 * @param string  $rule_cat      Bounce Mail Handler detect rule category.
 * @param int     $totalFetched  total number of messages in the mailbox
 * @return boolean
 */
function callbackAction ($msgnum, $bounce_type, $email, $subject, $xheader, $remove, $rule_no=false, $rule_cat=false, $totalFetched=0,$body) {

  // sample mysql code

//    echo "note: sample code would have set the database to allowed='false'<br />";
  
  
	
        

   

   


  $displayData = prepData($email, $bounce_type, $remove);
  $bounce_type = $displayData[bounce_type];
  $emailName   = $displayData[emailName];
  $emailAddy   = $displayData[emailAddy];
  $remove      = $displayData[remove];

  $msgnum . ': '  . $rule_no . ' | '  . $rule_cat . ' | '  . $bounce_type . ' | '  . $remove . ' | ' . $email . ' | '  . $subject . "<br />\n";




preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $email, $find);
 $find[0];
if($find[0]=="mailer-daemon@perfora.net")
{
preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $body, $matches);

$domain_company = strstr($body, 'Reply-to:');
$domain_company1 = explode('Subject:',$domain_company); 
$domain_company2 = str_replace('Reply-to:','',$domain_company1); 
 $domain_company2[0];
 
echo  $sql_update = "update  comp_user_tbl SET  `no_of_bounce` = '1' where  `email` = '" .  $matches[0]. "' and `campaign_name` = '".$domain_company2[0]."'";
$result_update = mysql_query($sql_update);
if($result_update)
{
echo "Records successfully Added";
}
else
{
echo mysql_error();
}
/*$selectQuery = "SELECT * FROM  mailinglist where email='".$matches[0]."'";
	$exQuery = mysql_query($selectQuery); 
 if(mysql_num_rows($exQuery)>0) { 
 


// prints @example.com;


 }
 else {
// $domain_company = strstr($body, 'Reply-to:');
//echo $domain_company; // prints @example.com

   $sql_update = "update  comp_user_tbl SET  no_of_bounce='1' where  email = '" .  $matches[0]. "' and id = ".$domain_company2[0];
        $result_update = mysql_query($sql_update);
		}*/

}
  return true;
}

/* Function to clean the data from the Callback Function for optimized display */
function prepData($email, $bounce_type, $remove) {
  $data[bounce_type] = trim($bounce_type);
  $data[email]       = '';
  $data[emailName]   = '';
  $data[emailAddy]   = '';
  $data[remove]      = '';
  if ( strstr($email,'<') ) {
    $pos_start = strpos($email,'<');
    $data[emailName] = trim(substr($email,0,$pos_start));
    $data[emailAddy] = substr($email,$pos_start + 1);
    $pos_end   = strpos($data[emailAddy],'>');
    if ( $pos_end ) {
      $data[emailAddy] = substr($data[emailAddy],0,$pos_end);
    }
  }

  // replace the < and > able so they display on screen
  $email = str_replace('<','&lt;',$email);
  $email = str_replace('>','&gt;',$email);
  $data[email]     = $email;

  // account for legitimate emails that have no bounce type
  if ( trim($bounce_type) == '' ) {
    $data[bounce_type] = 'none';
  }

  // change the remove flag from true or 1 to textual representation
  if ( stristr($remove,'moved') && stristr($remove,'hard') ) {
    $data[removestat] = 'moved (hard)';
    $data[remove] = '<span style="color:red;">' . 'moved (hard)' . '</span>';
  } elseif ( stristr($remove,'moved') && stristr($remove,'soft') ) {
    $data[removestat] = 'moved (soft)';
    $data[remove] = '<span style="color:gray;">' . 'moved (soft)' . '</span>';
  } elseif ( $remove == true || $remove == '1' ) {
    $data[removestat] = 'deleted';
    $data[remove] = '<span style="color:red;">' . 'deleted' . '</span>';
  } else {
    $data[removestat] = 'not deleted';
    $data[remove] = '<span style="color:gray;">' . 'not deleted' . '</span>';
  }

  return $data;
}

?>
