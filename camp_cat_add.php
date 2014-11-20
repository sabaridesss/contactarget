<?php

include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
include("cfg/MYSQL.php");

//connect to the database

	db_connect(DB_HOST,DB_USER,DB_PASS) or die (db_error());

	db_select_db(DB_NAME) or die (db_error());
	
	
/*	edit record starts*/
	
if($_REQUEST['edit'])
		{
		
		 $id = $_REQUEST['page_id'];
		$edit_query = "select * from `camp_category` where `id` ='$id'";
	    $edit_query_result = mysql_query($edit_query);
	    $num_rows = mysql_num_rows($edit_query_result);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
	   
				$id= $edit_item["id"];
			    $cate_name = $edit_item["cate_name"];
				
			
				}}
				
				
				/*	edit record Ends*/
				
				
			
				
				
				/*	Adding record starts*/
				
				
	if(isset($_REQUEST['addcat']))
		{
		
				$cate_name = $_REQUEST['cate_name'];
				
		      
 $query = 'INSERT INTO camp_category
								SET
									company_admin    = \''.$company_admin.'\',
									cate_name    = \''.$cate_name.'\'';
if(mysql_query($query))	
	header("location:camp_cat_list.php?msg=2");
	else
	echo mysql_error();
	}			
	
	
	/*	Updating record Ends*/
				
	if(isset($_REQUEST['Update']))
		{
				 $id = $_REQUEST['page_id'];
				$cate_name = $_REQUEST['cate_name'];
				
 				
 $query = 'update camp_category
								SET
									company_admin    = \''.$company_admin.'\',
									cate_name    = \''.$cate_name.'\'
									
									 where id='.$id ; 
	if(mysql_query($query))
	header("location:camp_cat_list.php?msg=3");
	}
				
		/*	Updating record Ends*/		
				
?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <!--welcome admin start here--><!--welcome admin start here-->
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                  <?=$msg?>
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
            </table>
          </div>
          
            <div class="content"><br>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top" class="login-top">Campaign Type</td>
            </tr>
            <tr>
              <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                  <tr>
                    <td align="right" valign="top" id="title_name"> Campaign Type</td>
                    <td align="left"><input type="hidden" value="<?=$id?>" id="page_id"  name="page_id" />
                      <input  type="text" name="cate_name" width="500" id="cate_name" class="login-texbox1" value="<?=$cate_name?>">
                       e.g. - Blog post, Information, promotional etc.,
                    </td>
                  </tr>
                  
                  
                  
                  
                  <tr>
                    <td align="right" valign="top">&nbsp;</td>
                    <td align=""><?php        if($_REQUEST['edit'])
		{
		?>
                      <input type="submit" name="Update" value="Update" class="btn btn-large btn-primary">
                      <?php }  else if($_REQUEST['view']== "true" ) {	 ?>
                      <a href="camp_cat_add.php?edit=true&prod_id=<?=$id?>&page_id=<?=$id?>" class="style3">
                      <input type="button" name="edit" value="Edit" class="btn btn-large btn-primary">
                      </a>
                      <?php }  else  {	 ?>
                      <input type="submit" name="addcat" value="Submit" class="btn btn-large btn-primary" >
                      <?php }   ?>
                      <a style='text-decoration: none;color:#FF0000'; href="camp_cat_list.php" >
                      <input type="button" name="cancel" value="Cancel"  class="btn btn-large btn-primary">
                      </a> </td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                    <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2"></td>
                  </tr>
                </table></td>
            </tr>
          </table>
          </div><br>
       <!--welcome admin end here-->
        </div><br>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here--></td>
    </tr>
  </table>
</form>
</div>
</center>
</body></html>