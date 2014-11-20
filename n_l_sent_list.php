



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
		
		$update_qry2 =  "SELECT * FROM n_l_readlist WHERE sent_id = '$del_pro'";
		$exupdate1 = mysql_query($update_qry2);
		
		$update_qry1 =  "DELETE FROM  nl_sent_detail_tbl WHERE id = '$del_pro'";
		$exupdate1 = mysql_query($update_qry1);
		}
		$msg = "Deleted Sucessfully";
	}
	$selectQuery = 'SELECT * FROM  nl_sent_detail_tbl WHERE nl_id='.$_REQUEST['id'];
	$exQuery = mysql_query($selectQuery); 
}
	

// -----starts-------- function for export option ----starts--------//
 if(isset($_REQUEST['Export']) && ($_REQUEST['Export'] == "Export"))
 {
 	$sDate = $_REQUEST['start_date'];
	$sPieces = explode("/", $sDate);
	$startDate = $sPieces[2].'-'.$sPieces[0].'-'.$sPieces[1];

 	$eDate = $_REQUEST['end_date'];
	$ePieces = explode("/", $eDate);
	$endDate = $ePieces[2].'-'.$ePieces[0].'-'.$ePieces[1];
	
 	$path = "export_request.php?reqSdate=".$startDate."&reqEdate=".$endDate;

 	header("location:restaurant_requote.php");
}	
?>
<?php include ('common/header.php')?>

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
                <td width="25%" align="right" valign="middle"><div class="addmenu"><a href=" bounce.php">Bounce Mail</a> </div></td>
              </tr>
            </table>
          </div>
          <div class="content_req">
            <table width="100%" align="center" >
              <!--<tr >
                <td height="30" colspan="8" ><table width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="12%">Start Date</td>
                      <td width="32%"><input type="text" name="start_date" id="start_date" value="<?php echo $start_date;?>" class='calender'>
                        <script language='JavaScript'>
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'start_date'
	});

	</script>
                      </td>
                      <td width="11%">End Date</td>
                      <td width="35%"><input type="text" name="end_date" id="end_date" value="<?php echo $end_date;?>" class="calender">
                        &nbsp;
                        <script language='JavaScript'>
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'end_date'
	});

	</script></td>
                      <td width="10%"><input type="submit" value="Export" class="addmenu2" name="Export"/></td>
                    </tr>
                  </table></td>
              </tr>-->
              <tr bgcolor="#cccccc">
                <td width="4%" height="30" align="left" class="table1">S .No</td>
                <td width="10%" align="center" class="table1">Total Sent</td>
                <td width="11%" align="center" class="table1">Number of Send </td>
                <td width="12%" align="center" class="table1">Number Of Failed</td>
                <td width="20%" align="center" class="table1">Number Of Read </td>
                <!--<td width="26%" align="center" class="table1">Action</td>-->
                <td width="26%" align="center" class="table1">Delete</td>
                
              </tr>
              <? 
	  $i=1;
	  while($row=mysql_fetch_array($exQuery)){
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";


		  
	   ?>
              <tr align="left" class="<?= $class ?>">
                <td height="27" style="padding-left:10px;"><?= $i; ?></td>
                <td style="padding-left:10px;"><?= $row['other_refer']?></td>
                <td style="padding-left:10px;"><?php 
				
				$sent_segment1=$row['total_sent_list'];
$sentChunks = explode("+$#@+", $sent_segment1);
$sent_list_mail= count($sentChunks)-1; echo $sent_list_mail;?>
				
				
				
				 </td>
                <td style="padding-left:10px;"><?php echo $row['other_refer'] - $sent_list_mail;?></td>
                <td style="padding-left:10px;"><?php 
				
			    	$check="SELECT * FROM n_l_readlist WHERE sent_id='".$row['sent_id']."' and  n_l_id = '".$row['nl_id']."'";
$check_record=mysql_query($check); 
if(!$check_record)
echo mysql_error();
$record_count=mysql_num_rows($check_record);
	echo $record_count;			
				?>
                
                
                
                
                </td>
                <!--<td style="padding-left:10px; text-decoration:underline;"><a  class="style3" style="text-decoration:none" href=" bounce.php?id=<?php echo $row['nl_id']; ?>">View Undelivered</a></td>-->
                <td align="center" style="padding-left:10px;"><input name="del[]" type="checkbox" id="del[]"  value="<?php echo $row['id']; ?>"/></td>
              </tr>
              <? $i++; } ?>
              <tr >
                <td height="27" colspan="5" align="left" class="style3">&nbsp;</td>
                <td align="center"><input name="Delete" type="submit" id="Delete" value="Delete" class="submit"  onClick="return deleteContent1();"/></td>
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