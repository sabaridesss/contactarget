<?php
session_start();
include("smarty_config.php");
include('ip_tracking.php');
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} 

$camp_id=$_REQUEST['send_id'];


function cvDate($date)
{
	if($date != "")
	{
	 $split_dt = explode("/",$date);
	 $mon=$split_dt[0];
	  $da=$split_dt[1];
	   $yea=$split_dt[2];
	 $date_of_birth = $yea.'-'.$mon.'-'.$da;
	return $date_of_birth;
	}
}


function get_call_track_details1($start_date,$end_date,$pageno,$camp_id){
		
		echo	 $query = "select *,TIMEDIFF( created_date_time,created_date) as timespent,DATE_FORMAT(`created_date`,'%m/%d/%Y') AS date,track_date,campaign_list from `tracking_tbl` where camp_id = $camp_id ";
			
			if(!isset($pageno)) {
				$query .= "order by `created_date_time` desc limit 0,20";	
			} else {
				$limit_start = (($pageno-1)*20);
				$query .= " order by `created_date_time` desc limit ".$limit_start.",20";	
			}	
			
			//echo $query;
			
			$result = get_query_result1($query);	
			return  $result;	    
}

function get_call_track_details($start_date,$end_date,$camp_id){
			
			
			$query = "select * from `tracking_tbl`  where  camp_id = $camp_id";
		
			$query .= " order by `created_date_time` desc";	
			
			
			//echo $query."<br/>";	
			
			$result = get_query_result1($query);	
			return  $result;	    
}
/*function CustomerInfo($ip)
{
    // Get XML
    $XmlContent = file_get_contents('http://api.hostip.info/?ip='.$ip);
  
    // Get the country
    preg_match('#<countryName>(.*?)</countryName>#', $XmlContent, $country);
    // Get the city (Might return city unknown, hostip.info didnt recognize the city)
    preg_match_all('#<gml:name>(.*?)</gml:name>#', $XmlContent, $city);
    // Get the ip
    preg_match('#<ip>([\d\.]*)</ip>#', $XmlContent, $ip);
    // Get country abbreviation
    preg_match('#<countryAbbrev>([\w]*?)</countryAbbrev>#', $XmlContent, $abbr);
     
    // Return array, filled with information
    return array('country' => $country[1], 'country_code' => $abbr[1], 'ip' => $ip[1], 'city' => $city[1][1]);
  
}*/
 function ip_address_to_number($IPaddress)
{
    if ($IPaddress == "") {
        return 0;
    } else {
        $ips = split ("\.", "$IPaddress");
        $return_number =  ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
	
		   $Select = "SELECT * FROM GeoIP WHERE (beginIpNum <=".$return_number." AND endIpNum >=".$return_number." )"; 
	       $Query   =  mysql_query($Select);
	       $Record  =  mysql_fetch_array($Query);	
	   	   return $Record['countryName'];	
    }
}

$ip      = $_SERVER['REMOTE_ADDR'];
$country = ip_address_to_number($ip) ;
// Assign information to variable

function get_query_result1($query)
{
	$query_result = mysql_query($query);
	return $query_result;
}

function get_num_record1($result)
{
	$num_result = mysql_num_rows($result);
	return $num_result;
}	

function get_fetch_record1($result)
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
	
 if($_REQUEST['page'])  
{
    $pageno = $_REQUEST['page'];  
}
 else
{
    $pageno=1;	
}



if($_REQUEST['start_date'] != "")
{
 
 $start_date = $_REQUEST['start_date'];

} else {
	$start_date = "";
}

if($_REQUEST['end_date'] != "")
{

 $end_date = $_REQUEST['end_date'];

} else {
	$end_date = "";
}




// -----starts-------- function for export option ----starts--------//
 if(isset($_REQUEST['Export']) && ($_REQUEST['Export'] == "Export")) {
 $start_date = $_REQUEST['start_date'];
 $end_date = $_REQUEST['end_date'];
 $path = "download_track.php?type=".$type."&start_date=".$start_date."&end_date=".$end_date;

 header("location:$path");
 }
 // -----ends-------- function for export option ----ends--------//
 
 
  $get_call_track_details_for_pagination = get_call_track_details($start_date,$end_date);
  
  $rows_per_page = 2;
  $limit = 'LIMIT ' .($pageno - 1) * $rows_per_page .',' .$rows_per_page; 
  $num_rows  = get_num_record1($get_call_track_details_for_pagination);
  
   $lastpage = ceil($num_rows/$rows_per_page);
   
   
   
   
   function get_page($limit,$pageno,$start_date,$end_date,$status,$check_unique,$camp_id)
{

	$get_call_track_details = get_call_track_details1($start_date,$end_date,$pageno,$camp_id);
	
	 $num_of_records  = get_num_record1($get_call_track_details);
	
			  
	$fetch_call_tracks     = get_fetch_record1($get_call_track_details);
	
	
	for($i=0;$i<$num_of_records;$i++){	
	
	
		if($pageno == 1 || !isset($pageno)){	
		$sno = $i+1;
		}
		else
	   {
	   $rows_per_page = 1;
	   $eu =($pageno-1)*$rows_per_page;
	   $sno = $i+$eu+1;
	   }
		
		$output_array[$i] = array($sno,$fetch_call_tracks[$i]['id'],$fetch_call_tracks[$i]['ip_address'],$fetch_call_tracks[$i]['source_url'],$fetch_call_tracks[$i]['d1'],$fetch_call_tracks[$i]['d2'],$fetch_call_tracks[$i]['d3'],$fetch_call_tracks[$i]['d4'],$fetch_call_tracks[$i]['d5'],$fetch_call_tracks[$i]['d6'],$fetch_call_tracks[$i]['d7'],$fetch_call_tracks[$i]['d8'],$fetch_call_tracks[$i]['d9'],$fetch_call_tracks[$i]['d10'],$fetch_call_tracks[$i]['d11'],$fetch_call_tracks[$i]['d12'],$fetch_call_tracks[$i]['d13'],$fetch_call_tracks[$i]['d14'],$fetch_call_tracks[$i]['d15'],$fetch_call_tracks[$i]['d16'],$fetch_call_tracks[$i]['d17'],$fetch_call_tracks[$i]['d18'],$fetch_call_tracks[$i]['d19'],$fetch_call_tracks[$i]['d20'],$fetch_call_tracks[$i]['browser_type'],$fetch_call_tracks[$i]['keyword'],$fetch_call_tracks[$i]['track_date'],$fetch_call_tracks[$i]['campaign_list'],$fetch_call_tracks[$i]['camp_id'],$fetch_call_tracks[$i]['camp_user'],$fetch_call_tracks[$i]['company_user_id']);
		
					
	}
	
	return $output_array;

}
  

$output_array = get_page($limit,$pageno,$start_date,$end_date,$status,$check_unique,$camp_id);

 if ($pageno > $lastpage){
                $pageno = $lastpage;   
     } 
  if ($pageno < 1){
	      $pageno = 1;
     }
           
 $page_nation ="";
 
 if($num_rows > 2){
      if ($pageno == 1){
	  				
                    // $page_nation .=" FIRST PREV ";
       }
	   else
       {	
	   		
            $page_nation .=" <a class='menu_href' href='{$_SERVER['PHP_SELF']}?page=1&start_date=$start_date&end_date=$end_date&send_id=$camp_id'>FIRST</a>";
            $prevpage = $pageno-1;
            $page_nation .=" <a  class='menu_href' href='{$_SERVER['PHP_SELF']}?page=$prevpage&start_date=$start_date&end_date=$end_date&send_id=$camp_id'>PREV</a>";
       }
	   $page_nation .=" <span class='menu_href'>( Page $pageno of $lastpage )</span> ";
	   if($pageno == $lastpage){
                  //$page_nation .=" NEXT LAST ";
       }
	   else
       {
		   $nextpage = $pageno+1;
           $page_nation .=" <a class='menu_href' href='{$_SERVER['PHP_SELF']}?page=$nextpage&start_date=$start_date&end_date=$end_date&send_id=$camp_id'>NEXT</a> ";
		   
           $page_nation .=" <a class='menu_href' href='{$_SERVER['PHP_SELF']}?page=$lastpage&start_date=$start_date&end_date=$end_date&send_id=$camp_id'>LAST</a> ";
       }
    }else if($num_rows<1){
                    $page_nation .="No Items Found ";
    }
	
	$page_nation="<div align='center'>".$page_nation."</div>";
	
	
	
?>
<?php include ('common/header.php')?>
<link rel="stylesheet" href="css/tinypopup_style.css" />
<script type="text/javascript" src="javascript/tinybox.js"></script>
<form name="product_list" method="post" action="" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="content" style="min-height:800px">
            <table width="100%" border="0" align="left" bordercolor="#FFFFFF" >
              <!--<tr style="background-color:#efede2;">
                <td height="40" colspan="26" align="left" ><span style="color:#333;font-weight:bold;">Start Date</span>&nbsp;&nbsp;
                  <input type="text" name="start_date" id="start_date" value="<?php echo $start_date;?>" class='calender'>
                  &nbsp;
                  <script language='JavaScript'>
	new tcal ({
		// form name
		'formname': 'product_list',
		// input name
		'controlname': 'start_date'
	});

	</script>
                  &nbsp;&nbsp;<span style="color:#333; font-weight:bold;">End Date</span>&nbsp;&nbsp;
                  <input type="text" name="end_date" id="end_date" value="<?php echo $end_date;?>" class="calender">
                  &nbsp;
                  <script language='JavaScript'>
	new tcal ({
		// form name
		'formname': 'product_list',
		// input name
		'controlname': 'end_date'
	});

	</script>
                  &nbsp;&nbsp;
                  <input type="button" value="Search" class="addmenu2" onclick="return filter_by_options()">
                  &nbsp;&nbsp;
                  <input type="submit" value="Export" class="addmenu2" name="Export"/></td>
              </tr>-->
              <tr bgcolor="#cccccc">
                <td align="left" class="table1">Date</td>
                <!--<td align="left" class="table1">Time Spent</td>-->
                <td align="left" class="table1">User</td>
                <td class="table1">IP Address</td>
                <td class="table1">Country</td>
                <td class="table1">City</td>
                <td class="table1">Campaign</td>
                <td class="table1">Source</td>
                <td class="table1">Keyword</td>
                <td class="table1">d1</td>
                <td class="table1">d2</td>
                <td class="table1">d3</td>
                <td class="table1">d4</td>
                <td class="table1">d5</td>
                <td class="table1">d6</td>
                <td class="table1">d7</td>
                <td class="table1">d8</td>
                <td class="table1">d9</td>
                <td class="table1">d10</td>
                <td class="table1">d11</td>
                <td class="table1">d12</td>
                <td class="table1">d13</td>
                <td class="table1">d14</td>
                <td class="table1">d15</td>
                <td class="table1">d16</td>
                <td class="table1">d17</td>
                <td class="table1">d18</td>
                <td class="table1">d19</td>
                <td class="table1">d20</td>
                <!--<td class="table1">Browser</td>-->
              </tr>
              <? 
	  if(count($output_array)>0) {
	  		for($i=0;$i<count($output_array);$i++) {
				 $class="table2";
				if(($i%2)==0)
				 $class="table3";
				 $ip = $output_array[$i]['2'];
				 $InFo = ip_address_to_number($ip);
				 $id = $output_array[$i]['1'];
				 $select_ipquery1   =  "select * from cityip where ip_address = '".$output_array[$i]['2']."'";
				 $imple_ipquery1    =   mysql_query($select_ipquery1);
				 $fetch_ipquery1    =   mysql_fetch_array($imple_ipquery1);
		         $track_ip_city     =  $fetch_ipquery1['city_name'];
	    ?>
              <tr class="<?=$class;?>">
                <td align="left" class="style3"><?Php echo $output_array[$i]['26']; ?></td>
                <!--<td align="left" class="style3"><?Php echo $output_array[$i]['1']; ?></td>-->
                <td align="left" class="style3"><?php  $email_query = "SELECT firstname,lastname,email FROM user_tbl where id= ".$output_array[$i]['29'];
	
	$email_result = mysql_query($email_query);
	$array_k = mysql_fetch_array($email_result);
	if($array_k['email']!="")
	echo  ucfirst($array_k['firstname'])." ". $array_k['lastname']." <". $array_k['email'].">";
	?>
                  <!--<a onclick="TINY.box.show({url:'keyword_list.php',post:'id=<?php echo $id; ?>',boxid:'frameless',fixed:false,closejs:function(){closeJS()}})">List</a>--></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['2']; ?></td>
                <td align="left" class="style3"><?Php echo $InFo; ?></td>
                <td align="left" class="style3"><?Php if($track_ip_city != "")  { echo $track_ip_city; }
		   else
		   {
		   echo "Anonymous";
		   }
		   ?></td>
                <?php 
		if(preg_match('/http:\/\/(.*?)\//',$output_array[$i]['3'],$matches)) {
				$source_url = urldecode($matches[1]);
	    }
		
		?>
                <td align="left" class="style3"><?Php echo $output_array[$i]['27']; 
		
	 echo $query_curl =  "select a.camp_id,b.c_name,b.c_keyword from compaign_name a, campaign_list b where b.id = a.camp_id  AND a.id = ".$output_array[$i]['28'];
	$query_result_curl = @mysql_query($query_curl);
	
	if(!$query_result_curl)
	echo mysql_error();
	$item_save_curl = @mysql_fetch_array($query_result_curl);
	
	
	
	
	
	echo $item_save_curl['c_name'];
		 ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['3'];  ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['25']; echo $item_save_curl['c_keyword']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['4']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['5']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['6']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['7']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['8']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['9']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['10']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['11']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['12']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['13']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['14']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['15']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['16']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['17']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['18']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['19']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['20']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['21']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['22']; ?></td>
                <td align="left" class="style3"><?Php echo $output_array[$i]['23']; ?></td>
                <?php
		
		if(strstr($output_array[$i]['24'],"MSIE"))
				{
					$browser_type="Internet Explorer";
				} else {
					$browser_type="Mozilla Firefox";
				}
		
		?>
                <!--<td align="left" class="style3"><?Php echo $browser_type; ?></td>-->
              </tr>
              <?
		 }
	  } else {
	   ?>
              <tr bgcolor="#A1CDEA">
                <td align="center" class="style3" colspan="25">No Data Found</td>
              </tr>
              <? 
	  }
	  ?>
            </table>
            <div class="font2"><?Php echo $page_nation; ?></div>
          </div>
          <!--welcome admin end here-->
        </div>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here--></td>
    </tr>
  </table>
</form>
</div>
</center>
</body></html>