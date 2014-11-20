<?php
include("smarty_config.php");


if(isset($_REQUEST['h1']))	{
 $header_title1  =   $_REQUEST['h1'];
 ?>

<h1 id="header_replace">
<?=$header_title1;?>
</h1>
<?php  } 
if(isset($_REQUEST['h2']))	{
 $header_title2  =   $_REQUEST['h2'];
 ?>

<h2 id="header2_replace">
<?=$header_title2;?>
</h2>
<?php  } 


if(isset($_REQUEST['id']))
	{
	$id=$_REQUEST['id'];
	$viewSelect = 'SELECT * FROM menu_page_tbl WHERE id = '.$id;
$exViewQuery = mysql_query($viewSelect);
$user_rows       =  mysql_num_rows($exViewQuery);
$view_item = mysql_fetch_array($exViewQuery);
$image=$view_item['image'];
if($user_rows == 0)
{?>
<div id="sub_banner_preview">
<img  src="../images/bg_iphone.jpg" class="max_width" alt="DESSS " title="DESSS" width="" height="">
<div>
<?php 	} elseif($user_rows > 0){ 
?>
<div id="sub_banner_preview">
<img  src="../uplodeImage/thumbImg/<?=$image?>" class="max_width" alt="DESSS" title="DESSS" width="" height="">
<div>
<?php
}
}






if(isset($_REQUEST['main']))
	{
	$page_id=$_REQUEST['main'];
	$viewSelect1 = 'SELECT * FROM menu_page_tbl WHERE id = '.$id;
$exViewQuery1 = mysql_query($viewSelect1);
$user_rows1       =  mysql_num_rows($exViewQuery1);
$view_item1 = mysql_fetch_array($exViewQuery1);
$image=$view_item1['image'];
if($user_rows1 == 0)
{?>
<div id="main_banner_preview"> <img src="../images/bg_iphone.jpg" alt="DESSS TELECOM" title="DESSS " width="767" height="390"> </div>
<?php 	} elseif($user_rows1 > 0){ 
?>
<div id="main_banner_preview"> <img src="../uplodeImage/thumbImg/<?=$image?>" alt="DESSS" title="DESSS TELECOM" width="767" height="390"> </div>

<?php
}
}


if(isset($_REQUEST['about_preview_addinfo']))
	{
?>
<div id="about_preview_addinfo">
<?php $page_id=$_REQUEST['about_preview_addinfo'];
  $select_homeclients = 'SELECT * FROM contentinfo where page_id ='.$page_id;
$query_homeclients = mysql_query($select_homeclients);
if(mysql_num_rows($query_homeclients)>0)
{
echo '';
while($item_homeclients=mysql_fetch_array($query_homeclients)){
  
   ?>
   <div class="wid_50_per_sub fright mar_20 content_desss1">
    <img align="left" class="MR15"  src="../uplodeImage/desc_content/<?=$item_homeclients['image']?>" width="471" height="300" alt="<?=$item_homeclients['imagename']?>" title="<?=$item_homeclients['imagename']?>" />
  <h2>
    <?=$item_homeclients['name']?></h2>
	<p><?=$item_homeclients['desc_content']?></p>
 
    </div>
   <?php }
   
 echo '</div>';  
   
    } else {?>  
</div>
 <?php }?> 
</div>

<?php 
}

if(isset($_REQUEST['about_preview_featured']))
	{
?>
 <div id="about_preview_featured"> 
      <?php
	  $page_id=$_REQUEST['about_preview_featured'];
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
		   
 
   ?>   
    </div>  
<?php 
}
?>
</div>
<?php
 $select_homeclients1 = 'SELECT description FROM menu_page_tbl where parent_id ='.$id;
$query_homeclients1 = mysql_query($select_homeclients1);
if(mysql_num_rows($query_homeclients1)>0)
{
echo '';
while($item_homeclients1=mysql_fetch_array($query_homeclients1)){
  
   ?>
<p><?=$item_homeclients1['description']?></p>
    </div>
  <?php }
   
 echo '</div>';  
   
    } else {?>  
</div>
 <?php }?>
