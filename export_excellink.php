<?php 
include("smarty_config.php");
 
$excel_query="SELECT title as Title,file_name as URL,meta_keyword as Keywords,meta_content as Description,h1_title as H1,h2_title as H2, 	real_description as Content FROM menu_page_tbl";

//$query="SELECT a.price_id,a.companyName,a.model_no,a.model_type,a.moq,price_each,b.delivery,c.description FROM int_pricelist a, int_stock_delivery b,int_description c WHERE a.model_no= b.model_no AND a.model_no= c.model_no AND a.companyName = b.companyName AND a.companyName = c.companyName";
$result = mysql_query($excel_query);
$count = mysql_num_fields($result);
for ($i = 0; $i < $count; $i++){
$header .= mysql_field_name($result, $i)."\t";
}
while($row = mysql_fetch_row($result)){
$line = '';
foreach($row as $value){
if(!isset($value) || $value == ""){
$value = "\t";
}else{
# important to escape any quotes to preserve them in the data.
$value = str_replace('"', '""', $value);
# needed to encapsulate data in quotes because some data might be multi line.
# the good news is that numbers remain numbers in Excel even though quoted.
$value = '"' . $value . '"' . "\t";
}
$line .= $value;
}
$data .= trim($line)."\n";
}
# this line is needed because returns embedded in the data have "\r"
# and this looks like a "box character" in Excel
$data = str_replace("\r", "", $data);


# Nice to let someone know that the search came up empty.
# Otherwise only the column name headers will be output to Excel.
if ($data == "") {
$data = "\nno matching records found\n";
}

# This line will stream the file to the user rather than spray it across the screen
//header("Content-Type: application/vnd.ms-excel; name='excel'");

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=Link-Exchange-".$_REQUEST[reqSdate]."-To-".$_REQUEST[reqEdate].".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo $header."\n".$data;

//print "done";
 ob_end_flush(); ?>