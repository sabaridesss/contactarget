<?php

include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$custId = $_REQUEST['page_id'];

	$action = $_REQUEST['action'];
	
	if($custId != "" && $action == "delete_page_content")
	{
	
	 $del_query = "delete from customer_type where cust_id = $custId";
		  
	 $del_query_result = mysql_query($del_query);
	 
	 if($del_query_result)
	 {
	 
	 header("location:customer_view.php?msg=del");
	 
	 }
	
	
	}
	
	 $query = "select * from `customer_type` ORDER BY `cust_name` ASC";
		  
	 $query_result = mysql_query($query);
	
	
	 
	 
	 $msg = "";
	if($_REQUEST["msg"] == 'add'){
		$msg = "Sucessfully Added";
		
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Sucessfully Updated";
		
	}else if($_REQUEST["msg"] == 'del'){
	
		$msg = "Deleted Sucessfully";
		
	}
}

?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" >
<table width="1200px" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	<?php include('common/top_menu.php') ?>
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle"></td>
  </tr>
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td colspan="2" align="right" valign="middle"><table width="70%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="addmenu"><a href="subscriber_cust_view.php">News Letter</a></div></td>
        <td><div class="addmenu"><a href="request_cust_view.php">Request quote</a></div></td>
        <td><div class="addmenu"><a href="allCustomertype_view.php">All Customer Type</a></div></td>
        <td><div class="addmenu"><a href="add_customer.php">Add Customer Type</a></div></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0">
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1"><strong>ID</strong></td>
        <td width="75%" align="left" class="table1"><strong>Customer Type </strong></td>
        <td width="22%" class="table1"><strong>Action</strong></td>
      </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	     $class="table3";
	   ?>
      <tr class="<?= $class ?>" >
        <td width="3%" height="27" align="left" style="padding-left:10px;"><?=$i?></td>
        <td height="20" align="left" style="padding-left:10px;"><?=$item["cust_name"]?></td>
        <td width="22%" style="padding-left:10px;"><table width="60%"  border="0">
            <tr>
              <td width="24%" align="center"><a href="add_customer.php?page_id=<?=$item["cust_id"]?>" class="style3">Edit </a> </td>
              <td width="37%" align="center"><a href="javascript:void(0)" class="style3" onclick='return delete_page_customer_page(<?=$item["cust_id"]?>)'> Delete</a> </td>
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
</body>
</html>

