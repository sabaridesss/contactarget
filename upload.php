<?php
include("smarty_config.php");
//require_once('smtp_validateEmail.class.php');
/*if (isset($_REQUEST["status"]) ) {
$uploadedStatus = 1;
}
else
{
$uploadedStatus = 0;
}*/


if(isset($_REQUEST['btn_submit']) && $_FILES['userfile']['name'] != ""){

if ($_FILES["userfile"]["error"] > 0) {
echo "Return Code: " . $_FILES["userfile"]["error"] . "<br />";
}
else {
if (file_exists($_FILES["userfile"]["name"])) {
unlink($_FILES["userfile"]["name"]);
}

$storagename = 'discussdesk.xlsx';
move_uploaded_file($_FILES["userfile"]["tmp_name"], $storagename);
$uploadedStatus = 1;

set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'discussdesk.xlsx'; 

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
//print_r($allDataInSheet);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
//print_r($arrayCount);die;

$delete_query = mysql_query("DELETE FROM mapping_fields");

for($j=1;$j<=1;$j++)
{
if(isset($allDataInSheet[1]["A"]) && $allDataInSheet[1]["A"]!=''){ $cell_1 = trim($allDataInSheet[1]["A"]);}else{$cell_1='';}
if(isset($allDataInSheet[1]["B"]) && $allDataInSheet[1]["B"]!=''){ $cell_2 = trim($allDataInSheet[1]["B"]);}else{$cell_2='';}
if(isset($allDataInSheet[1]["C"]) && $allDataInSheet[1]["C"]!=''){ $cell_3 = trim($allDataInSheet[1]["C"]);}else{$cell_3='';}

if($cell_1!=''){
$filedval = $cell_1;
$insertTable= mysql_query("insert into mapping_fields header_fields values('".$filedval."')");}
if($cell_2!=''){
$filedval = $cell_2;
$insertTable= mysql_query("insert into mapping_fields header_fields values('".$filedval."')");}
if($cell_3!=''){
$filedval = $cell_3;
$insertTable= mysql_query("insert into mapping_fields header_fields values('".$filedval."')");}
}
}
}


if(isset($_REQUEST['mbtn_submit'])) {
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'discussdesk.csv'; 

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}


$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet

$objPHPExcel = new PHPExcel();
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'First Name');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Last Name');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'email');

if(isset($_REQUEST['firstname']) && $_REQUEST['firstname']!=''){$firstname=$_REQUEST['firstname'];}else{$firstname='';}
if(isset($_REQUEST['lastname']) && $_REQUEST['lastname']!=''){$lastname=$_REQUEST['lastname'];}else{$lastname='';}
if(isset($_REQUEST['email']) && $_REQUEST['email']!=''){$email=$_REQUEST['email'];}else{$email='';}

for($i=2;$i<=$arrayCount;$i++){

if(isset($allDataInSheet[1]["A"]) && $allDataInSheet[1]["A"]!=''){$cell_1 = trim($allDataInSheet[1]["A"]);}else{$cell_1='';}
if(isset($allDataInSheet[1]["B"]) && $allDataInSheet[1]["B"]!=''){$cell_2 = trim($allDataInSheet[1]["B"]);}else{$cell_2='';}
if(isset($allDataInSheet[1]["C"]) && $allDataInSheet[1]["C"]!=''){$cell_3 = trim($allDataInSheet[1]["C"]);}else{$cell_3='';}


if(isset($allDataInSheet[$i]["A"]) && $allDataInSheet[$i]["A"]!=''){$aval=$allDataInSheet[$i]["A"];}else{$aval='';}
if(isset($allDataInSheet[$i]["B"]) && $allDataInSheet[$i]["B"]!=''){$bval=$allDataInSheet[$i]["B"];}else{$bval='';}
if(isset($allDataInSheet[$i]["C"]) && $allDataInSheet[$i]["C"]!=''){$cval=$allDataInSheet[$i]["C"];}else{$cval='';}

if($cell_1 == $firstname){$first_name = trim($aval);}else if($cell_2 == $firstname){$first_name = trim($bval);}else if($cell_3 == $firstname){$first_name = trim($cval);}

if($cell_1 == $lastname){$last_name = trim($aval);}else if($cell_2 == $lastname){$last_name = trim($bval);}else if($cell_3 == $lastname){$last_name = trim($cval);}

if($cell_1 == $email){$primary_email = trim($aval);}else if($cell_2 == $email){$primary_email = trim($bval);}else if($cell_3 == $email){$primary_email = trim($cval);}

}

unlink('some_excel_file.csv');
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('products_excel/some_excel_file.csv');
 } 

if($_REQUEST['submit'] == 'Demo'){
$file = 'user_tbl.csv';
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    
}}




?>


<html>

<head>
<title>Administartor</title>

<style>
body {
    background-color: #ffffff;
    color: #333333;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 20px;
    margin: 0;
}
.select_box {
    background-color: #ffffff;
    border: 1px solid #cccccc;
    width: 220px;
	height: 30px;
    line-height: 30px;
	border: 1px solid #cccccc;
	
}
</style>

</head>

<?php include ('common/header.php')?>
<script type="text/javascript">
var cb = document.getElementsByTagName('input');
var checked = 0;

function countCB()
{
 for(i = 0; i < cb.length; i++)
 {
    if(cb[i].type == 'checkbox' )
    {
	  if(document.getElementById("show").value=="show")
	   {
	     cb[i].checked=true;
		 document.getElementById('showall').innerHTML="Unselect All";
	   }	
	   
	   if(document.getElementById("show").value=="hidden")
	   {
	     cb[i].checked=false;
		 document.getElementById('showall').innerHTML="Select All";
	   }	 
       // ++checked;
    }
  }
    if(document.getElementById("show").value=="show")
	  document.getElementById("show").value="hidden";
	 else
       document.getElementById("show").value="show";
	  
 // alert(checked);
}


function countCB1()
{
 for(i = 0; i < cb.length; i++)
 {
    if(cb[i].type == 'checkbox' )
    {
	  cb[i].checked=false;
       // ++checked;
    }
  }
 // alert(checked);
}
</script>
<script language="javascript">
function formValidator()
{
	document.content_add.submit();
	return true;

}

function mappingformValidator()
{
	document.content_add.submit();
	return true;
}
</script>

<?php if($uploadedStatus==0){  ?>

<form name="content_add" method="post" action="" enctype="multipart/form-data">
  <?php /*?><input type="hidden" value="<?=$content_id?>" id="sub_catid" /><?php */?>
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
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                 
                  </font></strong></td>
             <!--<td width="25%" align="right" valign="middle">  <input type="submit" name="submit" value="Demo" class="addmenu2" /></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>-->
                <!--   <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="mail_subscribers.php">Email Tool</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="Campaign.php"> Campaign</a></div></td>-->
              </tr>
            </table>
          </div>
          <div class="content"><br>
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top">Import Audience</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="17%" align="right" valign="top" id="title_name">Import .csv file:</td>
                      <td width="83%" align="left"><input type="file" id="userfile" name="userfile" class="login-textarea1">
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    
                    <tr>
                      <td width="17%" align="right" valign="top" id="title_name">Sample import data</td>
                      <td width="83%" align="left"><input type="submit" name="submit" value="Demo" class="btn btn-large btn-primary" />
                      </td>
                    </tr>
                    
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">
                      <?php /*?><input type="hidden" name="hid_id" value="<?=$row2['id']?>" /><?php */?>
                        <?php if($_REQUEST['id'] != '' ) {?>
                        <input type="submit" name="btn_submit" value="Submit" class="btn btn-large btn-primary" />
                        &nbsp;&nbsp;&nbsp;
                        <?php } else {?>
                        <input type="submit" name="btn_submit" value="Submit" class="btn btn-large btn-primary" onClick="return formValidator()" />
                        &nbsp;&nbsp;&nbsp;
                        <?php }?>
                        <input type="button" name="Cancel" value="Cancel" class="btn btn-large btn-primary" onClick="history.back();"/></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <p>&nbsp;</p>
          </div>
          <!--welcome admin end here-->
        </div>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here--></td>
    </tr>
  </table>
</form>

<?php } ?>

<?php if($uploadedStatus==1){  

$result =  mysql_query("SELECT * FROM mapping_fields");
$result1 = mysql_query("SELECT * FROM mapping_fields");
$result2 = mysql_query("SELECT * FROM mapping_fields");
$result3 = mysql_query("SELECT * FROM mapping_fields");
$result4 = mysql_query("SELECT * FROM mapping_fields");
$result5 = mysql_query("SELECT * FROM mapping_fields");
$result6 = mysql_query("SELECT * FROM mapping_fields");
$result7 = mysql_query("SELECT * FROM mapping_fields");
$result8 = mysql_query("SELECT * FROM mapping_fields");
$result9 = mysql_query("SELECT * FROM mapping_fields");
$result10 = mysql_query("SELECT * FROM mapping_fields");
$result11 = mysql_query("SELECT * FROM mapping_fields");
$result12 = mysql_query("SELECT * FROM mapping_fields");
?>
<form name="mapping" method="post" action="" enctype="multipart/form-data">
  <?php /*?><input type="hidden" value="<?=$content_id?>" id="sub_catid" /><?php */?>
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
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                 
                  </font></strong></td>
             
              </tr>
            </table>
          </div>
          <div class="content"><br>
            <table width="98%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top">Mapping Fields</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                
                    <tr>
        <td align="right" valign="top">First Name:</td>
        <td align=""><select name="firstname" id="firstname" class="input-xlarge focused" style="width:50%"   tabindex="13"  >
                     <option value="">I don't have this</option>
<?php while($row = mysql_fetch_array($result1)) { ?><option value="<?=$row['header_fields']?>" <?php if($row['header_fields']!='' && strtolower($row['header_fields'])=='first name'){?> selected <?php } ?>><?php echo $row['header_fields']?></option><? } ?>
                            </select></td>
      				</tr>
                    
                    <tr>
        <td align="right" valign="top">Last Name:</td>
        <td align=""><select name="lastname" id="lastname" class="input-xlarge focused" style="width:50%"   tabindex="13"  >
                     <option value="">I don't have this</option>
<?php while($row = mysql_fetch_array($result2)) { ?><option value="<?=$row['header_fields']?>" <?php if($row['header_fields']!='' && strtolower($row['header_fields'])=='last name'){?> selected <?php } ?>><?=$row['header_fields']?></option><? } ?>
                            </select></td>
      				</tr>
                    
                    <tr>
        <td align="right" valign="top">Email:</td>
        <td align=""><select name="email" id="email" class="input-xlarge focused" style="width:50%" tabindex="13">
                     <option value="">I don't have this</option>
<?php while($row = mysql_fetch_array($result8)) { ?><option value="<?=$row['header_fields']?>" <?php if($row['header_fields']!='' && strtolower($row['header_fields'])=='email'){?> selected <?php } ?>><?=$row['header_fields']?></option><? } ?>
                            </select></td>
      				</tr>
                    
                    
                    <tr>
                      <td width="17%" align="right" valign="top" id="title_name">Groups Type:</td>
                      <td width="83%" align="left"><select name="sort_order[]" id="sort_order" multiple="multiple">
                          <?php  $sel_tbl_link_cat="SELECT * FROM camp_categ where company_admin='$company_admin' order by cat_order ASC";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {
		 
		  ?>
                          <?=$tbl_link_cat_Fetch['cate_name']?>
                          <option  value="<?php 
								echo $tbl_link_cat_Fetch['cate_name'];?>" <?php
                    if($displaySite['user_type'] == $tbl_link_cat_Fetch['cate_name'])
					{
					echo 'selected="selected"';
					}
					?> >
                          <?=$tbl_link_cat_Fetch['cate_name']?>
                          </option>
                          <?php }?>
                        </select>  (For Multiple Group use Shift)
                      </td>
                    </tr>
                    
                    
              <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    
                    
                    
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><?php /*?><input type="hidden" name="hid_id" value="<?=$row2['id']?>" /><?php */?>
                        <?php if($_REQUEST['id'] != '' ) {?>
                        <input type="submit" name="mbtn_submit" value="Submit" class="btn btn-large btn-primary" />
                        &nbsp;&nbsp;&nbsp;
                        <?php } else {?>
                        <input type="submit" name="mbtn_submit" value="Submit" class="btn btn-large btn-primary" onClick="return mappingformValidator()" />
                        &nbsp;&nbsp;&nbsp;
                        <?php }?>
                        <input type="button" name="Cancel" value="Cancel" class="btn btn-large btn-primary" onClick="history.back();"/></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <p>&nbsp;</p>
          </div>
          <!--welcome admin end here-->
        </div>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here--></td>
    </tr>
  </table>
</form>

<? } ?>

</div>
</center>
</body></html>