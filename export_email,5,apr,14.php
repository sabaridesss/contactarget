<?php 
include("smarty_config.php");
 
 
if($_REQUEST['sort']=='All')
{
 $query = "select  firstname as FirstName,lastname as LastName,subscribe as Subscribe(0-for-Yes&1-for-No),email as Email from user_tbl where company_admin=$company_admin order by id asc";
 
}

else
{ 
 
 
 $query = "select  firstname as FirstName,lastname as LastName,subscribe as Subscribe,email as Email from user_tbl  where  user_type='".$_REQUEST['sort']."' and company_admin=$company_admin order by id asc";
}
$result = mysql_query($query);
if(!$result)
$error_mail= mysql_error();
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

header("Content-Disposition: attachment; filename=Audience-".$_REQUEST['sort']."-".date('d_m_y').".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo $header."\n".$data;

//print "done";
 ob_end_flush(); ?>