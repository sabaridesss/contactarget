<?php

//include("smarty_config.php");

$category_array = array();
$indus_array = array();
$tech_array = array();

$categoryDetail = 'SELECT * FROM sitecat_tbl order by sitecat_id ASC'; 
$exCatDetail = mysql_query($categoryDetail);


$industry = 'SELECT * FROM industry';
$exIndu = mysql_query($industry);
	
$technology = 'SELECT * FROM technology_tbl';
$exTech = mysql_query($technology);

if(is_resource($exCatDetail)) {
	$m = 0;
	
	while($row = mysql_fetch_assoc($exCatDetail)) {
	
		$category_array[$m] = $row;
		$m++;
		
	}
}
	
	
if(is_resource($exIndu)) {
	$m = 0;
	
	while($row = mysql_fetch_assoc($exIndu)) {
	
		$indus_array[$m] = $row;
		$m++;
		
	}	
}


if(is_resource($exTech)) {
	$m = 0;
	
	while($row = mysql_fetch_assoc($exTech)) {
	
		$tech_array[$m] = $row;
		$m++;
		
	}	
}


$combination_array = array();
$l = 0;




for($i=0;$i<count($category_array);$i++){

	/*$category_array[$i]['sitecat_name'] = str_replace("&","&",$category_array[$i]['sitecat_name']);
	$category_array[$i]['sitecat_id'] = str_replace("&","&",$category_array[$i]['sitecat_id']);
	*/
	$combination_array[$l] =  "http://webdesignerhouston.us/webdesign_portfolio.php?category=".$category_array[$i]['sitecat_name']."&industry=&technology=&cat=".$category_array[$i]['sitecat_id']."&tec=&ind=&search.x=30&search.y=16";
	
	$l++;
	
	for($j=0;$j<count($indus_array);$j++){
		
		/*$category_array[$i]['sitecat_name'] = str_replace("&","&",$category_array[$i]['sitecat_name']);
		$category_array[$i]['sitecat_id'] = str_replace("&","&",$category_array[$i]['sitecat_id']);
		$indus_array[$j]['industry_name'] = str_replace("&","&",$indus_array[$j]['industry_name']);
		$indus_array[$j]['industry_id'] = str_replace("&","&",$indus_array[$j]['industry_id']);*/
	
		$combination_array[$l] =  "http://webdesignerhouston.us/webdesign_portfolio.php?category=".$category_array[$i]['sitecat_name']."&industry=".$indus_array[$j]['industry_name']."&technology=&cat=".$category_array[$i]['sitecat_id']."&tec=&ind=".$indus_array[$j]['industry_id']."&search.x=30&search.y=16";
		
		$l++;
	
		for($k=0;$k<count($tech_array);$k++){
			
			$combination_array[$l] =  "http://webdesignerhouston.us/webdesign_portfolio.php?category=".$category_array[$i]['sitecat_name']."&industry=".$indus_array[$j]['industry_name']."&technology=".$tech_array[$k]['technology_name']."&cat=".$category_array[$i]['sitecat_id']."&tec=".$tech_array[$k]['technology_id']."&ind=".$indus_array[$j]['industry_id']."&search.x=30&search.y=16";
			
			$l++;
			
		}
		
	}

}




for($i=0;$i<count($category_array);$i++){

	for($k=0;$k<count($tech_array);$k++){
	
		$combination_array[$l] =  "http://webdesignerhouston.us/webdesign_portfolio.php?category=".$category_array[$i]['sitecat_name']."&industry=&technology=".$tech_array[$k]['technology_name']."&cat=".$category_array[$i]['sitecat_id']."&tec=".$tech_array[$k]['technology_id']."&ind=&search.x=30&search.y=16";
		
		$l++;
	}
}



for($j=0;$j<count($indus_array);$j++) {
	
	$combination_array[$l] =  "http://webdesignerhouston.us/webdesign_portfolio.php?category=&industry=".$indus_array[$j]['industry_name']."&technology=&cat=&tec=&ind=".$indus_array[$j]['industry_id']."&search.x=30&search.y=16";
	$l++;
	
	for($k=0;$k<count($tech_array);$k++){ 
	
		$combination_array[$l] =  "http://webdesignerhouston.us/webdesign_portfolio.php?category=&industry=".$indus_array[$j]['industry_name']."&technology=".$tech_array[$k]['technology_name']."&cat=&tec=".$tech_array[$k]['technology_id']."&ind=".$indus_array[$j]['industry_id']."&search.x=30&search.y=16";
		$l++;
			
	}
	
}



for($k=0;$k<count($tech_array);$k++){ 
	
		$combination_array[$l] = $array3[$k];
		$combination_array[$l] =  "http://webdesignerhouston.us/webdesign_portfolio.php?category=&industry=&technology=".$tech_array[$k]['technology_name']."&cat=&tec=".$tech_array[$k]['technology_id']."&ind=&search.x=30&search.y=16";
		$l++;
			
}

/*echo "<pre>";
print_r($combination_array);
echo "</pre>";*/





?>