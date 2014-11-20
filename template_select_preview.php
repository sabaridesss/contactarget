<?php
include("smarty_config.php");




$temp_page_type     =  $_REQUEST['page_value'];
$type_page_id       =  $_REQUEST['type_page_id'];
$page_id            =  $_REQUEST['type_page_id'];
 $temp_sel_query = "update `menu_page_tbl` set `page_type`	    =  '".($temp_page_type)."' 
												  where `id` 			=  '".($type_page_id)."'";
												  
$temp_imple =  mysql_query($temp_sel_query); 												  
								 
$temp_imple_temp_sel    =  "select * from menu_page_tbl where id = '".$type_page_id."'";
$temp_imple_query       =  mysql_query($temp_imple_temp_sel); 
$temp_imple_fetch       =  mysql_fetch_array($temp_imple_query); 
$is_menu                = $temp_imple_fetch['is_menu'];
?>
 
 
 <div id="design_html">
                            <?php 
					//	echo	$page_type__id=$_REQUEST['page_value'];
												 					 
                       require("../preview/module1/".$temp_page_type.".php"); ?>
                          </div>
 

