<?php 
include("smarty_config.php");

// Update Original Content
if($_REQUEST['uval'])
{
$uval 	  =  $_REQUEST['uval'];
$pdfid    =  $_REQUEST['pdfid'];
$query 	  = "UPDATE file_attach 
			 set org_content	= '".$uval."'
			 where id 			= ".$pdfid;
$exUpdate = mysql_query($query);
}

// Insert For Save AS Concept
if($_REQUEST['new'])
{
$Insert_val =  $_REQUEST['ival'];
$Title 		=  $_REQUEST['title'];
$query 		= "INSERT file_attach 
		  	                    SET  org_content		='".$Insert_val."',
		       						 company_admin		='".$company_admin."',
		       		                 name_file			='".$Title."',
		       		                 template_type		='static'";
$exUpdate   = mysql_query($query);
$lastid		= mysql_insert_id();
echo  'edit_dynamic_template_pdf.php?pdfid='.$lastid.'&save=save';
}




?>