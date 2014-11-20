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
		$insert_query = "insert into technology_tbl (technology_name) values('".$_POST["category"]."')";
		$result = mysql_query($insert_query);
		if($result){
		/*print"<script>alert('Inserted successfully')</script>";
		*/
		print"<script>location.href='view_technology.php?msg=2'</script>";
		}
	}

	if(isset($_REQUEST['category_id']) != '')
	{
		$category_id = $_REQUEST['category_id'];
		$cat_query = 'select * from technology_tbl where technology_id ='.$category_id;
		$rs = mysql_query($cat_query);
		$row = mysql_fetch_array($rs);
		
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		$category_id = $_REQUEST['category_id'];
		$insert_query = 'UPDATE technology_tbl   
										SET
											technology_name = \''.$_POST['editCat'].'\'
											WHERE technology_id ='.$category_id;
										
		$result = mysql_query($insert_query);
		if($result){
		/*print"<script>alert('Inserted successfully')</script>";
		*/
		print"<script>location.href='view_technology.php?msg=3'</script>";
		}
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		print"<script>location.href='view_technology.php'</script>";
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
  <tr>
    <td align="left" valign="middle">&nbsp;</td>
    <td colspan="2" align="center" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div class="addmenu"><a href="view_siteinfo.php" class="style5">View Category </a></div></td>
        <td><div class="addmenu"><a href="view_sitedetails.php"  class="style5">View Site Details</a></div></td>
        <td><div class="addmenu"><a href="view_technology.php" class="style5">View Technologys</a></div></td>
        <td><div class="addmenu"><a href="clients_list.php"  class="style5">View Clients</a></div></td>
        <td><div class="addmenu"><a href="view_industry.php"  class="style5">View Industry</a></div></td>
      </tr>
    </table></td>
    </tr>
</table>
</div>
<div class="content">
		    <?php if(isset($_REQUEST['category_id']) != '')
		  { ?><br>

		  <table width="60%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Technology </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Technology Name</span>:</td>
                    <td align="left"><input name="editCat" type="text" id="editCat" size="45" value="<?php echo $row['technology_name']; ?>" class="login-textarea1"/></td>
                  </tr>

                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input name="Modify" type="submit" id="Modify" value="Modify" class="addmenu2"/>
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                    </tr>

              </table></td>
            </tr>
          </table><br>

            <?php } else { ?><br>

            <table width="60%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Add Technology</span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Technology Name </span>:</td>
                    <td align="left"><input name="category" type="text" id="category" size="50" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><input type="submit" name="Submit" value="Add" class="addmenu2" />
                <input name="Close" type="submit" id="Close" value="Close" class="addmenu2" /></td>
                  </tr>
              </table></td>
            </tr>
          </table><br>

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

