<?php
include("smarty_config.php");

ob_flush();
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
}
else
{
	/*if(isset($_REQUEST['Delete']) && $_REQUEST['Delete'] == 'Delete')
	{
		foreach($_POST['del'] as $key=>$value)
		{
		$del_pro=$_POST['del'][$key];
		
		$update_qry1 =  "DELETE FROM signupdetails WHERE id = '$del_pro'";
		
		$exupdate1 = mysql_query($update_qry1);
		}
		$msg = "Deleted Sucessfully";
	}*/
	
	
	
	
	$type_mode=$_REQUEST['type'];
	if($type_mode=='clicked')
	$type_select="a.clicks";
	else if($type_mode=='readed')
	$type_select="a.no_of_read";
	else if($type_mode=='failed')
	$type_select="a.no_of_fail";
	else if($type_mode=='bounced')
	$type_select="a.no_of_bounce";
	else
	$type_select="no_of_sent";
	$campid=$_REQUEST['campid'];
	$sendid=$_REQUEST['sendid'];
	
	
	
	
	
/*	
	 $selectQuery = "SELECT * FROM comp_user_tbl WHERE company_admin='$company_admin' and $type_select=1 AND campaign_name=$campid AND send_id=$sendid order by id asc";
	$exQuery = mysql_query($selectQuery); */
				  
			  
/*search Gen*/


	//$search=$_REQUEST['search']; 
/*	Pagination Starts Here   */

	//$tbl_name="menu_page_tbl";		
	$adjacents = 4;
	 $query = "SELECT  COUNT(*) as num FROM comp_user_tbl WHERE company_admin='$company_admin' and $type_select=1 AND campaign_name=$campid AND send_id=$sendid order by id asc";
	
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	$targetpage = "view_list_result.php?type=".$type_mode."&campid=".$campid."&sendid=".$sendid; 	
	$limit = 500; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
 $sql = " SELECT a.user_id as user_id ,b.firstname as firstname ,b.email as email FROM comp_user_tbl a ,user_tbl b WHERE a.company_admin='$company_admin' and $type_select=1 AND a.campaign_name=$campid AND a.send_id=$sendid  and a.user_id =b.id order by a.id asc LIMIT $start, $limit"; 
	$result = mysql_query($sql);

	$num_res_count=mysql_num_rows($result);
	
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage&page=$prev\"><< Previous</a>";
		else
			$pagination.= "<span class=\"disabled\"><< Previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage&page=$next\">Next >></a>";
		else
			$pagination.= "<span class=\"disabled\">Next >></span>";
		$pagination.= "</div>\n";		
	}
	if($num_res_count==0)
	$fld1="<span style='color:#FF0000'>No Results Found</span";
	else
	{	  $i=$start + '1';

}
	
	
	

	
	
	
	
	
}
	




	
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style>
div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px !important ;
	margin: 2px !important ;
	border: 1px solid #AAAADD !important ;
	text-decoration: none !important ; /* no underline */
	color:  #FFA145 !important ;
	float:none; !important ;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid  #FFA145;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid  #FFA145;
	font-weight: bold;
	background-color:  #FFA145;
	color: #FFF;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #EEE;
	color: #DDD;
}
</style>
<script type="text/javascript">
function close_window()
{
 window.close();

}
</script>
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form id="form1" name="form1" method="post" action="">
  <table width="800px" border="0" cellpadding="0">
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
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000"> User
                 
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <div >
            <table width="100%" align="center" >
              <tr >
                <td height="30" colspan="9" ><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                  </table></td>
              </tr>
              <tr >
                <td height="27" colspan="3" align="left" class="style3"><div style='float:right'>
            <?=$pagination?>
          </div></td>
                
              </tr>
              <tr bgcolor="#cccccc">
                <td width="3%" height="30" align="left" class="table1">S .No</td>
                <td width="3%" align="center" class="table1">User</td>
                <td width="3%" align="center" class="table1">Email</td>
                <?php //if($type_mode=='clicked') 
			//	echo '<td width="3%" align="center" class="table1">Visited page</td>';?>
              </tr>
              <? 
				  
				  if($num_res_count>0) {
				  

	while ($row = mysql_fetch_array($result)) {
	

	
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";
	

	 	  
	   ?>
              <tr align="left" class="<?= $class ?>">
                <td height="27" style="padding-left:10px;"><?= $i; ?></td>
                <td style="padding-left:10px;"><?= $row['firstname']?></td>
                <td style="padding-left:10px;"><?php echo $row['email'];
				
				
			 	/*$sel_tbl_main_cat="SELECT email,id FROM user_tbl WHERE company_admin='$company_admin' AND  email='".$row['email']."'";
  $query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat);
  $tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat);*/
				
				
				?></td>
                <?php // if($type_mode=='clicked') 
				//echo '<td style="padding-left:10px;"><a href="view_page_result.php?id='.$tbl_main_cat_Fetch['id'].'&campid='.$campid.'&sendid='.$sendid.'"> Visited List</a></td>';?>
              </tr>
              <? $i++; 
			  
			  	ob_flush();
flush();
			  
			  
			  } } else {  ?>
              <tr align="left" class="table2">
                <td height="27" colspan="3" style="padding-left:10px;">No Record Found</td>
              </tr>
              <?php } ?>
              <tr >
                <td height="27" colspan="3" align="left" class="style3"><div style='float:right'>
            <?=$pagination?>
          </div></td>
                
              </tr>
            </table>
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
