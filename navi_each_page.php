<?php
include("smarty_config.php");
include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$page_id = $_REQUEST['page_id'];

	$action = $_REQUEST['action'];
	
	
	if($_REQUEST['Submit'])
	{
	
	     $hid_page_id =  $_REQUEST['hid_page_id'];
		 $del_query = "delete from navi_each_page_tbl where page_id=".$hid_page_id;
		
		$exec_del_query = mysql_query($del_query);

			foreach(array_filter($_POST['check1']) as $key=>$value)
			{
			
				$checMenu1	= $_POST['check1'][$key];
				$ordDetail1 = $_POST['menuOrd1'.$value];
				
				$insert_query = 'insert into navi_each_page_tbl
												SET
													page_id		 = \''.$hid_page_id.'\',
													link_id		 = \''.$checMenu1.'\',
													page_order	 = \''.$ordDetail1.'\'';
				$exec_insert_query = mysql_query($insert_query);
			}
	header("Location:navi_each_page.php?msg=3&page_id=".$hid_page_id);
	 }
	
	 
	 
	 $msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Menus Sucessfully Added";
		
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Updated Sucessfully";
		
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Portfolio</title>
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
<link href="menu_css_js/ddsmoothmenu.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="tigra_calendar/calendar.css">
<script type="text/javascript" src="menu_css_js/ddsmoothmenu.js"></script>
<script type="text/javascript" src="menu_css_js/jquery.min.js"></script>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<script language="JavaScript" src="tigra_calendar/calendar_us.js"></script>
<style type="text/css">
<!--
#link_title {font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:20px;
font-weight:bold;
margin-left:32px;
color:#003333;
}
#title_name {font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:12px;
font-weight:bold;
margin-left:32px;
color:#006666;
}
.style3 {font-size: 12px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif;}
.textColor 
{
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#999999;
	font-weight:bold;
}

-->
</style>
<script type="text/javascript">
function delete_page_content(page_id)
{
window.location = "page_index.php?page_id="+page_id+"&action=delete_page_content"
}
</script>

</head>

<body>


<form name="content_add" method="post" action="" >
<div class="content">
<table width="500" border="0" align="center" cellpadding="5">
  <tr>
    <td width="167">&nbsp;</td>

	<td align="right"><div class="submit"><a href="#" onclick="window.close()">Close</a></div></td>
  </tr>
  <tr>
    <td colspan="6" valign="top">
	<div style="height:300px;overflow-x:hidden;overflow-y:auto;">	
	<table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="30" class="welcome-admin">Menu Links: </td>
      </tr>
      <tr>
        <td><?php

		 $query = "select * from menu_page_tbl where is_menu='1' order by order_id asc";
	     $exQuery = mysql_query($query);

      $displayPage ='<table width="98%" border="1" align="center">
        <tr bgcolor="#cccccc">
          <td width="69%" align="left" class="table1">Menus Name</td>
          <td width="6%" align="left" class="table1">&nbsp;</td>
          <td width="25%" align="left" class="table1">Menu Order</td>
        </tr>';
	  $i=1;
	  while($row = mysql_fetch_array($exQuery)){
	   $bgcolor="#ffffff";
	   if(($i%2)==0)
	     $bgcolor="#f6f6f6";
		
		$checkQuery = 'select * from navi_each_page_tbl where page_id ='.$page_id.' AND link_id ='.$row['id']; 
	 	$exCheckQuery = mysql_query($checkQuery);
		$checkRow = mysql_fetch_array($exCheckQuery);
		
		   $displayPage.='<tr bgcolor="'.$bgcolor.'" onmouseover="this.className=\'tableover\'" onmouseout="this.className=\'dataclass\'">
			  <td height="27" align="left" class="textColor" style="padding-left:5px;">'.$row['title'].'</td>
		     <td width="27" align="center">
			 <input name="check1[]" type="checkbox" id="check1[]" value="'.$row['id'].'"';
			if($checkRow['link_id'] == $row['id']){
			$displayPage .='checked="checked"';
			}
			$displayPage .=' /></td>
		     <td align="left"><input name="menuOrd1'.$row['id'].'" type="text" id="menuOrd1'.$row['id'].'" size="5" value="'.$checkRow['page_order'].'" class="calender"/></td>
			  </tr>';
				$subMenu = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id'].' order by order_id asc';
				$subMenu1 = mysql_query($subMenu);
				while($row1 = mysql_fetch_array($subMenu1))
				{
				
					$checkQuery1 = 'select * from navi_each_page_tbl where page_id ='.$page_id.' AND link_id ='.$row1['id']; 
					$exCheckQuery1 = mysql_query($checkQuery1);
					$checkRow1 = mysql_fetch_array($exCheckQuery1);

					  $displayPage.='<tr bgcolor="'.$bgcolor.'" onmouseover="this.className=\'tableover\'" onmouseout="this.className=\'dataclass\'">
					  <td height="27" align="left" class="style3" style="padding-left:18px;">'.$row1["title"].'</td>
					  <td width="27" align="center"><input name="check1[]" type="checkbox" id="check1[]" value="'.$row1['id'].'"';
						if($checkRow1['link_id'] == $row1['id']){
						$displayPage .='checked="checked"';
						}
						$displayPage .='  /></td>
					  <td align="left"><input name="menuOrd1'.$row1['id'].'" type="text" id="menuOrd1'.$row1['id'].'" size="5" value="'.$checkRow1['page_order'].'" class="calender"/></td>
					  </tr>';
					
					  $inserSubMenu = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'].' order by order_id asc';		  $inserSubMenu1 = mysql_query($inserSubMenu);
				      while($row2 = mysql_fetch_array($inserSubMenu1))
					  {
						
						$checkQuery2 = 'select * from navi_each_page_tbl where page_id ='.$page_id.' AND link_id ='.$row2['id']; 
						$exCheckQuery2 = mysql_query($checkQuery2);
						$checkRow2 = mysql_fetch_array($exCheckQuery2);

						$displayPage.='<tr bgcolor="'.$bgcolor.'" onmouseover="this.className=\'tableover\'" onmouseout="this.className=\'dataclass\'">
					  <td height="27" align="left" class="style3" style="padding-left:30px;">'.$row2["title"].'</td>
					  <td width="27" align="center"><input name="check1[]" type="checkbox" id="check1[]" value="'.$row2['id'].'"';
						if($checkRow2['link_id'] == $row2['id']){
						$displayPage .='checked="checked"';
						}
						$displayPage .=' /></td>
					  <td align="left"><input name="menuOrd1'.$row2['id'].'" type="text" id="menuOrd1'.$row2['id'].'" size="5" value="'.$checkRow2['page_order'].'" class="calender"/></td>
					  </tr>';
					  }
    			}
				
			$displayPage.='<input type="hidden" name="hid_page_id" value="'.$page_id.'"/>';	
			}
			
  $displayPage.='</table>';
	

	echo $displayPage;			 
?></td>
      </tr>
      <tr>
        <td height="8"></td>
      </tr>
      <tr>
        <td height="30" class="welcome-admin">Other Links: </td>
      </tr>
      <tr>
        <td>
		<table width="98%" border="1" align="center">
    <tr bgcolor="#cccccc">
      <td width="69%" class="table1">Other Page Name</td>
      <td width="6%" class="table1">&nbsp;</td>
      <td width="25%" class="table1">Menu Order</td>
    </tr>
	<?php 
	$otherPage = 'SELECT * FROM menu_page_tbl WHERE is_menu = \'0\'';
	$exOtherPage = mysql_query($otherPage);
	while($otherRow = mysql_fetch_array($exOtherPage))
	{
	
		$checkQuery3 = 'select * from navi_each_page_tbl where page_id ='.$page_id.' AND link_id ='.$otherRow['id']; 
		$exCheckQuery3 = mysql_query($checkQuery3);
		$checkRow3 = mysql_fetch_array($exCheckQuery3);

	?>
    <tr>
      <td bgcolor="#FFFFFF" class="style3"><?php echo $otherRow['title']; ?></td>
      <td bgcolor="#FFFFFF"><input name="check1[]" type="checkbox" id="check1[]" value="<?php echo $otherRow['id']; ?>"<?php if($checkRow3['link_id'] == $otherRow['id']){?> checked="checked"<?php } ?> /></td>
      <td align="left" bgcolor="#FFFFFF"><input name="menuOrd1<?php echo $otherRow['id']; ?>" type="text" id="menuOrd1<?php echo $otherRow['id']; ?>" size="5" value="<?php echo $checkRow3['page_order']?>" class="calender"/></td>
    </tr>
	<?php } ?>
  </table></td>
      </tr>
    </table>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="6" valign="top">	</td>
  </tr>
  <tr>
    <td colspan="6" valign="top"><div align="center">
      <input type="submit" name="Submit" id="Submit" value="Update" class="submit"/>
      &nbsp;&nbsp;&nbsp;
      <!--<input type="button" name="Cancel" value="Cancel" /> -->
    </div></td>
  </tr>
</table>
</div>
</form>


</div>
</center>
</body>
</html>
