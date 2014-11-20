<?php 
include("smarty_config.php");
 
$query="SELECT quote_name as Name,quote_phone as PhoneNumber,quote_email as Email,quote_qustcomments as Comments  FROM new_re_quote WHERE  date_time between '$_REQUEST[reqSdate]'and '$_REQUEST[reqEdate]'";

//$query="SELECT a.price_id,a.companyName,a.model_no,a.model_type,a.moq,price_each,b.delivery,c.description FROM int_pricelist a, int_stock_delivery b,int_description c WHERE a.model_no= b.model_no AND a.model_no= c.model_no AND a.companyName = b.companyName AND a.companyName = c.companyName";
$result = mysql_query($query);
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

header("Content-Disposition: attachment; filename=Request Quote".date('d_m_y').".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo $header."\n".$data;

//print "done";
 ob_end_flush(); ?>