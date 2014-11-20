<? 
ob_start();
header ("Content-Type:text/xml");
include("smarty_config.php");
include("portfolio_xml.php");

$query = 'SELECT * FROM menu_page_tbl';
$exQuery = mysql_query($query);


$page_url = 'SELECT * FROM site_tbl';
$exPage_url = mysql_query($page_url);


$url = $_REQUEST['url'];
$url = str_replace("&","&amp;",$url);
$date = date('Y-m-d');
$time = date('H:i:s');
$fre = $_REQUEST['frequency'];
$pfs = $_REQUEST['pfs'];

$stack = array();
$selectCity = 'SELECT site_city FROM websites_list_tbl';
$exCity = mysql_query($selectCity);
while($a = mysql_fetch_array($exCity))
{
	array_push($stack, $a['site_city']);
}

?>
<?php
$word ='<?xml version="1.0" encoding="iso-8859-1"?> 
<urlset>
<url>
  <loc>'.$url.'</loc>
  <lastmod>'.$date.'T0'.$time.'+00:00</lastmod>
  <changefreq>'.$fre.'</changefreq>
  <priority>1.00</priority>
</url>';
while($row = mysql_fetch_array($exQuery))
{

$row['file_name'] = str_replace("&","&amp;",$row['file_name']);
$word .= '<url>
  <loc>'.$url.'/'.$row['file_name'].'</loc>
  <lastmod>'.$date.'T0'.$time.'+00:00</lastmod>
  <changefreq>'.$fre.'</changefreq>
  <priority>0.80</priority>
</url>';

for($n=0;$n<count($stack);$n++)
{

$popPageUrl1 = explode('.',$row['file_name']);

$word .= '<url>
  <loc>'.$url.'/'.$popPageUrl1[0].'-'.$stack[$n].'.'.$popPageUrl1[1].'</loc>
  <lastmod>'.$date.'T0'.$time.'+00:00</lastmod>
  <changefreq>'.$fre.'</changefreq>
  <priority>0.80</priority>
</url>';

}


}


while($pageRow = mysql_fetch_array($exPage_url))
{
$pageRow['page_url'] = str_replace("&","&amp;",$pageRow['page_url']);
$popPageUrl = explode('.',$pageRow['page_url']);
$word .= '<url>
  <loc>'.$url.'/portfolio/'.$pageRow['site_id'].'/'.$popPageUrl[0].'-houston.'.$popPageUrl[1].'</loc>
  <lastmod>'.$date.'T0'.$time.'+00:00</lastmod>
  <changefreq>'.$fre.'</changefreq>
  <priority>0.80</priority>
</url>';
}


$word .= '<url>
<loc>'.$combination_array[$n].'</loc>
<lastmod>'.$date.'T0'.$time.'+00:00</lastmod>
<changefreq>'.$fre.'</changefreq>
<priority>0.80</priority>
</url>';


if($pfs == "1") {


for($n=0;$n<count($combination_array);$n++) {

$combination_array[$n] = str_replace("&","&amp;",$combination_array[$n]);

$word .= '<url>
<loc>'.$combination_array[$n].'</loc>
<lastmod>'.$date.'T0'.$time.'+00:00</lastmod>
<changefreq>'.$fre.'</changefreq>
<priority>0.80</priority>
</url>';
	
	}

}

$word .= '</urlset>';


$file_name = 'sitemap.xml';	
$fp=@fopen($file_name,'w');

fwrite($fp,$word);
fclose($fp);
@header("Cache-Control: ");// leave blank to avoid IE errors
@header("Pragma: ");// leave blank to avoid IE errors
@header("Content-type: application/octet-stream");
@header("Content-Disposition: attachment; filename=\"".$file_name."\"");
echo $word;
?>