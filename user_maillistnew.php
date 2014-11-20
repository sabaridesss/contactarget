<?php
include("smarty_config.php");
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
$search=$_REQUEST['sort']; 
$sql_order="WHERE  company_admin='$company_admin' AND `user_type` = '".$_REQUEST['sort']."'";
}
}
else
{
$search='All'; 
$sql_order="WHERE  company_admin='$company_admin' order by id ASC";

}

$sql = "select * from  user_tbl"; 
	$result = mysql_query($sql);




   // $query2= "select * from  user_tbl ".$sql_order;
//	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = "Data Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Data Successfully Added";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Successfully deleted";	
	}
	else if($_REQUEST["msg"] == '5'){
	
		$msg = "All Records Successfully deleted";	
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
          <!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="33%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
                  </font></strong></td>
                <td  width="36%">Audience type &nbsp;
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
                  
             </td><td>     <input type="submit" value="Export" class="addmenu2" name="Export"/></td>
                <td width="35%" align="right" valign="middle" ><div class="addmenu2"><a href="upload_users.php">Upload </a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="users_name.php">Add Audience</a></div></td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a onclick="return getConfirmation();" href="usermail_list.php?deleteuser=all">Delete All</a></div></td>
                <!-- <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="javascript:void(0)" onclick="window.open('camp_cat_list_cator.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=900,height=400,top=200,left=200,scrollbars=yes'); ">category</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="Campaign.php"> Campaign</a></div></td>-->
              </tr>
            </table>
          </div>
          <div id="content" class="span10">
			<!-- content starts -->
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2>Audience List</h2>
			</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>S.NO</th>
								  <th>Audience Type</th>
								  <th>First Name</th>
								  <th>Last Name</th>
                                  <th>Email</th>
                                  <th>Subscription</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                          <?php
                          while ($item = mysql_fetch_array($result)) {

/*pagination ends*/
 $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
							<tr>
								<td><?=$i?></td>
     	<td class="center"><?=$item["user_type"]?></td>
								<td class="center"><?=$item["firstname"]?></td>
                                	<td class="center"><?=$item["lastname"]?></td>
                                    	<td class="center"><?=$item["email"]?></td>
                                        <?php if($item["subscribe"]==0)
										{
										?>
								<td class="center">
									<span class="label label-success">Active</span>
								</td>
                                <?php
								} else
								{
								?>
                                	<td class="center">
								<span class="label label-important">Banned</span>
								</td>
                                <?php
								}
								?>
								<td class="center">
													<a class="btn btn-info" href="users_name.php?id=<?=$item["id"]?>">
										<i class="icon-edit icon-white"></i>  
										Edit                                            
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white"></i> 
										Delete
									</a>
								</td>
							</tr>
                            <?php
							}
							?>

						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<!--/row-->
			<!--/row-->
<div class="row-fluid sortable">
  <!--/span-->
</div>
<!--/row-->
    
					<!-- content ends -->
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