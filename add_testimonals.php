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
		$date = explode("/", $_REQUEST['date']);
		$display = $date[2].'-'.$date[0].'-'.$date[1];
		
		$insert = 'INSERT INTO testimonial_tbl
										SET
											testimonial_name 		= \''.$_REQUEST['name'].'\',
											testimonial_company 	= \''.$_REQUEST['company'].'\',
											testimonial_position	= \''.$_REQUEST['position'].'\',
											testimonial_date		= \''.$display.'\',
											testimonial_viewmore	= \''.$_REQUEST['view_more'].'\',
											show_home	            = \''.$_REQUEST['show_home'].'\',
											testimonial_comment		= \''.$_REQUEST['comment'].'\'';
		$query = mysql_query($insert);
		header('location:testimonials_list.php?msg=2');									

	}

	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		$query2 =  'select * from testimonial_tbl where testimonial_id ='.$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	
	if(isset($_REQUEST['Modify']) && $_REQUEST['Modify'] == 'Modify')
	{
		$date = explode("/",$_REQUEST['date']);
		$display = $date[2].'-'.$date[0].'-'.$date[1];
		
	$insert = 'UPDATE testimonial_tbl
										SET
											testimonial_name 		= \''.$_REQUEST['name'].'\',
											testimonial_company 	= \''.$_REQUEST['company'].'\',
											testimonial_position	= \''.$_REQUEST['position'].'\',
											testimonial_date		= \''.$display.'\',
											show_home	            = \''.$_REQUEST['show_home'].'\',
											testimonial_comment		= \''.$_REQUEST['comment'].'\'
											WHERE testimonial_id ='.$id;
											
		$query = mysql_query($insert);
		header('location:testimonials_list.php?msg=3');
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location: testimonials_list.php");
	}

	
}	
?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" enctype="multipart/form-data">
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
    <td colspan="2" align="center" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
		    <?php if($_REQUEST['id'] != '')
			  {
			   ?><br>

		  <table width="60%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top"><span class="style4">Edit Testimonials </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Name </span>:</td>
                    <td align="left"><input name="name" type="text" id="name" value="<?php echo $displaySite['testimonial_name']; ?>" size="60" class="login-textarea1"/></td>
                  </tr>

                  <tr>
                    <td align="right" valign="top">Company :</td>
                    <td align=""><input name="company" type="text" id="company" value="<?php echo $displaySite['testimonial_company']?>" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Date</span> :</td>
                    <td align=""><input name="date" type="text" id="date" value="<?php echo date("m/d/Y",strtotime($displaySite['testimonial_date']))?>" size="20" class="login-textarea1"/>
					<script language='JavaScript'>
						new tcal ({
							// form name
							'formname': 'content_add',
							// input name
							'controlname': 'date'
						});
					
					</script>
</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Position : </td>
                    <td align=""><input name="position" type="text" id="position" value="<?php echo $displaySite['testimonial_position']?>" size="60" class="login-textarea1"/></td>
                  </tr>
                  
                  <tr>
                    <td align="right" valign="top">Comment : </td>
                    <td align=""><textarea name="comment" cols="80" rows="8" class="login-textarea2" id="comment"><?php echo $displaySite['testimonial_comment']?></textarea></td>
                  </tr>
                  <tr>
        <td align="right" valign="top" id="title_name">Show in home</td>
        <td colspan="2" align="left"><select name="show_home" id="show_home">
		<option value="">----Select---</option>
        <option value="Yes" <?php if($show_home=="Yes")
		   {
		   echo 'selected="selected"';
		   }
		   ?> >Yes</option>
		<option value="No" <?php if($show_home=="No")
		   {
		   echo 'selected="selected"';
		   }
		   ?> >No</option>
           
           
		
		</select></td>
                  
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align="">&nbsp;</td>
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
              <td align="left" valign="top" class="login-top"><span class="style4">Add Testimonials </span></td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"><span class="style3">Name</span> :</td>
                    <td align="left"><input name="name" type="text" id="name" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Company :</td>
                    <td align=""><input name="company" type="text" id="company" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  <tr>
                    <td align="right" valign="top"><span class="style3">Date </span>:</td>
                    <td align=""><input name="date" type="text" id="date" value="" size="20" class="login-textarea1"/>
					<script language='JavaScript'>
						new tcal ({
							// form name
							'formname': 'content_add',
							// input name
							'controlname': 'date'
						});
					
						</script>
					</td>
                  </tr>
                  <tr>
                    <td align="right" valign="top">Position :</td>
                    <td align=""><input name="position" type="text" id="position" value="" size="60" class="login-textarea1"/></td>
                  </tr>
                  
                  <tr>
                    <td align="right" valign="top">Comment : </td>
                    <td align=""><textarea name="comment" cols="80" rows="8" class="login-textarea2" id="comment"></textarea></td>
                  </tr>
                  <tr>
                      <td align="right" valign="top" id="title_name">Show in home</td>
                      <td colspan="2" align="left"><select name="show_home" id="show_home">
                          <option value="No">----Select---</option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select></td>
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

