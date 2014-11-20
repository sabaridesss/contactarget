<?php
include("smarty_config.php");
//include("top_menu.php");


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

if(isset($_REQUEST['sort']))
{
if($_REQUEST['sort']=='All')
$sql_order="order by sort_order ASC";
else
$sql_order="WHERE `package_id` LIKE ".$_REQUEST['sort'];
}
else
{
$sql_order="order by sort_order ASC";

}

    $query2= "select * from pkg_tbl ".$sql_order;
	$query_result = mysql_query($query2);
  	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Sucessfully Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	else if($_REQUEST["msg"] == '5'){
	
		$msg = "Suceessfully Published";	
	}
	
	if($_REQUEST['delete']=="true") {
		$id = $_REQUEST['id'];
		
		$query = "delete from pkg_tbl where id =".$id;
		if(mysql_query($query)) {
					header("Location:packages.php?msg=4");		
				}
	}
}
?>
<?php include ('common/header.php')?>
<script type="text/javascript">
function sort_check()
{
var sort1 = document.content_add.sort.value;
window.location = "packages.php?sort="+sort1;
}</script>

<form name="content_add" method="post" action="" >
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
                <td width="30%" align="center" valign="middle"><div class="addmenu"><a href="package_publish.php">Publish</a></div></td>
                <td align="center" width="60%">Filter By Package &nbsp;
                  <select name='sort' onChange='return sort_check()' class="TxtBox_products">
                    <option value='All' <?php
                    if($_REQUEST['sort'] == 'All')
					{
					echo 'selected="selected"';
					}
					?> >Show All</option>
                    <?php 
 
 
 
  $sel_tbl_main_cat="SELECT * FROM pakage_categories order by cat_order ASC";
				  
				  $query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat);
		 
		  while($tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat)) {?>
                    <option id="sort"    value="<?php 
								echo $tbl_main_cat_Fetch['id'];?>"
                                
                                 <?php
                    if($_REQUEST['sort'] == $tbl_main_cat_Fetch['id'])
					{
					echo 'selected="selected"';
					}
					?> >
                    <?php  echo $tbl_main_cat_Fetch['cat_name'];?>
                    </option>
                    <?php }?>
                  </select></td>
                <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="package_categories.php">Package Type</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="add_new_package.php">Add New Package</a> </div></td>
              </tr>
              
              <tr><td colspan="5">&nbsp;</td></tr><tr>
                <td width="20%" align="left" valign="middle"></td>
                
                <td width="30%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
                  </font></strong></td>
                
                <td width="25%" align="right" valign="middle"></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"></td>
              </tr>
            </table>
          </div>
          <div class="content">
            <table width="100%" border="0" align="center" >
              <tr class="table1">
                <td height="30" align="center" class="style6"><strong>ID</strong></td>
                <td align="left" class="style6"><strong> Package Type </strong></td>
                <td align="left" class="style6"><strong> Package Desc </strong></td>
                <td align="left" class="style6"><strong>Platinum</strong></td>
                <td align="left" class="style6"><strong>Gold</strong></td>
                <td align="left" class="style6"><strong>Silver</strong></td>
                <td align="left" class="style6"><strong>Sort Order</strong></td>
                <td class="style6"><strong>Action</strong></td>
              </tr>
              <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	      $class="table3";

		if($item["gold"] == '1')
		$gold = 'Yes';
		else
		$gold = 'No';
		if($item["silver"] == '1')
		$silver = 'Yes';
		else
		$silver = 'No';
		if($item["platinum"] == '1')
		$platinum = 'Yes';
		else
		$platinum = 'No';
			  
	   ?>
              <tr class="<?=$class?>">
                <td width="4%" height="27" align="center" class="style6"><?=$i?></td>
                <td width="14%" align="left" class="style6"><?php $query3= "select cat_name from pakage_categories WHERE id=".$item['package_id'];
	$query_get = mysql_query($query3);  
	$item_package=mysql_fetch_array($query_get);	
		echo $item_package['cat_name'];
		
		?></td>
                <td width="25%" align="left" class="style6"><?=$item['description']?></td>
                <td width="15%" align="left" class="style6"><?php echo $platinum; if(($platinum=='Yes') && ($item['plat_des']!="")) echo '&nbsp;('.$item['plat_des'].'&nbsp; )';?></td>
                <td width="14%" align="left" class="style6"><?php echo $gold; if(($gold=='Yes') && ($item['gold_des']!="")) echo '&nbsp;('.$item['gold_des'].'&nbsp; )';?></td>
                <td width="16%" align="left" class="style6"><?php echo $silver; if(($silver=='Yes') && ($item['silver_des']!="")) echo '&nbsp;('.$item['silver_des'].'&nbsp;)';?></td>
                <td width="16%" align="left" class="style6"><?=$item['sort_order']?></td>
                <td width="17%"><table width="100%"  border="0">
                    <tr>
                      <td width="21%" align="center"><a href="add_new_package.php?id=<?=$item["id"]?>" class="style6">Edit </a> </td>
                      <td width="31%" align="center"><a href="packages.php?id=<?=$item["id"]?>&delete=true" class="style6" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> Delete</a> </td>
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