<?php

include("smarty_config.php");
$fullPath = 'http://www.desss.com/';
//$fullPath = 'http://192.168.1.211/karunakaran/desss_new/';


function menus()
{ 
$fullPath = 'http://www.desss.com/';
	//fetching records for menus
	$query = "select * from menu_page_tbl where is_menu='1' order by order_id asc ";
	$exQuery = mysql_query($query);
    $menu1count = mysql_num_rows($exQuery);
	$count=1;

	while($row = mysql_fetch_array($exQuery))
	{
	
	$numberRow = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id'] .' order by order_id asc';
		$numberRow1= mysql_query($numberRow);
		$numberRow2 = mysql_num_rows($numberRow1);
		
		if($numberRow2 == '0')
		{           
			$menus.='<li class="current"><a  href="'.$fullPath.$row['file_name'].'" >'.$row['title'].'</a></li>';
		}
		else
		{
			$menus.='<li><a href="'.$fullPath.$row['file_name'].'" >'.$row['title'].'</a>';
			
			
			if($count==1)
			$menus.='<div class="it_services sub_menu">';
			elseif($count==2)
			$menus.='<div class="solutions sub_menu">';
			elseif($count==3)
			$menus.='<div class="solutions sub_menu">';
			elseif($count==4)
			$menus.='<div class="solutions sub_menu">';
			elseif($count==5)
			$menus.='<div class="Staffing sub_menu">';
			elseif($count==6)
			$menus.='<div class="products sub_menu">';
			elseif($count==7)
			$menus.='<div class="products sub_menu">'; 
			elseif($count==8)
			$menus.='<div class="technology sub_menu">';
			elseif($count==9)
			$menus.='<div class=" sub_menu">'; 
				
		
			$subMenu = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id'].' order by order_id asc';
		 	$subMenu1 = mysql_query($subMenu);			
			$numbersub2 = mysql_num_rows($subMenu1);			
		$nubsubcount=1;
			while($row1 = mysql_fetch_array($subMenu1))
			{
			    if($count==1)
				{
			 if(($nubsubcount==1) || ($nubsubcount==5) || ($nubsubcount==9) )
			$menus.='<article class="ffleft width175"><article>';
			else
			$menus.='<article class="MT10">';
				}
				elseif($count==2)
				{
				if(($nubsubcount==1) || ($nubsubcount==3) || ($nubsubcount==7) )
			$menus.='<article class="ffleft width175"><article>';
			else
			$menus.='<article class="ffleft width175 MT10">';
	           }  
			   elseif($count==3)
				{
				
				if(($nubsubcount==1) ||  ($nubsubcount==4) )
			$menus.='<article class="ffleft width175"><article>';
			else 
			$menus.='<article class="ffleft width175 MT10">';
	           }  
			    elseif($count==4)
				{
				
				if(($nubsubcount==1) ||  ($nubsubcount==5) )
			$menus.='<article class="ffleft width175"><article>';
			else 
			$menus.='<article class="ffleft width175 MT10">';
	           } 
			     elseif($count==5)
				{
				
				if(($nubsubcount==1) ||  ($nubsubcount==4) )
			$menus.='<article class="ffleft  width199"><article>';
			else 
			$menus.='<article class="ffleft width199 MT10">';
	           } 
			     elseif($count==6)
				{
				
				if(($nubsubcount==1) ||  ($nubsubcount==6) )
			$menus.='<article class="ffleft width187"><article>';
			else 
			$menus.='<article class="ffleft width187 MT10">';
	           } 
			 elseif($count==7)
				{
				
				if(($nubsubcount==1) ||  ($nubsubcount==17) )
			$menus.='<article class="ffleft width187"><article>';
			else 
			$menus.='<article class="ffleft width187 MT10">';
	           } 
			    elseif($count==8)
				{
				
				if(($nubsubcount==1) ||  ($nubsubcount==4) )
			$menus.='<article class="ffleft width120"><article>';
			else 
			$menus.='<article class="ffleft width120 MT10">';
	           } 
			    elseif($count==9)
				{
				
				if(($nubsubcount==1) ||  ($nubsubcount==4) )
			$menus.='<article class="ffleft width120"><article>';
			else 
			$menus.='<article class="ffleft width120 MT10">';
	           } 
			   
			   
			 
			   
				//$menus.=$nubsubcount;	
				
//$menus.= $count;		
				$numberRow3 = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'] .' order by order_id asc';
				$numberRow4= mysql_query($numberRow3);
				$numberRow5 = mysql_num_rows($numberRow4);
				
				if($numberRow5 == '0')
				{
					$menus.='<span><a href="'.$fullPath.$row1['file_name'].'">'.$row1['title'].'</a> </span>';
					
				}
				else
				
				{   
			
					$menus.='<span><a href="'.$fullPath.$row1['file_name'].'">'.$row1['title'].'</a> </span>';
 
					 $inserSubMenu = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'].' order by order_id asc';
					$inserSubMenu1 = mysql_query($inserSubMenu);
					 $numbersub22 = mysql_num_rows($inserSubMenu1);
			
					while($row2 = mysql_fetch_array($inserSubMenu1))
					{
					
					
					$menus.='<p><a href="'.$fullPath.$row2['file_name'].'">'.$row2['title'].'</a></p>';
					
				}
									
				}
			 if($count==1)
				{	
				if(($nubsubcount==1) || ($nubsubcount==5) || ($nubsubcount==9) )
				$menus.='</article>';
				elseif(($nubsubcount==4) || ($nubsubcount==8) || ($nubsubcount==12) )
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }
			 else if($count==2)
				{	
				if(($nubsubcount==1) || ($nubsubcount==3) || ($nubsubcount==7) )
				$menus.='</article>';
				elseif(($nubsubcount==2) || ($nubsubcount==6) || ($nubsubcount==12) )
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }
			   else if($count==3)
				{	
				if(($nubsubcount==1) ||  ($nubsubcount==6) )
				$menus.='</article>';
				elseif(($nubsubcount==3)  || ($nubsubcount==15) )
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }
			  else if($count==4)
				{	
				if(($nubsubcount==1) ||  ($nubsubcount==12) )
				$menus.='</article>';
				elseif(($nubsubcount==4)  || ($nubsubcount==15) )
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }
			   else if($count==5)
				{	
				if(($nubsubcount==1) ||  ($nubsubcount==5) )
				$menus.='</article>';
				elseif(($nubsubcount==3)  || ($nubsubcount==15) )
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }
			   else if($count==6)
				{	
				if(($nubsubcount==1) ||  ($nubsubcount==12) )
				$menus.='</article>';
				elseif(($nubsubcount==5)  || ($nubsubcount==15) )
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }
			else if($count==7)
				{	
				if($nubsubcount==1) 
				$menus.='</article>';
				elseif($nubsubcount==16)  
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }else if($count==8)
				{	
				if(($nubsubcount==1) ||  ($nubsubcount==12) )
				$menus.='</article>';
				elseif(($nubsubcount==3)  || ($nubsubcount==15) )
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }
			  else if($count==9)
				{	
				if(($nubsubcount==1) ||  ($nubsubcount==12) )
				$menus.='</article>';
				elseif(($nubsubcount==3)  || ($nubsubcount==15) )
				$menus.='</article></article>';
				else
				$menus.='</article>';
			  }
				$nubsubcount++;
					}
		
			
	
	$menus.='</div></li>';
		
		
		$artcount++;
		}
	
		
		$count++;
	}

return $menus;

}



//fetching records for pages
function pages()
{
	$fullPath = 'http://www.desss.com/';
	$query = "";
	$query_result = "";
	$resultset = "";
	$footer = "";
	$pages = "";
	$query = "select b.title as title,b.file_name as file_name from top_banner a,menu_page_tbl b where a.Page_ID=b.id order by a.order_id asc";
	$query_result = mysql_query($query);
	$page_count=1;
	$page_countr=mysql_num_rows($query_result);
	if(mysql_num_rows($query_result)>0) {
	
		while($val = mysql_fetch_assoc($query_result)) {
		if($page_count ==1)
		 {
		$pagstyl='style="border:none"';
		}
		else
		{
		$pagstyl='';
		}
		
			$pages.="<a href='".$fullPath.$val['file_name']."'>".$val['title']."</a>";
			$page_count++;
		}
	}
	
	
	
	return $pages;

}
function menus1()
{ 
$fullPath = 'http://www.desss.com/';
	//fetching records for menus
	$query = "select * from menu_page_tbl where is_menu='1' order by order_id asc ";
	$exQuery = mysql_query($query);
    $menu1count = mysql_num_rows($exQuery);
	$count=1;

	while($row = mysql_fetch_array($exQuery))
	{
	
	 	$numberRow = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id']; 
		$numberRow1= mysql_query($numberRow);
		$numberRow2 = mysql_num_rows($numberRow1);
		
		if($numberRow2 == '0')
		{           
			$menus1.='<h3><a  href="'.$fullPath.$row['file_name'].'" >'.$row['title'].'</a></h3>';
		}
		else
		{
			$menus1.='<h3><a href="'.$fullPath.$row['file_name'].'" >'.$row['title'].'</a></h3><div class="inner">';
			
			$subMenu = 'select * from menu_page_tbl where is_menu=\'2\' AND parent_id = ' .$row['id'].' order by order_id asc';
			$subMenu1 = mysql_query($subMenu);
			
			$numbersub2 = mysql_num_rows($subMenu1);
			
			$nubsubcount=1;
			
			while($row1 = mysql_fetch_array($subMenu1))
			{
	
							
				$numberRow3 = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'];
				$numberRow4= mysql_query($numberRow3);
				$numberRow5 = mysql_num_rows($numberRow4);
				if($numberRow5 == '0')
				{
					$menus1.='<h4><a href="'.$fullPath.$row1['file_name'].'">'.$row1['title'].'</a></h4>';
					
				}
				else
				{   
			
					$menus1.='<h4><a href="'.$fullPath.$row1['file_name'].'">'.$row1['title'].'</a></h4><div class="inner">';
 
					$inserSubMenu = 'select * from menu_page_tbl where is_menu=\'3\' AND parent_id = ' .$row1['id'].' order by order_id asc';
					$inserSubMenu1 = mysql_query($inserSubMenu);
					$numbersub22 = mysql_num_rows($inserSubMenu1);
					
					while($row2 = mysql_fetch_array($inserSubMenu1))
					{
					
					
				$query_menu_4 = 'select * from menu_page_tbl where is_menu=\'4\' AND parent_id = ' .$row2['id'];
				$number_ex_menu_4= mysql_query($query_menu_4);
				$number_row_menu_4 = mysql_num_rows($number_ex_menu_4);
					
					if($number_row_menu_4 == '0')
				{
					$menus1.='<h4><a href="'.$fullPath.$row2['file_name'].'">'.$row2['title'].'</a></h4>';
					
				}
				else
				{   
					
						$menus1.='<h4><a href="'.$fullPath.$row2['file_name'].'">'.$row2['title'].'</a></h4>';
						
						//$menus.='<ul class="the_sub">';
					$inser_sub_4 = 'select * from menu_page_tbl where is_menu=\'4\' AND parent_id = ' .$row2['id'].' order by order_id asc';
					$inserSubMenu4 = mysql_query($inser_sub_4);
					$numbersub_row = mysql_num_rows($inserSubMenu4);
					
					while($row_fetch = mysql_fetch_array($inserSubMenu4))
					{
					//	$menus.='<li><a href="'.$row_fetch['file_name'].'">'.$row_fetch['title'].'</a></li>';
						
						}
					
					//$menus.='</ul>';	
				}
				
				
						
				}
				$menus1.='</div>';
				
					}
		$nubsubcount++;
		}	
	
	$menus1.='</div>';
		
		}
	
		
		$count++;
	}

return $menus1;

}


//fetching records for footers
function footers()
{

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



$select_anal         = "select * from analitic_tbl";
$select_imp          =  mysql_query($select_anal);
$count_analtic       =  mysql_num_rows($select_imp);
$analtic_fetch       =  mysql_fetch_array($select_imp);
$analtic_fetch['meta_misc'];
$analtic_fetch['g_analitic'];




function sidebarEach($imageId)
{
	//fetching records Sidebars for Each Page

	$query = "";
	$query_result = "";
	$resultset = "";
	$footer = "";
	
	$query = "select b.title as title,b.file_name as file_name from navi_each_page_tbl a,menu_page_tbl b where a.page_id=$imageId and a.link_id=b.id order by a.page_order asc";
	
	$query_result = mysql_query($query);
	$sideEach_cont=mysql_num_rows($query_result);
	if($sideEach_cont>0){
$sidebars.='<div class="call_service MT10">
        <p class="box_head PL10">Services</p>
        <div class="request_inner_bg PB10 box-quote">
          <ul class="services_icons1">';
		while($val = mysql_fetch_assoc($query_result))
		{	
					$sidebars.="<li><a href='".$fullPath."".$val['file_name']."'>".$val['title']."</a></li>";

		}
		
		$sidebars.='</ul>
        </div>
        <div> </div>
      </div>';
		
	}
	return $sidebars;
}


//fetching records for Sound Media

function soundMedia()
{
$fullPath = 'http://www.desss.com/';
	$selectSound = 'SELECT * FROM social_media_tbl WHERE active = 1 ORDER BY image_order ASC';
	$exSound = mysql_query($selectSound);

		$imgPath = 'uplodeImage/soundMedia/';
		while($rowSound = mysql_fetch_array($exSound))
			{

          $soundMedia.= '<a class="PL12" href="'.$rowSound['media_link'].'" target="_blank"><img  class="MT8"  src="'.$fullPath.$imgPath.$rowSound['media_image'].'" alt="'.$rowSound['company_name'].'" title="'.$rowSound['company_name'].'"/></a>';
		  }
 	
	return $soundMedia;
}




//NEW FOOTER
 $footer_query   = "select * from footer_menu order by link_page asc";
$footer_execute = mysql_query($footer_query) ;
$footer_content.="";
$footer_count=1;
$footer_countr=mysql_num_rows($footer_execute);
while($footer_fetch=mysql_fetch_array($footer_execute))
{
  if($footer_count == 1)
   {
$class1='<p class="font_footer_links one">';
		
$class2='<div class="ffleft four fotter_links_bottom PL10">
        <ul class="footer_inner_fon MT8">';		
}
elseif($footer_count == 2)
{
$class1='<p class="font_footer_links no_bor_lap cur_sub">';
 $class2='<div class="ffleft fotter_links_bottom PL10">
        <ul class="footer_inner_fon MT8">';
}	
elseif($footer_count == 3)
{
$class1='<p class="font_footer_links cur_sub1 ">';
 $class2='<div class="ffleft fotter_links_bottom cur_sub2 PL10">
        <ul class="footer_inner_fon MT8">';
}	
	
else
{
$class1='<p class="font_footer_links two no_border">';
 $class2='<div class="ffleft three fotter_links_bottom PL10">
        <ul class="footer_inner_fon MT8">';
}	

$footer_content.='<div class="footer_div'.$footer_count.' fleft MT10">'.$class1.$footer_fetch['footer_name'].'</p> ';
   $sub_footer="select * from navi_each_page_tbl where footer_id=".$footer_fetch['footer_id']." order by page_order asc";
	$sub_footer_execute = mysql_query($sub_footer) ;
	$footer_content.=$class2;
	while($sub_footer_fetch=mysql_fetch_array($sub_footer_execute))
	{
	$menu_footer="select * from menu_page_tbl where id=".$sub_footer_fetch['link_id'];
	$menu_select = mysql_query($menu_footer);
	
	  while($menu_fetch= mysql_fetch_array($menu_select))
	  {
	  $footer_content.='<li><a href="'.$fullPath.$menu_fetch['file_name'].'">'.$menu_fetch['title'].'</a></li>';
	  }
	
	}
 $footer_content.='</ul><div class="spacer"></div>
      </div> </div>';
	  $footer_count++;
}







/*$content = array();
$content = content();*/

//$analitic = array();
//$analitic = analitic_code();
//$page_id = GetPageid();
$pages = pages();
$footer = footers();
//$article_var = article();
//$sidebars = sidebarEach($page_id);
//$footer_content = footer_links();
//$footer_content1 = footer_links1();
$menus = menus();
$menus1 = menus1();
$soundMedia = soundMedia();
//$menus1 = menus1();
//$content_part = array();
//$content_part = content();
//$pageURL = pageURLName();









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
        $fpage.= " <a href='" . $PHP_SELF . "?page=".($page-1)."&search=$searchtext'>Previous" . $space . $pagelimit . "</a>" . $space . $space . "";
    }

// dynamic page number links

    for ($i=1; $i<=$pagenums; $i++) {
        if ($i!=$page) {
            $dpage.= " <a href='" . $PHP_SELF . "?page=$i&search=$searchtext' >$i</a>";
        }
        else {
            $dpage.= " <b>[".$i."]</b>";
        }
    }


// next link 0  (if the page you are on is less than the total amount of page numbers, there are more pages left)

    if ($page<$pagenums) {
       $pless.= "" . $space . $space . $space . $space . " <a href='" . $PHP_SELF . "?page=".($page+1)."&search=$searchtext' class=main>Next " . $var2 . "</a> ";
    }


// LIMIT 0,10 will start at 0 and display 10 results
// LIMIT 10,5 will start at 10 and display 5 results

/* now you can do whatever you'd like with this query. it will only output ten results per page.
change the $pagelimit variable to whatever to output more than 10 result per page. */

}


	
	}
	
	/*pagination ends*/
	
	
?>


