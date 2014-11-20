<!--<gallary>-->
    <link href="css/royalslider.css" rel="stylesheet">
    <script src="css/jquery.royalslider.mind3fb.js?v=9.3.4"></script>
    <link href="css/rs-defaulte166.css?v=1.0.4" rel="stylesheet">
<style>
#gallery-1 {
	  width: 100%;
	  -webkit-user-select: none;
	  -moz-user-select: none;  
	  user-select: none;
}
.category_gallary {
    background: url("images/sub_page/category_bg.png") repeat-x scroll left top #FD7217;
    width: 200px;
}
.cont_right_gallary  {
	width:715px;

}
.accordsuffix {
	display:none;
}
    </style>

<div class="col span_4 fwImage">
  <div id="gallery-1" class="royalSlider rsDefault">
    <a class="rsImg"  data-rsBigImg="images/1.jpg" href="images/1.jpg">Vincent van Gogh - Still Life: Vase with Twelve Sunflowers<img width="120" height="75" class="rsTmb" src="images/1.jpg" /></a>
    <a class="rsImg"  data-rsBigImg="images/2.jpg" href="images/2.jpg">Vincent van Gogh - The Starry Night<img width="120" height="75" class="rsTmb" src="images/2.jpg" /></a>
    <a class="rsImg" data-rsBigImg="images/3.jpg" href="images/3.jpg">Leonardo da Vinci - Mona Lisa<img width="120" height="75" class="rsTmb" src="images/3.jpg" /></a>
    <a class="rsImg" data-rsBigImg="images/4.jpg" href="images/4.jpg">Grant DeVolson Wood - American Gothic<img width="120" height="75" class="rsTmb" src="images/4.jpg" /></a>
    <a class="rsImg" data-rsBigImg="images/5.jpg" href="images/5.jpg">Rembrandt - The Night Watch<img width="120" height="75" class="rsTmb" src="images/5.jpg" /></a>
    <a class="rsImg" data-rsBigImg="images/6.jpg" href="images/6.jpg">Johannes Vermeer - Girl with a Pearl Earring<img width="120" height="75" class="rsTmb" src="images/6.jpg" /></a>
    <a class="rsImg" data-rsBigImg="images/7.jpg" href="images/7.jpg">Paul Cezanne - Card Players<img width="120" height="75" class="rsTmb" src="images/7.jpg" /></a>
    <a class="rsImg" data-rsBigImg="images/8.jpg" href="images/8.jpg">Ilya Repin - Reply of the Zaporozhian Cossacks<img width="120" height="75" class="rsTmb" src="images/8.jpg" /></a>
  </div>
</div>
<script>
      jQuery(document).ready(function($) {
  $('#gallery-1').royalSlider({
    fullscreen: {
      enabled: true,
      nativeFS: false
    },
    controlNavigation: 'thumbnails',
    autoScaleSlider: false, 
    autoScaleSliderWidth:1500,     
    autoScaleSliderHeight: 1500,
    loop: true,
    imageScaleMode: 'fit-if-smaller',
    navigateByClick: true,
    numImagesToPreload:3,
    arrowsNavAutoHide: true,
    arrowsNavHideOnTouch: true,
    keyboardNavEnabled: true,
    fadeinLoadedSlide: true,
    globalCaption: true,
    globalCaptionInside: false,
    thumbs: {
     appendSpan: true,
     firstMargin: true,
     paddingBottom: 4,
	 orientation: 'vertical'

    }
  });
});

    </script>
<!--<gallary>-->