<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {

	
		$id = $_REQUEST['id'];
		if($_REQUEST["msg"] == '2'){
		$msg = "Details Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Details Sucessfully Deleted";	
	}
	
	// Add Contents
	if(isset($_POST['Submit']) && ($_POST['Submit'] == "Submit")){
	
									 
		  $query = 'INSERT INTO careers_sub_cat_tbl_job
		  
		  							SET
										main_cat_id =\''.$id.'\',
										sub_cat_name     = \''.$_REQUEST['sub_cat_name'].'\'';
								 
								 
		$exQuery = mysql_query($query);
		
		if($exQuery){
					header("location:sub_categories_add.php?msg=2&id=$id");
				}	
				else
				echo mysql_error();  
		}
		// cancel 
			if(isset($_POST['Cancel']) && ($_POST['Cancel'] == "Cancel")){
	

					header("location:categories.php");
				 
		}
		
		
		
		
		if($_REQUEST['delid']) {
		$delid = $_REQUEST['delid'];
		
		$query = "delete from careers_sub_cat_tbl_job where id=".$delid;
		if(mysql_query($query)) {
					header("location:sub_categories_add.php?msg=3&id=$delid");		
				}
				else
				echo mysql_error(); 
	}
		
		
		
}

?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" >
<table width="1200px" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	<?php include('common/top_menu.php') ?>
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle">&nbsp;</td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>


  <table width="60%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Add Job Category </td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
	   <tr>
        <td width="210" align="right" valign="top" id="title_name">&nbsp;</td>
        <td width="482" align="left"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
      </tr>

      <tr>
        <td width="210" align="right" valign="top" id="title_name">Sub Category Name:</td>
        <td width="482" align="left"><input name="sub_cat_name" type="text" id="sub_cat_name" size="60" class="login-texbox1" value="<?=$cat_name;?>"/></td>
      </tr>
   
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
		 <input type="submit" name="Submit" value="Submit"  class="addmenu2"/>
          &nbsp;&nbsp;&nbsp;
          <input type="submit" name="Cancel" value="Cancel" class="addmenu2" /></td>
        </tr>
    </table></td>
  </tr>
</table>
  <br>  <br>


<table width="100%" border="0" align="center" class="welcome">
      <tr class="table1">
        <td height="30" align="left" ><strong>ID</strong></td>
        <td align="left" width="60%" ><strong>Sub Categories Name</strong></td>

        <td width="40%" ><strong>Action</strong></td>
      </tr>
      <? 
	$query3= "select * from careers_sub_cat_tbl_job where main_cat_id =$id  order by cat_order ASC";
	
	$query_result3 = mysql_query($query3);
	  $i=1;
	  while($item=mysql_fetch_array($query_result3)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
      <tr class="<?=$class?>" >
        <td width="3%" height="27" align="left" class="font2"><?=$i?></td>
        <td width="20%" align="left" class="font2"><?=$item["sub_cat_name"]?></td>
             <td width="28%">
		<table width="100%"  border="0">
            <tr>
      
              
              <td width="50%" align="center" class="font2"><a href="sub_categories_add.php?delid=<?=$item["id"]?>&delete=true&id=<?=$id?>" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> Delete</a> </td>
              
            </tr>
        </table></td>
      </tr>
      <? $i++; } ?>
    </table>

  <br>
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
</body>
</html>

