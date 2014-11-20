<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} 

else 

{

   if($_REQUEST['EXPORT'] == 'EXPORT')
   {

	   $output_name  = str_replace('.com','',$_SERVER['SERVER_NAME']);
	   $output_name  = str_replace('.net','',$_SERVER['SERVER_NAME']);
	   $output_name  = str_replace('.us','',$_SERVER['SERVER_NAME']);
	   
	  if($_REQUEST['export_content'] == 'MSWORD')
	  {
	  $Word_Select    =   "SELECT * FROM menu_page_tbl";
	  $Word_Query     =    mysql_query($Word_Select);
	
		 
       header("Content-type: application/vnd.ms-word");
       header("Content-Disposition: attachment; Filename=".$output_name.".doc" );
         ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
       </head>
       <body>
       <h1 align="center"><?=$_SERVER['SERVER_NAME'];?></h1>
       <?php
	      while($Word_Fetch     =    mysql_fetch_array($Word_Query))
	     {
		?>
        <br />
        <h1 align="center"><?=$Word_Fetch['title'];?></h1> 
        <b>Page URL: </b> <p><?=$Word_Fetch['file_name'];?></p>
        <b>Title: </b> <p><?=$Word_Fetch['title'];?></p>
        <b>Description : </b> <p><?=$Word_Fetch['meta_content'];?></p>
        <b>Keywords: </b> <p><?=$Word_Fetch['meta_keyword'];?></p>
        <b>Header Title1: </b> <p><?=$Word_Fetch['h1_title'];?></p>
        <b>Header Title2: </b> <p><?=$Word_Fetch['h2_title'];?></p>
        <b>Content: </b> <p><?=$Word_Fetch['real_description'];?></p>
         <br />
         <br />
         <br />
   
      <?php
	  }
	  ?>
    </body>
    </html>
		<?php 
		  }
	   else
	   {
	   header('Location:export_excellink.php') ;
	   }


   }	 
		
}




?>

<?php include ('common/header.php')?>

<form name="content_add" method="post" action="" enctype="multipart/form-data">
<input type="hidden" value="<?=$content_id?>" id="sub_catid" />
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
    <td width="55%" align="center" valign="middle">&nbsp;</td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
  <table width="95%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Export</td>
  </tr>

  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
     <tr>
        <td colspan="2" align="center" valign="top" id="title_name">    <select name="export_content">
    <option value="MSWORD">MS WORD</option>
    <!--<option value="EXCEL">EXCEl</option>-->
    </select></td>
        </tr>
      <tr>
        <td colspan="2" align="left" valign="top" id="title_name"><input type="hidden" name="hid_id" value="<?=$id?>" /></td>
        </tr>
          <tr>
       
        <td align="center" colspan="2">
		<input type="submit" name="EXPORT" value="EXPORT" class="addmenu2" />
		          &nbsp;&nbsp;&nbsp;</td>
          </tr>
    </table></td>
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
</body>
</html>
