<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$page_id=$_REQUEST["page_id"];
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit"))
	{
		
		
	
		foreach($_POST['text']as $key1=>$value1)
		{
		$del_pro2=$_POST['text'][$key1];
		
		$table_content2[].= $del_pro2; 	
	
		}
		
		foreach($_POST['sort_order']as $key1=>$value1)
		{
		$del_pro1=$_POST['sort_order'][$key1];
		$sort_order.=$_POST['sort_order'][$key1].'+$&+';
		
		$table_content1[].= $del_pro1; 	
	
		}
		
	
		
//print_r($table_content2);
//echo '<br>';
//print_r($table_content1);
		
$table_content3=array_combine($table_content1,$table_content2);
 ksort($table_content3);

foreach($table_content3 as $key3=>$value3)
		{
		$del_pro3=$table_content3[$key3];
		 
		
		$table_content.= $del_pro3.'+$&+'; 	
	
		}
		
		$norow_minus=$_POST['norows']-1;
		$nocol_minus=$_POST['nocols']-2;
	
	
	
	$fname = $_FILES['upImg']['name'];
	if($fname !="")
	{
		$tmpname = $_FILES['upImg']['tmp_name'];
		$path = "../uplodeImage/listicon/";
		$p_small = $path.$fname;
		$file_name_img=$fname;				
		
	move_uploaded_file($tmpname,$p_small);
	}
	
	else
	$file_name_img="";
	
	$query = 'INSERT INTO featured_table1
								SET
									tab_title	= \''.$_POST['tab_title'].'\',
									desc_data	= \''.$_POST['desc_data'].'\',
									page_id	= \''.$_POST['page_id'].'\',									
									image= \''.$file_name_img.'\',
									norows	= \''.$norow_minus.'\',
									nocols	= \''.$nocol_minus.'\',
									description	= \''.addslashes($table_content).'\'';
								
		
		$exInsert = mysql_query($query);
		if(!$exInsert)
echo mysql_error();
else
		header('location:featured_description1.php?msg=2&page_id='.$_POST['page_id']);									
	
	}



//Cancel Page
if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
{
	header('location:featured_description1.php?page_id='.$_POST['page_id']);		
}




}




?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript">
function close_window()
{
 window.close();

}
</script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script  src="javascript/jquery-1.4.4.min.js" type="text/javascript"></script>
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="clear:both"></div>
<script  type="text/javascript">
function allownumbers(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
	return false;

 return true;
}
</script>
<script>
// Add row to the HTML table
function addRow() {    
 var table = document.getElementById('my_table'); //html table
 var rowCount = table.rows.length; //no. of rows in table
 var columnCount =  table.rows[0].cells.length; //no. of columns in table          
 var row = table.insertRow(rowCount); //insert a row            
 
 var cell1 = row.insertCell(0); //create a new cell           
 var element1 = document.createElement("input"); //create a new element           
 element1.type = "checkbox"; //set the element type 
 element1.setAttribute('id', 'newCheckbox'); //set the id attribute         
 cell1.appendChild(element1); //append element to cell
             
var rowpluse=document.getElementById('norows').value;			 
			 
			 
var cell2 = row.insertCell(1);          
cell2.innerHTML = '<input type="text" name="sort_order[]" id="sort_order[]"  style="background-color:#FFFFFF;" value="'+rowpluse+'" />'; //append data to cell
 
 
var cell3 = row.insertCell(2);
      
cell3.innerHTML = '<textarea style="width: 200px; height: 40px;"style="background-color:#FFFFFF" id="text[]" value="" name="text[]"></textarea> '; //append data to cell
 
 



 //Add the cells for more than 3 columns
 if(columnCount >= 3){
  for (var i=4; i<=columnCount; i++) {
   var newCel = row.insertCell(i-1); //create a new cell           
   var element = document.createElement("div"); //create a div element
   var txt = document.createTextNode("cell "+i); //create a text element
   element.appendChild(txt); //append text to div      
   newCel.innerHTML = '<textarea style="width: 200px; height: 40px;"style="background-color:#FFFFFF" id="text[]" value="" name="text[]"></textarea> '; //appent div to cell
  }
 }
} 

// delete the selected rows from table
function deleteSelectedRows() {    
 var table = document.getElementById('my_table'); //html table
        var rowCount = table.rows.length; //no. of rows in table          
 for(var i=0; i< rowCount; i++) { //loops for all row in table               
  var row = table.rows[i]; //return a particular row              
  var chkbox = row.cells[0].childNodes[0]; //get check box onject               
  if(null != chkbox && true == chkbox.checked) { //wheather check box is selected                   
   table.deleteRow(i); //delete the selected row                    
   rowCount--; //decrease rowcount by 1                   
   i--;               
  }             
 }
}


</script>
<style>

table.jPicker {

    margin: 200px 10px !important;

}
</style>
<form  method="post" enctype="multipart/form-data" name="form1" >
  <table width="100%" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><div class="wholesite-inner">
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="content"> <br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top"> Add              
                  Features </td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="210" align="right" valign="top" id="title_name">Feature Title</td>
                      <td width="482" align="left"><input name="tab_title" type="text" id="tab_title" size="60" class="login-texbox1" value=""/>
                        <input type="hidden" id="page_id" name="page_id" value="<?=$page_id?>" /></td>
                    </tr>
                   <?php /*?><tr>
                      <td width="210" align="right" valign="top" id="title_name">List Image Icon</td>
                      <td width="482" align="left"><input name="upImg" type="file"  class="login-texbox1" id="upImg"  />
                      </td>
                    </tr>
                      <?php if($_REQUEST['image'] != '')
	  {
	  ?>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><img src="../uplodeImage/listicon/<?php echo $viewRow['image']; ?>" width="115" height="115" /> </td>
                  </tr>
                  <?php } ?><?php */?>
                   <?php /*?><tr>
                      <td width="210" align="right" valign="top" id="title_name">Description:</td>
                       </tr>
                       <tr>
                       <td colspan="2">
                      <textarea name="desc_data" id="desc_data" cols="35" rows="5"><?=$viewRow["desc_data"]?>
</textarea><script type="text/javascript">
    CKEDITOR.replace('desc_data');
 </script>
                   
                   </td> </tr><?php */?>
                    <tr>
                     <td width="210" align="right" valign="top" id="title_name">Add  Features </td>
                      <td width="482" align="left"><input type="button"  style="background-color:#00CEFA" value="Add Feature" onClick="addRow()" />
                        <input type="button"  style="background-color:#00CEFA" value="Delete selected rows" onClick="deleteSelectedRows()" />
                      </td>
                    </tr>
                    <tr>
                      <td colspan="2" align="center" ><textarea readonly="readonly" name="norows" id="norows"  style="width: 18px; height: 18px;"  cols="0" rows="0"></textarea><textarea  style="width: 18px; height: 18px;" readonly="readonly" name="nocols" id="nocols" cols="0" rows="0"></textarea>
                        
                        <table id="my_table">
                          <tr>
                            <td></td>
                            <td>Sort Order</td>
                            <td>Features</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox" id="newCheckbox"></td>
                            <td><input style="background-color:#FFFFFF;" type="text" name="sort_order[]" id="sort_order[]" value="1"  /></td>
                            <td><textarea style="width: 200px; height: 40px;background-color:#FFFFFF;" id="text[]" value="" name="text[]"></textarea></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td><script language=javascript> setInterval("updateCount()", 10);

function updateCount() {

 

 var rows = document.getElementById('my_table').rows.length;

 var cols = $('#my_table').find('tr')[0].cells.length;
 
 $('#nocols').html( cols );
 $('#norows').html( rows );

 
 
 }	</script></td>
                      <td><input type="submit" name="Submit" value="Submit"  class="addmenu2" />
                        &nbsp;&nbsp;&nbsp;
                        <input type="submit" name="Cancel" value="Cancel" class="addmenu2" />
                      </td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br>
          </div>
          <!--welcome admin end here-->
        </div>
        <!--footer start here-->
        <!--footer end here-->
      </td>
    </tr>
  </table>
</form>
</div>
</center>
</body>
</html>
