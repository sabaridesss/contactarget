<?php
ini_set('display_errors',"1");
include("smarty_config.php");
include("phpmailfunction.php");
$php_mail = new phpmail_function();
$template  =  $_REQUEST['id'];
$displaySite = $php_mail->gettemplates($template,$company_admin);




?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript" >
$(document).ready(function() {
						   
// Here we will write a function when link click under class popup				   
$('a.popup').click(function() {
									
									
// Here we will describe a variable popupid which gets the
// rel attribute from the clicked link							
var popupid = $(this).attr('rel');


// Now we need to popup the marked which belongs to the rel attribute
// Suppose the rel attribute of click link is popuprel then here in below code
// #popuprel will fadein
$('#' + popupid).fadeIn();


// append div with id fade into the bottom of body tag
// and we allready styled it in our step 2 : CSS
$('body').append('<div id="fade"></div>');
$('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();


// Now here we need to have our popup box in center of 
// webpage when its fadein. so we add 10px to height and width 
var popuptopmargin = ($('#' + popupid).height() + 10) / 2;
var popupleftmargin = ($('#' + popupid).width() + 10) / 2;


// Then using .css function style our popup box for center allignment
$('#' + popupid).css({
'margin-top' : -popuptopmargin,
'margin-left' : -popupleftmargin
});
});


// Now define one more function which is used to fadeout the 
// fade layer and popup window as soon as we click on fade layer
$('#fade').click(function() {


// Add markup ids of all custom popup box here 						  
$('#fade , #popuprel , #popuprel2 , #popuprel3').fadeOut()
return false;
});
});
</script>
<style>
/* CSS Document */
#trigger {
	text-align:center;
}
/* Style you custom popupbox according to your requirement */
.popupbox {
	width:500px;
	height:300px;
	background-image:url(/edit_media/2010/201010/20101009/custompopup/images/pop-up_03.png);
	background-repeat:no-repeat;
	display: none; /* Hidden as default */
	float: left;
	position: fixed;
	top: 50%;
	left: 50%;
	z-index: 99999;
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
}
.popupbox2 {
	width:454px;
	height:307px;
	background-image:url(/edit_media/2010/201010/20101009/custompopup/images/pu_03.png);
	background-repeat:no-repeat;
	display: none;
	float: left;
	position: fixed;
	top: 50%;
	left: 50%;
	z-index: 99999;
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
}
.popupbox3 {
	width:502px;
	height:302px;
	background-image:url(/edit_media/2010/201010/20101009/custompopup/images/3_03.png);
	background-repeat:no-repeat;
	display: none;
	float: left;
	position: fixed;
	top: 50%;
	left: 50%;
	z-index: 99999;
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
}
#fade {
	display: none; /* Hidden as default */
	background: #000;
	position: fixed;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	opacity: .80;
	z-index: 9999;
}
#intabdiv {
	text-align:center;
}
#close img {
	text-decoration:none;
}
#close {
	width:50px;
	height:50px;
	position: absolute;
	float:right;
}
#intabdiv2 {
	padding:70px;
}
#intabdiv2 h2 {
	font-size:24px;
	color:#696868;
	font-family:Verdana, Geneva, sans-serif;
}
#intabdiv2 p {
	font-size:12px;
	color:#696868;
	font-family:Verdana, Geneva, sans-serif;
	line-height:20px;
}
#intabdiv3 {
	padding:70px;
}
#intabdiv3 h2 {
	font-size:24px;
	color:#fff;
	font-family:Verdana, Geneva, sans-serif;
}
#intabdiv3 p {
	font-size:12px;
	color:#fff;
	font-family:Verdana, Geneva, sans-serif;
	line-height:20px;
}
</style>

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
<div style="display:none">
<form  method="post" id="conten_pre" name="conten_pre"  action=''>
                <input type="hidden" id="actual_image_name" name="actual_image_name" value="desss_logo.png" class="text_email_blast" />
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
<div>


<?php 
if($displaySite['design_mail']!="")
{
require("tpl_folder/".$displaySite['design_mail']);
		 		  echo     "<script type='text/javascript'>
$(document).ready(function()
{

$('.whole_div').css('background','#".$displaySite['template_color']."');
$('.phone').html('".$displaySite['phone']."');
$('.title').html('".$displaySite['title']."');  
$('.slogan').html('".$displaySite['slogan']."'); 
$('.bottom_message').html('".$displaySite['content']."');
$('.actual_image_name').attr('src','uploads/'+'".$displaySite['logo']."');
var id_div=$('#bottom_message').val();
if(id_div=='tpl_two.php')
$('.temp_two_hide').css('display','none');
else
$('.temp_two_hide').css('display','inline');




});


</script>";
}
else
{

require("tpl_folder/tpl_one.php ");
		 		  echo     "<script type='text/javascript'>
$(document).ready(function()
{

$('.whole_div').css('background','#".$displaySite['template_color']."');
$('.phone').html('".$displaySite['phone']."');
$('.title').html('".$displaySite['title']."');  
$('.slogan').html('".$displaySite['slogan']."'); 
$('.bottom_message').html('".$displaySite['content']."');
$('.actual_image_name').attr('src','uploads/'+'".$displaySite['logo']."');
var id_div=$('#bottom_message').val();
if(id_div=='tpl_two.php')
$('.temp_two_hide').css('display','none');
else
$('.temp_two_hide').css('display','inline');




});


</script>";



}
?>

  
</div>