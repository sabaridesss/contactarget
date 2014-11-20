<?php
include("smarty_config.php");
//include("top_menu.php");



	

$path = "mail_logo/temp/";
	if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Add')
	{
			
		$title =$_REQUEST['title']; 
		$photoimage=$_REQUEST['actual_image_name']; 
		$slogan=$_REQUEST['slogan']; 
		$phone=$_REQUEST['phone']; 
		$content_desc=$_REQUEST['content_desc']; 
		$fb_input=$_REQUEST['fb_input']; 	
		$twitter_input=$_REQUEST['twitter_input']; 
		$linkedin_input=$_REQUEST['linkedin_input']; 
		$google_input=$_REQUEST['google_input']; 
		$stumbleupon_input=$_REQUEST['stumbleupon_input']; 
		$youtube_input=$_REQUEST['youtube_input']; 
		$bottom_message=$_REQUEST['bottom_message']; 
		$phone_color=$_REQUEST['phone_color']; 
        $template_color=$_REQUEST['template_color'];
		$design_mail=$_REQUEST['design_mail']; 
		
	 	 $insert = 'INSERT INTO emailnl_template_tbl 
										SET											
											title 	= \''.trim($title).'\',
											logo 	= \''.trim($photoimage).'\',
											slogan 	= \''.trim($slogan).'\',
											phone_color 	= \''.trim($phone_color).'\',
											design_mail 	= \''.trim($design_mail).'\',
											company_admin 	= \''.trim($company_admin).'\',
											fb 	= \''.trim($fb_input).'\',											
											tw 	= \''.trim($twitter_input).'\',
											lin 	= \''.trim($linkedin_input).'\',
											gplus 	= \''.trim($google_input).'\',
											st 	= \''.trim($stumbleupon_input).'\',											
											utube 	= \''.trim($youtube_input).'\',
		     								template_color 	= \''.trim($template_color).'\',
											content 	= \''.trim($bottom_message).'\',
											phone 	= \''.trim($phone).'\'';

		$query = mysql_query($insert);
		if(!$query)
		{
		echo mysql_error();
		exit;
		}
		header('location:templates_list_email.php?msg=2');									

	}


	if(isset($_REQUEST['Update']) && $_REQUEST['Update'] == 'Update')
	{
		$id =$_REQUEST['id']; 
		$title =$_REQUEST['title']; 
		$photoimage=$_REQUEST['actual_image_name']; 
		$slogan=$_REQUEST['slogan']; 
		$phone=$_REQUEST['phone']; 
		$content_desc=$_REQUEST['content_desc']; 
		$fb_input=$_REQUEST['fb_input']; 	
		$twitter_input=$_REQUEST['twitter_input']; 
		$linkedin_input=$_REQUEST['linkedin_input']; 
		$google_input=$_REQUEST['google_input']; 
		$stumbleupon_input=$_REQUEST['stumbleupon_input']; 
		$youtube_input=$_REQUEST['youtube_input']; 
		$bottom_message=$_REQUEST['bottom_message']; 
		$template_color=$_REQUEST['template_color']; 
		$phone_color=$_REQUEST['phone_color']; 
		$design_mail=$_REQUEST['design_mail']; 

		
	echo 	 $insert = 'UPDATE emailnl_template_tbl
										SET
											title 	= \''.trim($title).'\',
											logo 	= \''.trim($photoimage).'\',
											slogan 	= \''.trim($slogan).'\',
											phone_color 	= \''.trim($phone_color).'\',
											design_mail 	= \''.trim($design_mail).'\',
											fb 	= \''.trim($fb_input).'\',											
											tw 	= \''.trim($twitter_input).'\',
											lin 	= \''.trim($linkedin_input).'\',
											company_admin 	= \''.trim($company_admin).'\',
											gplus 	= \''.trim($google_input).'\',
											st 	= \''.trim($stumbleupon_input).'\',											
											utube 	= \''.trim($youtube_input).'\',
											template_color 	= \''.trim($template_color).'\',
											content 	= \''.trim($bottom_message).'\',
											phone 	= \''.trim($phone).'\'
											
											WHERE id ='.$id; 
		$query = mysql_query($insert);
		if(!$query)
		{
		echo mysql_error();
		exit;
		}
		header('location:templates_list_email.php?msg=3');
	}
	
	if(isset($_REQUEST['Close']) && $_REQUEST['Close'] == 'Close')
	{
		header("location:templates_list_email.php");
	}

	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/admin-cms_style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<link href="menu_css_js/ddsmoothmenu.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="menu_css_js/ddsmoothmenu.js"></script>
<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>
<script src="javascript/admin_javascript.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
</head>
<center>
  <div class="wholesite">
    <style type="text/css">
.content {
	background:#fff;
	padding:10px;
	margin-top:10px;
	border:1px solid #C0C0C0;
}
.content p {
	font:normal 12px/24px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
}
.content span {
	font:bold 14px/24px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
	display:block;
}
.content ul {
	list-style:circle;
}
.content ul li {
	font:normal 12px/18px Verdana, Geneva, sans-serif;
	color:#515151;
	margin:10px 0px 0px 0px;
}
.spacer {
	clear:both;
}
.fleft {
	float:left;
}
.fright {
	float:right;
}
.img_cls {
width:202px;
height:91px;
}
.cont_left {
	width:450px;
	background:#F2F2F2;
	border:1px solid #C0C0C0;
	padding:15px;
}
.cont_right {
	width:654px;
}
.container_ner_email_blast {
	width:950px;
	margin:0px auto;
	padding:0px;
}
.cont_left p {
	color: #515151;
	font: 12px/24px Verdana, Geneva, sans-serif;
	margin: 10px 0 0;
	display:inline-block;
	padding-right:15px;
	width:100px;
	text-align:right;
}
.cont_left span {
	color: #515151;
	font: 12px/24px Verdana, Geneva, sans-serif;
	margin: 10px 0 0;
	display:inline-block;
	padding-left:15px;
}
.text_email_blast {
	width:190px;
	height:28px;
	padding:0px 4px;
	color: #515151;
	font: 12px/24px Verdana, Geneva, sans-serif;
	margin-bottom:15px;
	background:#fff;
	border:1px solid #CCC;
}
.tool {
	width:100%;
	margin-top:10px;
	margin-bottom:10px;
}
.tool img {
	max-width:100%;
}
.text_email_blast_check {
	margin-right:15px;
}
</style>
    <script type="text/javascript" src="javascript/jscolor.js"></script>
    <script type="text/javascript" >
   function twitter_click()
   {
      if(document.conten_pre.twitter.checked)
      {
         document.getElementById("twitter_input_div").style.display='inline';
		  document.getElementById("twitter_img_div").style.display='inline';
		 return false;
      }
      else
      {
         document.getElementById("twitter_input_div").style.display='none';
		  document.getElementById("twitter_img_div").style.display='none';
		 document.getElementById("twitter_input").value="";
return false;
      }

   }
   
      function fb_click()
   {
      if(document.conten_pre.fb.checked)
      {
         document.getElementById("fb_input_div").style.display='inline';
		 	  document.getElementById("fb_img_div").style.display='inline';
		 return false;
      }
      else
      {
         document.getElementById("fb_input_div").style.display='none';
		  	  document.getElementById("fb_img_div").style.display='none';
		 document.getElementById("fb_input").value="";
return false;
      }

   }
   
      function linkedin_click()
   {
      if(document.conten_pre.linkedin.checked)
      {
         document.getElementById("linkedin_input_div").style.display='inline';
		  document.getElementById("linkedin_img_div").style.display='inline';
		 return false;
      }
      else
      {
         document.getElementById("linkedin_input_div").style.display='none';
		   document.getElementById("linkedin_img_div").style.display='none';
		 document.getElementById("linkedin_input").value="";
return false;
      }

   }
   
      function google_click()
   {
      if(document.conten_pre.google.checked)
      {
         document.getElementById("google_input_div").style.display='inline';
		  document.getElementById("google_img_div").style.display='inline';
		 return false;
      }
      else
      {
         document.getElementById("google_input_div").style.display='none';
		  document.getElementById("google_img_div").style.display='none';
		 document.getElementById("google_input").value="";
return false;
      }

   }
   
      function youtube_click() 
   {
      if(document.conten_pre.youtube.checked)
      {
         document.getElementById("youtube_input_div").style.display='inline';
		  document.getElementById("youtube_img_div").style.display='inline';
		 return false;
      }
      else
      {
         document.getElementById("youtube_input_div").style.display='none';
		   document.getElementById("youtube_img_div").style.display='none';
		 document.getElementById("youtube_input").value="";
return false;
      }

   }
   
    function stumbleupon_click() 
   {
      if(document.conten_pre.stumbleupon.checked)
      {
         document.getElementById("stumbleupon_input_div").style.display='inline';
		  document.getElementById("stumbleupon_img_div").style.display='inline';
		 return false;
      }
      else
      {
         document.getElementById("stumbleupon_input_div").style.display='none';
		   document.getElementById("stumbleupon_img_div").style.display='none';
		 document.getElementById("stumbleupon_input").value="";
return false;
      }

   }
   
 
 
 $(document).ready(function() { 
	            $('#bottom_photoimg').change(function(){ 
				$("#preview").html('');				
				$("#preview").html('<img src="loader.gif" alt="Uploading...."/>');
				$("#imageform").ajaxForm({
						target: '#preview'
						
		}).submit();
		
	
	});
	

	
});      

  </script>
    <script type="text/javascript">
$(document).ready(function()
{


$("#design_mail").change(function()
{
var id='tpl_folder/'+$(this).val();
var id_div=$(this).val();
$("#template_div_show").load(id,function(){

if(id_div=='tpl_two.php')
$('.temp_two_hide').css('display','none');
else
$('.temp_two_hide').css('display','inline');

$('.whole_div').css('background','#'+$("#template_color").val());
$('.phone').html($("#phone").val());
$('.title').html($("#title").val());  
$('.slogan').html($("#slogan").val()); 
$('.bottom_message').html($("#bottom_message").val());


$('.actual_image_name').attr('src','uploads/'+$('#actual_image_name').val());




 
  });

});

$("#title").keyup(function(){
$('.title').html($("#title").val());
});
$("#bottom_message").keyup(function(){
$('.bottom_message').html($("#bottom_message").val());

});


$("#template_color").change(function(){
$('.whole_div').css('background','#'+$("#template_color").val());
});

$("#phone").keyup(function(){
$('.phone').html($("#phone").val());
});

$("#phone_color").change(function(){

$('.phone').css('color','#'+$("#phone_color").val());
});







$("#title").keyup(function(){
$('.title').html($("#title").val());
});
$("#slogan").keyup(function(){
$('.slogan').html($("#slogan").val());
});

});





	setInterval("updateCount1()", 10);
function updateCount1() {
var elem_img=document.getElementById("actual_image_name1").value;
if (typeof (elem_img) != undefined && typeof (elem_img) != null && typeof (elem_img) != 'undefined') {


document.getElementById("actual_image_name").value = document.getElementById("actual_image_name1").value;


}

}

</script>
    <table width="1200px" border="0" cellpadding="0">
      <tr>
        <td></td>
      </tr>
      <tr>
        <td align="center" class="top"><?php include('common/top_menu.php');  
	if($_REQUEST['id'] != '') {	
		$id=$_REQUEST['id'];
		$query2 =  "select * from emailnl_template_tbl where company_admin='$company_admin' AND  id =".$id;
		$query_result2 = mysql_query($query2);
		$displaySite = mysql_fetch_array($query_result2);
	}
	

	
	?>
          <div class="wholesite-inner-template1">
            <!--welcome admin start here-->
            <div class="fleft cont_left">
              <form  method="post"  id="imageform" name="imageform" enctype="multipart/form-data" action='ajaxupload.php'>
                <p> Logo</p>
                <span id="pimg" class="prod_content">
                <input type="file"   id="bottom_photoimg" value=""  name="bottom_photoimg"/>
                </span>
                <div class="spacer"></div>
              </form>
              <form  method="post" id="conten_pre" name="conten_pre"  action=''>
         <input type="hidden" id="actual_image_name" name="actual_image_name" value="<?=$displaySite['logo'];?>" class="text_email_blast" />
                <input type="hidden" id="id" name="id" value=" <?=$displaySite['id'];?>" class="text_email_blast" />
                <p>Choose Design</p>
                <select class="text_email_blast" name="design_mail" id="design_mail"  >
                  <option value="" >--Select--</option>
                  <option <?php if($displaySite['design_mail']=="tpl_one.php") echo 'selected="selected"' ?>   value="tpl_one.php" >design1</option>
                  <option value="tpl_two.php"  <?php if($displaySite['design_mail']=="tpl_two.php") echo 'selected="selected"' ?> >design2</option>
                </select>
                <div class="spacer"></div>
                <p>Title</p>
                <input type="text" id="title" name="title" value=" <?=$displaySite['title'];?>" class="text_email_blast" />
                <div class="spacer"></div>
                <p>Slogan</p>
                <input type="text" id="slogan" name="slogan" value=" <?=$displaySite['slogan'];?>" class="text_email_blast" />
                <div class="spacer"></div>
                <div class="temp_two_hide">
                <p> Phone Number </p>
                <input type="text" id="phone" name="phone" value=" <?=$displaySite['phone'];?>" class="text_email_blast" />
                <div class="spacer"></div>
                <p> Phone Number Font </p>
                <input type="text" id="phone_color" name="phone_color" value=" <?=$displaySite['phone_color'];?>" class="text_email_blast color" />
                <div class="spacer"></div>

                <p>Facebook</p>
                <input type="checkbox" value="fb" id="fb" name="list" class="text_email_blast_check" <?php if($displaySite['fb']!="") echo 'checked="checked"'?>    onchange="return fb_click()"  />
                <div <?php if($displaySite['fb']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?>  class="prod_content" id="fb_input_div">
                  <input type="text" id="fb_input" value="<?=$displaySite['fb'];?>" class="text_email_blast"  name="fb_input"/>
                </div>
                <div class="spacer"></div>
                <p>Twitter</p>
                <input type="checkbox" value="twitter" id="twitter" name="list" <?php if($displaySite['tw']!="") echo 'checked="checked"'?>   class="text_email_blast_check" onChange="return twitter_click()"  />
                <div <?php if($displaySite['tw']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?> class="prod_content"  id="twitter_input_div">
                  <input type="text" id="twitter_input" value="<?=$displaySite['tw'];?>" name="twitter_input" class="text_email_blast"/>
                </div>
                <div class="spacer"></div>
                <p>Linkedin</p>
                <input type="checkbox" value="linkedin" id="linkedin" name="list" <?php if($displaySite['lin']!="") echo 'checked="checked"'?>   class="text_email_blast_check" onChange="return linkedin_click()"  />
                <div <?php if($displaySite['lin']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?> class="prod_content"  id="linkedin_input_div">
                  <input type="text" id="linkedin_input" value="<?=$displaySite['lin'];?>" name="linkedin_input" class="text_email_blast"/>
                </div>
                <div class="spacer"></div>
                <p>Google+</p>
                <input type="checkbox" value="google" id="google" name="list" <?php if($displaySite['gplus']!="") echo 'checked="checked"'?>  class="text_email_blast_check" onChange="return google_click()"  />
                <div <?php if($displaySite['gplus']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?> class="prod_content"  id="google_input_div">
                  <input type="text" id="google_input" value="<?=$displaySite['gplus'];?>" name="google_input" class="text_email_blast"/>
                </div>
                <div class="spacer"></div>
                <p>Stumbleupon</p>
                <input type="checkbox" value="stumbleupon" id="stumbleupon" name="list" <?php if($displaySite['st']!="") echo 'checked="checked"'?>   class="text_email_blast_check" onChange="return stumbleupon_click()"  />
                <div <?php if($displaySite['st']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?> class="prod_content"  id="stumbleupon_input_div">
                  <input type="text" id="stumbleupon_input" value="<?=$displaySite['st'];?>" name="stumbleupon_input" class="text_email_blast" />
                </div>
                <div class="spacer"></div>
                <p>You Tube</p>
                <input type="checkbox" value="youtube" id="youtube" name="list" <?php if($displaySite['utube']!="") echo 'checked="checked"'?>   class="text_email_blast_check" onChange="return youtube_click()"  />
                <div <?php if($displaySite['utube']=="") echo 'style="display:none"'; else 'style="display:inline"'; ?> class="prod_content"  id="youtube_input_div">
                  <input type="text" id="youtube_input" value="<?=$displaySite['utube'];?>" name="youtube_input" class="text_email_blast" />
                   </div>
                </div>
                <div class="spacer"></div>
                <h3>Footer Messages</h3>
                <div class="spacer"></div>
<textarea style="width: 253px; height: 76px; margin-top:10px;" id="bottom_message" name="bottom_message" class="text_email_blast" ><?=$displaySite['content'];?></textarea>
               
                <div class="spacer"></div>
                <p>Template Color</p>
                <input type="text"  value="<?=$displaySite['template_color'];?>" class="text_email_blast color" id="template_color" name="template_color" style="width:190px;height:28px;padding:0px 4px;color: #515151;"  />
                <div class="spacer"></div>
                <?php if($_REQUEST['id'] != '') { ?>
                <input type="submit" name="Update" value="Update" class="addmenu2" />
                <?php } else { ?>
                <input type="submit" name="Submit" value="Add" class="addmenu2" />
                <?php } ?>
                <input type="button" name="Cancel" value="Cancel" class="addmenu2" onClick="history.back();"/>
              </form>
            </div>
            <div class="fright cont_right" id="template_div_show" style="margin-top:20px;">
          <?php   if($_REQUEST['id'] != '') {
		 include("tpl_folder/".$displaySite['design_mail']);
		 		  echo     "<script type='text/javascript'>
$(document).ready(function()
{

$('.whole_div').css('background','#".$displaySite['template_color']."');
$('.phone').html('".$displaySite['phone']."');
$('.title').html('".$displaySite['title']."');  
$('.slogan').html('".$displaySite['slogan']."'); 
$('.bottom_message').html('".$displaySite['content']."');
$('.actual_image_name').attr('src','uploads/'+'".$displaySite['logo']."');
var id_div=$('#design_mail').val();
if(id_div=='tpl_two.php')
$('.temp_two_hide').css('display','none');
else
$('.temp_two_hide').css('display','inline');




});


</script>";
           } ?>
             </div>
            <div class="spacer"></div>
            <!--welcome admin end here-->
          </div>
          
          <!--footer start here-->
          <div class="footer"> Copyright &copy; 2011 <a href="#">desss admin.com</a> |   Privacy Policy </div>
          <!--footer end here-->
        </td>
      </tr>
    </table>
  </div>
</center>
