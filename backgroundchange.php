<?php
include("smarty_config.php");
//include("top_menu.php");

if( !isset($_SESSION['username']) ) {
	header("Location:logout.php");
} else {
	$msg = "";
	if($_REQUEST["msg"] == '2'){
		$msg = " Sucessfully Added";	
	}else if($_REQUEST["msg"] == '3'){
	
		$msg = " Default Color Updated";	
	}else if($_REQUEST["msg"] == '4'){
	
		$msg = "Suceessfully deleted";	
	}
	
	// Add Color
if(isset($_REQUEST['Submit']) && $_REQUEST['Submit'] == 'Update')
{
$backgroundcolor        = $_POST['backgroundcolor'];  
$bannerpcolor           = $_POST['bannerpcolor'];
$banner_h1fontsize      = $_POST['banner_h1fontsize'];
$h3size                 = $_POST['h3size'];
$font_family			= $_POST['font_family'].";";
$txth1					= $_POST['txth1'];
$txth1fonttype			= $_POST['txth1fonttype'];
$txtH2					= $_POST['txtH2'];
$txth2fontsize			= $_POST['txth2fontsize'];
$txth2fonttype			= $_POST['txth2fonttype'];
$alink					= $_POST['alink'];
$ptagcolor				= $_POST['ptagcolor'];
$ptagsize				= $_POST['ptagsize'];
$menucolor				= $_POST['menucolor'];
$menusize				= $_POST['menusize'];
$menualinkcolor			= $_POST['menualinkcolor'];
$menuhovercolor			= $_POST['menuhovercolor'];
$footcolor				= $_POST['footcolor'];
$foothead				= $_POST['foothead'];
$footerfontsize			= $_POST['footerfontsize'];
$bannercolor            = $_POST['bannercolor'];
$bannerptagsize         = $_POST['bannerptagsize'];
$home_bannerbackgd      = $_POST['home_bannerbackgd'];
$homebanner_hcolor      = $_POST['homebanner_hcolor'];
$home_habackgd          = $_POST['home_habackgd'];
$homebannersize         = $_POST['homebannersize'];
$homehanner_h1bg        = $_POST['homehanner_h1bg'];
$homebanneralinkcolor   = $_POST['homebanneralinkcolor'];
$homebanneralinksize    = $_POST['homebanneralinksize'];
$about_bannerbackgd     = $_POST['about_bannerbackgd'];
$aboutbanner_h1color    = $_POST['aboutbanner_h1color'];
$aboutbanner_h1size     = $_POST['aboutbanner_h1size'];
$aboutbanner_pcolor     = $_POST['aboutbanner_pcolor'];
$aboutbanner_psize      = $_POST['aboutbanner_psize'];
$tbl_header_txtcolor    = $_POST['tbl_header_txtcolor'];
$tbl_header_bgcolor     = $_POST['tbl_header_bgcolor'];
$tbl_font_color         = $_POST['tbl_font_color'];
$tbl_color1             = $_POST['tbl_color1'];
$tbl_color2             = $_POST['tbl_color2'];



$query = "INSERT INTO dynamic_colorchange_tbl
								SET
								    font_family		      =  '".$font_family."',
								 	h1color		          =  '".$txth1."',
									h1size		          =  '".$txth1fontsize."',
									h1type	              =  '".$txth1fonttype."',
									h2color		          =  '".$txtH2."',
									h2size		          =  '".$txth2fontsize."',
									h2type		          =  '".$txth2fonttype."',
									alinkcolor	          =  '".$alink."',
									bannerpcolor		  =  '".$bannerpcolor."',
									backgroundcolor		  =  '".$backgroundcolor."',
									ptagcolor	          =  '".$ptagcolor."',
									ptagsize	          =  '".$ptagsize."',
									menucolor	          =  '".$menucolor."',
									menufontsize 	      =  '".$menusize."',
									menualinkcolor	      =  '".$menualinkcolor."',
									menuhover	          =  '".$menuhovercolor."',
									footercolor	          =  '".$footcolor."',
									footerfontsize	      =  '".$footerfontsize."',
									footertitle 	      =  '".$foothead."',
									bannerptagsize	      =  '".$bannerptagsize."',
									bannercolor           =  '".$bannercolor."',
									home_bannerbackgd     =  '".$home_bannerbackgd."',
									homebanner_hcolor     =  '".$homebanner_hcolor."',
									home_habackgd         =  '".$home_habackgd."',
									homebannersize        =  '".$homebannersize."',
									homehanner_h1bg       =  '".$homehanner_h1bg."',
									homebanneralinkcolor  =  '".$homebanneralinkcolor."',
									homebanneralinksize   =  '".$homebanneralinksize."',
									about_bannerbackgd    =  '".$about_bannerbackgd."',
									aboutbanner_h1color   =  '".$aboutbanner_h1color."',
									aboutbanner_h1size    =  '".$aboutbanner_h1size."',
									aboutbanner_pcolor    =  '".$aboutbanner_pcolor."',
									tbl_header_txtcolor   =  '".$tbl_header_txtcolor."',	
									tbl_header_bgcolor    =  '".$tbl_header_bgcolor."',	
									tbl_font_color        =  '".$tbl_font_color."',	
									tbl_color1            =  '".$tbl_color1."',	
									tbl_color2            =  '".$tbl_color2."',
									banner_h1fontsize     =  '".$banner_h1fontsize."',
									h3size                =  '".$h3size."',	
									aboutbanner_psize     =  '".$aboutbanner_psize."'";

		$exInsert = mysql_query($query);
		if(!$exInsert)
		echo mysql_error();
		else
		{
$name="../css/";
require('dynamic_style.php');
chmod("color.css",0777);
$fh = fopen($name.'color.css','w') or die("can't open file");
fwrite($fh,$writestyle);
fclose($fh);
	header('location:backgroundchange.php?msg=2');		
}}

//Default Color

if(isset($_POST['Default']) && $_POST['Default'] == 'Default')
		{
$font_family			=   'Arial, Helvetica, sans-serif;';
$txth1					=   'fd600b';
$txth1fonttype			=   'FFFFFF';
$txtH2					=   'fd600b';
$txth2fontsize			=   '12';
$txth2fonttype			=   'fd5900';
$alink					=   'FD5900';
$ptagcolor				=   'FFFFFF';
$ptagsize				=   '12';
$backgroundcolor		=   'FFFFFF';
$bannerptagsize         =   '12';
$menucolor				=   '000';
$menusize				=   'fff';
$menualinkcolor			=   '535353';
$menuhovercolor			=   'FFFFFF';
$banner_h1fontsize		=   '18';
$h3size			        =   '12';
$footcolor				=   'fff';
$foothead				=   'FFFFFF';
$footerfontsize			=   '12';
$bannercolor            =   '000000';
$bannerpcolor           =   'FFFFFF';
$home_bannerbackgd      =   'FFFFFF';
$homebanner_hcolor      =   'E65302';
$home_habackgd          =   '666666';
$homebannersize         =   '12';
$homehanner_h1bg        =   '808080';
$homebanneralinkcolor   =   'f2f2f2';
$homebanneralinksize    =   '12';
$about_bannerbackgd     =   '3c3c3c';
$aboutbanner_h1color    =   'fd5900';
$aboutbanner_h1size     =   '12';
$aboutbanner_pcolor     =   'ccc';
$aboutbanner_psize      =   '14';
$tbl_header_txtcolor    =   'FF7200';
$tbl_header_bgcolor     =   'fff';
$tbl_font_color         =   'fff';
$tbl_color1             =   'FF7200';
$tbl_color2             =   'FCFCFC';


  $query = "INSERT INTO dynamic_colorchange_tbl
								SET
									font_family		       =  '".$font_family."',
									bannerpcolor		   =  '".$bannerpcolor."',
								 	h1color		           =  '".$txth1."',
									h1size		           =  '".$txth1fontsize."',
									h1type	               =  '".$txth1fonttype."',
									h2color	           	   =  '".$txtH2."',
									h2size		           =  '".$txth2fontsize."',
									h2type		           =  '".$txth2fonttype."',
									alinkcolor		       =  '".$alink."',
									ptagcolor	           =  '".$ptagcolor."',
									backgroundcolor	       =  '".$backgroundcolor."',
									bannerptagsize         =  '".$bannerptagsize."',
									ptagsize	           =  '".$ptagsize."',
									menucolor	           =  '".$menucolor."',
									menufontsize 	       =  '".$menusize."',
									menualinkcolor	       =  '".$menualinkcolor."',
									menuhover	           =  '".$menuhovercolor."',
									footercolor	           =  '".$footcolor."',
									footerfontsize	       =  '".$footerfontsize."',
									footertitle 	       =  '".$foothead."',
									bannercolor            =  '".$bannercolor."',
									home_bannerbackgd      =  '".$home_bannerbackgd."',
									homebanner_hcolor      =  '".$homebanner_hcolor."',
									home_habackgd          =  '".$home_habackgd."',
									homebannersize         =  '".$homebannersize."',
									homehanner_h1bg        =  '".$homehanner_h1bg."',
									homebanneralinkcolor   =  '".$homebanneralinkcolor."',
									homebanneralinksize    =  '".$homebanneralinksize."',
									about_bannerbackgd     =  '".$about_bannerbackgd."',
									aboutbanner_h1color    =  '".$aboutbanner_h1color."',
									aboutbanner_h1size     =  '".$aboutbanner_h1size."',
									aboutbanner_pcolor     =  '".$aboutbanner_pcolor."',									
									tbl_header_txtcolor    =  '".$tbl_header_txtcolor."',	
									tbl_header_bgcolor     =  '".$tbl_header_bgcolor."',	
									tbl_font_color         =  '".$tbl_font_color."',	
									tbl_color1             =  '".$tbl_color1."',	
									tbl_color2             =  '".$tbl_color2."',
									banner_h1fontsize      =  '".$banner_h1fontsize."',	
									h3size                 =  '".$h3size."',
									aboutbanner_psize      =  '".$aboutbanner_psize."'";
	
		$exInsert = mysql_query($query);
		if(!$exInsert)
		echo mysql_error();
		else
		{
		
$name="../css/"	;
require('dynamic_style.php');
chmod("color.css",0777);
$fh = fopen($name.'color.css','w') or die("can't open file");
fwrite($fh,$writestyle);
fclose($fh);
		
		
		header('location:backgroundchange.php?msg=3');	
		}}

// Cancel 

if(isset($_POST['Cancel']) && $_POST['Cancel'] == 'Cancel')

{
header('location:main_page.php');	
}

	
}


$con_query = "select * from dynamic_colorchange_tbl order by id DESC";
$rs = mysql_query($con_query);
$item=mysql_fetch_array($rs);

$font_family			= $item['font_family'];
$txth1					= $item['h1color'];
$txth1fontsize			= $item['h1size'];
$txth1fonttype			= $item['h1type'];
$txtH2					= $item['h2color'];
$txth2fontsize			= $item['h2size'];
$txth2fonttype			= $item['h2type'];
$bannerpcolor		    =  $item['bannerpcolor'];
$alink					= $item['alinkcolor'];
$ptagcolor				= $item['ptagcolor'];
$ptagsize				= $item['ptagsize'];
$menucolor				= $item['menucolor'];
$menusize				= $item['menufontsize'];
$menualinkcolor			= $item['menualinkcolor'];
$menuhovercolor			= $item['menuhover'];
$footcolor				= $item['footercolor'];
 $foothead				= $item['footertitle'];
$footerfontsize			= $item['footerfontsize'];
$bannercolor			= $item['bannercolor'];
$backgroundcolor		= $item['backgroundcolor'];
$bannerptagsize         = $item['bannerptagsize'];
$home_bannerbackgd      = $item['home_bannerbackgd'];
$homebanner_hcolor      = $item['homebanner_hcolor'];
$home_habackgd          = $item['home_habackgd'];
$homebannersize         = $item['homebannersize'];
$homehanner_h1bg        = $item['homehanner_h1bg'];
$homebanneralinkcolor   = $item['homebanneralinkcolor'];
$homebanneralinksize    = $item['homebanneralinksize'];
$about_bannerbackgd     = $item['about_bannerbackgd'];
$aboutbanner_h1color    = $item['aboutbanner_h1color'];
$aboutbanner_h1size     = $item['aboutbanner_h1size'];
$aboutbanner_pcolor     = $item['aboutbanner_pcolor'];
$aboutbanner_psize      = $item['aboutbanner_psize'];
$banner_h1fontsize      = $item['banner_h1fontsize'];
$h3size                 = $item['h3size'];
$tbl_header_txtcolor    = $item['tbl_header_txtcolor'];
$tbl_header_bgcolor     = $item['tbl_header_bgcolor'];
$tbl_font_color         = $item['tbl_font_color'];
$tbl_color1             = $item['tbl_color1'];
$tbl_color2             = $item['tbl_color2'];



				  
 $fontsize = Array('24' => '24',
 				  '22'=>'22',
				  '20'=>'20',
				  '18'=>'18',
				  '16'=>'16',
				  '14'=> '14',
				  '12'=>'12',
				  '10'=>'10',
				  '8'=>'8');
			  
?>
<?php include ('common/header.php')?>
<link rel="Stylesheet" type="text/css" href="css/jPicker-1.1.6.min.css" />
<link rel="Stylesheet" type="text/css" href="css/jPicker.css" />
<script  src="javascript/jquery-1.4.4.min.js" type="text/javascript"></script>
<script  src="javascript/jpicker-1.1.6.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function()
      {
        $.fn.jPicker.defaults.images.clientPath='images/';
        var LiveCallbackElement = $('#Live'),
            LiveCallbackButton = $('#LiveButton');
      $('#Binded').jPicker({window:{title:'Binded Example'},color:{active:new $.jPicker.Color({ahex:'993300ff'})}});
});
      
  $(document).ready(
    function()
    {
      $('.Binded').jPicker();
    });
	
	
function confirmColor(){
var agree=confirm("Reset to Default colors? This will Appear Colors From Original Design.And It Will Appear In Website. ");
if (agree)
     return true;
else
     return false;
}


	
	
</script>
<script type="text/javascript"  >
/**
* Font selector plugin
* turns an ordinary input field into a list of web-safe fonts
* Usage: $('select').fontSelector();
*
* Author     : James Carmichael
* Website    : www.siteclick.co.uk
* License    : MIT
*/
jQuery.fn.fontSelector = function() {

  var fonts = new Array(
'Arial,Arial,Helvetica,sans-serif',
'Arial Black,Arial Black,Gadget,sans-serif',
'Comic Sans MS,Comic Sans MS,cursive',
'Courier New,Courier New,Courier,monospace',
'Georgia,Georgia,serif',
'Impact,Charcoal,sans-serif',
'Lucida Console,Monaco,monospace',
'Lucida Sans Unicode,Lucida Grande,sans-serif',
'Palatino Linotype,Book Antiqua,Palatino,serif',
'Tahoma,Geneva,sans-serif',
'Times New Roman,Times,serif',
'Trebuchet MS,Helvetica,sans-serif',
'Verdana,Geneva,sans-serif' );
 

 
 
  return this.each(function(){

    // Get input field
    var sel = this;

    // Add a ul to hold fonts
    var ul = $('<ul id="display_font" class="fontselector"></ul>');
    $('body').prepend(ul);
    $(ul).hide();

    jQuery.each(fonts, function(i, item) {
      
      $(ul).append('<li><a href="#" class="font_' + i + '" style="font-family: ' + item + '">' + item.split(',')[0] + '</a></li>');

      // Prevent real select from working
      $(sel).focus(function(ev) {

        ev.preventDefault();

        // Show font list
        $(ul).show();
        
        // Position font list
        $(ul).css({ top:  $(sel).offset().top + $(sel).height() + 4,
                    left: $(sel).offset().left});

        // Blur field
        $(this).blur();
        return false;
      });


      $(ul).find('a').click(function() {
        var font = fonts[$(this).attr('class').split('_')[1]];
        $(sel).val(font);
        $(ul).hide();
        return false;
      });
    });

  });

}</script>
<script type="text/javascript">

$(function() {
  $('input.font').fontSelector();
});


</script>
<style type="text/css">
ul.fontselector {
	background: white;
	border: 1px solid #ccc;
	border-top: 0;
	font-size: 14px;
	float: left;
	list-style: none;
	margin: 0;
	padding:0;
	line-height: 1.2;
	z-index:    10;
	position:   absolute;
}
ul.fontselector li {
	margin:   0;
	padding:  0;
	list-style: none;
}
ul.fontselector a {
	display:    block;
	padding:    3px;
	color:      black;
	text-decoration: none;
}
ul.fontselector a:hover {
	background: #ddd;
	cursor:     pointer;
}
</style>
<script type="text/javascript" >
function close_font()
{
document.getElementById('display_font').style.display='none'; 
return true;
}
</script>
<form id="form1" name="form1" method="post" action="">
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
                <td width="13%" align="right" valign="middle" ><input type="hidden" value="<?=$item['id']?>" name="id" />
                  <input type="submit" name="Default" value="Default" title="Reset To Original"  onclick="return confirmColor()" class="addmenu2" /></td>
              </tr>
            </table>
          </div>
          <div class="content_req">
            <table width="100%" align="center" border="0" >
              <tr>
                <td class="table1" colspan="6">font Family</td>
              </tr>
              <tr>
                <td class="table2" colspan="6"></td>
              </tr>
              <tr class="table3">
                <td colspan="2" align="right" > font Family : </td>
                <td colspan="4" ><input value="<?=$font_family?>" class="font login-textarea1" name="font_family" id="font_family"  />
                  <img src="images/icon_close.png" alt="Close" title="Close" onclick="return close_font()" /> </td>
              </tr>
             
              <tr>
                <td class="table2" colspan="6"></td>
              </tr>
              <tr>
                <td class="table1" colspan="6">Headings Groups</td>
              </tr>
              <tr>
                <td class="table2" colspan="6"></td>
              </tr>
              <tr class="table3">
              <td width="15%" >Background Color Change: </td>
                <td width="16%" ><input class="Binded" type="text" name="backgroundcolor" value="<?=$backgroundcolor?>"  readonly="readonly"  />
                
                <td width="15%" >Background Head Color: </td>
                <td width="16%" ><input class="Binded" type="text" name="txth1" value="<?=$txth1?>"  readonly="readonly"  />
                </td>
              <td width="13%" ></td>
                <td width="16%" ><!--<select name="txth1fontsize"  >
                    <option value="">Select</option>
                    <option value="18" <?php if($txth1fontsize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($txth1fontsize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($txth1fontsize == "14"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($txth1fontsize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select>--></td>
               
              </tr>
             <tr class="table2">
                <td width="15%" >Search Text color: </td>
                <td width="16%" ><input class="Binded" type="text" name="txtH2" value="<?=$txtH2?>"  readonly="readonly"  />
             </td>
                <td width="15%" ><!--Search a link(color):--> </td>
                <td width="16%" ><!--<input class="Binded" type="text" name="tbl_font_color" value="<?=$tbl_font_color?>"  readonly="readonly"  />-->
                <td width="13%" ></td>
                <td width="16%" ><!--<select name="txth1fontsize"  >
                    <option value="">Select</option>
                    <option value="18" <?php if($txth1fontsize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($txth1fontsize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($txth1fontsize == "14"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($txth1fontsize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select>--></td>
               
                </td></tr>
                
               <!-- <tr class="table2">
                <td width="15%" >Search A Links(color): </td>
                <td width="16%" ><input class="Binded" type="text" name="tbl_header_bgcolor" value="<?=$tbl_header_bgcolor?>"  readonly="readonly"  />
                </td>-->
                
              <!-- /////////////////////////////-->
          
         
              <tr>
                <td class="table3" colspan="7"></td>
              </tr>
              <tr>
                <td class="table1" colspan="7">Menus Page</td>
              </tr>
              <tr>
                <td class="table2" colspan="7"></td>
              </tr>
              <tr class="table2">
              <td width="15%" >Menu Header(back ground): </td>
                <td width="16%" ><input class="Binded" type="text" name="homehanner_h1bg" value="<?=$homehanner_h1bg?>"  readonly="readonly"  />
                </td>
              
                <td>Menu Text links Color </td>
                <td><input class="Binded" type="text" name="home_bannerbackgd" value="<?=$home_bannerbackgd?>" readonly="readonly"  /></td>
                 <td><!--Menu A links sub Color--></td>
                <td><!--<input class="Binded" type="text" name="home_habackgd" value="<?=$home_habackgd?>" readonly="readonly"  />--></td>
               
               
              <tr class="table3">
                <td>Menu  sub1  Color</td>
                <td><input class="Binded" type="text" name="homebanner_hcolor" value="<?=$homebanner_hcolor?>" readonly="readonly"  /></td>
                 <td>Menu Text links sub(Color)</td>
                <td><input class="Binded" type="text" name="home_habackgd" value="<?=$home_habackgd?>" readonly="readonly"  /></td>
               
                <!--<td>Menu Page H1 Font Size</td>
                <td ><select name="homebannersize"  >
                    <option value="">Select</option>
                    <option value="18" <?php if($homebannersize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($homebannersize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($homebannersize == "14"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($homebannersize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select></td>-->
                <td></td>
                <td></td>
              </tr>
              <!--<tr class="table2">
                <td>Menu A hover Color </td>
                <td><input class="Binded" type="text" name="homebanneralinkcolor" value="<?=$homebanneralinkcolor?>" readonly="readonly"  /></td>
                <td>Home A hover Font Size</td>
                <td ><select name="homebanneralinksize">
                    <option value="">Select</option>
                    <option value="18" <?php if($homebanneralinksize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($homebanneralinksize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($homebanneralinksize == "12"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($homebanneralinksize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select></td>
                <td></td>
                <td></td>
              </tr>-->
              <!--////////////////////////////////////////    -->
              <!--/////////////////////////////////// -->
              <tr>
                <td class="table3" colspan="7"></td>
              </tr>
              <tr>
                <td class="table1" colspan="7">Sub Page Content</td>
              </tr>
              <tr>
                <td class="table2" colspan="7"></td>
              </tr>
              <tr class="table2">
               
                <td>Sub Page Content (Font Size)</td>
                <td ><select name="bannerptagsize"  >
                    <option value="">Select</option>
                    <option value="18" <?php if($bannerptagsize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($bannerptagsize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($bannerptagsize == "14"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($bannerptagsize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select></td>
                <td>Sub page H1 (Font Size)</td>
                <td ><select name="banner_h1fontsize"  >
                    <option value="">Select</option>
                    <option value="24" <?php if($banner_h1fontsize == "24"){ ?> selected="selected" <?php } ?>>24</option>
                    <option value="22" <?php if($banner_h1fontsize == "22"){ ?> selected="selected" <?php } ?>>22</option>
                    <option value="20" <?php if($banner_h1fontsize == "20"){ ?> selected="selected" <?php } ?>>20</option>
                    <option value="18" <?php if($banner_h1fontsize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                  </select></td>
                 <td></td><td></td>
                
               </tr>
                <tr class="table3">
                
               <td>Sub Page List(Font Size)</td>
                <td ><select name="ptagsize"  >
                    <option value="">Select</option>
                    <option value="18" <?php if($ptagsize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($ptagsize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($ptagsize == "14"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($ptagsize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select></td>
           <td>Sub page H2 (Font Size)</td>
                <td ><select name="h3size"  >
                    <option value="">Select</option>
                    <option value="18" <?php if($h3size == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($h3size == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($h3size == "14"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($h3size == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select></td>
                  <td></td><td></td>
                
               </tr>
              <!--<tr class="table3">
                <td>Client Head(A Color)</td>
                <td><input class="Binded" type="text" name="txth1fonttype" value="<?=$txth1fonttype?>" readonly="readonly"  /></td>
                <td>About Banner Content Font (Size)</td>
                <td ><select name="aboutbanner_psize">
                    <option value="">Select</option>
                    <option value="18" >18</option>
                    <option value="16" >16</option>
                    <option value="14" >14</option>
                    <option value="12" >12</option>
                  </select></td>
                <td></td>
                <td></td>
              </tr>-->
             
              
              <!--/////////////////////////////////// -->
              
              
              
              
              
               <!--/////////////////////////////////// -->
              <tr>
                <td class="table3" colspan="7"></td>
              </tr>
              <tr>
                <td class="table1" colspan="7">Testimonials Tab</td>
              </tr>
              <tr>
                <td class="table2" colspan="7"></td>
              </tr>
              <tr class="table2">
                <td>Client Head (gdColor)</td>
                <td><input class="Binded" type="text" name="txth2fonttype" value="<?=$txth2fonttype?>" readonly="readonly"  /></td>
                <td>Client Text (Color)</td>
                <td><input class="Binded" type="text" name="bannerpcolor" value="<?=$bannerpcolor?>" readonly="readonly"  /></td>
                <td></td><td></td>
                <tr>
              <tr class="table3">
               
                 <td>Client(background color)</td>
                <td><input class="Binded" type="text" name="tbl_header_bgcolor" value="<?=$tbl_header_bgcolor?>" readonly="readonly"  /></td>
                <td></td><td></td>
                <td></td><td></td>
                  </tr>
              <!--<tr class="table3">
                <td>Client Head(A Color)</td>
                <td><input class="Binded" type="text" name="txth1fonttype" value="<?=$txth1fonttype?>" readonly="readonly"  /></td>
                <td>About Banner Content Font (Size)</td>
                <td ><select name="aboutbanner_psize">
                    <option value="">Select</option>
                    <option value="18" <?php if($aboutbanner_psize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($aboutbanner_psize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($aboutbanner_psize == "14"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($aboutbanner_psize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select></td>
                <td></td>
                <td></td>
              </tr>-->
             
              
              <!--/////////////////////////////////// -->
          
              <!--////////////////////////////////////////    -->
              <tr>
                <td class="table3" colspan="7"></td>
              </tr>
              <tr>
                <td class="table1" colspan="7">Content Tab</td>
              </tr>
              <tr>
                <td class="table2" colspan="7"></td>
              </tr>
              <tr class="table2">
                <td>Content (Back Ground) </td>
                <td><input class="Binded" type="text" name="alink" value="<?=$alink?>" readonly="readonly"  /></td>
                <td>Content Text(font color)</td>
                <td><input class="Binded" type="text" name="ptagcolor" value="<?=$ptagcolor?>" readonly="readonly"  /></td>
                <td></td>
<td></td>

              </tr>
              
              <tr class="table3">
                <td>Tab Text color</td>
                <td><input class="Binded" type="text" name="menucolor" value="<?=$menucolor?>" readonly="readonly"  /></td>
               
              <td></td>
<td></td>
<td></td>
<td></td>
              </tr>
              
              <tr class="table2">
                <td>Tab Text link(Color)</td>
                <td><input class="Binded" type="text" name="about_bannerbackgd" value="<?=$about_bannerbackgd?>" readonly="readonly"  /></td>
                 <td></td>
<td></td>
<td></td>
<td></td>
              </tr>
              
               
              <tr class="table3">
                <td>Tab Hover(bgColor)</td>
                <td><input class="Binded" type="text" name="aboutbanner_pcolor" value="<?=$aboutbanner_pcolor?>" readonly="readonly"  /></td>
              
               <td></td>
<td></td>
                <td></td>
                <td></td>
              </tr>
         <tr>
                <td class="table2" colspan="7"></td>
              </tr>
              <tr class="table2">
                <td class="table1" colspan="7">Description Content</td>
              </tr>
              <tr>
                <td class="table3" colspan="7"></td>
              </tr>
              <tr class="table2">
                <td>Description H1 Color</td>
                <td><input class="Binded " type="text" name="tbl_header_txtcolor" value="<?=$tbl_header_txtcolor?>" readonly="readonly"  /></td>
                 <td>Description (background Color)</td>
                <td><input class="Binded" type="text" name="tbl_color2" value="<?=$tbl_color2?>" readonly="readonly"  /></td>
             <!--  <td>Description Head2 Font (Size)</td>
                <td ><select name="aboutbanner_psize">
                    <option value="">Select</option>
                    <option value="20" <?php if($aboutbanner_psize == "20"){ ?> selected="selected" <?php } ?>>20</option>
                    <option value="18" <?php if($aboutbanner_psize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($aboutbanner_psize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($aboutbanner_psize == "14"){ ?> selected="selected" <?php } ?>>14</option>
                  </select></td>-->
                <td></td>
                <td></td>
                 </tr>
               
                 <tr class="table2">
                 <td>Description Text link Color</td>
                <td><input class="Binded" type="text" name="tbl_color1" value="<?=$tbl_color1?>" readonly="readonly"  /></td>
                <td></td>
                <td></td>
                
                <td></td>
                <td></td>
                </tr>
             
            <!-- <tr>
                <td class="table2" colspan="7"></td>
              </tr>
              <tr class="table2">
                <td class="table1" colspan="7">Client Part</td>
              </tr>
              <tr>
                <td class="table3" colspan="7"></td>
              </tr>
              <tr class="table2">
                <td>Client Head (back ground)</td>
                <td><input class="Binded " type="text" name="aboutbanner_h1color" value="<?=$aboutbanner_h1color?>" readonly="readonly"  /></td>
                
                 <tr class="table2">
                 <td>Client Head Color</td>
                <td><input class="Binded" type="text" name="menuhovercolor" value="<?=$menuhovercolor?>" readonly="readonly"  /></td>
                
                <td></td>
                <td></td>
                </tr>-->
             
             
              <tr>
                <td class="table2" colspan="7"></td>
              </tr>
              <tr class="table2">
                <td class="table1" colspan="7">Footer Part</td>
              </tr>
              <tr>
                <td class="table3" colspan="7"></td>
              </tr>
              <tr class="table2">
                <td>Footer Head(background Color)</td>
                <td><input class="Binded " type="text" name="footcolor" value="<?=$footcolor?>" readonly="readonly"  /></td>
                <td>Footer Text links (Font Color)</td>
                <td><input class="Binded" type="text" name="foothead" value="<?=$foothead?>" readonly="readonly"  /></td>
                <td><!--Footer links font size--></td>
                <td ><!--<select name="footerfontsize"  >
                    <option value="">Select</option>
                    <option value="40" <?php if($footerfontsize == "40"){ ?> selected="selected" <?php } ?>>40</option>
                    <option value="18" <?php if($footerfontsize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($footerfontsize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="12" <?php if($footerfontsize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select>--></td>
              </tr>
            <tr class="table2">
                <td>Footer Text  Color</td>
                <td><input class="Binded " type="text" name="bannercolor" value="<?=$bannercolor?>" readonly="readonly"  /></td>
               <td><!--Footer background  Color--></td>
                <td><!--<input class="Binded " type="text" name="menuhovercolor" value="<?=$menuhovercolor?>" readonly="readonly"  />--></td>
               <td><!--Footer innerfon font size--></td>
                <td ><!--<select name="txth2fontsize"  >
                    <option value="">Select</option>
                    <option value="18" <?php if($txth2fontsize == "18"){ ?> selected="selected" <?php } ?>>18</option>
                    <option value="16" <?php if($txth2fontsize == "16"){ ?> selected="selected" <?php } ?>>16</option>
                    <option value="14" <?php if($txth2fontsize == "14"){ ?> selected="selected" <?php } ?>>14</option>
                    <option value="12" <?php if($txth2fontsize == "12"){ ?> selected="selected" <?php } ?>>12</option>
                  </select>--></td>
              </tr>
              <tr>
                <td align="right" valign="top">&nbsp;</td>
                <td align="right" valign="top">&nbsp;</td>
                <td align="center"><input type="submit" name="Submit" value="Update"  class="addmenu2" /></td>
                <td align="center"><input type="submit" name="Cancel" value="Cancel" class="addmenu2" />
                </td>
              </tr>
            </table>
          </div>
          <!--welcome admin end here-->
        </div>
        <!--footer start here-->
        <?php include('common/footer.php'); ?>
        <!--footer end here-->
      </td>
    </tr>
  </table>
</form>
</div>
</center>
</body></html>