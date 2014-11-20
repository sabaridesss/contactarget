<?php include("smarty_config.php");


if($_REQUEST['dval']  && $_REQUEST['uval'])
{


$query2= "select * from  file_attach where company_admin='$company_admin' and id=".$_SESSION['pdfid']." order by id desc";
$query_result = mysql_query($query2);
$count_save_mail=mysql_num_rows($query_result);
$fetch_val=mysql_fetch_array($query_result);

 if($_REQUEST['dval']=='banner_left')
{
$id='banner_left';
$newdata = "<div id=\"banner_left\"><img  src=\"".$fullpath.$_REQUEST['uval']."\"  style=\"max-width: 188px;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;\" class=\"mcnImage\" width=\"188\" height=\"148\"    /> </div>";

}
else if($_REQUEST['dval']=='banner_right')
{
$id='banner_right';
$newdata = "<div id=\"banner_right\"><img  src=\"".$fullpath.$_REQUEST['uval']."\"  style=\"max-width: 188px;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;\" class=\"mcnImage\" width=\"188\"  height=\"148\"   /> </div>";

}

else if($_REQUEST['dval']=='banner_footer')
{

$id='banner_footer';
$newdata = "<div id=\"banner_footer\"><img style=\"max-width: 600px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;\" class=\"mcnImage\" align=\"left\" width=\"564\" src=\"".$fullpath.$_REQUEST['uval']."\"   /> </div>";
}
else if($_REQUEST['dval']=='banner_custom')
{

$id='banner_custom';
$newdata = "<div id=\"banner_custom\"><img width='900' style='margin-bottom:30px;' src=\"".$fullpath.$_REQUEST['uval']."\"   /> </div>";
}
else
{

$id='banner_full';
$newdata = "<div id=\"banner_full\"><img style=\"max-width: 600px;padding-bottom: 0;display: inline !important;vertical-align: bottom;border: 0;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;\" class=\"mcnImage\" align=\"left\" width=\"564\" src=\"".$fullpath.$_REQUEST['uval']."\"   /> </div>";
}

$content = preg_replace("#<div[^>]*id=\"{$id}\".*?</div>#si",$newdata,stripslashes($fetch_val['org_content']));
echo $query = "update file_attach set org_content='".addslashes(trim($content))."' where  id = '".$_SESSION['pdfid']."'";
$exUpdate = mysql_query($query);


}
















?>