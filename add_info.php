<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$page_id=$_REQUEST['page_id'];
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit"))
	{
		$select = 'SELECT * FROM addinfo order by id desc';
		$exSelect = mysql_query($select);
		$numRow = mysql_num_rows($exSelect);
		$imgId = $numRow+1;
		$page_id= $_REQUEST['page_id'];
		$fname = $_FILES['upImg']['name'];
		$tmpname = $_FILES['upImg']['tmp_name'];
		$path = "../uplodeImage/about/";
		$p_small = $path.$imgId.'-'.$fname;
		$file_name_img=$imgId.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);
		
		
		$insert = 'INSERT INTO addinfo
										SET
										name 		= \''.addslashes($_POST['name']).'\',
										page_id 		= \''.addslashes($_POST['page_id']).'\',
										email		= \''.addslashes($_POST['email']).'\',
										sort_order		= \''.addslashes($_POST['sort_order']).'\',
										address		= \''.addslashes($_POST['address']).'\',
										desc_data 		= \''.addslashes($_POST['desc']).'\',
																				
											image	= \''.$file_name_img.'\'';
		
		$exInsert = mysql_query($insert);
		if(!$exInsert)
		echo mysql_error(); 
		else
		header('location:view_info.php?msg=2&page_id='.$page_id);									
	
	}


//Edit Image
if(isset($_REQUEST['menus_id']) != '')

{

	$editImg = 'SELECT * FROM  addinfo WHERE id ='.$_REQUEST['menus_id'];
	$exEdit = mysql_query($editImg);
	$viewRow = mysql_fetch_array($exEdit);

}
//Cancel Page
if(isset($_REQUEST['Cancel']) && $_REQUEST['Cancel'] == 'Cancel')
{$page_id= $_REQUEST['page_id'];
	header('location:view_info.php?page_id='.$page_id);		
}


// Update Information

if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Update')
{		
		$imgId = $_REQUEST['menus_id'];
		$fname = $_FILES['upImg']['name'];
		$page_id= $_REQUEST['page_id'];
		if($fname != '')
		{
		$tmpname = $_FILES['upImg']['tmp_name'];
		$path = "../uplodeImage/about/";
		$p_small = $path.$imgId.'-'.$fname;
		$file_name_img=$imgId.'-'.$fname;
		move_uploaded_file($tmpname,$p_small);
		}
		else
		{
			$file_name_img = $viewRow['image'];
			
		}   	
	
	$update = 'UPDATE addinfo
							  SET
									name 		= \''.addslashes($_POST['name']).'\',
									page_id 		= \''.addslashes($_POST['page_id']).'\',
									email		= \''.addslashes($_POST['email']).'\',
									sort_order		= \''.addslashes($_POST['sort_order']).'\',
									address		= \''.addslashes($_POST['address']).'\',
									desc_data 		= \''.addslashes($_POST['desc']).'\',
									image		= \''.$file_name_img.'\'
									WHERE id    ='.$_REQUEST['id'];
	$exUpdate = mysql_query($update);
	if(!$exUpdate)
		echo mysql_error(); 
		else
	header('location:view_info.php?msg=3&page_id='.$page_id);								
							  	
								
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
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form  method="post" enctype="multipart/form-data" name="form1" >
   <table width="700px" style="margin:0px auto; float:left" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top">
        <div class="wholesite-inner">
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
          <div class="content"><br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top"><?php if($_REQUEST['menus_id'] != ''){ ?>
                  Edit
                  <?php } else{?>
                  Add
                  <?php } ?>
                  Image </td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td width="210" align="right" valign="top" id="title_name">Name :</td>
                      <td width="482" align="left"><input name="name" type="text" id="name" size="60" class="login-texbox1" value="<?php echo $viewRow['name']; ?>"/>
                      <input type="hidden" name="page_id" id="page_id" value="<?=$_REQUEST['page_id']?>" />
                      <input type="hidden" name="id" id="id" value="<?php echo $viewRow['id']; ?>" />
                      </td>
                    </tr>
                    <tr>
                      <td width="210" align="right" valign="top" id="title_name">E-mail :</td>
                      <td width="482" align="left"><input name="email" type="text" id="email" size="60" class="login-texbox1" value="<?php echo $viewRow['email']; ?>"/></td>
                    </tr>
                    
                    <!--<tr>
                      <td width="210" align="right" valign="top" id="title_name">Address :</td>
                      <td width="482" align="left"><input name="address" type="text" id="address" size="60" class="login-texbox1" value="<?php echo $viewRow['address']; ?>"/></td>
                    </tr>-->
                    <tr>
                      <td width="210" align="right" valign="top" id="title_name">Sort Order :</td>
                      <td width="482" align="left"><input name="sort_order" type="text" id="sort_order" size="60" class="login-texbox1" value="<?php echo $viewRow['sort_order']; ?>"/></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name">Uplode Image :</td>
                      <td align="left"><input name="upImg" type="file"  class="login-texbox1" id="upImg"  />&nbsp;(image size(105*155))</td>
                    </tr>
                    <?php if($viewRow['image'] != '')
	  {
	  ?>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><img src="../uplodeImage/about/<?=$viewRow["image"]?>" width="180" height="130" /> </td>
                    </tr>
                    <?php } ?>
                    <tr>
                      <td width="210" align="right" valign="top" id="title_name">Description:</td>
                       </tr>
                       <tr>
                       <td colspan="2">
                      <textarea name="desc" id="desc" cols="35" rows="5"><?=$viewRow["desc_data"]?>
</textarea><script type="text/javascript">
    CKEDITOR.replace('desc');
 </script>
                   
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align=""><?php if($_REQUEST['menus_id'] != '') {?>
                        <input type="submit" name="Submit" value="Update"  class="addmenu2" />
                        <?php } else {?>
                        <input type="submit" name="Submit" value="Submit"  class="addmenu2" />
                        <?php } ?>
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
       
        <!--footer end here--></td>
    </tr>
  </table>
</form>
</div>
</center>
</body></html>