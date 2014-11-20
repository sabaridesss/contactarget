
<?php

$content_html.='<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="google-site-verification" content="HAmClMrTChhktEwZ7ivYC64sFEG-28uFPDz-4TSa5Z8" />
<meta name="msvalidate.01" content="C9436AE4100DD3B916EF4ED938717F2D" />
<title>'.$meta_title.'</title>
<meta name="description" content="'.$meta_content.'"/>
<meta name="keywords" content="'.$meta_keyword.'"/>
<!--<script type="text/javascript" src="../js/menu_jquery.js"></script>-->
<link type="text/css" href="../css/menu.css" rel="stylesheet" />
<!--<script type="text/javascript" src="../js/menu.js"></script>-->
<link rel="stylesheet" type="text/css" href="../css/reset.css">
<link rel="stylesheet" type="text/css" href="../css/support.css">
<link href="../css/menu-style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/main_slider.css">
<link rel="stylesheet" type="text/css" href="../css/style_tab_slider.css">
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/phone_validation.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.maskedinput-1.2.2.min.js"></script>
<script type="text/javascript">
function gen_search(elem)
	{
	if(elem.value.length == 0){
		alert("Please Enter Some Keywords");
		elem.focus(); // set the focus to this input
		return false;
	}
	return true;
}

function search_data(){
var search_data = document.getElementById(\'searchField\').value;
window.location = "search_result.php?search_data="+search_data;
}
$(document).ready(function() {
	$("input.PhoneMask").mask("(999)999-9999");

});
</script>
<link href="../css/desss_style.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
    <script type="text/javascript" src="../js/html5.js"></script>
    <link rel="stylesheet" href="../css/ie.css" type="text/css" media="screen">
<![endif]-->
<!--[if IE 8]>
<link href="../css/ie8.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--[if IE 7]>
<link href="../css/ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!--<slider>-->

<script type="text/javascript" src="../js/s3Slider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(\'#slider\').s3Slider({
            timeOut: 3000
        });
    });
</script>
<!--<slider>-->
<!--<tab>-->
<!--    <script src=\'http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js\'></script>-->
<script src="../js/organictabs.jquery.js"></script>
<script>
        $(function() {
            $("#example-two").organicTabs({
                "speed": 200
            });
        });
		
    </script>
<!--<tab>-->
<!--<submenu>-->
<script type="text/javascript" src="../js/jquery.hoverIntent.minified.js"></script>
<!--<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>-->
<script type="text/javascript" src="../js/validation.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	function megaHoverOver(){
		$(this).find(".sub").stop().fadeTo(\'fast\', 1).show();
			
		//Calculate width of all ul\'s
		(function($) { 
			jQuery.fn.calcSubWidth = function() {
				rowWidth = 0;
				//Calculate row
				$(this).find("ul").each(function() {					
					rowWidth += $(this).width(); 
				});	
			};
		})(jQuery); 
		
		if ( $(this).find(".row").length > 0 ) { //If row exists...
			var biggestRow = 0;	
			//Calculate each row
			$(this).find(".row").each(function() {							   
				$(this).calcSubWidth();
				//Find biggest row
				if(rowWidth > biggestRow) {
					biggestRow = rowWidth;
				}
			});
			//Set width
			$(this).find(".sub").css({\'width\' :biggestRow});
			$(this).find(".row:last").css({\'margin\':\'0\'});
			
		} else { //If row does not exist...
			
			$(this).calcSubWidth();
			//Set Width
			$(this).find(".sub").css({\'width\' : rowWidth});
		}
	}
	function megaHoverOut(){ 
	  $(this).find(".sub").stop().fadeTo(\'fast\', 0, function() {
		  $(this).hide(); 
	  });
	}
	var config = {    
		 sensitivity: 2, // number = sensitivity threshold (must be 1 or higher)    
		 interval: 100, // number = milliseconds for onMouseOver polling interval    
		 over: megaHoverOver, // function = onMouseOver callback (REQUIRED)    
		 timeout: 100, // number = milliseconds delay before onMouseOut    
		 out: megaHoverOut // function = onMouseOut callback (REQUIRED)    
	};

	$("ul#topnav li .sub").css({\'opacity\':\'0\'});
	$("ul#topnav li").hoverIntent(config);
});
</script>';
$content_html.="
<script type='text/javascript'>        $( function() {

            var loaded = false,
                behaviorId,
                behaviorUrl = 'js/PIE.htc';

            function getBorderRadiusCss() {
                var on = $( '#borderRadiusToggle' ).is(':checked'),
                    size = $( '#borderRadiusSize' ).val();
                return on ? [ '-webkit-border-radius: ' + size + 'px;', '-moz-border-radius: ' + size + 'px;', 'border-radius: ' + size + 'px;' ] : []
            }

            function getBoxShadowCss() {
                var on = $( '#boxShadowToggle' ).is(':checked'),
                    x = $( '#boxShadowX' ).val(),
                    y = $( '#boxShadowY' ).val(),
                    blur = $( '#boxShadowBlur' ).val(),
                    cssVal = on ? '#666 ' + x + 'px ' + y + 'px ' + blur + 'px;' : '';
                return cssVal ? [ '-webkit-box-shadow: ' + cssVal, '-moz-box-shadow: ' + cssVal, 'box-shadow: ' + cssVal ] : [];
            }

            function getGradientCss() {
                var on = $( '#gradientToggle' ).is(':checked'),
                    color1 = $( '#gradientColor1' ).val(),
                    color2 = $( '#gradientColor2' ).val(),
                    css = [ 'background: ' + color1 + ';' ];
                if( on ) {
                    css.push( 'background: -webkit-gradient(linear, 0 0, 0 bottom, from(' + color1 + '), to(' + color2 + '));' );
                    css.push( 'background: -webkit-linear-gradient(' + color1 + ', ' + color2 + ');' );
                    css.push( 'background: -moz-linear-gradient(' + color1 + ', ' + color2 + ');' );
                    css.push( 'background: -ms-linear-gradient(' + color1 + ', ' + color2 + ');' );
                    css.push( 'background: -o-linear-gradient(' + color1 + ', ' + color2 + ');' );
                    css.push( 'background: linear-gradient(' + color1 + ', ' + color2 + ');' );
                    if( $( '#pieToggle' ).is(':checked') ) {
                        css.push( '-pie-background: linear-gradient(' + color1 + ', ' + color2 + ');' );
                    }
                }
                return css;
            }

            function updateCss() {
                var tgtEl = $( '.content_header request_inner_bg submit_request client_head client_inner' )[0],
				
                    css = [ 'border: 1px solid #696;', 'padding: 60px 0;', 'text-align: center; width: 200px;' ].concat( getBorderRadiusCss() ).concat( getBoxShadowCss() ).concat( getGradientCss() );

                if( $( '#pieToggle' ).is(':checked') ) {
                    css.push( 'behavior: url(' + behaviorUrl + ');' );
                }
                $( '#output' ).html( css.join( '<br>' ) );

                tgtEl.style.cssText = css.join( '' );

                if( tgtEl.addBehavior ) {
                    if( $( '#pieToggle' ).is(':checked') ) {
                        if( !behaviorId ) {
                            behaviorId = tgtEl.addBehavior( behaviorUrl );
                        }
                    }
                    else if( behaviorId ) {
                        tgtEl.removeBehavior( behaviorId );
                        behaviorId = null;
                    }
                }
            }

            function updateDetailsVis() {
                $( '#controls .toggle > input' ).each( function() {
                    var checked = this.checked,
                        deets = $( this ).closest( 'fieldset' ).find( '.details' );
                    if( loaded ) {
                        deets[ checked ? 'fadeIn' : 'fadeOut' ]( 'fast' );
                    } else {
                        deets[ checked ? 'show' : 'hide' ]();
                    }
                } );
            }

            function updateCodeVis() {
                var checked = $( '#codeToggle' ).is( ':checked' ),
                    code = $( '#output' );
                if( loaded ) {
                    code[ checked ? 'slideDown' : 'slideUp' ]( 'fast' );
                } else {
                    code[ checked ? 'show' : 'hide' ]();
                }
            }

            $( '#controls input' ).change( updateCss );
            $( '#controls .toggle > input' ).change( updateDetailsVis );
            $( '#codeToggle' ).change( updateCodeVis );

            $( '#controls input.color' ).each( function() {
                var inp = $( this ),
                    picker = $( '<div class=\"colorPicker\"/>' ),
                    farb = $.farbtastic( picker, function( c ) {
                        if( c ) {
                            inp[0].value = c.toUpperCase();
                            inp.change();
                        }
                    } );

                inp.focus( function() {
                    farb.setColor( this.value );
                    picker.css( inp.position() ).fadeIn();
                    $( document ).bind( 'mousedown', function handler() {
                        picker.fadeOut();
                        $( this ).unbind( 'mousedown', handler )
                    } );
                } );

                picker.insertAfter( inp ).hide().mousedown( function( e ) {
                    e.stopPropagation();
                } );
            } );

            updateCss();
            updateDetailsVis();
            updateCodeVis();
            loaded = true;
        } );  
</script>
<script type=\"text/javascript\" src=\"js/jquery.hoverIntent.minified.js\"></script>
<script type=\"text/javascript\" src=\"js/validation.js\"></script>
<script type=\"text/javascript\">
$(document).ready(function() {
	function megaHoverOver(){
		$(this).find(\".sub\").stop().fadeTo('fast', 1).show();
		//Calculate width of all ul's
		(function($) { 
			jQuery.fn.calcSubWidth = function() {
				rowWidth = 0;
				//Calculate row
				$(this).find(\"ul\").each(function() {					
					rowWidth += $(this).width(); 
				});	
			};
		})(jQuery); 
		if ( $(this).find(\".row\").length > 0 ) { //If row exists...
			var biggestRow = 0;	
			//Calculate each row
			$(this).find(\".row\").each(function() {							   
				$(this).calcSubWidth();
				//Find biggest row
				if(rowWidth > biggestRow) {
					biggestRow = rowWidth;
				}
			});
			//Set width
			$(this).find(\".sub\").css({'width' :biggestRow});
			$(this).find(\".row:last\").css({'margin':'0'});
			
		} else { //If row does not exist...
			
			$(this).calcSubWidth();
			//Set Width
			$(this).find(\".sub\").css({'width' : rowWidth});
		}
	}
	function megaHoverOut(){ 
	  $(this).find(\".sub\").stop().fadeTo('fast', 0, function() {
		  $(this).hide(); 
	  });
	}
	var config = {    
		 sensitivity: 2, // number = sensitivity threshold (must be 1 or higher)    
		 interval: 100, // number = milliseconds for onMouseOver polling interval    
		 over: megaHoverOver, // function = onMouseOver callback (REQUIRED)    
		 timeout: 100, // number = milliseconds delay before onMouseOut    
		 out: megaHoverOut // function = onMouseOut callback (REQUIRED)    
	};

	$(\"ul#topnav li .sub\").css({'opacity':'0'});
	$(\"ul#topnav li\").hoverIntent(config);
});
</script>
</head>
<body>
<header>";
$content_html.='  <div class="header_inner">
    <div class="wrapper">
      <div class="logo fleft"> <a href="../index.php" alt="DESSS APPLYING TECHNOLOGIES" title="DESSS APPLYING TECHNOLOGIES"><img src="../images/logo.jpg"></a> </div>
      <div class="header_right fright">
        <div class="search fright">
          <p class="search_text fleft">Search :</p>
         <form action="../search.php" method="post">
          <input type="text" id="search" name="search" class="search_text_bx fleft">
          <input type="submit" id="submit" name="text" class="search_submit_button fleft" value="&nbsp;" onClick="return gen_search(search)">
          </form>
          <div class="spacer"></div>
        </div>
        <div class="spacer"></div>
        <div class="small_menu MT25">
          <nav>
            <ul>
            '.pages().'
                  </ul>
          </nav>
        </div>
       	<div>
    <!--menu starts here-->
<!--navi div starts here-->
    <ul id="topnav">
         '.$menus.'
    </ul>
<script type="text/javascript" src="../js/jquery.hoverIntent.minified.js"></script>
<!--<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>-->
<script type="text/javascript" src="../js/validation.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	

	function megaHoverOver(){
		$(this).find(".sub").stop().fadeTo(\'fast\', 1).show();
			
		//Calculate width of all ul\'s
		(function($) { 
			jQuery.fn.calcSubWidth = function() {
				rowWidth = 0;
				//Calculate row
				$(this).find("ul").each(function() {					
					rowWidth += $(this).width(); 
				});	
			};
		})(jQuery); 
		
		if ( $(this).find(".row").length > 0 ) { //If row exists...
			var biggestRow = 0;	
			//Calculate each row
			$(this).find(".row").each(function() {							   
				$(this).calcSubWidth();
				//Find biggest row
				if(rowWidth > biggestRow) {
					biggestRow = rowWidth;
				}
			});
			//Set width
			$(this).find(".sub").css({\'width\' :biggestRow});
			$(this).find(".row:last").css({\'margin\':\'0\'});
			
		} else { //If row does not exist...
			
			$(this).calcSubWidth();
			//Set Width
			$(this).find(".sub").css({\'width\' : rowWidth});
			
		}
	}
	
	function megaHoverOut(){ 
	  $(this).find(".sub").stop().fadeTo(\'fast\', 0, function() {
		  $(this).hide(); 
	  });
	}


	var config = {    
		 sensitivity: 2, // number = sensitivity threshold (must be 1 or higher)    
		 interval: 100, // number = milliseconds for onMouseOver polling interval    
		 over: megaHoverOver, // function = onMouseOver callback (REQUIRED)    
		 timeout: 100, // number = milliseconds delay before onMouseOut    
		 out: megaHoverOut // function = onMouseOut callback (REQUIRED)    
	};

	$("ul#topnav li .sub").css({\'opacity\':\'0\'});
	$("ul#topnav li").hoverIntent(config);



});



</script>

      </div>
      <div id="copyright " style="display:none;">Copyright &copy; 2012 <a href="http://apycom.com/">Apycom jQuery Menus</a></div>
      <div class="spacer"></div>
    </div>
  </div>
</header>
<div class="spacer"></div>
<section>
  <div class="wrapper section_body">
    <div class="container_left fleft PT10">';
	
	
	
	if($eventimage=="")
{
$content_html.='	
      <div id="slider">
        <ul id="sliderContent">
          <li class="sliderImage"> <a href="../"><img src="../images/1.png" alt="1" /></a> <span class="top">
            <div class="wid_340">
              <p  class="title_desss_slider">Staffing</p>
              <p  class="title1_desss_slider">What\'s New</p>
              <p  class="small_desss_slider">CDP Partners with Dess, Microsoft and SAP to Establish the DE FActo Global Climate Change Data and Reporting Platform</p>
              <br />
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">High Performance Business
                  Initiative</p>
                <p  class="small_desss_slider">See How Bussinesses Outperform the Competition</p>
                <br />
                <p  class="title1_desss_slider">How may we help you?</p>
                <p  class="small_desss_slider">Contact Us
                <p  class="small_desss_slider">Request for Services</p>

                <p  class="small_desss_slider">Your Content</p>
                <p  class="small_desss_slider">E-mail Alerts & News Letters</p>
                </p>
              </div>
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">Inside Desss.com</p>
                <p  class="small_desss_slider">Client Successes</p>
                <p  class="small_desss_slider">Locations</p>
                <p  class="small_desss_slider">Corperate Governance</p>
                <p  class="small_desss_slider">Code of Business Ethics</p>
                <p  class="small_desss_slider">Investor Relations</p>
                <p  class="small_desss_slider">Newsroom</p>
                <p  class="small_desss_slider">Outlook Jornal</p>
                <p  class="small_desss_slider">RSS & Podcasts</p>
                <p  class="small_desss_slider">Blogs</p>
              </div>
            </div>
            </span> </li>
          <li class="sliderImage"> <a href="../"><img src="../images/2.png" alt="2" /></a> <span class="bottom">
            <div class="wid_340">
              <p  class="title_desss_slider">Technology</p>
              <p  class="title1_desss_slider">What\'s New</p>
              <p  class="small_desss_slider">CDP Partners with Dess, Microsoft and SAP to Establish the DE FActo Global Climate Change Data and Reporting Platform</p>
              <br />
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">High Performance Business
                  Initiative</p>
                <p  class="small_desss_slider">See How Bussinesses Outperform the Competition</p>
                <br />
                <p  class="title1_desss_slider">How may we help you?</p>
                <p  class="small_desss_slider">Contact Us
                <p  class="small_desss_slider">Request for Services</p>
                <p  class="small_desss_slider">Your Content</p>
                <p  class="small_desss_slider">E-mail Alerts & News Letters</p>
                </p>
              </div>
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">Inside Desss.com</p>
                <p  class="small_desss_slider">Client Successes</p>
                <p  class="small_desss_slider">Locations</p>
                <p  class="small_desss_slider">Corperate Governance</p>
                <p  class="small_desss_slider">Code of Business Ethics</p>
                <p  class="small_desss_slider">Investor Relations</p>
                <p  class="small_desss_slider">Newsroom</p>
                <p  class="small_desss_slider">Outlook Jornal</p>
                <p  class="small_desss_slider">RSS & Podcasts</p>
                <p  class="small_desss_slider">Blogs</p>
              </div>
            </div>
            </span> </li>
          <li class="sliderImage"> <img src="../images/3.png" alt="3" /> <span class="top">
            <div class="wid_340">
              <p  class="title_desss_slider">Out Sourcing</p>
              <p  class="title1_desss_slider">What\'s New</p>
              <p  class="small_desss_slider">CDP Partners with Dess, Microsoft and SAP to Establish the DE FActo Global Climate Change Data and Reporting Platform</p>
              <br />
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">High Performance Business
                  Initiative</p>
                <p  class="small_desss_slider">See How Bussinesses Outperform the Competition</p>
                <br />
                <p  class="title1_desss_slider">How may we help you?</p>
                <p  class="small_desss_slider">Contact Us
                <p  class="small_desss_slider">Request for Services</p>
                <p  class="small_desss_slider">Your Content</p>
                <p  class="small_desss_slider">E-mail Alerts & News Letters</p>
                </p>
              </div>
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">Inside Desss.com</p>
                <p  class="small_desss_slider">Client Successes</p>
                <p  class="small_desss_slider">Locations</p>
                <p  class="small_desss_slider">Corperate Governance</p>
                <p  class="small_desss_slider">Code of Business Ethics</p>
                <p  class="small_desss_slider">Investor Relations</p>
                <p  class="small_desss_slider">Newsroom</p>
                <p  class="small_desss_slider">Outlook Jornal</p>
                <p  class="small_desss_slider">RSS & Podcasts</p>
                <p  class="small_desss_slider">Blogs</p>
              </div>
            </div>
            </span> </li>
          <li class="sliderImage"> <img src="../images/4.png" alt="4" /> <span class="bottom">
            <div class="wid_340">
              <p  class="title_desss_slider">Media</p>
              <p  class="title1_desss_slider">What\'s New</p>
              <p  class="small_desss_slider">CDP Partners with Dess, Microsoft and SAP to Establish the DE FActo Global Climate Change Data and Reporting Platform</p>
              <br />
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">High Performance Business
                  Initiative</p>
                <p  class="small_desss_slider">See How Bussinesses Outperform the Competition</p>
                <br />
                <p  class="title1_desss_slider">How may we help you?</p>
                <p  class="small_desss_slider">Contact Us
                <p  class="small_desss_slider">Request for Services</p>
                <p  class="small_desss_slider">Your Content</p>
                <p  class="small_desss_slider">E-mail Alerts & News Letters</p>
                </p>
              </div>
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">Inside Desss.com</p>
                <p  class="small_desss_slider">Client Successes</p>
                <p  class="small_desss_slider">Locations</p>
                <p  class="small_desss_slider">Corperate Governance</p>
                <p  class="small_desss_slider">Code of Business Ethics</p>
                <p  class="small_desss_slider">Investor Relations</p>
                <p  class="small_desss_slider">Newsroom</p>
                <p  class="small_desss_slider">Outlook Jornal</p>
                <p  class="small_desss_slider">RSS & Podcasts</p>
                <p  class="small_desss_slider">Blogs</p>
              </div>
            </div>
            </span> </li>
          <li class="sliderImage"> <img src="../images/5.png" alt="4" /> <span class="top">
            <div class="wid_340">
              <p  class="title_desss_slider">Products</p>
              <p  class="title1_desss_slider">What\'s New</p>
              <p  class="small_desss_slider">CDP Partners with Dess, Microsoft and SAP to Establish the DE FActo Global Climate Change Data and Reporting Platform</p>
              <br />
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">High Performance Business
                  Initiative</p>
                <p  class="small_desss_slider">See How Bussinesses Outperform the Competition</p>
                <br />
                <p  class="title1_desss_slider">How may we help you?</p>
                <p  class="small_desss_slider">Contact Us
                <p  class="small_desss_slider">Request for Services</p>
                <p  class="small_desss_slider">Your Content</p>
                <p  class="small_desss_slider">E-mail Alerts & News Letters</p>
                </p>
              </div>
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">Inside Desss.com</p>
                <p  class="small_desss_slider">Client Successes</p>
                <p  class="small_desss_slider">Locations</p>
                <p  class="small_desss_slider">Corperate Governance</p>
                <p  class="small_desss_slider">Code of Business Ethics</p>
                <p  class="small_desss_slider">Investor Relations</p>
                <p  class="small_desss_slider">Newsroom</p>
                <p  class="small_desss_slider">Outlook Jornal</p>
                <p  class="small_desss_slider">RSS & Podcasts</p>
                <p  class="small_desss_slider">Blogs</p>
              </div>
            </div>
            </span> </li>
          <li class="sliderImage"> <img src="../images/6.png" alt="4" /> <span class="bottom">
            <div class="wid_340">
              <p  class="title_desss_slider">Consulting</p>
              <p  class="title1_desss_slider">What\'s New</p>
              <p  class="small_desss_slider">CDP Partners with Dess, Microsoft and SAP to Establish the DE FActo Global Climate Change Data and Reporting Platform</p>
              <br />
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">High Performance Business
                  Initiative</p>
                <p  class="small_desss_slider">See How Bussinesses Outperform the Competition</p>
                <br />
                <p  class="title1_desss_slider">How may we help you?</p>
                <p  class="small_desss_slider">Contact Us
                <p  class="small_desss_slider">Request for Services</p>
                <p  class="small_desss_slider">Your Content</p>
                <p  class="small_desss_slider">E-mail Alerts & News Letters</p>
                </p>
              </div>
              <div class="ffleft wid_158">
                <p  class="title1_desss_slider">Inside Desss.com</p>
                <p  class="small_desss_slider">Client Successes</p>
                <p  class="small_desss_slider">Locations</p>
                <p  class="small_desss_slider">Corperate Governance</p>
                <p  class="small_desss_slider">Code of Business Ethics</p>
                <p  class="small_desss_slider">Investor Relations</p>
                <p  class="small_desss_slider">Newsroom</p>
                <p  class="small_desss_slider">Outlook Jornal</p>
                <p  class="small_desss_slider">RSS & Podcasts</p>
                <p  class="small_desss_slider">Blogs</p>
              </div>
            </div>
            </span> </li>
          <div class="clear sliderImage"></div>
        </ul>
      </div>';
	}
else
{
$content_html.='<a href="" ><img src="../uplodeImage/thumbImg/'.$eventimage.'" width="932px" height="357px"  /></a>';
 }  
	  
	  
	  
	  
	  
 $content_html.='     <div class="MT10 MB10 PL10 PR10 content_desss1">
        <h1>'.$header_title1.'</h1>
      ';
		$content_html.=stripslashes($content);
		$content_html.='
        <div class="aligncenter wid_684">
        <a href="../#" class="request_button ML15 fleft"> </a> 
        <a href="../#" class="request_email ML15 fleft"> </a>
        <a href="../#" class="request_chat ML15 fleft"> </a> 
        <div class="spacer"></div>
        </div>
        
        <!--<div class="services_sub_page"> <img src="../images/services_head.png">
          <ul class="services_icons">
            <li><a href="../#"> Blackberry App Development</a></li>
            <li><a href="../#"> Windows App Development</a> </li>
            <li><a href="../#"> Android App Development</a> </li>
            <li><a href="../#">iPad Game Development</a> </li>
            <li><a href="../#"> Android Game Development</a> </li>
            <li><a href="../#"> iPad App Development</a> </li>
            <li><a href="../#">iPhone Game Development</a> </li>
            <li><a href="../#"> iphone App Development</a> </li>
            <li><a href="../#"> Blackberry App Development</a></li>
            <li><a href="../#"> Windows App Development</a> </li>
            <li><a href="../#"> Android App Development</a> </li>
            <li><a href="../#">iPad Game Development</a> </li>
            <li><a href="../#"> Android Game Development</a> </li>
            <li><a href="../#"> iPad App Development</a> </li>
            <li><a href="../#">iPhone Game Development</a> </li>
            <li><a href="../#"> iphone App Development</a> </li>
            <li><a href="../#"> Blackberry App Development</a></li>
            <li><a href="../#"> Windows App Development</a> </li>
            <li><a href="../#"> Android App Development</a> </li>
            <li><a href="../#">iPad Game Development</a> </li>
            <li><a href="../#"> Android Game Development</a> </li>
            <li><a href="../#"> iPad App Development</a> </li>
            <li><a href="../#">iPhone Game Development</a> </li>
            <li><a href="../#"> iphone App Development</a> </li>
            <div class="spacer"></div>
          </ul>
          <img src="../images/services_bottom.png">
          <div class="MT10 wid_900"> <a href="../" class="ffleft request_quote_bottom"></a>
            <p class="ffleft request_q_letter">To know more about us, our offshore custom software application development services and outsourced solutions, drop us a message or mail us at info@desss.com</p>
            <div class="spacer"></div>
          </div>
        </div>-->
        <div class="spacer"></div>
      </div>
    </div>
    <aside class="fright">
      <div class="MB10"> <a href="../#" class="request_quote"></a> </div>
      <div class="call_service">
        <p class="box_head PL10">Get in Touch</p>
        <div class="request_inner_bg PB10 box-quote"> <img src="../images/phone_icon.png" class="ffleft MT8 ML25"> <span class="fright MT8 MR20">
          <p class="call_font">'.$contact_number.'</p>
          <!--   <p class="call_font">(877)293-1237</p>--> 
          </span>
          <div class="spacer"></div>
          <img src="../images/mail_icon.png" class="ffleft MT8 ML25"><span class="fright MT8 MR20">
          <p class="call_font ">E-mail us</p>
          </span>
          <div class="spacer"></div>
        </div>
        <div> </div>
      </div>
      <div class="call_service MT10">
        <p class="box_head PL10">Quick Contact </p>
        <div class="request_inner_bg PB10 box-quote">
        <form  method="post" action="http://www.desss.com/code.php" name="contactus" id="contactus"/>
         <table>
     
            <tr >
              <td ><input type="text" name="Name_field" id="Name_field"  class="text_box1" maxlength="50" tabindex="1" onFocus="if(this.value == \'Name\') {this.value = \'\';}"onblur="if(this.value == \'\') {this.value = \'Name\';}" value="Name"></td>
            </tr>
            <tr>
              <td><input id="Phone_field" class="text_box1" type="text" onkeydown="return mask(event,this)" onkeyup="return mask(event,this)" maxlength="12" onBlur="if (this.value == \'\') {this.value = \'Phone\';}" onFocus="if(this.value == \'Phone\') {this.value = \'\';}"  name="Phone_field"  tabindex="2" value="Phone"></td>
            </tr>
            <tr>
              <td><input type="text" name="Email_field" id="Email_field"  class="text_box1" maxlength="50" tabindex="3" onFocus="if(this.value == \'Email\') {this.value = \'\';}" onBlur="if (this.value == \'\') {this.value = \'Email\';}" value="Email"></td>
            </tr>
            <tr>
              <td><textarea class="text_area1" name="Comment_field" id="Comment_field"  maxlength="150" tabindex="4" onFocus="if(this.value == \'Comments\') {this.value = \'\';}" onBlur="if(this.value == \'\') {this.value = \'Comments\';}" onKeyDown="limitText(this,150);" 
onKeyUp="limitText(this,150);">Comments</textarea></td>
            </tr>
            <tr><td class="aligncenter">
           
              <input type="button" id="submit_qc" name="submit_qc" class="submit_request MT8" value="Contact Me"  tabindex="5" onClick="javascript:formValidator();"></td>
            </tr>
   </table></form>
        </div>
       <div> </div>
      </div>
     <div class="call_service MT10">
        <p class="box_head PL10">Services</p>
        <div class="request_inner_bg PB10 box-quote">
          <ul class="services_icons1">
          '.sidebarEach($page_id).'
           
            <div class="spacer"></div>
          </ul>
        </div>
        <div> </div>
      </div>
    </aside>
    <div class="spacer"></div>
    <div class="MT10 MB10">
      <div class="footer_lin box-quote">
  '.$footer_head.'
      </div>
      <div class="client_inner1 box-quote">
	  
	  '.$footer_content1.'
		
		
        <div class="spacer"></div>
      </div>
    </div>
  </div>
</section>
<div class="spacer"></div>
<footer>
  <div class="wrapper">
    <ul class="footer_menu aligncenter">
     '.footers().'
    </ul>
    <div class="spacer"></div>
    <p class="aligncenter footer_abv"><a href="http://www.desss.com"><img src="../images/rss_feed.gif" class="MT12"></a> <a href="http://www.facebook.com/DessInc" class="PL12"><img src="../images/face_book.gif" class="MT10"></a></p>
    <div class="spacer"></div>
    <p class="footer_copy">Copyright &copy; <a href="http://www.desss.com" target="_blank">DESSS</a> INC., 2011 <a href="http://validator.w3.org/">XHTML</a> <a href="../http://jigsaw.w3.org/css-validator/">CSS</a></p>
  </div>
</footer>'.$analitic['g_analitic'].'
</body>
</html>';

?>