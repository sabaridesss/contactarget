<?php
include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{

	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Add')
	{
		$insert_query = "insert into footer_menu(footer_name,pagr_url,link_page) values('".$_POST["category"]."','".$_POST["pageUrl"]."','".$_POST["linkOrd"]."')";
		$result = mysql_query($insert_query);
		if($result){
		/*print"<script>alert('Inserted successfully')</script>";
		*/
		print"<script>location.href='viewFooterDetail.php?msg=2'</script>";
		}
	}

	if(isset($_REQUEST['webId']) != '')
	{
		$category_id = $_REQUEST['webId'];
		$cat_query = 'select * from footer_menu where footer_id ='.$category_id;
		$rs = mysql_query($cat_query);
		$row = mysql_fetch_array($rs);
		
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		$category_id = $_REQUEST['webId'];
		$insert_query = 'UPDATE footer_menu 
										SET
											footer_name = \''.$_POST['editCat'].'\',
											pagr_url	= \''.$_POST['pageUrl'].'\',
											link_page	= \''.$_POST['linkOrd'].'\'
											WHERE footer_id ='.$category_id;
										
		$result = mysql_query($insert_query);
		if($result){
		/*print"<script>alert('Inserted successfully')</script>";
		*/
		print"<script>location.href='viewFooterDetail.php?msg=3'</script>";
		}
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		print"<script>location.href='viewFooterDetail.php'</script>";
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
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
<?php if(isset($_REQUEST['webId']) != '')
{ ?>
<br>
<table width="60%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td align="left" valign="top" class="login-top"><span class="font2">Edit Footer </span></td>
   </tr>
   <tr>
     <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
         <tr>
           <td width="28%" align="right" valign="top" id="title_name"><span class="style3"><span class="style4">Footer</span> Name</span></td>
           <td width="72%" align="left"><input name="editCat" type="text" id="editCat" size="50" value="<?php echo $row['footer_name']; ?>" class="login-texbox1"/></td>
         </tr>

         <tr>
           <td align="right" valign="top">Page Url </td>
           <td align=""><input name="pageUrl" type="text" id="pageUrl" size="50" value="<?php echo $row['pagr_url']; ?>" class="login-texbox1"/></td>
         </tr>
         <tr>
           <td align="right" valign="top">Link Order</td>
           <td align=""><input name="linkOrd" type="text" class="login-textarea1" id="linkOrd"  size="20" value="<?php echo $row['link_page']; ?>"/></td>
         </tr>
         <tr>
           <td align="right" valign="top">&nbsp;</td>
           <td align=""><input name="Modify" type="submit" id="Modify" value="Modify" class="addmenu2" />&nbsp;&nbsp;
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" />           </td>
           </tr>
         <tr>
           <td align="right">&nbsp;</td>
           <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
         </tr>
     </table></td>
   </tr>
 </table><br>

   <?php } else { ?><br>

 <table width="60%" border="0" cellspacing="0" cellpadding="0">
   <tr>
     <td align="left" valign="top" class="login-top"><span class="font2">Add Footer </span></td>
   </tr>
   <tr>
     <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
         <tr>
           <td width="28%" align="right" valign="top" id="title_name"><span class="style3"><span class="style4">Footer</span> Name</span></td>
           <td width="72%" align="left"><input name="category" type="text" id="category" size="50" class="login-texbox1"/></td>
         </tr>
         <tr>
           <td align="right" valign="top">Page Url </td>
           <td align=""><input name="pageUrl" type="text" id="pageUrl" size="50" class="login-texbox1"/></td>
         </tr>
         <tr>
           <td align="right" valign="top">Link Order</td>
           <td align=""><input name="linkOrd" type="text" class="login-textarea1" id="linkOrd"  size="20" /></td>
         </tr>
         <tr>
           <td align="right" valign="top">&nbsp;</td>
           <td align=""><input type="submit" name="Submit" value="Add" class="addmenu2"/>&nbsp;&nbsp;
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2"/>           </td>
         </tr>
         <tr>
           <td align="right">&nbsp;</td>
           <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
         </tr>
     </table></td>
   </tr>
 </table>
 <br>
   <?php } ?>
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

