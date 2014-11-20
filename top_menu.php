<?php

$qry1 = "select * from admin where username='".$_SESSION['username']."'";

$qry1_result = mysql_query($qry1);
$row1 = mysql_fetch_assoc($qry1_result);
$user_id = $row1['id'];

$newPer = array();
$qry21= "select * from user_cmsmenu_link_tbl where user_id=".$user_id." order by order_id asc";
$qry2_result1 = mysql_query($qry21);
while($resustValue = mysql_fetch_array($qry2_result1))
{
	$displayPer.= array_push($newPer,$resustValue['menu_id']);
}

$qry2 = "select * from user_cmsmenu_link_tbl where user_id=".$user_id." order by order_id asc";
$qry2_result = mysql_query($qry2);
	$top_menu='<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#01c0e8">
	<div id="smoothmenu1" class="ddsmoothmenu" >
	<ul>';
	if(in_array(28,$displayPer)) {
	$top_menu.='<li><a href="main_page.php" class="dir">Main Page</a></li>';
	}
	$grp1 = '<li><a href="campaign.php" class="dir">Email Tool</a><ul>';
/*	$grp2 = '<li><a href="#" class="dir">SEO</a><ul>';
	$grp3 = '<li><a href="#" class="dir">ARTICLE</a><ul>';*/

while($row2 = mysql_fetch_assoc($qry2_result))
{
    $qry3 = "select * from cms_menu_tbl where id=".$row2['menu_id'];	
	$qry3_result = mysql_query($qry3);
	$row3 = mysql_fetch_assoc($qry3_result);
	
	if($row3['group_id'] == 1)  {
		$grp1.='<li><a href="'.$row3['menu_url'].'" class="dir">'.$row3['menu_name'].'</a></li>';
	}  /*elseif($row3['group_id'] == 2) {
		$grp2.='<li><a href="'.$row3['menu_url'].'" class="dir">'.$row3['menu_name'].'</a></li>';
	} elseif($row3['group_id'] == 3) {
		$grp3.='<li><a href="'.$row3['menu_url'].'" class="dir">'.$row3['menu_name'].'</a></li>';
	}*/ else {
		$top_menu1.= '<li><a href="'.$row3['menu_url'].'" class="dir">'.$row3['menu_name'].'</a></li>';
	}
	
    //$top_menu.='<a href="'.$row3['menu_url'].'" style="cursor:pointer"><span style="font-family:Arial, Helvetica,    sans-serif;font-size:12px;">'.$row3['menu_name'].'</span></a>&nbsp;|&nbsp;';
}

$grp1.='</ul></li>';
$grp2.='</ul></li>';
$grp3.='</ul></li>';

$top_menu = $top_menu.$grp1.$top_menu1;


//$top_menu.= '<a href="logout.php" style="cursor:pointer"><span style="font-family:Arial, Helvetica,    sans-serif;font-size:12px;">Logout</span></a>&nbsp;|&nbsp;';
if(in_array(29,$displayPer)) {
	//$top_menu.='<li><a href="all_page_index.php" class="dir">All Pages</a></li>';
}
if(in_array(30,$displayPer)) {
	//$top_menu.='<li><a href="customer_view.php" class="dir">Customer Type </a></li>';
	}
	$top_menu.='</ul>
	</div>
	</td>
  </tr>
</table>';

?>
<div class="header"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="300" height="110" align="center" valign="bottom"><a href="#"><img src="images/logo.png" width="270" height="110" border="0" /></a></td>
    <td align="right" valign="middle">
	<div class="contact">Email: support@desss.com <br /> Phone: (713)589-6496</div>
	</td>
  </tr>
</table>
</div>
<?php echo $top_menu; ?>
