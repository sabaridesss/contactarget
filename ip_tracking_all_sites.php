<?php
//error_reporting();
//include("smarty_config.php");
include("smarty_config.php");
   
   $ip_address = $_REQUEST['ip_address']; 
 echo  $select_ipquery   =  "select * from cityip where ip_address = '".$ip_address."'";
  $imple_ipquery    =   mysql_query($select_ipquery );
  $fetch_ipquery    =   mysql_fetch_array($imple_ipquery);
 echo  $cont_ipquery     =   mysql_num_rows($imple_ipquery);
 echo "<br/>";
    if($cont_ipquery == 0)
	{
/*$params = getopt('l:i:');

if (!isset($params['l'])) $params['l'] = 'doUOaZInO9R9'; if (!isset($params['i'])) $params['i'] = '24.24.24.24';*/
$params = array(
    "l" => "P7ocw3LS3MMg",
    "i" => $ipaddress,
);
/*$params['l'] = 'doUOaZInO9R9';
$params['i'] = '24.24.24.24'*/
//print_r($params);

$query = 'http://geoip.maxmind.com/f?' . http_build_query($params);

$omni_keys =
  array(
        'country_code',
        'country_name',
        'region_code',
        'region_name',
        'city_name',
        'latitude',
        'longitude',
        'metro_code',
        'area_code',
        'time_zone',
        'continent_code',
        'postal_code',
        'isp_name',
        'organization_name',
        );

$curl = curl_init();
curl_setopt_array( $curl, 
                   array(
                         CURLOPT_URL => $query,
                         CURLOPT_USERAGENT => 'MaxMind PHP Sample',
                         CURLOPT_RETURNTRANSFER => true
                         )
                   );

$resp = curl_exec($curl);

if (curl_errno($curl)) {
  throw new Exception('GeoIP Request Failed'.curl_errno($curl)); }

$omni_values = str_getcsv($resp);

//print_r($omni_values);
    $insert_cityquery = "insert into cityip(country_code,country_code1,city_name,postal_code,lat,longitude,metro_code,area_code,isp_name,org_name,created_date,ip_address) values ('".$omni_values[0]."','".$omni_values[1]."','".$omni_values[2]."','".$omni_values[3]."','".$omni_values[4]."','".$omni_values[5]."','".$omni_values[6]."','".$omni_values[7]."','".$omni_values[8]."','".$omni_values[9]."',now(),'".$ipaddress."')";

$imple_cityquery = mysql_query($insert_cityquery);
     }
	 else
	 {
	 print_r($fetch_ipquery);
	 
	 }

   
?>

