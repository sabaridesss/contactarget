<?php

function get_top_menus() {

		 $get_topmenus_query = get_topmenus_query();
		
		 $num_of_menus = get_num_record($get_topmenus_query);
		 
        $fetch_array_menus = get_fetch_record($get_topmenus_query);

		$output = "";
							
		for($p=0;$p<$num_of_menus;$p++){
	   
          $category_id = $fetch_array_menus[$p]['Main_category_ID'];
		  $category_name = $fetch_array_menus[$p]['Main_category_name'];
		  $page_name = $fetch_array_menus[$p]['page_name'];

				 if($page_name == 'Nill'){
				
				  $output .= "<li><a href='#'>$category_name</a>";
				 }else{
				  $output .= "<li><a href=http://www.rapidtorc.com/$page_name>$category_name</a>";
				 }
				 $output .="<ul>";

				  $get_submenus_query = get_submenus_query($category_id);
				  $nmu_of_submenus = get_num_record($get_submenus_query);
				  $fetch_array_submenus = get_fetch_record($get_submenus_query);
		
				  for($q=0;$q<$nmu_of_submenus;$q++){

					  $sub_id = $fetch_array_submenus[$q]['id'];
					  $sub_title = $fetch_array_submenus[$q]['sub_title'];
					  $sub_page_name = $fetch_array_submenus[$q]['page_name'];

						 if($sub_page_name == 'Nill'){

						  $output .="<li><a href='#'>$sub_title</a>";
						 }
						 else{
							  $output .="<li><a href=http://www.rapidtorc.com/$sub_page_name>$sub_title</a>";
							// $output .="<li><a href=page.php?sub_cat=$sub_id>$sub_title</a></li>";
						 }

			 $get_childmenus_query = get_childsubmenus_query($sub_id);
			 $nmu_of_childmenus = get_num_record($get_childmenus_query);
			 $fetch_array_childmenus = get_fetch_record($get_childmenus_query);
			$output .="<ul>";
			 for($m=0;$m<$nmu_of_childmenus;$m++){
			  $sub_id = $fetch_array_childmenus[$m]['sub_id'];
			  $sub_title1= $fetch_array_childmenus[$m]['sub_title'];
			  $sub_page_name1 = $fetch_array_childmenus[$m]['page_name'];

			   $output .="<li><a href=http://www.rapidtorc.com/$sub_page_name1>$sub_title1</a></li>";

		  }

		  $output .= "</ul></li>";

				  }
		
		 			  $output .="</ul></li>";

		 }
		 return $output;

}


 function get_overview_for_subcat($subcat,$master_category)
 {

if($master_category != 1)
{

$height = "300px";

$width = "280px";


}else if($master_category == 1)
{

$height = "auto";

$width = "auto";



}
 
 $overview_for_sub_category = overview_for_sub_category($subcat);
	
 $num_of_records  = get_num_record($overview_for_sub_category);
    	  
 $fetch_array     = get_fetch_record($overview_for_sub_category);

 $title = $fetch_array[0]['h1_title'];

 $dir = "admin/user_images/".$subcat."/";


if(is_dir($dir)){
	//echo  $images = "<div style='display:none;'>".images_in_folder("admin/user_images/$subcat/")."</div>";
				}else{
	//echo  $images = "<div style='display:none'>".images_in_folder("admin/user_images/no_image/1/")."</div>";
				}
 
$output = "<table width='400px' cellspacing='0' cellpadding='0' border='0'>";



$output .="<tr><td width='$width' colspan='2' align='center' valign='top' height='$height'>";

if(is_dir($dir))
			{

if($master_category != 1){
			$output .="<img src='http://www.rapidtorc.com/admin/user_images/".$subcat."/main.jpg' alt='Rapid-Torc-Rt Hydraulic Torque Wrench' width='259px' height=' 275px' style='border:#000000 solid 2px; padding:1px 1px;'/>";

			$output .= "<table width='291' border='0' cellpadding='5'>
  <tr>
    <td width='150' align='center' valign='top' style='background:url(images/straight-line.gif) right top no-repeat;'><div><a href='http://www.rapidtorc.com/admin/user_images/".$subcat."/main.jpg' rel='lightbox' title=''><img src='http://www.rapidtorc.com/images/enlarge-img.gif' width='71' height='57' alt='' /></a></div></td>";
	
if(is_dir($dir))
	 {
$output .= images_in_folder("admin/user_images/$subcat/");
	 }else {
$output .= images_in_folder("admin/user_images/no_image/1/");
	 }

$output .="</tr></table>";

			$output .= "</td>";
			}else {
if($master_category != 1){
			$output .="<img src='http://www.rapidtorc.com/admin/user_images/no_image/1/noimage.gif' alt='No Image Available' width='291' height='259' /></td>";
			}
}
}
if($title==""){
	 $output.="<td valign='top'>";
}else{

  $output.="<td width='300px' valign='top'><div class=in-head align=center>$title</div>";
}

if($num_of_records > 0){

for($p=0;$p<$num_of_records;$p++){
	      $tap_id = $fetch_array[$p]['tap_id'];
		  $tap_title = $fetch_array[$p]['tap_title'];
		  $tap_description = $fetch_array[$p]['content'];
		 // if($tap_title == 'Overview' || $tap_title == 'Specifications' ){
			$output .= "<div style='width:450px;' >$tap_description</div>";
  		 //  }
	}

}

/*$output .= "</td></tr><tr>
    <td width='150' align='center' valign='top' style='background:url(images/straight-line.gif) right top no-repeat;'><div><a href='admin/user_images/".$subcat."/main.jpg' rel='lightbox' title=''><img src='images/enlarge-img.gif' width='71' height='57' alt=''/></a></div></td>";
*/

$output .="</tr></table>";

return $output;
 
 }




function get_overview_for_childcat($child_id)
 {
 
$overview_for_sub_category = overview_for_child_category($child_id);
	
 $num_of_records  = get_num_record($overview_for_sub_category);
    	  
 $fetch_array     = get_fetch_record($overview_for_sub_category);


 $title = $fetch_array[0]['h1_title'];

 $dir = "admin/user_images/child_image/".$child_id."/";

if(is_dir($dir)){
	//echo  $images = "<div style='display:none'>".images_in_folder("admin/user_images/child_image/$child_id/")."</div>";
				}else{
	//echo  $images = "<div style='display:none'>".images_in_folder("admin/user_images/no_image/1/")."</div>";
				}
 
$output = "<table width='400px' border='0' cellspacing='0' cellpadding='0'>
  <tr><td width='300' colspan='2' align='center' valign='top' height='280'>";

if(is_dir($dir))
			{
			$output .="<img src='http://www.rapidtorc.com/admin/user_images/child_image/".$child_id."/main.jpg' alt='Rapid-Torc-Rt Hydraulic Torque Wrench' width='275px' height='259' style='border:#000000 solid 2px; padding:1px 1px;'/>";

$output .="<table width='291' border='0' cellpadding='5'>
  <tr>
   <td width='150' align='center' valign='top' style='background:url(images/straight-line.gif) right top no-repeat;'><div><a href='http://www.rapidtorc.com/admin/user_images/child_image/".$child_id."/main.jpg' rel='lightbox' title=''><img src='http://www.rapidtorc.com/images/enlarge-img.gif' width='71' height='57' alt=''/></a></div></td><td>";

if(is_dir($dir))
	 {
$output .= images_in_folder("admin/user_images/child_image/$child_id/");
	 }else {
$output .= images_in_folder("admin/user_images/no_image/1/");
	 }

$output .= "</td></tr></table>";


			$output .="</td>";
			}else {
			$output .="<img src='http://www.rapidtorc.com/admin/user_images/no_image/1/noimage.gif' alt='No Image Available' width='291' height='259' /></td>";
			}

if($title==""){
	 $output.="<td valign='top'>";
}else{

  $output.="<td width='300px' valign='top'><div class=in-head align=center>$title</div>";
}
if($num_of_records > 0){

for($p=0;$p<$num_of_records;$p++){
	      $tap_id = $fetch_array[$p]['tap_id'];
		  $tap_title = $fetch_array[$p]['tap_title'];
		  $tap_description = $fetch_array[$p]['content'];
		 // if($tap_title == 'Overview' || $tap_title == 'Specifications' ){
			$output .= "<div style='width:450px;' >$tap_description</div>";
  		 //  }
	}

}

/*$output .= "</td></tr><tr>
    <td width='150' align='center' valign='top' style='background:url(images/straight-line.gif) right top no-repeat;'><div><a href='admin/user_images/child_image/".$child_id."/main.jpg' rel='lightbox' title=''><img src='images/enlarge-img.gif' width='71' height='57' alt=''/></a></div></td>";
*/

$output .="</tr></table>";

return $output;

 
 }




/*function get_meta_title($subcat_id){

 $meta_title_category = overview_for_sub_category($subcat_id);
	
 $num_of_records  = get_num_record($meta_title_category);
    	  
 $fetch_array     = get_fetch_record($meta_title_category);

		  
 $meta_title = $fetch_array[0]['meta_title'];
 $meta_content = $fetch_array[0]['meta_content'];
 $meta_keyword = $fetch_array[0]['meta_keyword'];
  $output .= $fetch_array[0]['h1_title'];
  $output .= $fetch_array[0]['h2_title'];
 $output .= $fetch_array[0]['meta_misc'];


$output .= "<title>".$meta_title."</title>";
$output .= '<meta name="description" content="'.$meta_content.'" /><br>';
$output .= '<meta name="keywords" content="'.$meta_keyword.'" /><br>';
 //return  $output;



//echo $meta_title."\n";

//$meta_title = str_replace('\"','"',$meta_title)."\n";
	
// if($meta_title == "")
//	{
//	$meta_title ="<title>Rapid-Troc</title>";
//	}
 echo $output;

}

*/
function get_search_data($search_data,$limit){

$mysql_obj = new mysql_class();
$get_search_result_query = $mysql_obj->get_search_result_query_page_contents($search_data,$limit);
$get_search_result_query_subpagecontents = $mysql_obj->get_search_result_query_subpagecontents($search_data,$limit);
$get_search_result_query_tabcontents = $mysql_obj->get_search_result_query_tabcontents($search_data,$limit);
	
$num_of_records  = $mysql_obj->get_num_record($get_search_result_query);
$fetch_array     = $mysql_obj->get_fetch_record($get_search_result_query);

$num_of_sub_page_records  = $mysql_obj->get_num_record($get_search_result_query_subpagecontents);
$fetch_array_sub_page     = $mysql_obj->get_fetch_record($get_search_result_query_subpagecontents);

$num_of_tab_records  = $mysql_obj->get_num_record($get_search_result_query_tabcontents);  	  
$fetch_array_tab_page     = $mysql_obj->get_fetch_record($get_search_result_query_tabcontents);


$output = "<table border='0' width='630px' class='innerspe'>";
if($num_of_records > 0 || $num_of_sub_page_records>0 || $num_of_tab_records>0){

	for($p=0;$p<$num_of_records;$p++)
	{
	 $page_name = $fetch_array[$p]['title'];
	 $file_name = $fetch_array[$p]['file_name'];
	 $content = strip_tags($fetch_array[$p]['description']);
	
	$img_dir = "admin/Main_Menu/".$fetch_array[$p]['id']."/Thumbs/main.jpg";
	
	$output .= "<tr><td colspan='2'><h2>".$fetch_array[$p]['h1_title']."</h2></td></tr>
	
	<tr><td></td><td><div class='innerspe' style='font-size:12px'>".substr($content,0,300)."</div>&nbsp;&nbsp;&nbsp;<a href='".$file_name."' class='readmore' style='font-size:11px;color:#4f8101;text-decoration:underline;'>Read More</a></td></tr>
	
	<tr><td colspan='2'><hr></td></tr>";
	
	}

	
	for($i=0;$i<$num_of_sub_page_records;$i++)
	{
	 $sub_page_name = $fetch_array_sub_page[$i]['title'];
	 $file_name = $fetch_array[$p]['file_name'];
	 $content = strip_tags($fetch_array_sub_page[$i]['description']);
	
	 $img_dir_sub = "admin/Main_Menu/".$fetch_array_sub_page[$i]['id']."/Thumbs/main.jpg";
	
	 $output .= "<tr><td colspan='2'><h2>".$fetch_array_sub_page[$i]['h1_title']."</h2></td></tr>
	
	 <tr><td></td><td><div class='innerspe' style='font-size:12px'>".substr($content,0,300)."</div>&nbsp;&nbsp;&nbsp;<a href='".$file_name."' class='readmore' style='font-size:11px;color:#4f8101;text-decoration:underline;'>Read More</a></td></tr>
	
	<tr><td colspan='2'><hr></td></tr>";
	}

	
	for($k=0;$k<$num_of_tab_records;$k++)
	{	
		echo "<br/>";
		echo $num_of_tab_records." Test3";
	  $tab_name = $fetch_array_tab_page[$k]['Tab_Title'];
	   $content = strip_tags($fetch_array_tab_page[$k]['Tab_Description']);
	  $content1 = substr($content,0,300);
	  $parent_id = strip_tags($fetch_array_tab_page[$k]['parent_id']);
	  $parent_query = mysql_query("select * from menu_page_tbl where id='$parent_id'");
	  $parent_fetch = mysql_fetch_array($parent_query);
	  $file_name1 = $parent_fetch['file_name'];
	  
	
	 $output .= "<tr><td colspan='2'><h2>".$tab_name."</h2></td></tr>
	
	 <tr><td></td><td><div class='innerspe' style='font-size:12px'>".$content1."</div>&nbsp;&nbsp;&nbsp;<a href='".$file_name1."' class='readmore' style='font-size:11px;color:#4f8101;text-decoration:underline;'>Read More</a></td></tr>
	
	<tr><td colspan='2'><hr></td></tr>";
	}
	
}else{
 $output .= "<tr><td colspan='2'><span style='color:#FF0000; font-size:12px; font-weight:bold;'>No results found.</span></td></tr>";

}
$output .= "</table>";

return $output;

}


/**************************************************************************************/

function get_contents_for_main_menu($main_cat_id){

$get_page_contents_for_main_menu = get_page_contents_for_main_menu($main_cat_id);

$num_of_records  = get_num_record($get_page_contents_for_main_menu);
    	  
$fetch_array     = get_fetch_record($get_page_contents_for_main_menu);


$output = "<table border='0' width='740px' style='border:#eaeaea solid 2px;'>";

if($num_of_records > 0){

for($p=0;$p<$num_of_records;$p++)
{
 $page_name = $fetch_array[$p]['page_name'];

if($page_name != "Hydraulic_Torque_Wrench/Technical_Support.html" && $page_name != "hydraulic_stud_tensioners/tec_support.html"){

// $content = strip_tags($fetch_array[$p]['content']);

$content = $fetch_array[$p]['content'];

  $sub_cat_id = $fetch_array[$p]['id'];

if($sub_cat_id == 75){

//$ht = "275px" ;
$ht = "259px" ;
//$wt = "259px";
$wt = "275px";

}else{

$ht = "200px";

$wt = "350px";


}

$get_sub_page_contents_for_main_menu = get_sub_page_contents_for_main_menu($sub_cat_id);

$num_of_sub_page_records  = get_num_record($get_sub_page_contents_for_main_menu);
    	  
$fetch_array_sub_page     = get_fetch_record($get_sub_page_contents_for_main_menu);

//$img_dir = "admin/user_images/thumb_image/".$fetch_array[$p]['id']."/main.jpg";

$img_dir = "admin/user_images/thumb_image/".$fetch_array[$p]['id']."/main.jpg";

$output .= "<tr><td colspan='2'><a href='http://www.rapidtorc.com/$page_name' class='menu_href'>".$fetch_array[$p]['h1_title']."</a></td></tr>

<tr><td align='center'><img src='$img_dir' width='$wt' height='$ht' style='border:#000000 solid 2px; padding:1px 1px;'></td><td valign='top' width='500px'><p>".substr($content,0,500)."</p>&nbsp;&nbsp;&nbsp;<a href='http://www.rapidtorc.com/$page_name' class='menu_href'>Read More</a></td></tr>";

if($num_of_sub_page_records > 0){

 $output .= "<tr><td colspan='2'>


<table border='0' width='770px' align='right'>";
for($i=0;$i<$num_of_sub_page_records;$i++)
{

 $sub_page_name = $fetch_array_sub_page[$i]['page_name'];

 $content = strip_tags($fetch_array_sub_page[$i]['content']);

// $img_dir_sub = "admin/user_images/child_image/thumb_image/".$fetch_array_sub_page[$i]['sub_id']."/main.jpg";

 $img_dir_sub = "admin/user_images/child_image/thumb_image/".$fetch_array_sub_page[$i]['sub_id']."/main.jpg";
$output .= "<tr><td></td><td colspan='2'>
<a href='http://www.rapidtorc.com/$sub_page_name' class='menu_href'>".$fetch_array_sub_page[$i]['h1_title']."</a></td></tr>

 <tr><td align='center' width='25px'><span style=''><img src = 'http://www.rapidtorc.com/images/arrow.gif'></span></td><td><img src='$img_dir_sub' width='350' height='200' style='border:#000000 solid 2px; padding:1px 1px;'></td><td valign='top'><p>".substr($content,0,500)."</p>&nbsp;&nbsp;&nbsp;<a href='http://www.rapidtorc.com/$sub_page_name' class='menu_href'>Read More</a>

</td></tr>";

if($i != $num_of_sub_page_records-1)
{
$output .= "<tr><td></td><td colspan='2'><hr></td></tr>";
}

}
$output .= "</table>

</td></tr>";

}


$output .= "<tr><td colspan='2'><hr></td></tr>";



}
}


}else{
// $output .= "<tr><td colspan='2'><span style='color:#FF0000; font-size:12px; font-weight:bold;'>No results found.</span></td></tr>";

}
$output .= "</table>";

return $output;

}



?>