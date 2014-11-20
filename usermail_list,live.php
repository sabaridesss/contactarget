<?php
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {

if(isset($_REQUEST['sort']))
{
if($_REQUEST['sort']=='All')
{
$search='All'; 
$sql_order="WHERE  company_admin='$company_admin' order by id ASC";
}
else
{
$search=urldecode($_REQUEST['sort']); 
$sql_order="WHERE  company_admin='$company_admin' AND `user_type` = '".$search."'";
}
}
else
{
$search='All'; 
$sql_order="WHERE  company_admin='$company_admin' order by id ASC";

}


$total_subscribers  = $php_mail->get_user_total_records_count($company_admin);

$active_subscribers  = $php_mail->get_active_user_total_records_count($company_admin);

$bounce_subscribers  = $php_mail->get_bounce_user_total_records_count($company_admin);

$nonactive_subscribers  = $php_mail->get_deactive_user_total_records_count($company_admin);



   // $query2= "select * from  user_tbl ".$sql_order;
//	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Audience Added Successfully.
</div>';	
	}else if($_REQUEST["msg"] == '3'){
	
				$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Audience Updated Successfully.
</div>';	
	}else if($_REQUEST["msg"] == '4'){
	
					$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Audience Deleted Successfully.
</div>';	
	}
	else if($_REQUEST["msg"] == '5'){
	
		$msg = "All Records Successfully deleted";	
	}
	else if($_REQUEST["msg"] == '6'){
	
		$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Its Bounced Mail!</strong>
Can not add right now.
</div>';	
	}
	
	
	
	if(isset($_REQUEST['Delete']) && $_REQUEST['Delete'] == 'Delete')
	{
		foreach($_POST['del'] as $key=>$value)
		{
		$del_pro=$_POST['del'][$key];
		
		 $update_qry1 =  "DELETE FROM user_tbl WHERE  company_admin='$company_admin' AND id = '$del_pro'";
		$exupdate1 = mysql_query($update_qry1);
		}
		header("Location:usermail_list.php?msg=4");	
	}
	
	if(isset($_REQUEST['deleteuser']) && $_REQUEST['deleteuser'] == 'all')
	{
	
		
		 $update_qry1 =  "DELETE FROM user_tbl WHERE  company_admin='$company_admin'";
		$exupdate1 = mysql_query($update_qry1);
	
		header("Location:usermail_list.php?msg=4");	
	}
		
	
// -----starts-------- function for export option ----starts--------//
 if(isset($_REQUEST['Export']) && ($_REQUEST['Export'] == "Export"))
 {
 	$sort = $_REQUEST['sort'];
	
	
 	$path = "export_email.php?sort=".$sort;

 	header("location:$path");
}	


}
	
	
?>
<?php include ('common/header.php')?>
<script type="text/javascript">


// Javascript
function toggleCheckboxes(current, form, field) {
	var val = current.checked;
	var cbs = document.getElementById(form).getElementsByTagName('input');
	var length = cbs.length;
	
	for (var i=0; i < length; i++) {
		if (cbs[i].name == field +'[]' && cbs[i].type == 'checkbox') {
			cbs[i].checked = val;
		}
	}
}





function sort_check()
{
var sort1 = document.content_add.sort.value;
window.location = "usermail_list.php?sort="+sort1;
}</script>
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
<!--
function getConfirmation(){
   var retVal = confirm("Do you want to Delete ?");
   if( retVal == true ){
     
	  return true;
   }else{
    
	  return false;
   }
}
//-->
</script>
<form name="content_add" id="content_add" method="post" action="" >
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
                <td width="13%" align="center" valign="middle"><strong><font color="#FF0000">
                 
                  </font></strong></td>
                <td  width="21%">Groups Type&nbsp;
                  <select name='sort' onchange="return sort_check()" >
                    <option value='All' <?php
                    if($search == 'All')
					{
					echo 'selected="selected"';
					}
					?> >Show All</option>
                    <?php 
 
 
 
  					$sel_tbl_main_cat="SELECT * FROM camp_categ WHERE  company_admin='$company_admin'";
				  
				  $query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat);
		 
		  while($tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat)) {?>
                    <option id="sort"    value="<?php 
								echo $tbl_main_cat_Fetch['cate_name'];?>"
                                
                                 <?php
                    if($search == $tbl_main_cat_Fetch['cate_name'])
					{
					echo 'selected="selected"';
					}
					?> >
                    <?php  echo $tbl_main_cat_Fetch['cate_name'];?>
                    </option>
                    <?php }?>
                  </select>
                  
             </td><td>     <input type="submit" value="Export" class="btn btn-large btn-primary" name="Export"/></td>
                <td width="12%" align="right" valign="middle" ><a href="upload_users.php" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i>Upload</a> </td>
                <td width="1%" align="right" valign="middle">&nbsp;</td>
                <td width="15%" align="right" valign="middle"><a href="users_name.php" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Add Audience</a></td>
                 <td width="6%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><a onclick="return getConfirmation();" href="usermail_list.php?deleteuser=all" class="btn btn-danger btn-large"><i class="icon-chevron-left icon-white"></i> Delete All</a></td>
                 <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          <div>
          <div class="sortable row-fluid">
				<a data-rel="tooltip" title="." class="well span3 top-block" href="#">
					<span class="icon32 icon-black icon-user"></span>
					<div>Total Audience</div>
					<div>
                    
                    
					<?php
					
					if($search!='All')
					{
					 $user_tot_aud = "select user_type from  user_tbl WHERE  company_admin='$company_admin' AND `user_type` = '".$search."'"; 
					$user_tot_aud = mysql_query($user_tot_aud);
					echo mysql_num_rows($user_tot_aud);
					}
					else
					{
					echo $total_subscribers; }?></div>
				
				</a>

				<a data-rel="tooltip" title="4 new pro members." class="well span3 top-block" href="#">
			<span class="icon32 icon-blue icon-user"></span>
					<div>Active Audience</div>
					<div><?php
					
					if($search!='All')
					{
					 $user_tot_aud = "select user_type from  user_tbl WHERE  company_admin='$company_admin' AND subscribe = 0  AND `user_type` = '".$search."'"; 
					$user_tot_aud = mysql_query($user_tot_aud);
					echo mysql_num_rows($user_tot_aud);
					}
					else
					{
					echo $active_subscribers; }?></div>
					
				</a>

				<a data-rel="tooltip" title="$34 new sales." class="well span3 top-block" href="#">
			<span class="icon32 icon-red icon-user"></span>
					<div>Bounce Audience</div>
					<div><?php
					
					if($search!='All')
					{
					 $user_tot_aud = "select user_type from  user_tbl WHERE  company_admin='$company_admin' AND Bounced = 1 and subscribe = 1  AND `user_type` = '".$search."'"; 
					$user_tot_aud = mysql_query($user_tot_aud);
					echo mysql_num_rows($user_tot_aud);
					}
					else
					{
					echo  $bounce_subscribers; }?></div>
					
				</a>
				
				<a data-rel="tooltip" title="12 new messages." class="well span3 top-block" href="#">
					<span class="icon32 icon-orange icon-user"></span>
					<div>Non Active Audience</div>
					<div><?php
					
					if($search!='All')
					{
					 $user_tot_aud = "select user_type from  user_tbl WHERE  company_admin='$company_admin' AND and  subscribe = 1 and Bounced = 1  AND `user_type` = '".$search."'"; 
					$user_tot_aud = mysql_query($user_tot_aud);
					echo mysql_num_rows($user_tot_aud);
					}
					else
					{
					echo  $nonactive_subscribers; }?></div>
				
				</a>
			</div>
          
          </div>
          <div class="content">
            <table width="100%" border="0" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr class="table1">
                <td height="30" align="left" ><strong>ID</strong></td>
                <td align="left" class="style6"><strong>Group type </strong></td>
                <td align="left" >First Name</td>
                <td align="left" ><strong>Last Name</strong></td>
                <td align="left" ><strong>Email</strong></td>
                <td ><strong>Subscription</strong></td>
                <td ><strong>Action </strong> <input type="checkbox" onclick="toggleCheckboxes(this, 'content_add', 'del');" /></td>
              </tr>
              </thead>
              <? 
			  
			  
			  
			  
/*search Gen*/


	//$search=$_REQUEST['search']; 
/*	Pagination Starts Here   */

	//$tbl_name="menu_page_tbl";		
	$adjacents = 4;
	$query = "SELECT COUNT(*) as num FROM user_tbl $sql_order";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	$targetpage = "usermail_list.php"; 	
	$limit = 500; 								//how many items to show per page
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
$sql = "select * from  user_tbl $sql_order LIMIT $start, $limit"; 
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
			$pagination.= "<a href=\"$targetpage?sort=$search&page=$prev\"><< Previous</a>";
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
					$pagination.= "<a href=\"$targetpage?sort=$search&page=$counter\">$counter</a>";					
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
						$pagination.= "<a href=\"$targetpage?sort=$search&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?sort=$search&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?sort=$search&page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?sort=$search&page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?sort=$search&page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?sort=$search&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?sort=$search&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?sort=$search&page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?sort=$search&page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?sort=$search&page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?sort=$search&page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?sort=$search&page=$next\">Next >></a>";
		else
			$pagination.= "<span class=\"disabled\">Next >></span>";
		$pagination.= "</div>\n";		
	}
	if($num_res_count==0)
	$fld1="<span style='color:#FF0000'>No Results Found</span";
	else
	{	  $i=$start + '1';
while ($item = mysql_fetch_array($result)) {

/*pagination ends*/
 $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
              <tr class="<?=$class?>" >
                <td width="3%" height="27" align="left" class="font2"><?=$i?></td>
                <td width="20%" align="left" class="font2"><?=$item["user_type"]?></td>
                <td width="20%" align="left" class="font2"><?=$item["firstname"]?></td>
                <td width="18%" align="left" class="font2"><?=$item["lastname"]?></td>
                <td width="12%" align="left" class="font2"><?=$item["email"]?> </td>
                <td width="12%" align="left" class="font2"><?php if($item["subscribe"]==1 && $item["Bounced"]==1 ) echo '<span class="label label-important">Bounce</span>'; elseif($item["subscribe"]==0)  echo '<span class="label label-success">Active</span>'; else echo '<span class="label label-warning">Non active</span>';?></td>
                <td width="28%"><table width="100%"  border="0">
                    <tr>
                      <td  class="center"><a href="users_name.php?id=<?=$item["id"]?>" class="btn btn-info " style="text-decoration:none;"><i class="icon-edit icon-white"></i>Edit </a>
 </td>
                      <td width="31%" align="center" class="font2"><!--<a href="usermail_list.php?id=<?=$item["id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> Delete</a>-->
                        <input name="del[]" type="checkbox" id="del[]"  value="<?php echo $item['id']; ?>"/></td>
                    </tr>
                  </table></td>
              </tr>
              <? $i++; }      
}
     ?>
              <tr >
                <td height="27" colspan="6" align="left" class="style3">&nbsp;</td>
                <td align="right"><input class="btn btn-danger btn-large" name="Delete" type="submit" id="Delete" value="Delete"  onClick="return deleteContent1();"/></td>
              </tr>
              
              <tr >
                <td height="27" colspan="7" align="left" class="style3"><div style='float:right'>
            <?=$pagination?>
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
</body></html>