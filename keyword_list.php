<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
}
else
{

   $track_id  = $_REQUEST['id'];

    $select_track  = "SELECT * FROM `tracking_tbl` WHERE id  = '$track_id'";
	$track_query   = mysql_query($select_track); 
	$track_fetch   = mysql_fetch_array($track_query);
	
	$ip_address = $track_fetch['ip_address'];
	$date       = $track_fetch['created_date'];
	$date_now   = date('Y-m-d',strtotime($date));
	
	$selectQuery = "SELECT * FROM track_keywords where ip_address = '".$ip_address."' and DATE(created_date) = '$date_now'";
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

 	header("location:$path");
}	
?>
<?php include ('common/header.php')?>

 <form id="form1" name="form1" method="post" action="tracking_page_list.php">
<table width="100%" border="0" cellpadding="0">
 
  <!--<tr>
	<td></td>
  </tr>-->
  <tr>
	<td align="center" class="top">
	<?php // include('common/top_menu.php') ?>
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000"> Keyword Search for IP
      <?=$ip_address?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content_req">
<table width="100%" align="center" >
          <tr >
            <td height="30" colspan="8" ></td>
            </tr>
          <tr bgcolor="#cccccc">
            <td width="25%" height="30" align="left" class="table1">S .No</td>
            <td width="25%" align="center" class="table1">Search Engine</td>
            <td width="25%" align="center" class="table1">Keywords</td>
            <td width="25%" align="center" class="table1">Browser</td>
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
            <td style="padding-left:10px;"><?= $row['search_engine']?></td>
            <td style="padding-left:10px;"><?= $row['keywords']?></td>
            <td style="padding-left:10px;"><?= $row['browser']?></td>
          </tr>
		  <? $i++; } ?>
          <!--<tr >
            <td height="27" colspan="8" align="center" class="style3"><input name="Close" type="submit" id="Close" value="Close" class="submit" /></td>
       
          </tr>-->
        </table>
</div>
<!--welcome admin end here-->
</div>
<!--footer start here-->
<?php // include('common/footer.php'); ?>
<!--footer end here--></td>
  </tr>
</table>
</form>


</div>
</center>
</body>
</html>
