
<?php

include("admin/smarty_config.php");
//include("request-quote.php");

$url = $_SERVER["REQUEST_URI"];
$connect=mysql_connect("localhost","wordpress_6","desss");
mysql_select_db("wordpress_8",$connect);

$url = $_SERVER["REQUEST_URI"];
$connect=mysql_connect("localhost","dessscmuser","@G53^#6!237s");
mysql_select_db("dessscmsdb",$connect);

//fetching records for menus
function pageURLName()
{
	    $uri = $_SERVER['REQUEST_URI'];
		$split_uri=explode('/',$uri);
		if($split_uri[2] == '')
		{
			$urlSplit = $split_uri[1];
		}
		else
		{
			$urlSplit = $split_uri[1].'/'.$split_uri[2];
		}	
		//$split_uri=explode('/',$uri);
		//$count=count($split_uri)-2;
		//$count=$split_uri[1];
		//$count=$split_uri[0];
		$count = $urlSplit;
		//$page_name=$split_uri[$count];
		//$page_name=$count;
		
		
		$page_name_New=$count;
		$page_name_New=str_replace("_"," ",$page_name_New);
		//  $page_name=$split_uri[$count];
		
		
		$cName=explode('-',$page_name_New);
		$displayCity = $cName[count($cName)-1];
		$displayCity2 = str_replace("_"," ",$displayCity);;
		$displayCity1 = explode('.',$displayCity2);
		$stack = array();
/*		$selectCity = 'SELECT site_city FROM websites_list_tbl';
		$exCity = mysql_query($selectCity);
		while($a = mysql_fetch_array($exCity))
		{
			array_push($stack, $a['site_city']);
		}*/
		
		//$disName = array("Dallas", "Chicago", "Los Angeles", "Houston", "New York", "Austin", "San Antonio", "Phoenix");
		$disName = $stack;
		
		//strtolower($str)
		$upCase = $displayCity1[0];
		if(in_array(strtolower($upCase), $disName))
		{
			
			$cityValue = $displayCity1[0];
			$displayPage1 = '-'.$displayCity1[0];
			
			$pageURL = str_replace($displayPage1, "", $page_name_New);
			
		}
		else
		{
			$cityValue = '';
			$pageURL = $page_name_New;
		} 

$pageURL.'+'.$cityValue;
	return $pageURL.'+'.$cityValue;
	
}

function menus()
{
	$fullPath = 'http://www.desss.com/';
	//$fullPath = 'http://192.168.1.132/sabari/desss_HTML5/';
	
	$query = "select * from menu_page_tbl where is_menu='1' order by order_id asc";
	$exQuery = mysql_query($query);
	while($row = mysql_fetch_array($exQuery))
	{	
		$menus.='';
		$numberRow = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id'];
		$numberRow1= mysql_query($numberRow);
		$numberRow2 = mysql_num_rows($numberRow1);
		if($numberRow2 == '0')
		{
			$menus.='<li><a href="'.$fullPath.''.$row['file_name'].'" class="home">'.$row['title'].'</a></li>';
		}
		else
		{
			$menus.='<li><a href="'.$fullPath.''.$row['file_name'].'" class="home">'.$row['title'].'</a>
			<div class="sub" >';
			$subMenu = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id'].' order by order_id asc';
			$subMenu1 = mysql_query($subMenu);
			$J = 0;
			while($row1 = mysql_fetch_array($subMenu1))
			{
				$numberRow3 = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'];
				$numberRow4= mysql_query($numberRow3);
				$numberRow5 = mysql_num_rows($numberRow4);
				if($numberRow5 == '0')
				{	
					if($J%2==0){
						$menus.='<ul style="width: 85px;">';
					}
					
					$menus.='<li><h2><a href="'.$fullPath.''.$row1['file_name'].'">'.$row1['title'].'</a></h2></li>';
					
					if($J%2==1){
						$menus.='</ul>';
					}
				}
				else
				{	
					
					if($J%2==0){
						$menus.='<ul style="width: 85px;">';
					}
					
					$menus.='<li ><h2><a href="'.$fullPath.''.$row1['file_name'].'">'.$row1['title'].'</a></h2></li>';
					
					$inserSubMenu = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'].' order by order_id asc';
					$inserSubMenu1 = mysql_query($inserSubMenu);
					while($row2 = mysql_fetch_array($inserSubMenu1))
					{
						$menus.='<li ><a href="'.$fullPath.''.$row2['file_name'].'">'.$row2['title'].'</a></li>';
					}
					
					if($J%2==1){
						$menus.='</ul>';
					}
						
				}
				$J++;
			}
	$menus.='</div></li>';
		}
	}

return $menus;

}


//fetching records for pages
function pages()
{
	$fullPath = 'http://www.desss.com/';
	//$fullPath = 'http://192.168.1.132/sabari/desss_HTML5/';
	$query = "";
	$query_result = "";
	$resultset = "";
	$footer = "";
	$pages = "";
	$query = "select b.title as title,b.file_name as file_name from top_banner a,menu_page_tbl b where a.Page_ID=b.id order by a.order_id asc";
	$query_result = mysql_query($query);
	
	if(mysql_num_rows($query_result)>0) {
	
		while($val = mysql_fetch_assoc($query_result)) {
		
			$pages.="<li><a href='".$fullPath."".$val['file_name']."'>".$val['title']."</a></li>";
		}
	}
	
	
	return $pages;

}

//fetching records for footers
function footers()
{
$fullPath = 'http://www.desss.com/';
//$fullPath = 'http://192.168.1.132/sabari/desss_HTML5/';
$query = "";
$query_result = "";
$resultset = "";
$footer = "";
$query = "select b.title as title,b.file_name as file_name from footer_tbl a,menu_page_tbl b where a.Page_ID=b.id";
$query_result = mysql_query($query);
$bottom_count=1;
$bottom_countr=mysql_num_rows($query_result);
while($resultset = mysql_fetch_assoc($query_result)){
if($bottom_count != $bottom_countr)
		 {
	$footer.="<li><a href='".$fullPath.$resultset['file_name']."'>".$resultset['title']."</a></li>";	
	}
	if($bottom_count == $bottom_countr)
		 {
		 $footer.='<li style="border:0px;"><a href="'.$fullPath.$resultset['file_name'].'">'.$resultset['title'].'</a></li>';
		 }
	
	$bottom_count++;
}


return $footer;
}

//fetching records from content and sub title
function content()
{
		$content = array();
		
//		$uri = $_SERVER['REQUEST_URI'];
//		$split_uri=explode('=',$uri);
//		
//		//$count1=count($split_uri)-1;
//		
//		$count=$split_uri[1];
//		$page_name_New=$count;
//		//  $page_name=$split_uri[$count];
//		
//		
//		$cName=explode('_',$page_name_New);
//		$displayCity = $cName[count($cName)-1];
//		
//		$displayCity1 = explode('.',$displayCity);
//		
//		$disName = array("Dallas", "Chicago", "Los Angeles", "Houston", "New York", "Austin", "San Antonio", "Phoenix");
//		if(in_array($displayCity1[0], $disName))
//		{
//			$displayPage1 = _.''.$displayCity1[0];
//			$page_name = str_replace($displayPage1, "", $page_name_New);
//		
//		}
//		else
//		{
//			$page_name = $page_name_New;
//		} 
		
		$pageURL = pageURLName();
		$addCity_uri1 = explode('+',$pageURL);
		//echo $addCity_uri1[2];
		if((isset($_REQUEST['msg'])) && ($_REQUEST['msg'] == 1)){
		$page_names = $addCity_uri1[0];
		$page_name = str_replace("?msg=1","",$page_names);
		}else{
		$page_name = $addCity_uri1[0];
		}
		
		if($page_name == '')
		{
			$page_name = 'http://www.desss.com/';
		}
		//$page_name_array=explode('?',$page_name);
		$msg = $_REQUEST['msg'];
		 //if($page_name_array[0] != "") {
		 if($page_name != "") {
		   // $page_id_query='select * from menu_page_tbl where file_name="'.$page_name_array[0].'"';	
			$page_id_query='select * from menu_page_tbl where file_name="'.$page_name.'"';	
			$page_id_query_exec=mysql_query($page_id_query);
			if(mysql_num_rows($page_id_query_exec) > 0) {
				$get_main_cat_array = mysql_fetch_array($page_id_query_exec);
				$imageId = $get_main_cat_array['id'];	
				
				$selectImage = 'SELECT * FROM image_gallery WHERE page_id ='.$imageId.' AND image_type = \'Thumb Image\' AND status = \'1\'';
				$exSelectImage = mysql_query($selectImage);
				$viewImage = mysql_fetch_array($exSelectImage);
				
				
				$thumImageAlt = $viewImage['alt_text'];
				if($viewImage['image_name'] == '')
				{
					$thumImage = 'noimg.jpg';
				}
				else
				{
					$thumImage = $viewImage['image_name'];
				}
				
				
				
				$selectImageGallery = 'SELECT * FROM image_gallery WHERE page_id ='.$imageId.' AND image_type = \'Image Gallery\' AND status = \'1\'';
				$exSelectImageGallery = mysql_query($selectImageGallery);
				$numImgGallery = mysql_num_rows($exSelectImageGallery);
				
				
				//$content = $get_main_cat_array['description'];
				//$content['sub_title'] = $get_main_cat_array['h1_title'];	
				//$content['sub_content'] = $get_main_cat_array['h2_title'];	
				//$content['meta_misc'] = $get_main_cat_array['meta_misc'];	
				//$content['meta_desc'] = $get_main_cat_array['meta_content'];
				//$content['meta_title'] = $get_main_cat_array['meta_title'];		
				//$content['meta_keyword'] = $get_main_cat_array['meta_keyword'];
				$content['title'] = $get_main_cat_array['title'];	
				$content['page_id'] = $get_main_cat_array['id'];
				$content['req_quo'] = $get_main_cat_array['req_quo'];
				if($addCity_uri1[1] != '')
				{
					//$content['content'] = $get_main_cat_array['real_description'];
					$getContent = $get_main_cat_array['real_description'];
					$getMisc = $get_main_cat_array['meta_misc'];
					$getDesc = $get_main_cat_array['meta_content'];
					$getTitle = $get_main_cat_array['meta_title'];
					$getKeyword = $get_main_cat_array['meta_keyword'];
					$h1Title = $get_main_cat_array['h1_title'];	
				    $h2Title = $get_main_cat_array['h2_title'];	
										
					$find = array("&lt;city&gt;","<city>","-&lt;city&gt;");
					$find1 = array("<city>");
					//$replace = ucfirst($addCity_uri1[1]);
					$replace = $addCity_uri1[1];
					$replaceS = str_replace(" ","_",$replace);
					//$content['content'] = str_replace($replace);
					$content['content'] = str_replace($find, $replace, $getContent);
					$fFind = $replace.'.html"';
					$SReplace = $replaceS.'.html"';
					$content['content'] = str_replace($fFind,$SReplace,$content['content']);
					
					$content['meta_misc'] = str_replace($find1, $replace, $getMisc);
					$content['meta_desc'] = str_replace($find1, $replace, $getDesc);
					$content['meta_title'] = str_replace($find1, $replace, $getTitle);
					$content['meta_keyword'] = str_replace($find1, $replace, $getKeyword);
					$content['sub_title'] = str_replace($find1, $replace, $h1Title);
					$content['sub_content'] = str_replace($find1, $replace, $h2Title);
				}
				else
				{
					
					$getContent = $get_main_cat_array['real_description'];
					$getMisc = $get_main_cat_array['meta_misc'];
					$getDesc = $get_main_cat_array['meta_content'];
					$getTitle = $get_main_cat_array['meta_title'];
					$getKeyword = $get_main_cat_array['meta_keyword'];
					$h1Title = $get_main_cat_array['h1_title'];	
				    $h2Title = $get_main_cat_array['h2_title'];	


					$find = array("&lt;city&gt;","<city>");
					$find1 = array("<city>");
					$findTit = array(" <city>");
					$find2 = array("-&lt;city&gt;","&lt;city&gt;");
					$content['content'] = str_replace($find2,"",$getContent);
					$content['meta_misc'] = str_replace($find1,"",$getMisc);
					$content['meta_desc'] = str_replace($find1,"",$getDesc);
					$content['meta_title'] = str_replace($findTit,"",$getTitle);
					$content['meta_keyword'] = str_replace($find1,"",$getKeyword);
					$content['sub_title'] = str_replace($find1,"",$h1Title);
					$content['sub_content'] = str_replace($find1,"",$h2Title);

				}	
					
			}	
		
		 }
		 //return $content;
		//return $thumImage;
		$content_part = array($content,$thumImage,$thumImageAlt);
		return $content_part;
}

//fetching records for Analitic Code
/*function analitic_code()
{
	$analitic = array();
	$query = "";
	$query_result = "";
	$resultset = "";
    $query = "select * from analitic_tbl";
	$query_result = mysql_query($query);
	$resultset = mysql_fetch_assoc($query_result);
	if(count($resultset)>0) {
		$analitic['meta_misc'] = $resultset['meta_misc'];

		echo $analitic1['g_analitic'] = $resultset['g_analitic'];
	
	} 
	
	return $analitic;
	
	
}*/
$select_anal         = "select * from analitic_tbl";
$select_imp          =  mysql_query($select_anal);
$count_analtic       =  mysql_num_rows($select_imp);
$analtic_fetch       =  mysql_fetch_array($select_imp);
$analtic_fetch['meta_misc'];
$analtic_fetch['g_analitic'];



/*function meta_misc_code()
{
	$analitic = array();
	$query = "";
	$query_result = "";
	$resultset = "";
    $query = "select * from analitic_tbl";
	$query_result = mysql_query($query);
	$resultset = mysql_fetch_assoc($query_result);
	if(count($resultset)>0) {
		echo $analitic['meta_misc'] = $resultset['meta_misc'];
		$analitic['g_analitic'] = $resultset['g_analitic'];
	} 
	
	return $analitic;
	
	
}*/

//Code for Email Subscription
function email_subscription()
{

 if(isset($_REQUEST['subscribe_x']) && isset($_REQUEST['subscribe_y'])) {

	$subs_email = $_REQUEST['subs_email'];
	$query = "select * from nl_subscribers_tbl where mail='".$subs_email."'";
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result)<=0){
	
		$query1 = "insert into nl_subscribers_tbl (mail) values ('".$subs_email."')";
		if(mysql_query($query1)) {
			$subs_msg = "Requested Email Subscribed";
		}
		
	}else{
		$subs_msg = "Email Already Subscribed";
	}
	
}

return $subs_msg;

}

//code for retrive search result
function search_result() {

	if(isset($_REQUEST['search_data'])) {
		$search_data_query = $_REQUEST['search_data'];
		$get_search_data = get_search_data($search_data_query,$limit);
   }
}

function article()
{

	$query = "";
$query_result = "";
$resultset = "";
$query = "select * from article_tbl ".$limit;
$query_result = mysql_query($query);

if(mysql_num_rows($query_result)>0){

	while($val = mysql_fetch_assoc($query_result))
	{
			$article_name = "";
			$article_content = "";
			$article_content_array = "";
			$article_show = "";
			$article_name = $val['article_name'];
			$article_content = $val['article_content'];
			$article_content_array = explode(" ",$article_content);
			
			for($i=0;$i<=45;$i++) {
				$article_show.=$article_content_array[$i]." ";
			}
			
			$query1 = "select * from article_image_gallery where article_id=".$val['id']." and image_type='Thumb Image' and status='1'";
			$query_result1 = mysql_query($query1);
			$resultset1 = mysql_fetch_assoc($query_result1);
			$article_image_name =  $resultset1['image_name'];
			$article_alt_text = $resultset1['alt_text'];
			
		/*	$article_var.= '<tr>
							<td >
							<div class="wallercountypolitics">
							<div class="wallercountypolitics-top"></div>
							<div class="wallercountypolitics-center">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td width="150" align="left" valign="middle" class="table"><img alt="'.$article_alt_text.'" src="uplodeImage/thumbImg/'.$article_image_name.'" height="90" width="120" /></td>
							<td width="830" align="left" valign="top">
							<h1>'.$article_name.'</h1>
							<p>'.$article_show.'</p>
							<p><a href="article.php?id='.$val['id'].'&page='.$pageno.'">Read More...</a></p>
							</td>
						  </tr>
						</table>
						
							</div>
							<div class="wallercountypolitics-bottom"></div>
							</div>
							</td>
						   </tr>';*/
						   
			$article_var.= '<div class="in-page-single"><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="132" align="left" valign="top">
		<div class="in-page-single-img"><img alt="'.$article_alt_text.'" src="uplodeImage/thumbImg/'.$article_image_name.'" height="90" width="120" /></div></td>
		<td align="left" valign="top">
		<div><h3>'.$article_name.'</h3>
		<p>'.$article_show.'</p>
		<span class="in-page-readmore"><a href="article.php?id='.$val['id'].'&page='.$pageno.'">Read More...</a></span>    </div></td>
	  </tr>
	</table>
	</div>';	
	}
}

return $article_var;
}

function sidebarEach($imageId)
{
	//fetching records Sidebars for Each Page
	$fullPath = 'http://www.desss.com/';
	//$fullPath = 'http://192.168.1.132/sabari/desss_HTML5/';
	$query = "";
	$query_result = "";
	$resultset = "";
	$footer = "";
	
	$query = "select b.title as title,b.file_name as file_name from navi_each_page_tbl a,menu_page_tbl b where a.page_id=$imageId and a.link_id=b.id order by a.page_order asc";
	
	$query_result = mysql_query($query);
	if(mysql_num_rows($query_result)>0){

		while($val = mysql_fetch_assoc($query_result))
		{	
					$sidebars.="<li><a href='".$fullPath."".$val['file_name']."'>".$val['title']."</a></li>";

		}
	}
	return $sidebars;
}


function GetPageid()
{
//	    $uri = $_SERVER['REQUEST_URI'];
//		$split_uri=explode('=',$uri);
//		//$split_uri=explode('/',$uri);
//		//$count=count($split_uri)-2;
//		$count=$split_uri[1];
//		//$page_name=$split_uri[$count];
//		//$page_name=$count;
//		
//		
//		$page_name_New=$count;
//		//  $page_name=$split_uri[$count];
//		
//		
//		$cName=explode('_',$page_name_New);
//		$displayCity = $cName[count($cName)-1];
//		
//		$displayCity1 = explode('.',$displayCity);
//		
//		$disName = array("Dallas", "Chicago", "Los Angeles", "Houston", "New York", "Austin", "San Antonio", "Phoenix");
//		if(in_array($displayCity1[0], $disName))
//		{
//			$displayPage1 = _.''.$displayCity1[0];
//			$page_name = str_replace($displayPage1, "", $page_name_New);
//			$page_name;
//		
//		}
//		else
//		{
//			$page_name = $page_name_New;
//			echo 2;
//		} 
//		
	    $pageURL = pageURLName();
		$addCity_uri1 = explode('+',$pageURL);
		$page_name = $addCity_uri1[0];
		if((isset($_REQUEST['msg'])) && ($_REQUEST['msg'] == 1)){
		$page_names = $addCity_uri1[0];
		$page_name = str_replace("?msg=1","",$page_names);
		}else{
		$page_name = $addCity_uri1[0];
		}
		if($page_name == '')
		{
			$page_name = 'index.php';
		}
		//$page_name_array=explode('?',$page_name);
		
		// if($page_name_array[0] != "") {
		
		
		 if($page_name != "") {
		   // $page_id_query='select * from menu_page_tbl where file_name="'.$page_name_array[0].'"';	
			$page_id_query='select * from menu_page_tbl where file_name="'.$page_name.'"';	
			$page_id_query_exec=mysql_query($page_id_query);
			if(mysql_num_rows($page_id_query_exec) > 0) {
				$get_main_cat_array = mysql_fetch_array($page_id_query_exec);
				$page_id = $get_main_cat_array['id'];	
			}
		}
		return $page_id;
}


function menus1()
{
	$fullPath = 'http://www.desss.com/';
	//$fullPath = 'http://192.168.1.132/sabari/desss_HTML5/';
	
	$query = "select * from menu_page_tbl where is_menu='1' order by order_id asc";
	$exQuery = mysql_query($query);
	while($row = mysql_fetch_array($exQuery))
	{	
			$menus1.='<li><a href="'.$fullPath.''.$row['file_name'].'" class="home">'.$row['title'].'</a></li>';
	}
	

return $menus1;

}

//fetching records for Sound Media

function soundMedia()
{
	$selectSound = 'SELECT * FROM social_media_tbl WHERE active = 1 ORDER BY image_order ASC';
	$exSound = mysql_query($selectSound);
	$fullPath = 'http://www.desss.com/';
//	$fullPath = 'http://192.168.1.132/sabari/desss_HTML5/';
		$imgPath = 'uplodeImage/soundMedia/';
		$soundMedia.= '<table border="0" align="center" cellpadding="5" cellspacing="5">
        	<tr>';
			while($rowSound = mysql_fetch_array($exSound))
			{

          $soundMedia.= '<td width="140px" align="left"><a href="'.$rowSound['media_link'].'" target="_blank"><img src="'.$fullPath.''.$imgPath.''.$rowSound['media_image'].'"  alt="Social Media"/></a></td>';
		  }
        $soundMedia.= '</tr>
		</table>';
	
	
	return $soundMedia;
}



//NEW FOOTER
 $footer_query   = "select * from footer_menu order by link_page asc";
$footer_execute = mysql_query($footer_query) ;
$footer_content1.="";
$footer_count=1;
$footer_countr=mysql_num_rows($footer_execute);
while($footer_fetch=mysql_fetch_array($footer_execute))
{
if($footer_count == 1)
{
$class1='<div class="ffleft box-quote footer_div1">
        <p class="client_head1 MB10" >';
		
$class2='<ul class="footer_inner_fon">';		
}

elseif($footer_count == $footer_countr)
{
$class1='<div class="ffleft box-quote footer_div2">
        <p class="client_head2 MB10 no_border" >';
 $class2='<ul class="footer_inner_fon1 ML10">';
}		
else
{
$class1='<div class="ffleft box-quote footer_div2">
        <p class="client_head2 MB10" >';
 $class2='<ul class="footer_inner_fon1 ML10">';
}	

$footer_content1.=$class1.$footer_fetch['footer_name'].'</p> <div class="spacer"></div>';
   $sub_footer="select * from navi_each_page_tbl where footer_id=".$footer_fetch['footer_id']." order by page_order asc";
	$sub_footer_execute = mysql_query($sub_footer) ;
	$footer_content1.=$class2;
	while($sub_footer_fetch=mysql_fetch_array($sub_footer_execute))
	{
	$menu_footer="select * from menu_page_tbl where id=".$sub_footer_fetch['link_id'];
	$menu_select = mysql_query($menu_footer);
	
	  while($menu_fetch= mysql_fetch_array($menu_select))
	  {
	  $footer_content1.='<li><a href="'.$menu_fetch['file_name'].'">'.$menu_fetch['title'].'</a></li>';
	  }
	
	}
 $footer_content1.=' </ul>
      </div>';
	  $footer_count++;
}



/*$content = array();
$content = content();*/

//$analitic = array();
//$analitic = analitic_code();
$page_id = GetPageid();
$pages = pages();
$footer = footers();
$article_var = article();
$sidebars = sidebarEach($page_id);
//$footer_content = footer_links();
//$footer_content1 = footer_links1();
$menus = menus();
$soundMedia = soundMedia();
$menus1 = menus1();
$content_part = array();
$content_part = content();
$pageURL = pageURLName();






//fetching records for footers NAME 
$footer_query   = "select * from footer_menu order by link_page asc  limit 0,4";
$footer_execute = mysql_query($footer_query) ;
$footer_content.="";

while($footer_fetch=mysql_fetch_array($footer_execute))
{
$footer_content.= '<p class="client_head1">'.$footer_fetch['footer_name'].'</p>';

}




//fetching records for contact
    $query = "select * from contact_tbl where type=1"; 
    $query_result = $obj_mysql->db_query($query);
    $resultset = $obj_mysql->get_fetch_record($query_result);
    if(count($resultset)>0) 
    {
	    foreach($resultset as $key=>$val) 
	    {
		$contact_number = $val['contact'];
	    }
    }
    $query = "select * from contact_tbl where type=2"; 
    $query_result=mysql_query($query);
    //$query_result = $obj_mysql->db_query($query);
    $resultset=mysql_fetch_object($query_result);
    //$resultset = $obj_mysql->get_fetch_record($query_result);
    if(count($resultset)>0) 
    {
	   foreach($resultset as $key=>$val) 
	   {
		$contact_mail_id = $val['contact'];
	   }
    } 


if($_REQUEST['Name_field'])
{
$Name=$_REQUEST['Name_field'];
$Phone=$_REQUEST['Phone_field'];
$Email=$_REQUEST['Email_field'];
$Comments=$_REQUEST['Comment_field'];
$normal = "^[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})$";
$servername='success.php'	;
	/* 
	 if($Name == "" || $Name=='Name')
	{
		$msg = "Please Enter Your Name";
	}
	elseif(!eregi('^[A-Za-z]{3,50}$',$Name)) 
	{
		$msg = "Name is Not Valid";
	}
	
		elseif($Phone == ""  ) 
	{
		$msg = "Please Enter Phone Number ";
	}
	elseif(!ereg("^[0-9]{3}-[0-9]{3}-[0-9]{4}$", $Phone)) 
	{ 
    $msg = "Invalid Phone Number.Ex 000-000-0000";
    }
	
		elseif($Email == "") 
	{
		$msg = "Please Enter Email Address";
	}
	
	elseif(!eregi($normal, $Email)) 
	{
		$msg = "Email Not In Correct Format";
	}
	elseif($Comments == "" || $Comments == 'Comments') 
	{
		$msg = "Please Enter Your Comments";
	}

	elseif(strlen($Comments)>150) {
		$msg = "Max Length 150 Charecters";
	}
	else
	{
	*/
	$query = "INSERT INTO `re_quote` SET `quote_name`  ='".addslashes($Name)."',
 `quote_email`       ='".addslashes($Email)."',
 `quote_phone`       ='".addslashes($Phone)."',
 `quote_qustcomments`       ='".addslashes($Comments)."'";
 $sel_query = mysql_query($query);
if(!$sel_query)
    {
     header("location:success.php?msg=2");
    }
    else
    { //header("location:success.php?msg=1");
header("location:http://www.desss.com/QuickContactInfo.aspx?name=$Name&email=$Email&url=$servername&phone=$Phone&msg=$Comments");
    }

/*}*/
}

/*search Gen*/

			
			if($_REQUEST['search'])
			{
			
			
			$search=$_REQUEST['search']; 
			//to calculate the elapsed time
	$_SESSION['start_time'] = microtime(true);
	
	 function execute_time() 
	{
        return (microtime(true) - $_SESSION['start_time']);
    }
         
          
  
	
	
	
	
	

	
	
	//pagination search page
	
	
	$select = 'SELECT *';
$from   = ' FROM menu_page_tbl';
$where  = " WHERE  real_description LIKE '%$search%' OR	title LIKE '%$search%' OR file_name LIKE '%$search%' OR meta_content LIKE '%$search%' OR h1_title LIKE '%$search%'";





	
$searchtext = $_REQUEST['search'];
$page=$_REQUEST['page'];
	
	$pagelimit = "10";
// run query
   $strSQL = mysql_query($select . $from . $where) or die(mysql_error()); 



// count number of matches
   $totalrows = mysql_num_rows($strSQL);
   
 $res.= "About&nbsp;".$totalrows."&nbsp;results in &nbsp".round(execute_time(),4)."&nbsp;seconds</br>";
unset($_SESSION['start_time']);  
if ($totalrows > 0) {



// determine how many pages there will be by using ceil() and dividing total rows by pagelimit
   $pagenums = ceil ($totalrows/$pagelimit);

// if no value for page, page = 1
    if ($page==''){
        $page='1';
    }
// create a start value
   $start = ($page-1) * $pagelimit;

// blank matches found
$res.= "<b>" . $totalrows . " matches found</b><br>\n";

// Showing Results 1 to 10 (or if you're page limit were 15) 1 to 15, etc.
$starting_no = $start + 1;

if ($totalrows - $start < $pagelimit) {
   $end_count = $totalrows;
} elseif ($totalrows - $start >= $pagelimit) {
   $end_count = $start + $pagelimit;
}

      
$disp.= "Results $starting_no to $end_count shown.<br>\n";

// create dynamic next, previous, and page links

/* lets say you're set to show 10 results per page and your script comes out with 12 results.
this will allow your script to say next 2 if you're on the first page and previous 10 if you're on the second page. */

if ($totalrows - $end_count > $pagelimit) {
   $var2 = $pagelimit;
} elseif ($totalrows - $end_count <= $pagelimit) {
   $var2 = $totalrows - $end_count;
}

$space = "&nbsp;";


 $strquery =" SELECT * FROM menu_page_tbl WHERE  real_description LIKE '%$search%' OR	title LIKE '%$search%' OR file_name LIKE '%$search%' OR meta_content LIKE '%$search%' OR h1_title LIKE '%$search%' LIMIT ".$start." ,".$pagelimit;

//echo $strquery; // check the correct query is being written

$strSQL = mysql_query("$strquery") or die('Database error: '.mysql_error());



$pubname = ereg_replace('\\[(B|EB|I|EI|L|L=|L=[-_./a-z0-9!&%#?+,\'=:;@~]+|EL|E)?(]|$)', '', $pubname);

while ($publication = mysql_fetch_array($strSQL)) {

   $fld1.= "<li><h4>".$publication['title']."</h4></br>";
        $fld1.= strip_tags(substr($publication['real_description'],0,300));    
     $fld1.='...
	 
	<a class="read_more_bt fright" style="margin:7px 15px 10px 10px"  href="'.$publication['file_name'].'"></a></li>';
    
     
$fld1.="";
  
    
    
    
    
}
     


// previous link (if you're on any page besides the first, create previous link)
if ($page>1) {
        $fpage.= " <a href='" . $_SERVER['PHP_SELF'] . "?page=".($page-1)."&search=$searchtext'>Previous" . $space . $pagelimit . "</a>" . $space . $space . "";
    }

// dynamic page number links

    for ($i=1; $i<=$pagenums; $i++) {
        if ($i!=$page) {
            $dpage.= " <a href='" . $_SERVER['PHP_SELF'] . "?page=$i&search=$searchtext' >$i</a>";
        }
        else {
            $dpage.= " <b>[".$i."]</b>";
        }
    }


// next link 0  (if the page you are on is less than the total amount of page numbers, there are more pages left)

    if ($page<$pagenums) {
       $pless.= "" . $space . $space . $space . $space . " <a href='" . $_SERVER['PHP_SELF'] . "?page=".($page+1)."&search=$searchtext' class=main>Next " . $var2 . "</a> ";
    }


// LIMIT 0,10 will start at 0 and display 10 results
// LIMIT 10,5 will start at 10 and display 5 results

/* now you can do whatever you'd like with this query. it will only output ten results per page.
change the $pagelimit variable to whatever to output more than 10 result per page. */

}


	
	}
	
	/*pagination ends*/
	
	

	



	
	
	
	
	
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/1">
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link type="text/css" href="http://www.desss.com/css/menu.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="http://www.desss.com/css/reset.css">
<link rel="stylesheet" type="text/css" href="http://www.desss.com/css/support.css">
<link href="http://www.desss.com/css/menu-style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="http://www.desss.com/css/style.css">
<link rel="stylesheet" type="text/css" href="http://www.desss.com/css/main_slider.css">
<link rel="stylesheet" type="text/css" href="http://www.desss.com/css/style_tab_slider.css">
<link href="http://www.desss.com/css/desss_style.css" rel="stylesheet" type="text/css" />
<script src="http://www.desss.com/Scripts/swfobject_modified.js" type="text/javascript"></script>
<script type="text/javascript" src="http://www.desss.com/js/phone_validation.js"></script>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>
<script type="text/javascript" src="http://www.desss.com/js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="http://www.desss.com/js/validation.js"></script>
<script type="text/javascript" src="http://www.desss.com/js/jquery.maskedinput-1.2.2.min.js"></script>
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


</script>
<script type="text/javascript" src="http://www.desss.com/js/s3Slider.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#slider').s3Slider({
            timeOut: 3000
        });
    });
</script>
<script src="http://www.desss.com/js/organictabs.jquery.js"></script>
<script>
        $(function() {
            $("#example-two").organicTabs({
                "speed": 200
            });
        });
		
    </script>
<!--<tab>-->
<!--<submenu>-->
<script type="text/javascript" src="http://www.desss.com/js/jquery.hoverIntent.minified.js"></script>
<!--<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>-->
<script type="text/javascript" src="http://www.desss.com/js/validation.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	function megaHoverOver(){
		$(this).find(".sub").stop().fadeTo('fast', 1).show();
			
		//Calculate width of all ul's
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
			$(this).find(".sub").css({'width' :biggestRow});
			$(this).find(".row:last").css({'margin':'0'});
			
		} else { //If row does not exist...
			
			$(this).calcSubWidth();
			//Set Width
			$(this).find(".sub").css({'width' : rowWidth});
		}
	}
	function megaHoverOut(){ 
	  $(this).find(".sub").stop().fadeTo('fast', 0, function() {
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

	$("ul#topnav li .sub").css({'opacity':'0'});
	$("ul#topnav li").hoverIntent(config);
});
</script>
<script type='text/javascript'>        
		$( function() {
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
                    picker = $( '<div class="colorPicker"/>' ),
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
    <?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>	

<style>
.body{
margin:0px;
font:12px Arial, Helvetica, sans-serif;
background:#fff url(http://desss.com/images/main_bg_main.gif) center top repeat-x;
}
.wholesite{
width:1200px;/*1280*/
margin:0px auto;
/*font-family:Arial, Helvetica, sans-serif;*/
}

/* banner top starts here */
.wholebanner-bg{
width:100%;/*1280*/
height:136px;
background:url(http://desss.com/images/whole-banner-bg.gif) center no-repeat;
}
.wholebanner-main{
width:1200px;/*1280*/
height:136px;
background:url(http://desss.com/images/whole-banner-bg.gif) center no-repeat;
}
.wholebanner{
width:1200px;/*1280*/
height:136px;
}
.banner_top_whole{
width:100%;/*1280*/
height:28px;
background:url(http://desss.com/images/Banner_top_bg.gif) center no-repeat;
}
.banner_top{
width:1200px;/*1280*/
height:28px;
background:url(http://desss.com/images/Banner_top_bg.gif) center no-repeat;
}
.banner_top_right{
width:340px;/*410*/
height:28px;
float:right;
}
.dessslogo-bg{
width:206px; 
height:106px; 
margin:0px auto; 
background:url(http://desss.com/images/bg-logo.jpg) no-repeat;
}

.logo-desss{
width:132px; 
height:42px; 
margin:0px auto; 
position:relative; 
top:25px;
}
.search{
width:200px;
height:28px;
float:left;
font-size:11px;
color:#4e4e4e;
line-height:24px;
font-family:Arial, Helvetica, sans-serif;
}
.textfield{
height:16px;
border:#999999 solid 1px;
color:#2d2d2d;
padding-left:3px;
margin-left:5px;
margin-top:3px;
}
.advancesearch{
width:120px;
height:18px;
float:right;
margin:5px 10px 0px 0px;
}
.toprightmenu{
font-size:11px;
font-weight:bold;
padding:20px 20px 0px 0px;
color:#ffffff;
}
.toprightmenu a{
color:#ffffff;
padding:0px 10px;
background:url(http://desss.com/images/topmenu-sep.gif) right no-repeat;
line-height:21px;
text-decoration:none;
}
.toprightmenu a:hover{
color:#FF9900;
text-decoration:none;
}


/* banner top ends here */

/* banner down starts here */

.banner_down{
height:108px;
clear:both;
}
.logo_bg{
width:212px;
height:108px;
margin-left:20px;
background:url(http://desss.com/images/logo-bg.jpg) no-repeat;
}

/* navi starts ends */

.navi{
width:960px;
height:94px;
float:left;
}
.navi_icons{
width:960px;
height:24px;
margin-top:6px;
}
/*.navi_icons_right{
width:150px;
height:24px;
float:right;
}*/
.navi_space{
width:960px;
height:35px;
}
.menu{
width:950px;
height:28px;
font-family:Arial, Helvetica, sans-serif;
font-size:11px;
font-weight:bold;
margin-left:10px;
}
.menu ul{
padding:0px;
margin:0px;
}
.menu li{
padding:0px 8px;
margin:0px;
list-style:none;
line-height:28px;
display:inline;
}
.menu li a{
text-decoration:none;
color:#121212;
font-weight:bold;
}

.lipad{
padding:0px;
}

/* navi starts ends */

/* banner down starts ends */

/* banner ends */

/* whole content starts here */
.wholecontent-bg{
/*	width:100%;
	margin:0px;
	padding:0px;
	background:#ffe8c5 url(../images/whole-content-bg.gif) repeat-x;
*/
	width:1200px;
	margin:0px;
	padding:0px;
	background:#ffe8c5 url(http://desss.com/images/whole-content-bg.gif) no-repeat;

}
.wholecontent{
width:1200px;
margin:0px auto;
background:#fff;
border:solid #ff9328 1px;
border-bottom:none;
padding-left:0px;
}


@charset "utf-8";

*{outline: none;}
img {border: 0;}
.menucontainer {
	width: 860px;
	height:40px;
	padding: 0;
	position:relative;
	/*margin: 0 auto;*/
}
/*#header {
	background: url(header.jpg) no-repeat;
	width: 970px; height: 179px;
	float: left;
}*/
ul#topnav {
	margin: 0; padding: 0;
	float:left;
	width:100%;
	list-style: none;
	font-size: 1.1em;
	
}
ul#topnav li {
	float: left;
	margin: 0; padding: 0;
	position: relative;

}
ul#topnav li a {
	float: left; 
/*	text-indent: -9999px;*/
	height: 40px;
	font-family:Arial, Helvetica, sans-serif;
	color:#000000;
	font-size:11px;
	
}
ul#topnav li:hover a, ul#topnav li a:hover {color:#ff000a; background:url(http://desss.com/images/menu/bg-nav-hover2.gif) repeat-x; /*background:url(bg-nav-hover2.gif) repeat-x; background-position: left bottom;  */}
ul#topnav a.home {
	/*background: url(nav_home.png) no-repeat;*/
	background:url(http://desss.com/images/menu/right-side-border.gif) top right no-repeat;
	font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:38px;
	display:block;
	text-decoration:none;
	color:#2d2d2d;
	padding:0px 20px;
	/*width: 78px;*/
	text-align:left;
	font-weight:bold; 
}
ul#topnav a.home:hover{
color:#ff000a;
background:url(http://desss.com/images/menu/bg-nav-hover2.gif) repeat-x;
}
ul#topnav a.home:active a{
background:url(http://desss.com/images/menu/bg-nav-hover2.gif) repeat-x;
}
/*---------------------------------------------*/
/*ul#topnav a.last {
	/*background: url(nav_home.png) no-repeat;*/
	/*font-family:Arial, Helvetica, sans-serif;
	font-size:11px;
	line-height:40px;
	text-decoration:none;
	color:#2d2d2d;
	padding:0px 20px;
	/*width: 78px;*/
	/*text-align:center;
	font-weight:bold; 
}
ul#topnav a.last:hover{
background:url(bg-nav-hover2.gif) repeat-x;
}
ul#topnav a.last:active a{
background:url(bg-nav-hover2.gif) repeat-x;
}
/*-----------------------------------------------*/
ul#topnav a.products {
	/*background: url(../images/nav_products.png) no-repeat;*/
	width: 10px;
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
	color:#000000;
	line-height:30px;
	text-decoration:none; 
}
ul#topnav a.products:hover{
/*background:url(../images/bg-nav-hover2.gif) repeat-x;*/
}
ul#topnav a.products:active a{
/*background:url(../images/bg-nav-hover2.gif) repeat-x;*/
}
ul#topnav a.sale {
	/*background: url(nav_sale.png) no-repeat;*/
	width: 10px; 
	line-height:30px;
	text-decoration:none;
}
ul#topnav a.community {
/*	background: url(nav_community.png) no-repeat;*/
	width: 124px; 
}
ul#topnav a.store {
/*	background: url(nav_store.png) no-repeat;*/
	width: 141px; 
}


ul#topnav li .sub {
	border:#f4d3a5 solid 1px;
	border-top:#f4d3a5 solid 4px;
	position: absolute;	
	top: 39px; left: 0;
	background: #ffffff;
	padding: 0px 0px 0px 0px;
	float: left;
	/*--Bottom right rounded corner--*/
	-moz-border-radius-bottomright: 5px;
	-khtml-border-radius-bottomright: 5px;
	-webkit-border-bottom-right-radius: 5px;
	/*--Bottom left rounded corner--*/
	-moz-border-radius-bottomleft: 5px;
	-khtml-border-radius-bottomleft: 5px;
	-webkit-border-bottom-left-radius: 5px;
	display: none;
	font-weight:normal;
	text-align:left;
	
}
ul#topnav li .row {clear: both; float: left; width: 100%; margin-bottom: 10px; }
ul#topnav li .sub ul{
	list-style: none;
	width: 110px;
	float: left;
	font-weight:normal;
	background:none;
	padding: 0px 30px 0px 40px;
	}
ul#topnav .sub ul li {
	width: 200px;
	color: #000000;
	
}
ul#topnav .sub ul li h2 {
	padding: 0;  margin: 0;
	font-size: 11px;
	font-weight: bold;
	color:#666666;/*003366*/
}
ul#topnav .sub ul li h2 a {
	
	padding: 0px 0;
	background-image: none;
	color: #666666;
	font-weight:bold;
	
}
ul#topnav .sub ul li a {
	float: none; 
	text-indent: 0; /*--Reset text indent--*/
	height: auto;
	line-height:18px;
	/*background: url(navlist_arrow.png) no-repeat 5px 12px;*/
	padding: 0px 0px 0px 0px;
	display: block;
	text-decoration: none;
	font-weight:normal;
	color: #e65302;/*subnav list color*/
	background:none;
	color: #e65302;/*subnav list color*/
}
ul#topnav .sub ul li a:hover {color:#006699; background:none; /*background-position: 5px 12px ;*/}/*subnav list color*/


</style>	
	
	
	
</head>
<body>
	
//<?php
//
//$url = $_SERVER["REQUEST_URI"];
//$connect=mysql_connect("localhost","wordpress_6","desss");
//mysql_select_db("wordpress_8",$connect);
////fetching records for menus
//
//function menus()
//{
//	$fullPath = 'http://www.desss.com/';
//	
//	$query = "select * from menu_page_tbl where is_menu='1' order by order_id asc";
//	$exQuery = mysql_query($query);
//	while($row = mysql_fetch_array($exQuery))
//	{	
//		$menus.='';
//		$numberRow = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id'];
//		$numberRow1= mysql_query($numberRow);
//		$numberRow2 = mysql_num_rows($numberRow1);
//		if($numberRow2 == '0')
//		{
//			$menus.='<li><a href="'.$fullPath.''.$row['file_name'].'" class="home">'.$row['title'].'</a></li>';
//		}
//		else
//		{
//			$menus.='<li><a href="'.$fullPath.''.$row['file_name'].'" class="home">'.$row['title'].'</a>
//			<div class="sub" >';
//			$subMenu = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id'].' order by order_id asc';
//			$subMenu1 = mysql_query($subMenu);
//			$J = 0;
//			while($row1 = mysql_fetch_array($subMenu1))
//			{
//				$numberRow3 = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'];
//				$numberRow4= mysql_query($numberRow3);
//				$numberRow5 = mysql_num_rows($numberRow4);
//				if($numberRow5 == '0')
//				{	
//					if($J%2==0){
//						$menus.='<ul style="width: 85px;">';
//					}
//					
//					$menus.='<li><h2><a href="'.$fullPath.''.$row1['file_name'].'">'.$row1['title'].'</a></h2></li>';
//					
//					if($J%2==1){
//						$menus.='</ul>';
//					}
//				}
//				else
//				{	
//					
//					if($J%2==0){
//						$menus.='<ul style="width: 85px;">';
//					}
//					
//					$menus.='<li ><h2><a href="'.$fullPath.''.$row1['file_name'].'">'.$row1['title'].'</a></h2></li>';
//					
//					$inserSubMenu = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'].' order by order_id asc';
//					$inserSubMenu1 = mysql_query($inserSubMenu);
//					while($row2 = mysql_fetch_array($inserSubMenu1))
//					{
//						$menus.='<li ><a href="'.$fullPath.''.$row2['file_name'].'">'.$row2['title'].'</a></li>';
//					}
//					
//					if($J%2==1){
//						$menus.='</ul>';
//					}
//						
//				}
//				$J++;
//			}
//	$menus.='</div></li>';
//		}
//	}
//
//return $menus;
//
//}
//
//function pages()
//{
//	$fullPath = 'http://www.desss.com/';
//	$query = "";
//	$query_result = "";
//	$resultset = "";
//	$footer = "";
//	$pages = "";
//	$query = "select b.title as title,b.file_name as file_name from top_banner a,menu_page_tbl b where a.Page_ID=b.id order by a.order_id asc";
//	$query_result = mysql_query($query);
//	
//	if(mysql_num_rows($query_result)>0) {
//	
//		while($val = mysql_fetch_array($query_result)) {
//		
//			$pages.="<a href='".$fullPath."".$val['file_name']."'>".$val['title']."</a>";
//		}
//	}
//	
//	
//	return $pages;
//
//}
//
//$pages = pages();
//$menus = menus();
//
//?>
<header>
  <div class="header_inner">
    <div class="wrapper">
      <div class="logo fleft"> <a href="http://www.desss.com"><img src="http://www.desss.com/images/logo.jpg" title="DESSS APPLYING TECHNOLOGIES"  alt="DESSS APPLYING TECHNOLOGIES" /></a> </div>
      <div class="header_right fright">
        <div class="search fright">
          <p class="search_text fleft">Search :</p>
          <form action="search.php" method="post">
            <input type="text" id="search" name="search" class="search_text_bx fleft">
            <input type="submit" id="submit" name="text" class="search_submit_button fleft" value="&nbsp;" onClick="return gen_search(search)">
          </form>
          <div class="spacer"></div>
        </div>
        <div class="spacer"></div>
        <div class="small_menu MT25">
          <nav>
            <ul>
             <?=pages()?>
            </ul>
          </nav>
        </div>
        <div> 
          <!--menu starts here--> 
          <!--navi div starts here-->
                  <ul id="topnav">
        <?=$menus;?>
      </ul>
        </div>
        <div class="spacer"></div>
      </div>
    </div>
  </div>
</header>
