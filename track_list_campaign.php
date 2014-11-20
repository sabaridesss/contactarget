<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
}
else
{
	if(isset($_REQUEST['Delete']) && $_REQUEST['Delete'] == 'Delete')
	{
		foreach($_POST['del'] as $key=>$value)
		{
		$del_pro=$_POST['del'][$key];
		
		$update_qry1 =  "DELETE FROM tracking_tbl WHERE id = '$del_pro'";
		$exupdate1 = mysql_query($update_qry1);
		}
		$msg = "Deleted Sucessfully";
	}
	
}
	
 function ip_address_to_number($IPaddress)
{
    if ($IPaddress == "") {
        return 0;
    } else {
        $ips = split ("\.", "$IPaddress");
        $return_number =  ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
	
		 $Select = "SELECT * FROM GeoIP WHERE (beginIpNum <=".$return_number." AND endIpNum >=".$return_number." )"; 
	       $Query   =  mysql_query($Select);
	       $Record  =  mysql_fetch_array($Query);	
	   	   return $Record['countryName'];	
    }
}
$camp_id=$_REQUEST['send_id'];


/*	Pagination Starts Here   */
	
	

	$tbl_name="tracking_tbl";		
	$adjacents = 2;
	 $query = "SELECT COUNT(*) as num FROM $tbl_name where camp_id=$camp_id order by `track_date` desc";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	$targetpage = "track_list_campaign.php?send_id=$camp_id"; 	
	$limit = 20; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name where camp_id=$camp_id  order by track_date desc LIMIT $start, $limit"; 
	$result = mysql_query($sql);
	
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


?>




<?php include ('common/header.php')?>
<style>
div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px !important;
	margin: 2px !important;
	border: 1px solid #AAAADD !important;
	text-decoration: none !important; /* no underline */
	color:  #FFA145 !important;
	float:none;
!important;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #FFA145;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #FFA145;
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
<link rel="stylesheet" href="css/tinypopup_style.css" />
<script type="text/javascript" src="javascript/tinybox.js"></script>
<form id="form1" name="form1" method="post" action="">
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
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <div class="content_req">
            <table width="100%" align="center" >
              <tr >
                <td height="30" colspan="8" ><table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                  </table></td>
              </tr>
              <tr class="table1">
                <td width="4%" height="30" align="left" >S .No</td>
                <td width="10%" align="left" >Date</td>
                <td width="10%" align="left" >User</td>             
                <td width="12%" align="left" >Place</td>
                <td width="12%" align="left">Link1</td>
                <td width="12%" align="left" >Link2</td>
                <td width="12%" align="left" >Link3</td>
                <td width="6%" align="left" >View</td>
                <td width="7%" align="left" >Delete</td>
              </tr>
              <? 
	 $i=$start + '1';
	 
	  while($row=mysql_fetch_array($result)){
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";


		  
	   ?>
              <tr align="left" class="<?= $class ?>">
                <td height="27" class="font2"><?= $i; ?></td>
                <td class="font2"><?php echo $row['track_date'];?></td>
                <td class="font2"><?php  $email_query = "SELECT firstname,lastname,email FROM user_tbl where id= ".$row['camp_user'];
	
	$email_result = mysql_query($email_query);
	$array_k = mysql_fetch_array($email_result);
	if($array_k['email']!="")
	echo  ucfirst($array_k['firstname'])." ". $array_k['lastname']."<br> ". $array_k['email'];
	?></td> <td class="font2">
    
  <?php $country=ip_address_to_number($row['ip_address']);  
  			if($country!="") echo $country; else echo $row['ip_address']; ?>
    
    </td>
               
                <td  class="font2"><?php echo $row['d1']?></td>
                <td class="font2"><?php echo $row['d2']?></td>
                <td class="font2"><?php echo $row['d3']?></td>
                <td class="font2"><a style="cursor:pointer;" onclick="TINY.box.show({url:'view_page_list.php',post:'id=<?php echo $row['id']; ?>',boxid:'frameless',fixed:false,closejs:function(){closeJS()}})">List</a></td>
                <td class="font2"><input name="del[]" type="checkbox" id="del[]"  value="<?php echo $row['id']; ?>"/></td>
              </tr>
              <? $i++; } ?>
              <tr align="left" class="table3">
                <td height="27" colspan="8" align="left" class="style3">&nbsp;</td>
                <td align="center"><input name="Delete" type="submit" id="Delete" value="Delete" class="btn btn-large  btn-danger"  onClick="return deleteContent1();"/></td>
              </tr>
              <tr align="left" class="table2">
                <td colspan="9" align="center"><?=$pagination?>
                </td>
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
</body></html>