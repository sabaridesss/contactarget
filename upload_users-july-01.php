<?php
include("smarty_config.php");
//include("top_menu.php");


 if($_REQUEST['btn_submit'] && $_FILES['userfile']['name'] != ""){

/* 	if($_REQUEST['user_type'] == "Customer"){
		
		$user_type = 'C';
	} else if($_REQUEST['user_type'] == "Prospect" ){
		
		$user_type = 'P';

	}else if($_REQUEST['user_type'] == "" ){
  				
		$user_type= "C";
   }*/
  
  $sort_order	= $_REQUEST['sort_order'];
   $count_usertype=count($sort_order);

  $group_generl = 'yes';
  $fileName = $_FILES['userfile']['name'];
  $empty_space = '/ /';
  $replace = '-';
  $fileName = preg_replace($empty_space,$replace,$fileName);
  $tmpName = $_FILES['userfile']['tmp_name'];
  $fileSize = $_FILES['userfile']['size'];
  $fileType = $_FILES['userfile']['type'];
  $normal ="^[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})$";
	$dir = 'products_excel/';
	if(!is_dir($dir))
	{
	mkdir('products_excel/');
	}
	$filePath = $dir. $fileName;; 
		$result = move_uploaded_file($tmpName, $filePath);
	//	 $file_handle = fopen("toners.csv", "r");
	 $uploaded_file = $dir.$fileName;
	
	$file_handle = fopen($uploaded_file, "r");
	
	$k = 0;
	while(!feof($file_handle) ) {
	$line_of_text = fgetcsv($file_handle, 1024);
	if($k != 0)
	{
	$firstname = $line_of_text[0];
	$lastname = $line_of_text[1];
	$email = $line_of_text[2];
	//$user_type = $line_of_text[3];
	
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

 if($count_usertype==0)
  {
	
	if($firstname != "" && $email != ""){ 
		   $query = "insert into user_tbl(company_admin,firstname, lastname, email, group_generl,user_type) values('".$company_admin."','".$firstname."','".$lastname."','".$email."','".$group_generl."','".$user_type."')";
		$rs = mysql_query($query);
    	}  
		}
		else
		{
		 for ($i=0; $i<$count_usertype; $i++) {
		 
		  $query = "insert into user_tbl(company_admin,firstname, lastname, email, group_generl,user_type) values('".$company_admin."','".$firstname."','".$lastname."','".$email."','".$group_generl."','".$sort_order[$i]."')";
		$rs = mysql_query($query);
		 
		 }
		 
		 
		 }
		
		
		}
		
		
		
	/*if($firstname != "" && $email != ""){
		   $lat_query = "insert into per_user_tbl(company_admin,firstname, lastname, email, group_generl,user_type) values('".$company_admin."','".$firstname."','".$lastname."','".$email."','".$group_generl."','".$user_type."')";
		$lat_rs = mysql_query($lat_query);
    	}  */
	}

$k++;
}



	header("location:usermail_list.php?msg=3");

	
fclose($file_handle);







$view_query = "select * from user_tbl";
$view_rs = mysql_query($view_query);
	

	
		
}

if($_REQUEST['submit'] == 'Demo')
	{

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
    
}

}


?>
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
function formValidator(){
  
   var Audience = document.getElementById("sort_order").value;
  if((Audience.length == 0)||(Audience == 'Comments')){
   		alert('Please Select Audience Type');
		document.getElementById("sort_order").focus();
        return false;
    }

	else			
			{
					
					document.content_add.submit();
					return true;
			}
}</script>
<form name="content_add" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" value="<?=$content_id?>" id="sub_catid" />
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
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
                <td align="left" valign="top" class="login-top">Upload Audience</td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="17%" align="right" valign="top" id="title_name">Import .csv file:</td>
                      <td width="83%" align="left"><input type="file" id="userfile" name="userfile" class="login-textarea1">
                      </td>
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
                      <td width="17%" align="right" valign="top" id="title_name">Sample import data</td>
                      <td width="83%" align="left"><input type="submit" name="submit" value="Demo" class="btn btn-large btn-primary" />
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><input type="hidden" name="hid_id" value="<?=$row2['id']?>" />
                        <?php if($_REQUEST['id'] != '' ) {?>
                        <input type="submit" name="btn_submit" value="Submit" class="btn btn-large btn-primary" />
                        &nbsp;&nbsp;&nbsp;
                        <?php } else {?>
                        <input type="submit" name="btn_submit" value="Submit" class="btn btn-large btn-primary" onclick="return formValidator()" />
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
</div>
</center>
</body></html>