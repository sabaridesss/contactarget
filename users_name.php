<?php
include("smarty_config.php");
require_once('smtp_validateEmail.class.php');
//include("top_menu.php");


$msg = "";
if($_REQUEST["msg"] == '6'){
$msg = '<div class="alert alert-info">
<button class="close" data-dismiss="alert" type="button"></button>
<strong>Its Bounced Mail!</strong>
Can not add right now.
</div>';	
	}


if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
else
{
	$isbouncedval='no';
	if(isset($_REQUEST['Add']))
	{
			$firstname	= $_REQUEST['firstname'];
			$lastname	= $_REQUEST['lastname'];
			$email		= trim($_REQUEST['email']);
			$subscribe	= $_REQUEST['subscribe'];
            $sort_order	= $_REQUEST['sort_order'];
			
//checking bounce
$bounces         = "select email from bounce_tbl where email='".$email."'";
$implement_bounces      = mysql_query($bounces);
if(mysql_num_rows($implement_bounces)>0)
{
$isbouncedval='yes';
}

/*header('location:usermail_list.php?msg=6');*/
/*$email1 = $email;
$sender = 'user@mydomain.com';
$SMTP_Validator = new SMTP_validateEmail();
$SMTP_Validator->debug = true;
$results = $SMTP_Validator->validate(array($email1), $sender);

if ($results[$email1]=='' || $isbouncedval=='yes') {
$isbouncedval='yes';*/
//header('location:usermail_list.php?msg=6');
/*header('location:users_name.php?msg=6');		
exit;*/
/*} */
		
			
if($subscribe=='0')
{
$subscribe1=0;
}
else
{
$subscribe1=1;
}


$count_usertype=count($sort_order);

if($count_usertype==0)
{
echo $insert = 'INSERT INTO user_tbl SET firstname 		= \''.$firstname.'\',
											lastname 	= \''.$lastname.'\',
										    subscribe   = '.$subscribe1.',
											company_admin   = \''.$company_admin.'\',
											user_type 	= \''.$sort_order.'\',
											email 	= \''.$email.'\'';
  $query = mysql_query($insert);
  
 if(!$query) { echo mysql_error(); exit;}
  
  }
  else {
		
		 for ($i=0; $i<$count_usertype; $i++) {
		 echo $insert = 'INSERT INTO user_tbl SET firstname = \''.$firstname.'\',
										   lastname 	= \''.$lastname.'\',
										   subscribe   = '.$subscribe1.',
										   company_admin   = \''.$company_admin.'\',
										   user_type 	= \''.$sort_order[$i].'\',
										   email 	= \''.$email.'\'';
		 $query = mysql_query($insert);
		  if(!$query) { echo mysql_error(); exit;}
    }
		}
	header('location:usermail_list.php?msg=2');									

	}



if(isset($_REQUEST['Update']))
	{ 
	
	 		$hid	= $_REQUEST['hid'];
			//$del_user_type=mysql_query("DELETE FROM `user_tbl` WHERE company_admin  = $company_admin and  `id` =$hid");
			
	        $firstname	= $_REQUEST['firstname'];
			$lastname	= $_REQUEST['lastname'];
			$email		= $_REQUEST['email'];
			$subscribe	= $_REQUEST['subscribe'];
            $sort_order	= $_REQUEST['sort_order'];
			
//	echo $_REQUEST['subscribe'];


/*$email1 = $email;
$sender = 'user@mydomain.com';
$SMTP_Validator = new SMTP_validateEmail();
$SMTP_Validator->debug = true;
$results = $SMTP_Validator->validate(array($email1), $sender);

if ($results[$email1]=='') {
$isbouncedval='yes';*/
/*header('location:usermail_list.php?msg=6');*/
/*header('location:users_name.php?msg=6');*/	
/*exit;*/
/*} */

			
if($subscribe =='0' )
{
$subscribe1=0;
}
else
{
$subscribe1=1;
}


   $count_usertype=count($sort_order);
   
   
  if($count_usertype==0)
  {
  	 
		 echo $insert = 'INSERT INTO user_tbl SET firstname 		= \''.$firstname.'\',
											lastname 	= \''.$lastname.'\',
											subscribe   = '.$subscribe1.',
											company_admin   = \''.$company_admin.'\',
											user_type 	= \''.$sort_order.'\',
											email 	= \''.$email.'\'';
		 
		 

		$query = mysql_query($insert); if(!$query) { echo mysql_error(); exit;}
  }
  else {
		
		 for ($i=0; $i<$count_usertype; $i++) {
		 
		 
		 
		 echo $insert = 'INSERT INTO user_tbl SET firstname 		= \''.$firstname.'\',
											lastname 	= \''.$lastname.'\',
											subscribe   = '.$subscribe1.',
											company_admin   = \''.$company_admin.'\',
											user_type 	= \''.$sort_order[$i].'\',
											email 	= \''.$email.'\'';
		 
		 

		$query = mysql_query($insert); if(!$query) { echo mysql_error(); exit;}


    }
		}

		header('location:usermail_list.php?msg=2');									

	}



	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location: usermail_list.php");
	}
	
	if($_REQUEST['id'] != '') {
	
		$id=$_REQUEST['id'];
		//$query3 = "select * from  user_tbl where company_admin='$company_admin' AND email =".$displaySite['email'];
		$query3 = "select * from  user_tbl where company_admin='$company_admin' AND id =".$id;
		$query_result3 = mysql_query($query3);
		$displaySite = mysql_fetch_array($query_result3);
	}


}
	
?>
<?php include ('common/header.php')?>
<script language="javascript">
function formValidator(){

	
   var reg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
   var name = document.getElementById("firstname").value; 
   var address = document.getElementById("email").value;
    
   var Audience = document.getElementById("sort_order").value;
   var alpha = /^[a-z A-Z]*$/;
   var int = /^[0-9()-]*$/;
   var numExpression =/^\d\d\d\-\d\d\d-\d\d\d\d$/;
   
	if((name.length == 0)||(name == 'Name')) {
		alert('Please Enter Your Name');
		document.getElementById("firstname").focus();
		return false;
	}else if((alpha.test(name) == false) || (name.length <3)){
		alert("Please Enter Valid Name");
		document.getElementById("firstname").focus();
		document.getElementById("firstname").select();
		return false;	
   }
  

   else if((address.length == 0)||(address == 'Email')) {
   		alert('Please Enter Email Address');
		document.getElementById("email").focus();
        return false;
   }else if(reg.test(address) == false) {
   	  
      alert('Please Enter Email in Valid Format');
	  document.getElementById("email").focus();
	  document.getElementById("email").select();
      return false;
   }
    else if((Audience.length == 0)||(Audience == 'Comments')){
   		alert('Please Select Audience Type');
		document.getElementById("sort_order").focus();
        return false;
    }

	else			
			{
					
					document.content_add.submit();
					return true;
			}
}</script>

<form name="content_add" method="post" action="" enctype="multipart/form-data" >
  <table width="1200px" border="0" cellpadding="0">
    <tr>
      <td></td>
    </tr>
    <tr>
      <td align="center" class="top"><?php include('common/top_menu.php') ?>
        <div class="wholesite-inner">
          <!--welcome admin start here-->
 <div>
 <?=$msg?>
 </div>
          <div class="welcome-admin">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
                <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
                  
                  </font></strong></td>
                <td width="25%" align="right" valign="middle">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" valign="middle">&nbsp;</td>
                <td colspan="2" align="center" valign="middle">&nbsp;</td>
                <!--<td width="25%" align="right" valign="middle"><div class="addmenu"><a href="javascript:void(0)" onclick="window.open('camp_cat_list_cator.php?page_id=<?=$_REQUEST['page_id']?>&action=<?=$_REQUEST['action']?>&content_id=<?=$_REQUEST['content_id']?>&parent_id=<?=$_REQUEST['parent_id']?>&subcat_id=<?=$_REQUEST['subcat_id']?>&img=thumb_nail',
'mywindow','width=900,height=400,top=200,left=200,scrollbars=yes'); ">category</a></div></td>-->
              </tr>
            </table>
          </div>
          <div class="content">
            <table width="70%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="left" valign="top" class="login-top"><span class="style4">
                  <?php if($_REQUEST['id'] != '') { ?>
                  Edit
                  <?php }  else { ?>
                  Add
                  <?php } ?>
                  Audience </span></td>
              </tr>
              <tr>
                <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
                    <tr>
                      <td align="right" valign="top" id="title_name"><span class="font">First Name</span>:</td>
                      <td align="left"><input name="firstname" type="text" id="firstname" value="<?=$displaySite['firstname']?>" size="60" class="input-xlarge focused" />
                        <input type="hidden" value="<?=$displaySite['id']?>" id="hid" name="hid"  />
                      </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name"><span class="font">Last Name</span>:</td>
                      <td align="left"><input name="lastname" type="text" id="lastname" value="<?=$displaySite['lastname']?>" size="60" class="input-xlarge focused" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name"><span class="font">Email</span>:</td>
                      <td align="left"><input name="email" type="text" id="email" value="<?=$displaySite['email']?>" size="60" class="input-xlarge focused" /></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">Audience  Category:</td>
                      <td align=""><select name="sort_order[]" id="sort_order" multiple="multiple">
                          <?php  $sel_tbl_link_cat="SELECT * FROM camp_categ where company_admin='$company_admin' order by cat_order ASC";
				  
				  $query1_tbl_link_cat  = mysql_query($sel_tbl_link_cat);
		 
		  while($tbl_link_cat_Fetch = mysql_fetch_array($query1_tbl_link_cat)) {
		 
		  ?>
                          <?=$tbl_link_cat_Fetch['cate_name']?>
                          <option  value="<?php 
								echo $tbl_link_cat_Fetch['cate_name'];?>" <?php
                    if($displaySite['user_type'] == $tbl_link_cat_Fetch['cate_name'])
					{
					echo 'selected="selected"';
					}
					?> >
                          <?=$tbl_link_cat_Fetch['cate_name']?>
                          </option>
                          <?php }?>
                        </select>
                        (For Multiple Audience use Shift) </td>
                    </tr>
                    <tr>
                      <td align="right" valign="top" id="title_name"><span class="font">Subscription</span>:</td>
                      <td align="left"><input type="checkbox" name="subscribe" value="0" id="subscribe" align="right" <?php if($displaySite['subscribe']!= "1") echo 'checked="checked"';?>   ></td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="right" valign="top">&nbsp;</td>
                      <td align="">
<?php if($_REQUEST['id'] != '') { ?>
                     <input type="submit" name="Update" value="Update" class="btn btn-large btn-primary" onclick="return formValidator()" />  
                        <?php } else { ?>
                       <input type="submit" name="Add" value="Add" class="btn btn-large btn-primary" onclick="return formValidator()" />   
                        <?php }?>
                        <a href="usermail_list.php" style="text-decoration:none;"?> <input type="button" name="Close" value="Cancel" class="btn btn-large btn-primary" /> </a></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <br>
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
</body></html>