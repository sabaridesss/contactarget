<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Tonight8</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
{literal}
<style type="text/css">
/* For Mozilla only: create rounded corners */
#box {
  -moz-border-radius: 10px 10px 10px 10px;
}
</style>
{/literal}

<link href="tonight_style.css" rel="stylesheet" type="text/css">
<!--<link href="style_for_ie6.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript" src="javascript/admin_javascript.js"></script>
<script language="javascript" src="javascript/template_support.js"></script>
<script type="text/javascript" src="javascript/validation.js"></script>
{literal}
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAUNz_2ibhLAL2Q2NUFdMDeRTiIB0hH2SwlcV9KmMxy7mRPXKmlhQgsTQlcgCT_H7-kcv7j-SaA5wrqA" type="text/javascript"></script>
<!--<script src="http://gmaps-utility-library.googlecode.com/svn/trunk/markermanager/release/src/markermanager.js" type="text/javascript">-->
</script>
<head>

  <script type="text/javascript">
/*
function pausecomp(millis)
{
var date = new Date();
var curDate = null;

do { curDate = new Date(); }
while(curDate-date < millis);
} 
*/
    var map =  null;
    var geocoder = null;
 var iconheart = new GIcon(); 
    iconheart.image = 'http://tonightat8.com/images/event_heart_map.png';
    //iconBlue.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconheart.iconSize = new GSize(30, 30);
    iconheart.shadowSize = new GSize(22, 20);
    iconheart.iconAnchor = new GPoint(6, 20);
    iconheart.infoWindowAnchor = new GPoint(5, 1);

    var iconsport = new GIcon(); 
    iconsport.image = 'http://tonightat8.com/images/event_sport_map.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconsport.iconSize = new GSize(30, 30);
    iconsport.shadowSize = new GSize(22, 20);
    iconsport.iconAnchor = new GPoint(6, 20);
    iconsport.infoWindowAnchor = new GPoint(5, 1);

   var iconvideo = new GIcon(); 
    iconvideo.image = 'http://tonightat8.com/images/event_movie_map.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconvideo.iconSize = new GSize(30, 30);
    iconvideo.shadowSize = new GSize(22, 20);
    iconvideo.iconAnchor = new GPoint(6, 20);
    iconvideo.infoWindowAnchor = new GPoint(5, 1);

   var icondrama = new GIcon(); 
    icondrama.image = 'http://tonightat8.com/images/event_drama_map.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    icondrama.iconSize = new GSize(30, 30);
    icondrama.shadowSize = new GSize(22, 20);
    icondrama.iconAnchor = new GPoint(6, 20);
    icondrama.infoWindowAnchor = new GPoint(5, 1);

   var iconmusic = new GIcon(); 
    iconmusic.image = 'http://tonightat8.com/images/event_music_map.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconmusic.iconSize = new GSize(30, 30);
    iconmusic.shadowSize = new GSize(22, 20);
    iconmusic.iconAnchor = new GPoint(6, 20);
    iconmusic.infoWindowAnchor = new GPoint(5, 1);


  var iconcomedy = new GIcon(); 
    iconcomedy.image = 'http://tonightat8.com/images/event_comedy_map.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconcomedy.iconSize = new GSize(30, 30);
    iconcomedy.shadowSize = new GSize(22, 20);
    iconcomedy.iconAnchor = new GPoint(6, 20);
    iconcomedy.infoWindowAnchor = new GPoint(5, 1);

  var icondowntown = new GIcon(); 
    icondowntown.image = 'http://tonightat8.com/images/downtown.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    icondowntown.iconSize = new GSize(84, 53);
    icondowntown.shadowSize = new GSize(22, 20);
    icondowntown.iconAnchor = new GPoint(6, 20);
    icondowntown.infoWindowAnchor = new GPoint(5, 1);

  var icongalleria = new GIcon(); 
    icongalleria.image = 'http://tonightat8.com/images/galleria.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    icongalleria.iconSize = new GSize(84, 53);
    icongalleria.shadowSize = new GSize(22, 20);
    icongalleria.iconAnchor = new GPoint(6, 20);
    icongalleria.infoWindowAnchor = new GPoint(5, 1);

  var icongalveston = new GIcon(); 
    icongalveston.image = 'http://tonightat8.com/images/galveston.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    icongalveston.iconSize = new GSize(84, 53);
    icongalveston.shadowSize = new GSize(22, 20);
    icongalveston.iconAnchor = new GPoint(6, 20);
    icongalveston.infoWindowAnchor = new GPoint(5, 1);

  var iconnorthhouston = new GIcon(); 
    iconnorthhouston.image = 'http://tonightat8.com/images/northhouston.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconnorthhouston.iconSize = new GSize(173, 108);
    iconnorthhouston.shadowSize = new GSize(22, 20);
    iconnorthhouston.iconAnchor = new GPoint(6, 20);
    iconnorthhouston.infoWindowAnchor = new GPoint(5, 1);

  var iconsugarland = new GIcon(); 
    iconsugarland.image = 'http://tonightat8.com/images/sugarland.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconsugarland.iconSize = new GSize(140, 75);
    iconsugarland.shadowSize = new GSize(22, 20);
    iconsugarland.iconAnchor = new GPoint(6, 20);
    iconsugarland.infoWindowAnchor = new GPoint(5, 1);

  var iconwestuniversity = new GIcon(); 
    iconwestuniversity.image = 'http://tonightat8.com/images/west-university.png';
    //iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconwestuniversity.iconSize = new GSize(84, 53);
    iconwestuniversity.shadowSize = new GSize(22, 20);
    iconwestuniversity.iconAnchor = new GPoint(6, 20);
    iconwestuniversity.infoWindowAnchor = new GPoint(5, 1);


var customIcons = [];
    customIcons["Dating/Romantic"] = iconheart;
    customIcons["Sports"] = iconsport;
    customIcons["Movies"] = iconvideo;
    customIcons["Comedy"] = iconcomedy;
    customIcons["Drama"] = icondrama;
    customIcons["Concerts"] = iconmusic;
    customIcons["Bands"] = iconmusic;
    customIcons["downtown"] = icondowntown;
	customIcons["galleria"] = icongalleria;
	customIcons["galveston"] = icongalveston;
	customIcons["northhouston"] = iconnorthhouston;
	customIcons["sugarland"] = iconsugarland;
	customIcons["westuniversity"] = iconwestuniversity;
	 
    function initialize(loc) {
//GUnload();

load_pagination('','page_div',loc,'');
      if (GBrowserIsCompatible()) {
       
if(loc == null){
//load_cities(); 

//  alert("null");
//    map.setCenter(new GLatLng(29.76328, -95.36327), 10);
//document.getElementById("map").innerHTML = "<img src='http://www.tonightat8.com/images/tonightat8-googlemap.gif'>";

}else if(loc != null){
  // 
showAddress(loc,"show");

}

geocoder = new GClientGeocoder();
     


}
    }

    function showAddress(address,action,name, type, date, time, evt_id,evt_loc_id) {
//alert(address);
//alert(evt_loc_id);
//alert(address);
    map = new GMap2(document.getElementById("map"));

        map.addControl(new GSmallMapControl());
      map.addControl(new GMapTypeControl());    

      if (geocoder) 
      {
if(action == "show"){
/*if(document.getElementById("idhome").value == 'yes')
{
map.clearOverlays();
document.getElementById("idhome").value = 'no'
}*/


//alert("loading");

load_func(evt_loc_id);
//sleep(5000);
}

geocoder.getLatLng(address,function(point){
            if (!point) {
           //   alert(address + " not found");
            } else {
 
          if(action == "show")
           {

//map.clearOverlays();

var zoom_level;

if(address == "West University Place,houston,tx")
{

zoom_level = 13;

}else{

zoom_level = 12;

}
//alert(address);




evevent_day_new=document.getElementById("evevent_day").value;


load_pagination('','page_div',address,evevent_day_new);
//change_events_for_next_day(address);
               map.setCenter(point, zoom_level);
                 
				
			
				// setTimeout(showAddress(address,'show','','','','','',evt_loc_id), 7000);
           		   	  
		   }
           if(action != "show"){

             var marker = new GMarker(point, customIcons[type]);
             map.addOverlay(marker);
             //marker.openInfoWindowHtml(address);
            var html = "<b>" + name + "</b> <br/>" + type +"<br/>"+ time +"<br/>" + date +"<br/><ul><a href=event_details.php?id="+evt_id+">MORE INFO</a></ul>";
            GEvent.addListener(marker, 'click', function() {
            marker.openInfoWindowHtml(html); });
            }
			
			if(action == "city"){

             var marker = new GMarker(point, customIcons[type]);
             map.addOverlay(marker);
             //marker.openInfoWindowHtml(address);
            var html = "<b>" + name + "</b> <br/>" + type +"<br/>"+ time +"<br/>" + date +"<br/><ul><a href=event_details.php?id="+evt_id+">MORE INFO</a></ul>";
            //GEvent.addListener(marker, 'click', function() {marker.openInfoWindowHtml(html); });
            
		GEvent.addListener(marker, 'click', function() { return showAddress(address,'show','','','','','',evt_loc_id); });
			
			
			}
			
			
          }}
        );
      }
    }
    </script>

 <script type="text/javascript">
    
      function load_func(eeid)
{
//alert(eeid);
geocoder = new GClientGeocoder();
GDownloadUrl("phpsqlajax_genxml2.php?eventLocationId="+eeid, function(data) {
          var xml = GXml.parse(data);
            
          var markers = xml.documentElement.getElementsByTagName("marker");
         //alert(markers.length);
		  for (var i = 0; i < markers.length; i++) 
         {
            var name = markers[i].getAttribute("name");
            var address = markers[i].getAttribute("address");
            var type = markers[i].getAttribute("type");
            var date = markers[i].getAttribute("date");
            var time = markers[i].getAttribute("time");
            var evt_id = markers[i].getAttribute("evt_id");
            var evt_loc_id = markers[i].getAttribute("evt_loc_id");
//alert(evt_id);
 showAddress(address,'',name, type, date, time, evt_id, evt_loc_id);
//sleep(5000);

          }
        //setTimeout(load_func(eeid), 9000)
		}
		);
    
}

function load_cities()
{

var cities = new Array("Downtown,houston,tx","Hunters creek village,houston,tx","North Houston,houston,tx","Sugar Land,houston,tx","galveston,tx","West University Place,houston,tx");
geocoder = new GClientGeocoder();
for (var n = 0; n < cities.length; n++)
{

var add_load_cities=cities[n];
if(add_load_cities=='Downtown,houston,tx')
{
iconName='downtown';
evt_loc_id=1;
}
if(add_load_cities=='Hunters creek village,houston,tx')
{
iconName='galleria';
evt_loc_id=2;
}
if(add_load_cities=='North Houston,houston,tx')
{
iconName='northhouston';
evt_loc_id=4;
}
if(add_load_cities=='Sugar Land,houston,tx')
{
iconName='sugarland';
evt_loc_id=3;
}
if(add_load_cities=='galveston,tx')
{
iconName='galveston';
evt_loc_id=5;
}
if(add_load_cities=='West University Place,houston,tx')
{
iconName='westuniversity';
evt_loc_id=6;
}

showAddress(add_load_cities,'city','name', iconName, 'date', 'time', 'evt_id', evt_loc_id);


    customIcons["downtown"] = icondowntown;
	customIcons["galleria"] = icongalleria;
	customIcons["galveston"] = icongalveston;
	customIcons["northhouston"] = iconnorthhouston;
	customIcons["sugarland"] = iconsugarland;
	customIcons["westuniversity"] = iconwestuniversity;

}
//showAddress(address,'','name', 'type', 'date', 'time', 'evt_id', 'evt_loc_id');
}


  </script>
<!--[if lte IE 6]>
   
<style type="text/css">
   
.shadow { background:none;filter: progid:DXImageTransform.Microsoft.AlphaImageLoader (src="/img/bg-shadow.png", sizingMethod="image");background-repeat:no-repeat; }
  
</style>
   
<![endif]-->
{/literal}
</head>
<body class="body" onunload="GUnload();" >
<!--onLoad="MM_preloadImages('images/readmoreover.gif','images/postcommentsover.gif','images/submitover.gif'); initialize();" onunload="GUnload();"-->
<div  style=" float:right;z-index:1;">{include_php file='feedback.php'}</div>

<form>
<input type="hidden" id="evevent_day" value="" name="evevent_day" />
<input type="hidden" id="idhome" value="yes" name="evevent_day" />
</form>
<div class="dat">{$today_date}</div>
<div id="dat_button" class="dat_button"><!-- <input type="button" name="Next" id="nxt_button" value="Tomorrow's events" onClick="load_pagination('','page_div','','next_evt')"> --><img src="images/tomorrows-events.gif" border="0" onClick="load_pagination('','page_div','','next_evt')">


</div> 
<div class="wholesite">
  <div class="">
   <!--  <div class="banner">
      <div class="bannerspace"></div>
      <div class="logo"></div>
 {include file='user_top_menu.tpl'}
    </div> -->
<!--banner starts here-->
  <div>
    <div class="bannertop"><a href="index.php"><div class="logohome"></div></a></div><div class="toparrow"></div>
    <!--top menu starts here-->
    <div class="topmenu">
      <table width="auto" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td id="topmenuleft" width="1280px"><ul>
            <!--   <li><a href="#">Home</a></li>
              |
              <li><a href="#">events</a></li>
              |
              <li><a href="#">Logout</a></li>
              
            </ul> -->{include file='user_top_menu.tpl'}</td>
          <td class="topmenuright">&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
 <div id="">
    <table width="1280" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="230" valign="top">
		<a href="reward_program.php"><img src="images/freebies.gif" border="0"></a>
<div><div class="contentleft">
        
        


<div style="width:220px;">

<table id="Table_01" width="220" height="505" border="0" cellpadding="0" cellspacing="0" bgcolor="#1c1c1c">
	<tr>
		<td colspan="2">
			<!-- <img src="images/leftsidebanner-1_01.gif" width="220" height="61" alt="" border="0"> -->  <div id="signup_freeupdate_top" class="signup_freeupdate_top"></div>
  <div style="background:url(images/signup_freeupdate_middle.gif) repeat-y;"></td>
	</tr>
	<tr>
		<td>
			<a href="#"><img src="images/leftsidebanner-1_02.gif" width="46" height="111" alt="" border="0"></a></td>
  <td>
			<a href="javascript:void(0)" onclick = "index_page_sign_up('email')"><img src="images/leftsidebanner-1_03.gif" width="174" height="111" alt="" border="0"></a></td>
  </tr>
	<tr>
		<td>
			<a href="#"><img src="images/leftsidebanner-1_04.gif" width="46" height="109" alt="" border="0"></a></td>
  <td>
			<a href="javascript:void(0)" onclick = "index_page_sign_up('mobile')"><img src="images/leftsidebanner-1_05.gif" width="174" height="109" alt="" border="0"></a></td>
  </tr>
	<tr>
		<td>
			<a href="#"><img src="images/leftsidebanner-1_06.gif" width="46" height="98" alt="" border="0"></a></td>
  <td>
			<a href="#"><img src="images/leftsidebanner-1_07.gif" width="174" height="98" alt="" border="0"></a></td>
  </tr>
	<tr>
		<td>
			<a href="#"><img src="images/leftsidebanner-1_08.gif" width="46" height="109" alt="" border="0"></a></td>
  <td>
			<a href="http://twitter.com/houstontat8" target="_blank"><img src="images/leftsidebanner-1_09.gif" width="174" height="109" alt="" border="0"></a></td>
  </tr>
	<tr>
		<td colspan="2">
			<img src="images/leftsidebanner-1_10.gif" width="220" height="17" alt="" border="0"></td>
	</tr>
</table>
  </div>
<!--   <div style="background:url(images/sign_update_bottom.gif); height:7px;"></div> -->
</div>





      </div><!-- </div> --><div id="light" class="white_content">

            
              
           </div></td>
        <td valign="top"><!-- width = 785px -->
          <div style="padding-top:10px; padding-bottom:10px; padding-left:8px;"><a href="http://www.buytoneronline.com" target="_blank"><img src="images/buytoner-1.gif" border="0" ></a></div><div class="">
      
      <div class="contentcentre">
        <div class="map"> 
<span >
<a onClick="return showAddress('Downtown,houston,tx','show','','','','','',1)" href="#" class='menu_href'>Downtown</a></span>&nbsp;<span class='menu_href'>|</span>&nbsp;<span class='menu_href'><a onClick="return showAddress('Galleria,houston,tx','show','','','','','',2)" href="#" class='menu_href'>Galleria/Montrose</a></span>&nbsp;<span class='menu_href'>|</span>&nbsp;<span class='menu_href'><a onClick="return showAddress('North Houston,houston,tx','show','','','','','',4)" href="#" class='menu_href'>North Houston</a></span>&nbsp;<span class='menu_href'>|</span>&nbsp;<span class='menu_href'><a onClick="return showAddress('Sugar Land,houston,tx','show','','','','','',3)" href="#" class='menu_href'>Sugar Land/Stafford</a></span>&nbsp;<span class='menu_href'>|</span><!-- &nbsp;<span class='menu_href'><a onClick="return showAddress('galveston,tx','show','','','','','',5)" href="#" class='menu_href'>Galveston</a></span>&nbsp;<span class='menu_href'>|</span> -->&nbsp;<span class='menu_href'><a onClick="return showAddress('West University Place,houston,tx','show','','','','','',6)" href="#" class='menu_href'>West University/Kirby</a></span><br><br>
<div id="map" style="width: 780px; height: 400px"><img src='http://www.tonightat8.com/images/tonightat8-googlemap.gif' border="0" usemap="#Map"></div>
        </div>
        <div id="best_recommendation">
<span style="font-size:12px; color:#FFFFFF; font-weight:bold; display:block; margin-top:15px;font-family:Arial;">Best Recommendations for Houston Tonight</span>
         <!--  <div style=" width:504px; height:2px; background-color:#666666; margin-top:4px; margin-bottom:4px;"> -->
		  
		  </div>
          		 <br>
		 <div id="page_div">
			  
		  		<div style=" width:504px; height:35px; margin-left:160px;">
			  	
			  	</div>
		 </div>
		 
		
		 
		 
		  
        </div>
      </div>
	  {if $user_session_id == ""}
      <div class="contentright">

        <div class=""><div class=""></div>
              <div class=""></div></div>
			  {/if}
         <!--<br>-->
		
      
		{if $user_session_id == ""}
		  <!-- <div class="signup_new">
          <div class="singup"><a onClick="disp_and_hide('new_sign_up');"><img src="images/signup_hangout.gif" style="cursor:pointer " ></a></div> 
        </div> -->{include file='user_signup.tpl'}
		{/if}
		
      </div>
    </td>
        <td width="265" valign="top">
<br>
<table border="0" align="center">
<tr>
<td>{$messages_of_shelley}</td>
</tr>
<tr>
<td><img src="images/shelley.gif" border="0"><br>
<div class="shelley_fb"> <span class="shelley_fb_name">Shelley Boozer</span><br><br><span class="shelley_as_friend">Add Shelley as friend on </span><span ><a href="http://www.facebook.com/shelleyboozer?ref=search&sid=1174727874.2584453459..1" target="_blank" class="">&nbsp;<img src="images/facebook_button.gif" border="0" align="top"></a></span></div></td>
</tr>
<tr>
<td height="165px"><a href="http://www.thrillseekerstravelclub.com" target="_blank"><img src="images/travel-club1.gif" border="0"></a></td>
</tr>
<tr>
<td>{$messages_of_melissa}</td>
</tr>
<tr>
<td><img src="images/melissa.gif" border="0"><br><div class="melissa_fb"> <span class="shelley_fb_name">Melissa Howard</span><br><br><span class="shelley_as_friend">Add Melissa as friend on &nbsp;</span><span class=""><a href="http://www.facebook.com/search/?flt=1&q=melissa+howard&o=2048&sid=1174727874.4022588498..1&s=20#/profile.php?id=38704425&ref=search&sid=1174727874.4022588498..1" target="_blank" class=""><img src="images/facebook_button.gif" border="0" align="absmiddle"></a></span></div></td>
</tr>
</table>
</td>
      </tr>
    </table>
  </div>
  <!--banner ends here-->
    





<br>
    {include file='footer.tpl'}
  </div>
</div>


<map name="Map"><area shape="rect" coords="273,44,446,153" onClick="return showAddress('North Houston,houston,tx','show','','','','','',4)" href="#"><area shape="rect" coords="287,175,369,230" href="#" onClick="return showAddress('Galleria,houston,tx','show','','','','','',2)"><area shape="rect" coords="382,179,470,234" href="#" onClick="showAddress('Downtown,houston,tx','show','','','','','',1)"><area shape="rect" coords="333,220,415,271" href="#" onClick="return showAddress('West University Place,houston,tx','show','','','','','',6)"><area shape="rect" coords="162,278,302,356" href="#" onClick="return showAddress('Sugar Land,houston,tx','show','','','','','',3)"></map><script type="text/javascript">

MM_preloadImages('images/readmoreover.gif','images/postcommentsover.gif','images/submitover.gif');
initialize();

</script></body>
</html>
