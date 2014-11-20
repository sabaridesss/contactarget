<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {

  	$msg = "";
	
	if(isset($_REQUEST["msg"])) {
	
	if($_REQUEST["msg"] == '2'){
				$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Campaign Added Successfully.
</div>';
	}else if($_REQUEST["msg"] == '3'){
	
				$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Campaign Updated Successfully.
</div>';
	}else if($_REQUEST["msg"] == '1'){
	
					$msg = '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Mail Send Sucessfully!
</div>';	
	}else if($_REQUEST["msg"] == '4'){
	
					$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Success!</strong>
Campaign Deleted Successfully.
</div>';
	}
	
	}
	
	if(isset($_REQUEST['delete'])) {
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from campaign_list where company_admin='$company_admin' AND id=".$id;
		if(mysql_query($query)) {
					header("Location:campaign.php?msg=4");		
				}
	} }
}
	
	
?>
<?php include ('common/header.php')?>

<form name="content_add" method="post" action="campaign.php" >
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
                <td width="25%" align="center" valign="middle"><strong><font color="#FF0000">
                               </font></strong></td>
                <!-- <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="mail_subscribers.php">Email Tool</a></div></td>-->
                <!--<td width="25%" align="right" valign="middle">&nbsp;</td>
    <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="campaign_list.php"> Results</a></div></td>-->
                <td width="25%" align="right" valign="middle">&nbsp;</td>
               <!-- <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="usermail_list.php">User List</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="javascript:void(0)" onclick="window.open('camp_cat_list.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=900,height=400,top=200,left=200,scrollbars=yes'); ">Campaign Types</a></div></td>
                <td width="25%" align="right" valign="middle"></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>-->
                <td width="25%" align="right" valign="middle"><a href="campaign_page.php" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Add Campaign</a></td>
              </tr>
            </table>
          </div>
          <div class="content">
            <table width="100%" border="0" align="center" class="table table-striped table-bordered bootstrap-datatable datatable">
            <thead>
              <tr class="table1">
                <td height="30" align="left" ><strong>S.No</strong></td>
                <td align="left" >Campaign Name</td>
                <td align="left" ><strong>Keyword</strong></td>
                <td align="left" ><strong>Campaign Type</strong></td>
                <td ><strong>Action</strong></td>
              </tr>
              </thead>
              <? 
			  
			        $query2= "select * from campaign_list where company_admin='$company_admin'";
	$query_result = mysql_query($query2);
	if(!$query_result )
	echo mysql_error();
	
			  
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
              <tr class="<?=$class?>" >
                <td width="3%" height="27" align="left" class="font2"><?=$i?></td>
                <td width="20%" align="left" class="font2"><?=$item["c_name"]?></td>
                <td width="18%" align="left" class="font2"><?=$item["c_keyword"]?></td>
                <td width="12%" align="left" class="font2"><?php
				
				$viewSelect = "SELECT * FROM camp_category where company_admin='$company_admin' AND id=".$item["c_type"];
$exViewQuery = mysql_query($viewSelect);
$row = mysql_fetch_array($exViewQuery);
echo $row['cate_name'];				
 ?></td>
                <td width="28%"><table width="100%"  border="0">
                    <tr>
                      <td width="25%" align="center" class="font2"><a href="campaign_page.php?id=<?=$item["id"]?>" class="btn btn-info " style="text-decoration:none;"><i class="icon-edit icon-white"></i>Edit </a></td>
                      <td width="28%" align="center" class="font2">	<a class="btn btn-danger" href="campaign.php?id=<?=$item["id"]?>&delete=true" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'>
										<i class="icon-trash icon-white"></i> 
										Delete
									</a></td>
                      <td width="34%" align="center" class="font2"><a class="btn btn-success" href="campaign_list.php?campaign_id=<?=$item["id"]?>">
										<i class="icon-zoom-in icon-white"></i>  
										View  Report                                           
									</a> </td>
                      <td width="1%" align="center" class="font2"><!--<a href="mail_subscribers.php?campaign_id=<?=$item["id"]?>" class="style3" > Send Email</a>--> </td>
                    </tr>
                  </table></td>
              </tr>
              <? $i++; } ?>
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