<?php
include("smarty_config.php");
include("phpmailfunction.php");

$php_mail = new phpmail_function();
//include("top_menu.php");

//include('bounce.php');

$id  = $_REQUEST['send_id'];
if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} 
	  
$Campaign_Blasts 	 = $php_mail->Campaign_Details_JOIN($id,$company_admin);
$Campaign_Details	 = mysql_fetch_assoc($Campaign_Blasts);
$c_name 		     = $Campaign_Details['c_name'];
$email_subject 		 = $Campaign_Details['email_subject'];
          

?>
<?php include ('common/tracking_count.php');?>
<?php include ('common/header.php');?>

<form name="content_add" method="post" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top">
      <?php include('common/top_menu.php'); ?>
      <div class="wholesite-inner">
        <!--welcome admin start here-->
         <?php include('common/tracking_views.php'); 
		 
$adjacents = 4;
$total_pages = $no_of_unopened; 
$targetpage = "unopened_details.php?send_id=".$id; 			//if no page var is given, set start to 0
$num_res_count = $no_of_unopened_page;
	
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
		 
		echo  $sel_resend_count	="SELECT resent_status,id FROM comp_user_tbl WHERE resent_status=1";
$run_sel_resend			=mysql_query($sel_resend_count);
if(!$run_sel_resend	)
echo mysql_error();
echo mysql_num_rows($run_sel_resend);	
while($run_sel_resend_fetch =mysql_fetch_array($run_sel_resend))
{

echo $run_sel_resend_fetch['resent_status'].'=   id='.$run_sel_resend_fetch['id'];

}


exit;
		 
		 if(($no_of_successcount-$no_of_opened) != 0 ) {   echo $run_sel_resend_fetch['resent_status'].$resend_yes; ?>


         <div style="float:right"> <span class="title fwb ">Resend Status:</span> <span class="description">
      <?php if($no_of_unopened_Blasts != 0 && $resend_yes=='Yes'){  echo $resend_yes; } else { ?>
      <a href="preview_resend.php?camp_id=<?=$id;?>">Resend Now</a>
      <?php }  ?>
      </span> </div> 

<?php }  ?>


        <div  style="width:64%">
          <table border="0" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
            <tr class="table1">
              <td align="left" >Email</td>
              <td height="30" align="left" ><strong>First Name</strong></td>
              <td align="left" >Last Name</td>
            </tr> </thead>
            <?php 
			if($no_of_unopened>0) {
				while($item=mysql_fetch_array($no_of_unopened_Blasts_page)){

            	$Select_Blasts 	 = $php_mail->Select_Blast('user_tbl','id',$item['user_id']);
					while($item1=mysql_fetch_array($Select_Blasts)){
					$class="table2";
	   if(($i%2)==0)
	     $class="table3";
			?>
            <tr class="<?=$class?>" >
              <td width="15%" height="27" align="left" class="font2"><?=$item1['email'];?></td>
              <td width="15%" align="left" class="font2"><?=$item1['firstname'];?></td>
              <td width="15%" align="left" class="font2"><?=$item1['lastname'];?></td>
            </tr>
            <?php $i++;}} ?> <tr >
                <td height="27" colspan="3" align="left" class="style3"><div style='float:right'>
                    <?=$pagination?>
                  </div></td>
              </tr><?php   } else { ?><tr align="left" class="table2">
                <td height="27" colspan="3" style="padding-left:10px;">No Record Found</td>
              </tr> <?php }?>
           
          </table>
        </div>
        <div style="clear:both"></div>
        <!--welcome admin end here-->
      </div>
      <!--footer start here-->
      <?php include('common/footer.php'); ?>
      <!--footer end here-->
      </td>
    </tr>
  </table>
</form>
</div>
</center>
</body></html>