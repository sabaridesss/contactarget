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
	
	
	
	
	
	
	
	

	/*	Adding record Ends*/


if(isset($_REQUEST['newlink']))
		{
		
				$link_cat = $_REQUEST['link_cat'];
				$title1 =  $_REQUEST['title1'];
				$url1 = $_REQUEST['url1'];
				$content =  $_REQUEST['content'];
				$approved= $_REQUEST["approved"];
				$url_3party= $_REQUEST["url_3party"];
				$found_3party= $_REQUEST["found_3party"];
				$date= $_REQUEST["date"];
if($approved=="Yes")
{
$approved1="Yes";
}
else if($approved=="")
{
$approved1="No";
}

if($found_3party=="Yes")
{
$found_3party1="Yes";
}
else if($found_3party=="")
{
$found_3party1="Not Founded";
}

 if($url1!="") 
	{
		$url1_query      =  "select * from projects where url = '$url1'";
$url1_implement  =  mysql_query($url1_query);
$url1_rows       =  mysql_num_rows($url1_implement);
if($url1_rows == 0)
{

 $query = 'INSERT INTO projects
								SET
									
									category    = \''.$link_cat.'\',
									title    = \''.$title1.'\',
									url    = \''.$url1.'\',
									description	= \''.$content.'\',
									approved    = \''.$approved1.'\',
									url_3party	= \''.$url_3party.'\',
									found_3party    = \''.$found_3party1.'\',
									date    = \''.$date.'\'';
if(mysql_query($query))	
	header("location:link_exchange.php?msg=1");
}
elseif($url1_rows > 0)
{
$error_url1='URL already Exists';
}
	} 
	

	}			


/*	Adding record Ends*/





/*	edit record starts*/
	
if($_REQUEST['edit'])
		{
		
		 $id = $_REQUEST['page_id'];
		$edit_query = "select * from `projects` where `uid` ='$id'";
	    $edit_query_result = mysql_query($edit_query);
	    $num_rows = mysql_num_rows($edit_query_result);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
	   
				$tbl_id= $edit_item["uid"];
			    $link_cat = $edit_item["category"];
				$title1 = $edit_item["title"];
				$url1= $edit_item["url"];
			   	$content = $edit_item["description"];
				$approved= $edit_item["approved"];
				$url_3party= $edit_item["url_3party"];
				$found_3party= $edit_item["found_3party"];
				$date= $edit_item["date"];
			
				}}
				
				
				/*	edit record Ends*/



/*	edit record starts*/
	
if($_REQUEST['view']== "true" )
		{
		
		 $id = $_REQUEST['page_id'];
		$edit_query = "select * from `projects` where `uid` ='$id'";
	    $edit_query_result = mysql_query($edit_query);
	    $num_rows = mysql_num_rows($edit_query_result);
	   while($edit_item = mysql_fetch_array($edit_query_result)){
	   
				$tbl_id= $edit_item["uid"];
			    $link_cat = $edit_item["category"];
				$title1 = $edit_item["title"];
				$url1= $edit_item["url"];
			 	$content = $edit_item["description"];
				$approved= $edit_item["approved"];
				$url_3party= $edit_item["url_3party"];
				$found_3party= $edit_item["found_3party"];
				$date= $edit_item["date"];
				}}
				
				
				/*	edit record Ends*/


/*	Updating record Ends*/
				
	if(isset($_REQUEST['update']))
		{
$url1_query      =  "";
$url1_implement  = "";
$url1_rows       = "";


			 	$tbl_id = $_REQUEST['page_id'];
				$link_cat = $_REQUEST['link_cat'];
				$title1 =  $_REQUEST['title1'];
				$url2 = $_REQUEST['url1'];
				$content =  $_REQUEST['content'];
				$approved= $_REQUEST["approved"];
				$url_3party= $_REQUEST["url_3party"];
				$found_3party= $_REQUEST["found_3party"];
				$date= $_REQUEST["date"];
				
				if($approved=="Yes")
{
$approved1="Yes";
}
else if($approved=="")
{
$approved1="No";
}

if($found_3party=="Yes")
{
$found_3party1="Yes";
}
else if($found_3party=="")
{
$found_3party1="Not Founded";
}

if($url2==$url1)

{
  $query = 'update projects
								SET
									category    = \''.$link_cat.'\',
									title    = \''.$title1.'\',
									url    = \''.$url2.'\',
									description	= \''.$content.'\',
									approved    = \''.$approved1.'\',
									url_3party	= \''.$url_3party.'\',
									found_3party    = \''.$found_3party1.'\',
									date    = \''.$date.'\'						
									
									  where uid='.$tbl_id ;
	if(mysql_query($query))
	header("location:link_exchange.php?msg=4");
	}
	elseif($url2!=$url1)
	{
 $url1_query      =  "select * from projects where url = '$url2' And  NOT  uid=".$tbl_id;
$url1_implement  =  mysql_query($url1_query);
$url1_rows       =  mysql_num_rows($url1_implement);
if($url1_rows == 0 )
{
	$query = 'update projects
								SET
									category    = \''.$link_cat.'\',
									title    = \''.$title1.'\',
									url    = \''.$url2.'\',
									description	= \''.$content.'\',
									approved    = \''.$approved1.'\',
									url_3party	= \''.$url_3party.'\',
									found_3party    = \''.$found_3party1.'\',
									date    = \''.$date.'\'						
									
									  where uid='.$tbl_id ;
	if(mysql_query($query))
	header("location:link_exchange.php?msg=4");
	}
	else
	{
	$error_url1=$url2.'&nbsp; Already Exists';
	}
	}
}
				
		/*	Updating record Ends*/	


?>
<?php include ('common/header.php')?>
    <script lang='javascript'>               
   function showpasswordbox()
   {
      if(document.form1.found_3party.checked)
      {
         document.getElementById("mydiv").style.display='inline';
		 document.getElementById("mydiv1").style.display='inline';
		 return false;
      }
      else
      {
         document.getElementById("mydiv").style.display='none';
		  document.getElementById("mydiv1").style.display='none';
		  document.getElementById("url_3party").value="";
return false;
      }

   }
   
   
   
   function newlink_cat()
{

var link_cat 	 	=	document.getElementById('link_cat').value;
var title1 		=	document.getElementById('title1').value;
var url1		    =	document.getElementById('url1').value;
var date 			=	document.getElementById('date').value;
var content   =	document.getElementById('content').value;
var approved 		=	document.getElementById('approved').value;
var found_3party 		=	document.getElementById('found_3party').value;
var url_3party		=	document.getElementById('url_3party').value;

 
if(document.getElementById('link_cat').value==0)
{
alert('Please Select Categories');
document.getElementById('link_cat').focus();
return false;
}
 else if(document.getElementById('title1').value==0)
{
alert('Please Enter Title');
document.getElementById('title1').focus();
return false;
} 
 
else if(document.getElementById('url1').value==0)
{
alert('Please Enter Categories Url');
document.getElementById('url1').focus();

return false;
}

else if(document.getElementById('date').value==0)
{
alert('Please Enter Date');
document.getElementById('date').focus();

return false;
}

else if(document.getElementById('content').value==0)
{
alert('Please Enter Description');
document.getElementById('content').focus();
return false;
}

else if(document.form1.found_3party.checked && document.getElementById('url_3party').value==0)
{
alert('Please Enter URL(3rd Party)');
document.getElementById('url_3party').focus();
return false;
}
else

{
	
document.form1.submit();
return true;		
}




}
   
   
   
   
   
   
   
   
   
   
   
   
   
</script>
    <script type="text/javascript">
function validate_url(url1)
{
$.ajax({
type: "POST",
url: "new_links_ajax.php",
data: "&value="+url1,
success: function(html){
//Calling the ajax process php url
$("#url1_avail").html(html);
//Calling the responce IDs
}
});
}



</script>
    <form name="form1" method="post"  >
      <input type="hidden" value="<?=$tbl_id?>" name="page_id" />
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
                    <td align="right">[<a style='text-decoration: none;color:#FF0000'; href="link_exchange.php">Projects</a>][<a style='text-decoration: none;color:#FF0000'; href="new_links.php">Add New Link</a>] </td>
                  </tr>
                </table>
                <table width="75%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td align="left" valign="top" class="login-top">Link Details</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                        <tr>
                          <td width="18%" align="right" valign="top" id="title_name"><span  style="color:#FF6600">* </span>Category:&nbsp;</td>
                          <td width="82%" align="left"><select name="link_cat" id="link_cat"  style="width:50%"   tabindex="13" <?php if($_REQUEST['view']== "true" )
				echo 'disabled="disabled"'; ?>  >
                              <option  id="link_cat" value="0" >--Select Categories--</option>
                              <?php  $sel_tbl_link_cat="SELECT * FROM tbl_link_cat1";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {?>
                              <option id="link_cat" value="<?php 
								echo $tbl_link_cat_Fetch['link_cat'];?>" <?php
                    if($link_cat == $tbl_link_cat_Fetch['link_cat'])
					{
					echo 'selected="selected"';
					}
					?> >
                              <?php  echo $tbl_link_cat_Fetch['link_cat'];?>
                              </option>
                              <?php }?>
                            </select></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top" id="title_name"><span style="color:#FF6600">*</span>Title:&nbsp;</td>
                          <td align="left"><input <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?> type="text" name="title1"  width="500" id="title1" class="login-texbox1" value="<?=$title1?>"></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top"><span style="color:#FF6600">* </span>New Page Url:</td>
                          <td align=""><input <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?> type="text" name="url1" width="500" id="url1" class="login-texbox1" value="<?=$url1?>" <?php if($_REQUEST['edit']!= "true" ) { echo 'onBlur="return validate_url(this.value)"'; }?>>
                            &nbsp;
                           
                          <span style="color:#FF0000">  <div id="url1_avail"> <?=$error_url1?> </div></span></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top">&nbsp;<span style="color:#FF6600">* </span>Date</td>
                          <td align=""><input type="text" name="date" width="500" id="date" value="<?php if(isset($date)) echo $date; else echo date("Y-m-d");?>" class="login-texbox">
                            &nbsp;<img src="./calendar/calendar.gif" id="f_trigger_c" style="cursor:hand;" title="Date selector"  height="14" width="20"/>
                            <script type="text/javascript">
Calendar.setup({
inputField : "date",
ifFormat : "%Y-%m-%d",
button : "f_trigger_c",
singleClick : true
});
</script></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top"><span style="color:#FF6600">* </span>Description:</td>
                          <td ><textarea name="content" id="content"  <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?> class="login-textarea1"  style="width: 409px; height: 100px;" ><?=$content?>
</textarea>
                          </td>
                        </tr>
                        <tr>
                          <td  valign="top">&nbsp;</td>
                          <td align=""><p>
                              <input  <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?>  type="checkbox" name="approved" value="Yes" id="approved" align="right" <?php if($approved== "Yes") echo 'checked="checked"';?>  >
                              Approved &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input  type="checkbox" name="found_3party" value="Yes" id="found_3party"  <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?>  <?php if($found_3party== "Yes") echo 'checked="checked"';?> onchange='return showpasswordbox()'    >
                              Found </p></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top"><div  id="mydiv" <?php if($found_3party=="Yes")
			
			
			echo "style='display:inline'";
		 else
			echo "style='display:none'";
			 ?>> <span style="color:#FF6600">* </span>URL(3rd Party) </div></td>
                          <td align=""><div  id="mydiv1" <?php if($found_3party=="Yes")
			
			
			echo "style='display:inline'";
		 else
			echo "style='display:none'";
			 ?>>
                              <input type="text"  <?php if($_REQUEST['view']== "true" )
				echo 'readonly="readonly"'; ?>   name="url_3party" id="url_3party" align="left" width="500" class="login-texbox1" value="<?=$url_3party?>">
                            </div></td>
                        </tr>
                        <tr>
                          <td align="right" valign="top">&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="right" valign="top">&nbsp;</td>
                          <td align=""><?php if($_REQUEST['view']== "true" ) 
				{ ?>
                            <a href="new_links.php?edit=true&prod_id=<?=$tbl_id?>&page_id=<?=$tbl_id?>" class="style3">
                            <input type="button" name="edit" value="edit"  class="submit" >
                            </a>
                            <?php }  else  if($_REQUEST['edit']== "true" ) { ?>
                            <input type="submit" name="update" value="update"  class="submit" onclick="return newlink_cat()">
                            <?php }  else   { ?>
                            <input type="submit" name="newlink" value="Submit"  class="submit" onclick="return newlink_cat()">
                            <?php } ?>
                            <input type="submit" name="cancel" value="Cancel" onClick="return redirect_link()" class="submit">
                          </td>
                        </tr>
                        <tr>
                          <td align="right">&nbsp;</td>
                          <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
                        </tr>
                      </table></td>
                  </tr>
                </table>
                <p>&nbsp;</p>
                <p align="center"> </p>
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
