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
	
	
	if(isset($_REQUEST['Search']) && $_REQUEST['Search'] == 'Search')
	{
		$custType = $_REQUEST['cType'];
		 $query = 'select * from nl_subscribers_tbl WHERE cust_type ='.$custType;
			  
		 $query_result = mysql_query($query);
		
		
		 $query1 = 'select * from re_quote WHERE cust_type='.$custType;
			  
		 $query_result1 = mysql_query($query1);
 	}
	else
	{
		 $query = "select * from nl_subscribers_tbl";
			  
		 $query_result = mysql_query($query);
		
		
		 $query1 = "select * from re_quote ";
			  
		 $query_result1 = mysql_query($query1);

 	}
	 
	 $msg = "";
	if($_REQUEST["msg"] == 'add'){
		$msg = "Sucessfully Added";
		
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = "Sucessfully Updated";
		
	}else if($_REQUEST["msg"] == 'del'){
	
		$msg = "Deleted Sucessfully";
		
	}
	
	$selectCust = 'SELECT * FROM customer_type ORDER BY cust_name ASC';
	$exCustomer = mysql_query($selectCust);

	
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
    <td colspan="2" align="right" valign="middle"><table width="70%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><div class="addmenu"><a href="customer_view.php">Customer Type</a></div></td>
        <td><div class="addmenu"><a href="subscriber_cust_view.php">News Letter</a></div></td>
        <td><div class="addmenu"><a href="request_cust_view.php">Request quote</a></div></td>
        <td><div class="addmenu"><a href="allCustomertype_view.php">All Customer Type</a></div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40" colspan="3" align="left" valign="bottom"><table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="24%">Customer Type</td>
        <td width="25%"><select name="cType" id="cType" style="width:150px;" class="login-texbox1">
		<option value="">--Select--</option>
		<?php while ($viewType = mysql_fetch_array($exCustomer)){?>
		<option value="<?php echo $viewType['cust_id'];?>"<?php if($rowCust['cust_type'] == $viewType['cust_id']){ echo 'selected'; } ?>><?php echo $viewType['cust_name'];?></option>
		<?php } ?>
        </select></td>
        <td width="51%"><input name="Search" type="submit" class="submit" id="Search" value="Search"/></td>
      </tr>
    </table></td>
    </tr>
</table>
</div>
<div class="content">
<table width="100%" border="0">
      <tr>
        <td height="30" align="left" >&nbsp;</td>
        <td align="left" ><span class="welcome-admin">Subscribers</span></td>
        <td width="23%" align="left" >&nbsp;</td>
        <td width="15%" >&nbsp;</td>
      </tr>
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1"><strong>ID</strong></td>
        <td width="59%" align="left" class="table1">Subscribers Mail Id </td>
        <td colspan="2" align="left" class="table1">Customer Type</td>
        </tr>
      <? 
	  $i=1;
	  while($item=mysql_fetch_array($query_result)){
	    $class="table2";
	   if(($i%2)==0)
	     $class="table3";
		 
		$selectCust = 'SELECT * FROM customer_type WHERE cust_id ='.$item['cust_type'] ;
		$exCustomer = mysql_query($selectCust);
		$rowCust = mysql_fetch_array($exCustomer);
		
	   ?>
      <tr class="<?= $class ?>" >
        <td width="3%" height="27" align="left" style="padding-left:10px;"><?=$i?></td>
        <td height="20" align="left" style="padding-left:10px;"><?=$item["mail"]?></td>
        <td height="20" colspan="2" align="left" style="padding-left:10px;"><?php echo $rowCust['cust_name'];?></td>
        </tr>
      <? $i++; } ?>
    </table>
</div><br />
<div class="content">
<table width="100%" border="0">
      <tr>
        <td height="30" align="left" >&nbsp;</td>
        <td align="left" ><span class="welcome-admin">Request Quote </span></td>
        <td width="23%" align="left" >&nbsp;</td>
        <td width="15%" >&nbsp;</td>
      </tr>
      <tr bgcolor="#cccccc">
        <td height="30" align="left" class="table1"><strong>ID</strong></td>
        <td width="59%" align="left" class="table1">Subscribers Mail Id </td>
        <td colspan="2" align="left" class="table1">Customer Type</td>
        </tr>
      <? 
	  $i=1;
	  while($item1=mysql_fetch_array($query_result1)){
	    $class="table2";
	   if(($i%2)==0)
	     $class="table3";
		 
		$selectCust1 = 'SELECT * FROM customer_type WHERE cust_id ='.$item1['cust_type'] ;
		$exCustomer1 = mysql_query($selectCust1);
		$rowCust1 = mysql_fetch_array($exCustomer1);
		
	   ?>
      <tr class="<?= $class ?>" >
        <td width="3%" height="27" align="left" style="padding-left:10px;"><?=$i?></td>
        <td height="20" align="left" style="padding-left:10px;"><?=$item1["quote_email"]?></td>
        <td height="20" colspan="2" align="left" style="padding-left:10px;"><?php echo $rowCust1['cust_name'];?></td>
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

