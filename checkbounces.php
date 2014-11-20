<?php
include("smarty_config.php");
//include("top_menu.php");


if( !isset($_SESSION['username']) ) {
	header("Location:index.php");		
} else {


   // $query2= "select * from  user_tbl ".$sql_order;
//	$query_result = mysql_query($query2);
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
	
	
	
if(isset($_REQUEST['check_bounces']))
{
         $bounces                = "select * from user_tbl where subscribe = 0 and Bounced = 0 and company_admin =".$company_admin;

         $implement_bounces      = mysql_query($bounces);
 $APIUrl = 'http://www.email-validator.net/api/verify';
 $i=0;
         while($execute_query = mysql_fetch_array($implement_bounces))
         {
         $data = $execute_query['email'];     
		 
		 
		 
$bounces                = "select email from bounce_tbl where email='".$data."'";
$implement_bounces      = mysql_query($bounces);

if(mysql_num_rows($implement_bounces)>0)
{
 $sqluser = "Update  user_tbl set
										Bounced ='1',
										subscribe = '1'
										WHERE email = '".$data."'";
	$query1_sel_blast_templates  = mysql_query($sqluser);		 
}
else
{		 
		                                                                
        $data_string = "http://ws.zigzan.com/ZigzanService.svc/VerifyEmail?email=".$data;                                                                                   
 
// build API request

$Params = array('EmailAddress' =>  $data ,
                'APIKey' => 'ev-d4f03edea4532524dc89c4b642e312dd');
$Request = @http_build_query($Params);
$ctxData = array(
     'method' => "POST",
     'header' => "Connection: close\r\n".
     "Content-Length: ".strlen($Request)."\r\n",
     'content'=> $Request);
$ctx = @stream_context_create(array('http' => $ctxData));

// send API request
$result = json_decode(@file_get_contents(
    $APIUrl, false, $ctx));

// check API result
if ($result && $result->{'status'} > 0) {
    switch ($result->{'status'}) {
        // valid addresses have a {200, 207, 215} result code
        // result codes 114 and 118 need a retry
        case 200:
        case 207:
        case 215:
              
                break;
        case 114:
        case 118:
                // retry
                break;
        default:
				 $sqluser = "Update  user_tbl set
										Bounced ='1',
										subscribe = '1'
										WHERE email = '".$data."'";
	$query1_sel_blast_templates  = mysql_query($sqluser);
	
	$insert = 'INSERT INTO bounce_tbl 
										SET
											
											firstname 		= \''.$execute_query['firstname'].'\',
											lastname 	= \''.$execute_query['lastname'].'\',
											email 	= \''.$data.'\'';
											
											$query = mysql_query($insert); 
	
	
	
	
	
	$i++;
                break;
    }
	
	}
} 

         }


header("Location:checkbounces.php?id=".$i);	
exit;

}
		
	


}
	
	
?>
<?php include ('common/header.php')?>
<script type="text/javascript">


// Javascript
function toggleCheckboxes(current, form, field) {
	var val = current.checked;
	var cbs = document.getElementById(form).getElementsByTagName('input');
	var length = cbs.length;
	
	for (var i=0; i < length; i++) {
		if (cbs[i].name == field +'[]' && cbs[i].type == 'checkbox') {
			cbs[i].checked = val;
		}
	}
}





function sort_check()
{
var sort1 = document.content_add.sort.value;
window.location = "usermail_list.php?sort="+sort1;
}</script>
<style>
div.pagination {
	padding: 3px;
	margin: 3px;
}
div.pagination a {
	padding: 2px 5px 2px 5px !important ;
	margin: 2px !important ;
	border: 1px solid #AAAADD !important ;
	text-decoration: none !important ; /* no underline */
	color:  #FFA145 !important ;
	float:none; !important ;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid  #FFA145;
	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid  #FFA145;
	font-weight: bold;
	background-color:  #FFA145;
	color: #FFF;
}
div.pagination span.disabled {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #EEE;
	color: #DDD;
}
</style>
<script type="text/javascript">
<!--
function getConfirmation(){
   var retVal = confirm("Do you want to Delete ?");
   if( retVal == true ){
     
	  return true;
   }else{
    
	  return false;
   }
}
//-->
</script>

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
                    if($search == 'All')
					{
					echo 'selected="selected"';
					}
					?> >Show All</option>
                    <?php 
 
 
 
  					$sel_tbl_main_cat="SELECT * FROM camp_categ WHERE  company_admin='$company_admin'";
				  
				  $query1_tbl_main_cat  = mysql_query($sel_tbl_main_cat);
		 
		  while($tbl_main_cat_Fetch = mysql_fetch_array($query1_tbl_main_cat)) {?>
                    <option id="sort"    value="<?php 
								echo $tbl_main_cat_Fetch['cate_name'];?>"
                                
                                 <?php
                    if($search == $tbl_main_cat_Fetch['cate_name'])
					{
					echo 'selected="selected"';
					}
					?> >
                    <?php  echo $tbl_main_cat_Fetch['cate_name'];?>
                    </option>
                    <?php }?>
                  </select>
                  
             </td><!--<td>     <input type="submit" value="Export" class="addmenu2" name="Export"/></td>
                <td width="35%" align="right" valign="middle" ><div class="addmenu2"><a href="upload_users.php">Upload </a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="users_name.php">Add Audience</a></div></td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a onclick="return getConfirmation();" href="usermail_list.php?deleteuser=all">Delete All</a></div></td>-->
                <!-- <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu"><a href="javascript:void(0)" onclick="window.open('camp_cat_list_cator.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=900,height=400,top=200,left=200,scrollbars=yes'); ">category</a></div></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
                <td width="25%" align="right" valign="middle"><div class="addmenu2"><a href="Campaign.php"> Campaign</a></div></td>-->
              </tr>
              <tr>
              <td align="center" colspan="5" > <span style="color:#FF0000"><?php if(isset($_REQUEST['id'])) { if($_REQUEST['id'] != 0) { echo '<div class="alert alert-error ">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Oops!</strong>
'.$_REQUEST['id'].' Bounce Mail Found
</div>'; } else { echo '<div class="alert alert-success">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Great!</strong>
No Bounce Mail Found
</div>'; } } ?></span></td>
              </tr>
            </table>
          </div>
          <div  style="clear:both"></div>
          <div>
  <form action="" method="post">
       <input type="submit" name="check_bounces" value="Check Bounces" class="btn btn-large btn-primary">
       </form>
          </div>
          <!--welcome admin end here-->
        </div>
        
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here--></td>
    </tr>
  </table>

</div>
</center>
</body></html>