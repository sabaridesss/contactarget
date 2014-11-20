<?php 



require("code.php");
$fullPath = 'http://www.desss.com/';
$sel_query = "select * from `pakage_categories` WHERE url LIKE '%.html%'";
$exec_Sel_auery = mysql_query($sel_query);
$cot=mysql_num_rows($exec_Sel_auery);
 $packages_count=5;
while($item_publish1=mysql_fetch_array($exec_Sel_auery))
{
	
     $people= $item_publish1['url'];
	 $sel_query1 = "select * from `pakage_categories` WHERE url='".$people."'";
	 $exec_Sel_auery1 = mysql_query($sel_query1);
	
		while($item_publish=mysql_fetch_array($exec_Sel_auery1))
		{
		
		
			$content_html1="";
			$meta_title="";
			$meta_content="";
			$meta_keyword="";
			$eventimage="";
			$header_title1="";
			$content="";
			$meta_title=$item_publish['cat_name'];
			//$meta_content=$item_publish['meta_content'];
			//$meta_keyword=$item_publish['meta_keyword'];
			$header_title1=$item_publish['cat_name'].'&nbsp; Packages';
			$eventimage='<div class="banner"><a href="'.$fullPath.$people.'" ><img src="'.$fullPath.'uplodeImage/thumbImg/default.jpg" title="DESSS"  alt="DESSS" /></a></div>';
			$page_id=$item_publish['id'];
			$content="";
			
		 
		    $selectproj = "SELECT * FROM pkg_tbl WHERE  package_id='".$page_id."'";
		  $exselectproj = mysql_query($selectproj);
		  echo mysql_num_rows($exselectproj);
		  
		  
		  
		  $content.='<style>
.odd {
    background: none repeat scroll 0 0 #b8b8b8 ;
    font-family: Arial;
    font-size: 14px;
    padding-top: 7px;
		
}


.even {
    background: none repeat scroll 0 0 #e3e3e3;
    font-family: Arial;
    font-size: 14px;
    padding-top: 7px;
}
.tbl_head {
    background: none repeat scroll 0 0 #FD6310;
    font-family: Arial;
    font-size: 14px;
    padding-top: 7px;
		color:#FFFFFF !important;
}




</style><table width="100%" border="0" class="tablebox">
  <tbody>
  <tbody>
    <tr class="tbl_head">
	<td  align="center">Packages</td>
      <td  align="center">Silver</td>
      <td  align="center">Gold  </td> 
       <td  align="center">Platinum</td>
    </tr>';
			$i=1;
				while($item_exselectproj=mysql_fetch_array($exselectproj))
				{
				
				$class="even";
	   if(($i%2)==0)
	     $class="odd";
				
				if($item_exselectproj["gold"] == '1')
		$gold = 'Yes';
		else
		$gold = 'No';
		if($item_exselectproj["silver"] == '1')
		$silver = 'Yes';
		else
		$silver = 'No';
		if($item_exselectproj["platinum"] == '1')
		$platinum = 'Yes';
		else
		$platinum = 'No';
				
		 	$content.='<tr class="'.$class.'">
				 <td  align="center">'.$item_exselectproj['description'].'</td>
     			 <td  align="center">';
				 
	 if(($silver=='Yes') && ($item_exselectproj['silver_des']!="")) 
	$content.='&nbsp;'.$item_exselectproj['silver_des'].'&nbsp;';
	else 
	$content.=$silver ;
	
	$content.='</td>
      			 
				 
				 <td  align="center">';
				 
	 if(($gold=='Yes') && ($item_exselectproj['gold_des']!="")) 
	$content.='&nbsp;'.$item_exselectproj['gold_des'].'&nbsp;';
	else 
	$content.=$gold ;
	
	$content.='</td><td  align="center">';
				 
	 if(($platinum=='Yes') && ($item_exselectproj['plat_des']!="")) 
	$content.='&nbsp;'.$item_exselectproj['plat_des'].'&nbsp;';
	else 
	$content.=$platinum ;
	
	$content.='</td>
				 
				 
    			</tr>';
		$i++;	
			
		}
				
						
			$content.=' </tbody>
</table>';	
				
				
			
			require('publish_html_main.php');		
					
			$name = "../";
			chmod("$people",777);
			$fh = fopen($name.$people,'w') or die("can't open file");
			fwrite($fh,$content_html1);
			fclose($fh);
			
		}
}
header("location:packages.php?msg=5");


?>