<?php
include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
include("cfg/MYSQL.php");

//include("cfg/tables.inc.php");

//include("cfg/connect.inc.php");

//connect to the database

	db_connect(DB_HOST,DB_USER,DB_PASS) or die (db_error());

	db_select_db(DB_NAME) or die (db_error());

	if($_REQUEST["msg"] == '5'){
	
		$msg = "Published Suceessfully ";	
	}
if($_REQUEST["msg"] == '1'){
	
		$msg = "Record Added Suceessfully ";	
	}
if($_REQUEST["msg"] == '4'){
	
		$msg = "Record Updated Suceessfully ";	
	}

if(isset($_REQUEST['delete']))
		{
		$menus_id = $_REQUEST['page_id'];
		$sel_query = "delete from projects where uid ='".$menus_id."'";
		$exec_Sel_auery = mysql_query($sel_query);
		
			$msg = "Deleted Sucessfully";
		}

if(isset($_REQUEST['delete2']))
{
$delete_name   =  $_REQUEST['singledel'];
foreach($delete_name as $val)
{
$delete_record = "DELETE FROM projects WHERE uid = '$val'";
$delete_query  =  mysql_query($delete_record);
}
$msg = "Record Deleted Suceessfully ";	
}

if(isset($_REQUEST['check_all']))
{
$check_all = "CHECKED";
}


// -----starts-------- function for export option ----starts--------//
 if(isset($_REQUEST['Export']) && ($_REQUEST['Export'] == "Export"))
 {
 	$sDate = $_REQUEST['start_date'];
	$sPieces = explode("/", $sDate);
	$startDate = $sPieces[1].'-'.$sPieces[0].'-'.$sPieces[2];

 	$eDate = $_REQUEST['end_date'];
	$ePieces = explode("/", $eDate);
	$endDate = $ePieces[1].'-'.$ePieces[0].'-'.$ePieces[2];
	
 	$path = "export_link.php?reqSdate=".$startDate."&reqEdate=".$endDate;

 	header("location:$path");
}	
?>
<?php include ('common/header.php')?>
    <script type="text/JavaScript">
 
function confirmDelete(){
var agree=confirm("Are you sure you want to delete this file?");
if (agree)
     return true;
else
     return false;
}


function export_xls()
{

var start_date 	 	=	document.getElementById('start_date').value;
var end_date 		=	document.getElementById('end_date').value;


 
if(document.getElementById('start_date').value==0)
{
alert('Please Select Start Date');
document.getElementById('start_date').focus();
return false;
}
 else if(document.getElementById('end_date').value==0)
{
alert('Please Select End Date');
document.getElementById('end_date').focus();
return false;
}

 return true;
}


</script>
    <form name="content_add" method="post"  action="link_exchange.php" >
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
                    <td width="34%" align="center" valign="middle">List Links</td>
                   <!-- <td width="13%" align="right" valign="middle" ><div class="addmenu"><a href="link_publish1.php">Publish</a></div></td>-->
                    <!--<td width="13%" align="right" valign="middle" ><div class="addmenu"><a href="link_cat.php">Categorise</a></div></td>-->
                    <td width="13%" align="right" valign="middle" ><div class="addmenu"><a href="new_links.php">Add New Link</a></div></td>
                  </tr>
                </table>
              </div>
              <div class="content">
                <table width="100%" height="38" border="0">
                  <tr>
                    <td width="12%">Start Date</td>
                    <td width="17%"><input type="text" name="start_date" id="start_date" value="<?php echo $start_date;?>" class='calender'>
                      <script language='JavaScript'>
	new tcal ({
		// form name
		'formname': 'content_add',
		// input name
		'controlname': 'start_date'
	});

	</script>
                    </td>
                    <td width="11%">End Date</td>
                    <td width="17%"><input type="text" name="end_date" id="end_date" value="<?php echo $end_date;?>" class="calender">
                      &nbsp;
                      <script language='JavaScript'>
	new tcal ({
		// form name
		'formname': 'content_add',
		// input name
		'controlname': 'end_date'
	});

	</script></td>
                    <td width="10%"><input type="submit" value="Export" class="addmenu2" name="Export" onClick="return export_xls()"/></td>
                    <td width="894" valign=""><div align="right">
                        <input type="text" name="txtsearch" style="BORDER-RIGHT: #000000 1px solid; BORDER-TOP: #000000 1px solid; FONT-SIZE: 15px; BORDER-LEFT: #000000 1px solid; COLOR: #000000; BORDER-BOTTOM: #000000 1px solid; FONT-FAMILY: Verdana; TEXT-DECORATION: none" />
                        <input type="submit" name="search" value="Search" onClick="return formcheck()" class="addmenu2"/>
                      </div></td>
                  </tr>
                </table>
                <div align="center"><span  style="color:#FF0000;" ><b>
                  <?=$msg?>
                  </b></span></div>
                <table border='0' width='100%' align='center' class='content'>
                  <tr class='table1'>
                    <td width ='1%' align='center'><span style='font-family:Verdana; font-size:13px;'> <strong>Sno</strong> </span></td>
                    <td width ='6%' align='center'><span style='font-family:Verdana; font-size:13px;'>
                      <?php
					if($_REQUEST['date']=='desc')
					{
					?>
                      <a href="link_exchange.php?date=asc" class="arrow1_help_desk" style="text-decoration:none;font-family:Verdana; font-size:13px; color:#FFFFFF;"><strong>Created Since</strong></a>
                      <?php
					}
					else if($_REQUEST['date']=='asc')
					{
					?>
                      <a href="link_exchange.php?date=desc" class="arrow_help_desk" style="text-decoration:none;font-family:Verdana; font-size:13px; color:#FFFFFF;"><strong>Created Since</strong></a>
                      <?php
                    }
					else
					{
					?>
                      <a href="link_exchange.php?date=asc" style="text-decoration:none;font-family:Verdana; font-size:13px; color:#FFFFFF;"><strong>Created Since</strong></a>
                      <?php
					}
					?>
                      </span></td>
                    <td width='12%' align='center'><span style='font-family:Verdana; font-size:13px;'> <strong>Title </strong></span></td>
                    <td width ='10%' align='center'><span style='font-family:Verdana; font-size:13px;'><strong>Site URL</strong> </span></td>
                    <td width ='13%' align='center'><span style='font-family:Verdana; font-size:13px;'><strong>Category </strong> </span></td>
                    <td width ='8%' align='center'><span style='font-family:Verdana; font-size:13px;'>
                      <?php
					if($_REQUEST['foundurl']=='yes')
					{
					?>
                      <a href="link_exchange.php?foundurl=no" class="arrow1_help_desk" style="text-decoration:none;font-family:Verdana; font-size:13px; color:#FFFFFF;"><strong>Founded Url</strong></a>
                      <?php
					}
					else if($_REQUEST['foundurl']=='no')
					{
					?>
                      <a href="link_exchange.php?foundurl=yes" class="arrow_help_desk" style="text-decoration:none;font-family:Verdana; font-size:13px; color:#FFFFFF;"><strong>Founded Url</strong></a>
                      <?php
                    }
					else
					{
					?>
                      <a href="link_exchange.php?foundurl=no"  style="text-decoration:none;font-family:Verdana; font-size:13px; color:#FFFFFF;"><strong>Founded Url</strong></a>
                      <?php
					}
					?>
                      </span></td>
                    <td width ='1%' align='center'><span style='font-family:Verdana; font-size:13px;'><strong>Action</strong> </span></td>
                    <td width ='2%' align='center'><input type="checkbox" name="check_all" id="check_all" onclick="javascript:document.content_add.submit()" <?php if($check_all != '') { echo 'checked="checked"'; }?>  />
                    </td>
                  </tr>
                  <?php 
if($_REQUEST['date'] == 'asc')
{
$condition = "ORDER BY STR_TO_DATE(date, '%d-%m-%Y ') ASC";
}
else if($_REQUEST['date'] == 'desc')
{
$condition = "ORDER BY STR_TO_DATE(date, '%d-%m-%Y ') DESC";
}
else if($_REQUEST['foundurl'] == 'yes')
{
$condition = "ORDER BY url_3party DESC";
}
else if($_REQUEST['foundurl'] == 'no')
{
$condition = "ORDER BY url_3party ASC";
}
else
{				  
$condition =  '';				  
}
	$viewSelect = 'SELECT * FROM projects'.' '.$condition;
$exViewQuery = mysql_query($viewSelect);
$num = mysql_num_rows($exViewQuery);
	
	$i=1;
	while ($row = mysql_fetch_array($exViewQuery))
	{ 
	   $class="table2";
	   if(($i%2)==0)
	   $class="table3";
	?>
                  <tr class='<?= $class ?>'>
                    <td align='center' style='font-size:large'><?=$i?></td>
                    <td align="center"><?php  if($row['date'] != "")
{

echo $row['date'];
$start = strtotime($row['date']);
$end = strtotime(date("d-m-Y"));
if($start > time()) { $tim= 'days after'; }
if($start < time()) {  $tim= 'days ago'; }
$days_between = ceil(abs($end - $start) / 86400);
echo "<br/>(".$days_between."&nbsp;".$tim.")";

}
?></td>
                    <td><a href="new_links.php?view=true&prod_id=<?=$row["uid"]?>&page_id=<?=$row["uid"]?>" class="style3" title="View"><?php echo $row['title']; ?></a></td>
                    <td><a href="<?=$row['url']?>" target="_blank" ><?php echo $row['url']; ?></a></td>
                    <td><?php
					 $select_category     =  "SELECT * FROM prod_category WHERE id = ".$row['category'];
					 $select_catquery     =  mysql_query($select_category);
					 $select_catarray     =  mysql_fetch_array($select_catquery);
					 ?>
                      <?php echo $row['category']; ?></td>
                    <td align='center' style='font-size:large'><a href="<?=$row["url_3party"]?>"  target="_blank">
                      <?=$row["url_3party"]?>
                      </a></td>
                    <td align="right" ><a href="new_links.php?edit=true&prod_id=<?=$row["uid"]?>&page_id=<?=$row["uid"]?>" class="style3">Edit </a>&nbsp;&nbsp;&nbsp;<a onClick="return confirmDelete();" href="admin_sec.php?id=<?=$row["uid"]?>&delete=true&page_id=<?=$row["uid"]?>" class="style3" > Delete</a></td>
                    <td align="right" ><input type="checkbox" name="singledel[]" value="<?=$row["uid"]?>" id="single_del" <?php if($check_all != '') { echo 'checked="checked"'; }?>  />
                    </td>
                    <?php $i++; } ?>
                </table>
                <table align ='center' width='100%' height='15' border='0'>
                  <tr>
                    <td align='right' colspan="7"><input type="submit" value="Delete" name="delete2" class="addmenu" />
                      <div class='font2' align='right'></div></td>
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
