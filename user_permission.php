<?php
include("smarty_config.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	if($_REQUEST['Submit'])
	{
	
	     $hid_page_id =  $_REQUEST['hid_page_id'];
		 $del_query = "delete from  user_cmsmenu_link_tbl where user_id=".$_REQUEST['id'];
		$exec_del_query = mysql_query($del_query);

			foreach(array_filter($_POST['check1']) as $key=>$value)
			{
			
				$checMenu1	= $_POST['check1'][$key];
				$ordDetail1 = $_POST['menuOrd1'.$value];
				$insert_query = 'insert into user_cmsmenu_link_tbl
												SET
													user_id		 = \''.$_REQUEST['id'].'\',
													menu_id		 = \''.$checMenu1.'\',
													order_id	 = \''.$ordDetail1.'\'';
				$exec_insert_query = mysql_query($insert_query);
			}
			
			header("Location:user_list.php?msg=5");
	 }
	
	 
	 
	 $msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Menus Sucessfully Added";
		
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Updated Sucessfully";
		
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
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_menus.php">Add Menus</a></div></td>
  </tr>
</table>
</div>
<div class="content">
<table width="500" border="0" align="center" cellpadding="0">
  
  <tr>
    <td colspan="6" valign="top">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><?php

		 $query = "select * from cms_menu_tbl";
	     $exQuery = mysql_query($query);

      $displayPage ='<table width="98%" border="0" align="center" >
        <tr class="table1">
          <td width="736" height="30" align="left" >Menus Name</td>
          <td width="33" align="left" class="style3">&nbsp;</td>
          <td width="171" align="left">Menu Order</td>
        </tr>
<tr class="table1" >
			  <td height="27" align="left" class="font2" style="padding-left:5px;">Show All Menus</td>';
			  if($_REQUEST['checked'] ==1) {
			  		$displayPage.='<td width="27" align="center">
			        <input name="onchange_name" type="checkbox" id="onchange_id" checked="checked" onchange="on_change_permission();"/></td>';
			  } else {
			  		
					$displayPage.='<td width="27" align="center">
			        <input name="onchange_name" type="checkbox" id="onchange_id" onchange="on_change_permission();"/></td>';
			  }
			 $displayPage.='<td align="center">&nbsp;</td>
			  </tr>
		<tr >
		    <td height="27" colspan="3" align="left" class="font2">
			<div style="height:300px;overflow-x:hidden;overflow-y:auto;">	
			<table width="100%" border="0" cellspacing="0" cellpadding="0">';
	  $i=1;
	  while($row = mysql_fetch_array($exQuery)){
	  $class="table2";
	   if(($i%2)==0)
	     $class="table3";
		
		$checkQuery = 'select * from user_cmsmenu_link_tbl where user_id ='.$_REQUEST['id'].' and menu_id='.$row['id']; 
	 	$exCheckQuery = mysql_query($checkQuery);
		$checkRow = mysql_fetch_array($exCheckQuery);
            $displayPage.='<tr class="'.$class.'" >
              <td width="745" height="27" align="left" class="font2" style="padding-left:5px;">'.$row['menu_name'].'</td>';
			  if($_REQUEST['checked'] ==1) {
			  
			  		$displayPage.='<td  width="38" width="27" align="center">
			        <input name="check1[]" type="checkbox" id="check1[]" value="'.$row['id'].'" checked="checked" /></td>';
		
			  } elseif($_REQUEST['checked'] ==2) {
			  		$displayPage.='<td width="27" align="center">
			        <input name="check1[]" type="checkbox" id="check1[]" value="'.$row['id'].'" /></td>';
			  } else {
			  		$displayPage.='<td width="27" align="center">
			        <input name="check1[]" type="checkbox" id="check1[]" value="'.$row['id'].'"';
			        if($checkRow['menu_id'] == $row['id']){
			           $displayPage .='checked="checked"';
			        }
			        $displayPage .=' /></td>';
					 }	
		     
		     $displayPage .='<td align="center" width="165"><input name="menuOrd1'.$row['id'].'" type="text" id="menuOrd1'.$row['id'].'" size="5" value="'.$checkRow['order_id'].'" class="calender"/></td>
			  </tr>'; 
			$i++;
				
			}
          $displayPage.='</table>
		  </div>
		  </td>		 
			  </tr>
 </table>';
	

	echo $displayPage;			 
?></td>
      </tr>
      <tr>
        <td height="8"></td>
      </tr>
    
    </table>
	</td>
  </tr>
  <tr>
    <td colspan="6" valign="top">	</td>
  </tr>
  <tr>
    <td colspan="6" valign="top"><div align="center">
      <input type="submit" name="Submit" id="Submit" value="Update" class="addmenu"/>
	  <input type="button" name="Cancel" id="Cancel" value="Cancel" onclick="redirect_user_list();" class="addmenu"/>
      <!--<input type="button" name="Cancel" value="Cancel" /> -->
    </div></td>
  </tr>
</table>
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
