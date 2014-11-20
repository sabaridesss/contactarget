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
$query2= "select * from user_tbl order by id ASC";
$query_result = mysql_query($query2);
}
else
{

$campid=$_REQUEST['sort'];
$query = "select  b.id as id,b.firstname as firstname,b.lastname as lastname,b.subscribe as subscribe,b.email as email from user_type_select a,user_tbl b where a.user_id=b.id AND a.user_type='$campid' order by a.user_id asc";

$query_result  = mysql_query($query);
 
}
}
else
{
$query2= "select * from  user_tbl order by id ASC";
$query_result = mysql_query($query2);
}

	
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
		
		 $update_qry1 =  "DELETE FROM user_tbl WHERE id = '$del_pro'";
		$exupdate1 = mysql_query($update_qry1);
		}
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
function sort_check()
{
var sort1 = document.content_add.sort.value;
window.location = "usermail_list.php?sort="+sort1;
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
                <td width="33%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
                  </font></strong></td>
                <td  width="36%">Audience type &nbsp;
                  <select name='sort' onchange="return sort_check()" >
                    <option value='All' <?php
                    if($_REQUEST['sort'] == 'All')
					{
					echo 'selected="selected"';
					}
					?> >Show All</option>
                    <?php 
 
 
 
  					$sel_tbl_main_cat="SELECT * FROM camp_categ";
				  
				  $query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat);
		 
		  while($tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat)) {?>
                    <option id="sort"    value="<?php 
								echo $tbl_main_cat_Fetch['cate_name'];?>"
                                
                                 <?php
                    if($_REQUEST['sort'] == $tbl_main_cat_Fetch['cate_name'])
					{
					echo 'selected="selected"';
					}
					?> >
                    <?php  echo $tbl_main_cat_Fetch['cate_name'];?>
                    </option>
                    <?php }?>
                  </select>
                </td>
                <td><input type="submit" value="Export" class="addmenu2" name="Export"/></td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="upload_users.php">Upload Users</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="users_name.php">Add Users</a></div></td>
                <!-- <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="javascript:void(0)" onclick="window.open('camp_cat_list_cator.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=900,height=400,top=200,left=200,scrollbars=yes'); ">category</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="Campaign.php"> Campaign</a></div></td>-->
              </tr>
            </table>
          </div>
          <div class="content">
            <table width="100%" border="0" align="center" class="welcome">
              <tr class="table1">
                <td height="30" align="left" ><strong>ID</strong></td>
                <td align="left" class="style6"><strong>Audience type </strong></td>
                <td align="left" >First Name</td>
                <td align="left" ><strong>Last Name</strong></td>
                <td align="left" ><strong>Email</strong></td>
                <td ><strong>Subscription</strong></td>
                <td ><strong>Action</strong></td>
              </tr>
              <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	   $class="table2";
	   if(($i%2)==0)
	     $class="table3";


		  
	   ?>
              <tr class="<?=$class?>" >
                <td width="3%" height="27" align="left" class="font2"><?=$i?></td>
                <td width="20%" align="left" class="font2"><?php 
		 
 $sel_tbl_link_id="SELECT * FROM user_type_select WHERE  user_id =".$item["id"];
 $query1_tbl_link_id  = mysql_query($sel_tbl_link_id);
 $user_typ_commo=mysql_num_rows($query1_tbl_link_id);
 $commo_start=1;
 while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_id)) {
	echo $tbl_link_cat_Fetch['user_type'];
	if($commo_start!=$user_typ_commo)
	echo ",";
	$commo_start++;
					}?></td>
                <td width="20%" align="left" class="font2"><?=$item["firstname"]?></td>
                <td width="18%" align="left" class="font2"><?=$item["lastname"]?></td>
                <td width="12%" align="left" class="font2"><?=$item["email"]?></td>
                <td width="12%" align="left" class="font2"><?php if($item["subscribe"]==0) echo "Active"; else  echo "Deactive";?></td>
                <td width="28%"><table width="100%"  border="0">
                    <tr>
                      <td width="21%" align="center" class="font2"><a href="users_name.php?id=<?=$item["id"]?>" class="style3">Edit </a> </td>
                      <td width="31%" align="center" class="font2"><!--<a href="usermail_list.php?id=<?=$item["id"]?>&delete=true" class="style3" onclick='return deleteContent1(<?=$item["id"]?>,"delete_menus","")'> Delete</a>-->
                        <input name="del[]" type="checkbox" id="del[]"  value="<?php echo $item['id']; ?>"/></td>
                    </tr>
                  </table></td>
              </tr>
              <? $i++; } ?>
              <tr >
                <td height="27" colspan="6" align="left" class="style3">&nbsp;</td>
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