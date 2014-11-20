<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

     $query2= "select * from   file_attach where company_admin='$company_admin'  order by id desc";
	$query_result = mysql_query($query2);
	$count_save_mail=mysql_num_rows($query_result);

  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = '<div class="alert alert-success">

<strong> Success ! </strong>
 Saved Successfully.
</div> ';	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg =  '<div class="alert alert-success">

<strong>Success ! </strong>
 Updated Successfully.
</div> ';	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = '<div class="alert alert-info">
<button type="button" data-dismiss="alert" class="close"></button>
<strong>Success ! </strong>Your
 Deleted Successfully.
</div>';	
	}else if($_REQUEST["msg"] == '5'){
	
		$msg = '<div class="alert alert-info">
<button type="button" data-dismiss="alert" class="close"></button>
<strong>Success ! </strong>Your
 scheduled Successfully.
</div>';	
	}
//DELETE PDF
	if($_REQUEST['delete']=="true") {
		$Id 		  = $_REQUEST['id'];
		$Pdf_name     = $_REQUEST['pdf_name'];		
		$Query_delete = "delete from file_attach where company_admin='$company_admin' and id =".$Id;
		if(mysql_query($Query_delete)) {		
									unlink("pdf/".$Pdf_name);
									header("Location:preview_pdf.php?msg=4");		
				                    }
	}
	
//Editing PDF	
	if($_REQUEST['edit']=="true") {
	
		$Id			    = $_REQUEST['id'];		
		$Query_Edit     = "SELECT template_type from file_attach where company_admin='$company_admin' and id =".$Id;
		$Query_run_Edit = mysql_query($Query_Edit);
		if($Query_run_Edit) {
				$Fetch_type_pdf=mysql_fetch_array($Query_run_Edit);
				if($Fetch_type_pdf['template_type']=='static')		
					header("Location:edit_dynamic_template_pdf.php?edit=true&pdfid=".$Id);
				else			
					header("Location:dynamic_template_pdf.php?edit=true&pdfid=".$Id);
				}
	}
	
	
//Copy New Value
if($_REQUEST['Copy']) {

 $id    = $_REQUEST['insertid'];
 $title = $_REQUEST['title'];
		
 $query = "INSERT INTO `file_attach` ( name_file , company_admin, file_name_attach, pdf_name, org_content ,template_type)
		   SELECT  '".$title."' , company_admin, file_name_attach, pdf_name, org_content ,template_type
		   FROM `file_attach`
		   WHERE `id`=".$id;
		  if(mysql_query($query)) {
					header("Location:preview_pdf.php?msg=3");	} else { echo mysql_error(); exit; } }			
	
	
}
?>
<?php include ('common/header.php')?>
<script type="text/javascript">
<!--
function getConfirmation(){
   var retVal = confirm("Do you want to Delete ?");
   if( retVal == true ){
     
	  return true;
   }else{
    
	  return false;
   }
}


function save_as_pdf_prompt(id)
{

var title;
title		   = prompt('Enter PDF Title');

if (title!="")
{

if(title!=null)
{
window.location.replace('preview_pdf.php?Copy=Copy&insertid='+id+'&title='+title);
}
else
{

   return false; 
}

}
else
   {
   alert('Please Enter Valid Title');
   return false;
    }
	   return false; 
}

//-->
</script>
<link rel="stylesheet" href="css/tinypopup_style.css" />
<script type="text/javascript" src="javascript/tinybox.js"></script>
<table width="1200px" border="0" cellpadding="0">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td align="center" class="top"><?php include('common/top_menu.php') ?>
      <div class="wholesite-inner">
        <div>
          <?=$msg?>
        </div>
        <!--welcome admin start here-->
        <div class="welcome-admin">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
              <td width="55%" align="center" valign="middle"><strong><font color="#FF0000"> </font></strong></td>
              <td width="25%" align="right" valign="middle"><div class="addmenu"><a  href="add_gen_pdf.php">Generate PDF</a></div></td>
            </tr>
          </table>
        </div>
        <div class="content">
          <style > 
form {
    margin: 0 0 0 0 !important;
}
</style>
          <table width="100%" border="0" align="center" >
            <tr class="table1">
              <td height="30" align="center" class="style6"><strong>ID</strong></td>
              <td align="left" class="style6"><strong>Name </strong></td>
              <td align="left" class="style6"><strong>Pdf </strong></td>
              <td  align="left" class="style6"><strong>Action</strong></td>
            </tr>
            <? 
		  if($count_save_mail > 0)	  {
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	  
	    $class="table2";
	   if(($i%2)==0)
	     $class="table3";
		  
		  
		  
	       $img="pdf/".$item['pdf_name'];		   
		   $cnt=file_exists($img); 
			if($cnt=='1' && (trim($item['pdf_name'])!="") )	
			{
			$Pdf_status_view='target="_blank"  href="pdf/'.$item["pdf_name"].'"';
			$Pdf_title='Download PDF';
			}
			else
			{
			$Pdf_title='Generate PDF';
			if($item["template_type"]=='static')
			$Pdf_status_view='href="edit_dynamic_template_pdf.php?pdfid='.$item["id"].'"';
			else if($item["template_type"]=='dynamic')
			$Pdf_status_view='href="dynamic_template_pdf.php?pdfid='.$item["id"].'&edit=true"';
			else
				$Pdf_status_view='href="javascript:void(0)"';
			}
			 ?>
            <tr class="<?=$class?>">
              <td width="4%" height="27" align="center" class="style6"><?=$i?></td>
              <td width="30%" align="left" class="style6"><?=$item["name_file"]?>
                </td>
              <td width="30%" align="left" class="style6"><a class="btn btn-success"  <?=$Pdf_status_view?>> <i class="icon-zoom-in icon-white"></i> <?=$Pdf_title?> </a> </td>
              <td width="30%" align="left" class="style6"><a href="preview_pdf.php?id=<?=$item["id"]?>&edit=true"  class="btn btn-large btn-info" > <i class="icon-zoom-in icon-white"></i> Edit </a> <a   href="javascript:void(0)" onClick="return save_as_pdf_prompt('<?=$item["id"]?>');"  class=" btn btn-large  btn-primary  " > <i class="icon-zoom-in icon-white"></i> Copy </a> <a onclick="return getConfirmation()" class=" btn btn-large btn-danger"  href="preview_pdf.php?id=<?=$item["id"]?>&delete=true&pdf_name=<?=$item["pdf_name"]?>"> <i class="icon-zoom-in icon-white"></i> Delete </a> </td>
            </tr>
            <? $i++;  } }else { ?>
            <tr class="table3">
              <td width="4%" height="27" align="center" colspan="4" class="style6"> No Pdf Available</td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <!--welcome admin end here-->
      </div>
      <!--footer start here-->
      <?php include('common/footer.php'); ?>
      <!--footer end here-->
    </td>
  </tr>
</table>
</div>
</center>
</body></html>