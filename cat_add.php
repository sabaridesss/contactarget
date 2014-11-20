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
		$edit_query = "select * from `tbl_link_cat11` where `tbl_id` ='$id'";
	    $edit_query_result = mysql_query($edit_query);
	    $num_rows = mysql_num_rows($edit_query_result);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
	   
				$tbl_id= $edit_item["tbl_id"];
			    $link_cat = $edit_item["link_cat"];
				$link_url = $edit_item["link_url"];
				$meta_title = $edit_item["meta_title"];
				$meta_content = $edit_item["meta_content"];
				$meta_keyword = $edit_item["meta_keyword"];
			
				}}
				
				
				/*	edit record Ends*/
				
				
				/*	edit record starts*/
	
if($_REQUEST['view']== "true" )
		{
		
		 $id = $_REQUEST['page_id'];
		$edit_query = "select * from `tbl_link_cat1` where `tbl_id` ='$id'";
	    $edit_query_result = mysql_query($edit_query);
	    $num_rows = mysql_num_rows($edit_query_result);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
	   
				$tbl_id= $edit_item["tbl_id"];
			    $link_cat = $edit_item["link_cat"];
				$link_url = $edit_item["link_url"];
				$meta_title = $edit_item["meta_title"];
				$meta_content = $edit_item["meta_content"];
				$meta_keyword = $edit_item["meta_keyword"];
				
				}}
				
				
				/*	edit record Ends*/
				
				
				/*	Adding record starts*/
				
				
	if(isset($_REQUEST['addcat']))
		{
		
				$title = $_REQUEST['title1'];
				$url =  $_REQUEST['url1'];
				$meta_title = $_REQUEST["meta_title"];
				$meta_content = $_REQUEST["meta_content"];
				$meta_keyword = $_REQUEST["meta_keyword"];
		      
 $query = 'INSERT INTO tbl_link_cat1
								SET
									
									link_cat    = \''.$title.'\',
									link_url    = \''.$url.'\',
									meta_title    = \''.$meta_title.'\',
									meta_content    = \''.$meta_content.'\',
									meta_keyword	= \''.$meta_keyword.'\'';
if(mysql_query($query))	
	header("location:link_cat.php?msg=3");
	}			
	
	
	/*	Updating record Ends*/
				
	if(isset($_REQUEST['Update']))
		{
				 $id = $_REQUEST['page_id'];
				$title = $_REQUEST['title1'];
				$url =  $_REQUEST['url1'];
				$meta_title = $_REQUEST["meta_title"];
				$meta_content = $_REQUEST["meta_content"];
				$meta_keyword = $_REQUEST["meta_keyword"];
 				
 $query = 'update tbl_link_cat1
								SET
									
									link_cat    = \''.$title.'\',
									link_url    = \''.$url.'\',
									meta_title    = \''.$meta_title.'\',
									meta_content    = \''.$meta_content.'\',
									meta_keyword	= \''.$meta_keyword.'\'
									 where tbl_id='.$id ; 
	if(mysql_query($query))
	header("location:link_cat.php?msg=4");
	}
				
		/*	Updating record Ends*/		
				
?>
<?php include ('common/header.php')?>

<form name="form1" method="post"   >

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
      <table width="75%" height="39" border="0" align="center">
        <tr>
          <td align="right" >[<a style='text-decoration: none;color:#FF0000'; href="link_cat.php">Back</a>] </td>
        </tr>
      </table>
      <table width="75%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top" class="login-top">Category Details</td>
        </tr>
        <tr>
          <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
             
              <tr>
                <td align="right" valign="top" id="title_name"><span style="color:#FF6600">*</span> Title</td>
                <td align="left">
      
                <input type="hidden" value="<?=$tbl_id?>" id="page_id"  name="page_id" />
                
                <input <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?> type="text" name="title1" width="500" id="title1" class="login-texbox1" value="<?=$link_cat?>">
                
                
              </td>
              </tr>
              <tr>
                <td align="right" valign="top"><span style="color:#FF6600">* </span>Url</td>
                <td align=""><input <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?>  value="<?=$link_url?>" type="text" name="url1" width="500" id="url1" class="login-texbox1" >

     </td>
              </tr>
             <tr>
                <td align="right" valign="top"><span style="color:#FF6600">* </span>Meta Title</td>
                <td align=""><input  <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?> value="<?=$meta_title?>" type="text" name="meta_title" width="500" id="meta_title" class="login-texbox1" >

     </td>
              </tr>
              <tr>
                <td align="right" valign="top"><span style="color:#FF6600">* </span>Meta Description</td>
                <td align=""><input <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?>  value="<?=$meta_content?>" type="text" name="meta_content" width="500" id="meta_content" class="login-texbox1" >

     </td>
              </tr>
              <tr>
                <td align="right" valign="top"><span style="color:#FF6600">* </span>Meta Keyword</td>
                <td align=""><input <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?>  value="<?=$meta_keyword?>" type="text" name="meta_keyword" width="500" id="meta_keyword" class="login-texbox1" >

     </td>
              </tr>
              
              
              <tr>
                <td align="right" valign="top">&nbsp;</td>
                <td align="">  
                
                  <?php        if($_REQUEST['edit'])
		{
		?>
        
         <input type="submit" name="Update" value="Update" class="submit">
                 <?php }  else if($_REQUEST['view']== "true" ) {	 ?> 
                  
                  
                  <a href="cat_add.php?edit=true&prod_id=<?=$tbl_id?>&page_id=<?=$tbl_id?>" class="style3"><input type="button" name="edit" value="Edit" class="submit"></a>
<?php }  else  {	 ?> 
                  <input type="submit" name="addcat" value="Submit" class="submit">
<?php }   ?> 
   

    <a style='text-decoration: none;color:#FF0000'; href="link_cat.php"><input type="button" name="cancel" value="Cancel"  class="submit"></a>
</td>
                </tr>
              
              <tr>
                <td align="right">&nbsp;</td>
                <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
              </tr>
              <tr><td colspan="2"></td></tr>
              
          </table></td>
          
        </tr>
    
      </table></td></tr>
              
          </table>
      <p>&nbsp;</p>
      <p align="center">


</p>



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


