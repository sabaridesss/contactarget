<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	
	if($_REQUEST['Submit'])
	{
	
	     $hid_page_id =  $_REQUEST['hid_page_id'];
		 $del_query = "truncate table navigation_tbl";
		$exec_del_query = mysql_query($del_query);
			print_r();
			foreach(array_filter($_POST['check1']) as $key=>$value)
			{
			
				$checMenu1	= $_POST['check1'][$key];
				$ordDetail1 = $_POST['menuOrd1'.$value];
				$insert_query = 'insert into navigation_tbl
												SET
													page_id		 = \''.$checMenu1.'\',
													order_id	 = \''.$ordDetail1.'\'';
				$exec_insert_query = mysql_query($insert_query);
			}
			
			header("Location:navi_index.php?msg=3");
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
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content"><br>
<table width="500" border="0" align="center" cellpadding="0">
  
  <tr>
    <td colspan="6" valign="top">
	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><?php

		 $query = "select * from menu_page_tbl order by id asc";
	     $exQuery = mysql_query($query);

      $displayPage ='<table width="98%" border="0" align="center" >
        <tr class="table1">
          <td width="736" height="30" align="left" >Menus Name</td>
          <td width="33" align="left" class="style3">&nbsp;</td>
          <td width="171" align="left">Menu Order</td>
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
		
		$checkQuery = 'select * from navigation_tbl where Page_ID ='.$row['id']; 
	 	$exCheckQuery = mysql_query($checkQuery);
		$checkRow = mysql_fetch_array($exCheckQuery);
            $displayPage.='<tr class="'.$class.'" >
              <td width="78"><span class="content_txt" style="padding-left:5px;">'.$row['title'].'</span></td>
              <td width="4%"><input name="check1[]" type="checkbox" id="check1[]"  value="'.$row['id'].'"';
				if($checkRow['Page_ID'] == $row['id']){
				$displayPage .='checked="checked"';
				}
				$displayPage .=' /></td>
              <td width="18%"><input name="menuOrd1'.$row['id'].'" type="text" id="menuOrd1'.$row['id'].'" size="5" value="'.$checkRow['order_id'].'" class="calender"/></td>
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
      <!--<input type="button" name="Cancel" value="Cancel" /> -->
    </div></td>
  </tr>
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
