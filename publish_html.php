<?php 


require("code.php");

//Main page -	



$sel_query = "select * from `menu_page_tbl` WHERE file_name LIKE '%.html%'";
$exec_Sel_auery = mysql_query($sel_query);

$name = "../";
$cot=mysql_num_rows($exec_Sel_auery);
$i=1;
while($item_publish1=mysql_fetch_array($exec_Sel_auery))
{
	
	 $people= $item_publish1['file_name'];
	 
	 $page_id=$item_publish1['id'];	 
	 
	 $sel_query1 = "select * from `menu_page_tbl` WHERE file_name='".$people."'";
	 $exec_Sel_auery1 = mysql_query($sel_query1);
	 $j=$i;
	 
	 $split_uri_folder=explode('/',$people);
	             $count_folder=count($split_uri_folder)-2;
		    $page_name_folder=$split_uri_folder[$count_folder];
		$dirname = $page_name_folder;
   $filename = ($name. $dirname);
  
    if (file_exists($dirname)) {

	} else {
        mkdir($name . $dirname, 755);
      
    }	
	
	
	  
			  
		while($item_publish=mysql_fetch_array($exec_Sel_auery1))
		{
		$content_html1="";
		$list="";
		$about_info1="";
		$about_description="";		
		$meta_title="";
		$meta_content="";
		$meta_keyword="";
		$eventimage_viwe="";
		$about_info="";
		$content="";
		 $list1="";
		$id="";
		$img_alt="";
		$sidebars="";
		$num="";
		$meta_title=$item_publish['meta_title'];
		$file_name=$item_publish['file_name'];
		$meta_content=$item_publish['meta_content'];
		$meta_keyword=$item_publish['meta_keyword'];
		$eventimage_viwe=$item_publish['image'];
		$img_alt=$item_publish['img_alt'];
		$content=$item_publish['real_description'];
		$id=$item_publish['id'];
		$header_title1=$item_publish['h1_title'];
		$header_title2=$item_publish['h2_title'];
		$is_restaurant=$item_publish['is_restaurant'];
	 	$page_type=$item_publish['page_type'];
	    $page_title = $item_publish['title'];	
	    $description = $item_publish['description'];
	if($is_restaurant=="Yes")
	{
include('publish_restaurant_html.php');
chmod("$people",0777);
$fh = fopen($name.$people,'w') or die("can't open file");
fwrite($fh,$rest_html1);
fclose($fh);

	}
	else	
	{




	
	/*banner starts*/
	
	$selectImage_ban = 'SELECT * FROM sub_page_banner_new WHERE page_id = '.$id.' AND status = \'1\'';
				$exSelectImage_ban = mysql_query($selectImage_ban);
				$viewImage = mysql_fetch_array($exSelectImage_ban);
		$num = mysql_num_rows($exViewQuery);
				
				
		 
     $view_template = "select b.page_id as page_id,b.status as status,a.template_id as template_id,a.template_name as template_name from banner_template_new a,sub_page_banner_new b where b.status=1 AND b.page_id=$id and a.template_id =b.img_template_id  ";

$exview_template = mysql_query($view_template);
$template_count= mysql_num_rows($exview_template);

$selectexview_template = mysql_fetch_array($exview_template);
$template=  '../images/templates/'.$selectexview_template['template_name'];
         
        
				
	if($template_count>0)
	
	{			
				
$eventimage='<div class="common_div">
			<div class="desss_banner" style="background:url('.$template.')no-repeat left top; ">
	 <div>
	   <p class="font1">'.$viewImage['img_des'].' </p>
	 <img src="../uplodeImage/thumbImg/'.$viewImage['image_name'].'" alt="'.$viewImage['alt_text'].'" title="'.$img_alt.'"  class="img_cls"  />
	 </div> 

 <div>
	  <img alt="'.$viewImage['alt_text'].'" title="'.$viewImage['alt_text'].'"  src="../uplodeImage/thumbImg/'.$viewImage['icon_name'].'" class="iocon_image" />
 </div><div class="spacer">
  </div> </div></div>';
				
			
				}
		
	elseif($eventimage_viwe!="")	
	
		{
		$eventimage='<div class="banner"><a href="'.$fullPath.$people.'" > <img class="max_width" src="'.$fullPath.'uplodeImage/thumbImg/'.$eventimage_viwe.'"   alt="'.$img_alt.'"  title="'.$img_alt.'"  /></a></div>';
		
		
		}
	else
	{
	$eventimage='<div class="banner"><a href="'.$fullPath.$people.'" ><img class="max_width" src="'.$fullPath.'uplodeImage/thumbImg/default.jpg" title="DESSS"  alt="DESSS" /></a></div>';
	
		}	
	
	
	
	
	
	
	

    $query = "select * from menu_page_tbl where parent_id='$id' order by order_id asc";
    $menu_desc="";
	$exQuery = mysql_query($query);
	$count_menu0= mysql_num_rows($exQuery);
	$i=1;
	while($row = mysql_fetch_array($exQuery))
	{	
	          
	             $nme1=$row['file_name'];
	              $split_uri_folder1=explode('/',$nme1);
	                $count_folder1=count($split_uri_folder1)-2;
		             $page_name_folder1=$split_uri_folder[$count_folder1];

	$iconimg=$row["iconimg"];
	$menu_desc.='<li>';  
    if(($page_name_folder1  != ""))
	{	
	 
	if($iconimg=="")
	{
	$menu_desc.='<img src="'.$fullPath.'images/sub_page_content_image1.jpg" class="margin_1" width="200" height="92" alt="DESSS" title="DESSS" />';
	}
	else
	{
	$menu_desc.='<img src="'.$fullPath.'uplodeImage/iconimg/'.$iconimg.'" class="margin_1"  width="200px" height="92px" alt="'.$img_alt.'" title="'.$img_alt.'" />';
	}
	$menu_desc.='<p class="head4 PT6">'.$row['title'].'</p><p class="content1 just">';
	$menu_desc.= strip_tags(substr($row['real_description'],0,220));    
	$menu_desc.="...</p>";
	$menu_desc.='<a href="'.$fullPath.''.$row['file_name'].'" class="read_more_bt fright">Read More</a><div class="spacer"></div></li>';
	}
	else
	{

	if($iconimg=="")
	{
	$menu_desc.='<img src="'.$fullPath.'images/sub_page_content_image1.jpg" class="margin_1" width="200" height="92" alt="DESSS" title="DESSS" />';
	}
	else
	{
	$menu_desc.='<img src="'.$fullPath.'uplodeImage/iconimg/'.$iconimg.'" class="margin_1"  width="200" height="92" alt="'.$img_alt.'" title="'.$img_alt.'" />';
	}
	$menu_desc.='<p class="head4 PT6">'.$row['title'].'</p><p class="content1 just">';
	$menu_desc.= strip_tags(substr($row['real_description'],0,220));    
	$menu_desc.="...</p>";
	$menu_desc.='<a href="'.$fullPath.''.$row['file_name'].'" class="read_more_bt fright">Read More</a><div class="spacer"></div></li>';
	}
	$i++;
	}
			  
	//menu 2	



$query1 = "select * from menu_page_tbl where parent_id='$id' order by order_id asc";
$menu_desc1="";
$exQuery1 = mysql_query($query1);
$count_menu= mysql_num_rows($exQuery1);
$i=1;
while($row1 = mysql_fetch_array($exQuery1))
{	
                 
                 $nme2=$row1['file_name'];
	             $split_uri_folder2=explode('/',$nme2);
	             $count_folder2=count($split_uri_folder2)-2;
		         $page_name_folder2=$split_uri_folder[$count_folder2];
	
	$iconimg=$row1["iconimg"];
    if(!($page_name_folder2==""))
	{	
$menu_desc1.='<li><div class="image_max">';
if($iconimg=="")
	{
$menu_desc1.='<img src="'.$fullPath.'images/sub_pages2_image1.png" class="ffleft MT10 ML10 MB10" width="200" height="110" alt="DESSS" title="DESSS" /></div>';
}
else
{
$menu_desc1.='<img src="'.$fullPath.'uplodeImage/iconimg/'.$iconimg.'" class="ffleft MT10 ML10 MB10" width="200" height="110" alt="'.$img_alt.'" title="'.$img_alt.'"  /></div>';
}
$menu_desc1.=' <div class="fleft div_sub_page ML10">
<p class="head3 PT10">'.$row1['title'].'</p><p class="PT6">';
$menu_desc1.= strip_tags(substr($row1['real_description'],0,220));    
$menu_desc1.="...</p>";
$menu_desc1.='<a href="'.$fullPath.''.$row1['file_name'].'" class="read_more_bt MT12 fright">Read More</a><div class="spacer"></div>
          </div>
          <div class="spacer"></div></li>';
}
else
{
$menu_desc1.=' <li>';
if($iconimg=="")
	{
$menu_desc1.='<img src="'.$fullPath.'images/sub_pages2_image1.png" class="ffleft MT10 ML10 MB10" width="200" height="110" alt="DESSS" title="DESSS"  />';
}
else
{
$menu_desc1.='<img src="'.$fullPath.'uplodeImage/iconimg/'.$iconimg.'" class="ffleft MT10 ML10 MB10" width="200" height="110" alt="'.$img_alt.'" title="'.$img_alt.'" />';
}
$menu_desc1.='<div class="fleft div_sub_page ML10">
<p class="head3 PT10">'.$row1['title'].'</p><p class="PT6">';
$menu_desc1.= strip_tags(substr($row1['real_description'],0,220));    
$menu_desc1.="...</p>";
$menu_desc1.='<a href="'.$fullPath.''.$row1['file_name'].'" class="read_more_bt fright">Read More</a><div class="spacer"></div></div>
<div class="spacer"></div></li>';
}
$i++;
}
			
//fetching records Sidebars for Each Page

	$query = "";
	$query_result = "";
	$resultset = "";
	$footer = "";
	$sidebars="";
	$query = "select b.title as title,b.file_name as file_name from navi_each_page_tbl a,menu_page_tbl b where a.page_id=$id and a.link_id=b.id order by a.page_order asc";
	
	$query_result = mysql_query($query);
	$sideEach_cont=mysql_num_rows($query_result);
	if($sideEach_cont>0){

		while($val = mysql_fetch_assoc($query_result))
		{	
					$sidebars.="<li><a href='".$fullPath."".$val['file_name']."'>".$val['title']."</a></li>";

		}
		
	
	}
	
	
	//fetching records aboutpage for E Page		
 $select_addinfo = "SELECT * FROM  addinfo  WHERE page_id =".$id." order by sort_order ASC ";
		$query_addinfo = mysql_query($select_addinfo);
		$num_addinfo         =    mysql_num_rows($query_addinfo);
	 	if($num_addinfo>0)
		{
		while($view_addinfo = mysql_fetch_array($query_addinfo))
		
		$about_info.='<div><img alt="" width="105"  height="155" align="left"  src="uplodeImage/about/'.$view_addinfo['image'].'" class="MR10 MB10" />
					   <h6>'.$view_addinfo['name'].'</h6> 
                     <span>'.$view_addinfo['desc_data'].'</span>
                      <p><b>Contact Email:</b><a class="MR10" href="mailto:'.$view_addinfo['email'].'">&nbsp;<b>'.$view_addinfo['email'].'</b></a></p></div>';

		}
		else
		{
		$about_info="";		
		
		}

//menucontent4-featured_table 
	$select_list = 'SELECT * FROM featured_table WHERE page_id='.$page_id;
$query_result_list = mysql_query($select_list);
if(!$query_result_list)
echo mysql_error();
if(mysql_num_rows($query_result_list)>0)
{
while($row_list=mysql_fetch_array($query_result_list))
{


$list.='<p><strong>'.$row_list['tab_title'].'</strong></p>';



if(($row_list['description']!='+$&+') || ($row_list['description']!='') )
{
/*if($row_list['image']!="")
{
$list.='<ul style="list-style-image:url(Images/listicon/'.$row_list['image'].'); ">';
}
else*/
$list.='<ul>';


	$value_cnt=0;
	
					  $phoneChunks1 = explode("+$&+",$row_list['description']);
					   for ($r=0; $r<$row_list['norows']; $r++) {   
	
	
	
	 
      for ($c=0; $c<$row_list['nocols']; $c++) {
	 
	  
$list.='<li>'.$phoneChunks1[$value_cnt].'</li>';
		  $value_cnt=$value_cnt+1;
		  
    }
	$k=$k+1;
	
   
  } 
  
  
  $list.='</ul>';
  



$list.=''; 
}
}
}

	   
 echo $list;   			   
  
	
	
			


		
//fetching records aboutpage for E Page		
 $select_addinfo1 = 'SELECT * FROM contentinfo where page_id ='.$page_id;
		$query_addinfo1 = mysql_query($select_addinfo1);
		$num_addinfo1         =    mysql_num_rows($query_addinfo1);
	 	if($num_addinfo1>0)
		{
		while($view_addinfo1 = mysql_fetch_array($query_addinfo1))
		
		$about_info1.='<div class="wid_50_per_sub fright content_desss1">
		<div class="align_image">
		<img alt="" width="471px"  height="300px"  src="uplodeImage/desc_content/'.$view_addinfo1['image'].'" align="left" class="MR15 MB15"  /></div>
					   <h2>'.$view_addinfo1['name'].'</h2> 
                     <p>'.$view_addinfo1['desc_content'].'</p></div>
                      ';

		}
		else
		{
		$about_info1="";		
		
		}		
		
		
	//menucontent4-featured_table 
	$select_list1 = 'SELECT * FROM featured_table1 WHERE page_id='.$page_id;
$query_result_list1 = mysql_query($select_list1);
if(!$query_result_list1)
echo mysql_error();
if(mysql_num_rows($query_result_list1)>0)
{
while($row_list1=mysql_fetch_array($query_result_list1))
{


$list1.='<p><strong>'.$row_list1['tab_title'].'</strong></p>';



if(($row_list1['description']!='+$&+') || ($row_list1['description']!='') )
{
/*if($row_list['image']!="")
{
$list.='<ul style="list-style-image:url(Images/listicon/'.$row_list['image'].'); ">';
}
else*/
$list1.='<ul>';


	$value_cnt1=0;
	
					  $phoneChunks2 = explode("+$&+",$row_list1['description']);
					   for ($r=0; $r<$row_list1['norows']; $r++) {   
	
	
	
	 
      for ($c=0; $c<$row_list1['nocols']; $c++) {
	 
	  
$list1.='<li>'.$phoneChunks2[$value_cnt1].'</li>';
		  $value_cnt1=$value_cnt1+1;
		  
    }
	$k=$k+1;
	
   
  } 
  
  
  $list1.='</ul>';
  



$list1.=''; 
}
}
}

	   
 echo $list1; 	
		
		
		
//fetching records aboutpage for E Page		
     $select_addinfo2 = 'SELECT * FROM menu_page_tbl where id ='.$page_id;
		$query_addinfo2 = mysql_query($select_addinfo2);
		$num_addinfo2         =    mysql_num_rows($query_addinfo2);
	 	if($num_addinfo2>0)
		{
		while($view_addinfo2 = mysql_fetch_array($query_addinfo2))
		
		$about_description.='<p>'.$view_addinfo2['description'].'</p>
					';

		}
		else
		{
		$about_description="";		
		
		}
			


			  	
						  
 $is_menu=$item_publish['is_menu'];



if($page_type   == 'default')
{	
include('publish_html_main.php');
}
elseif($page_type   == 'aboutus')
{
include('publish_html_sub.php');
}
elseif($page_type   == 'category')
{
include('publish_html_main_sub1.php');
}
elseif($page_type   == 'sub_category')
{
include('publish_html_main_sub2.php');
}
chmod("$people",0777);
$fh = fopen($name.$people,'w') or die("can't open file");

fwrite($fh,$content_html1);
fclose($fh);
		
		}
		
		}
		/*}*/
	
	$i++;
}
header("location:main_page.php?msg=5");


?>