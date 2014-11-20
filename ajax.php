<?php
//include("connect.php");
	include("smarty_config.php");
include("top_menu.php");

$delete_id=$_GET['delete_id'];

$menus_id=$_GET['menus_id'];

$submenus_id=$_GET['submenus_id'];

$deletetab_id=$_GET['deletetab_id'];

$deletechildtab_id=$_GET['deletechildtab_id'];
$delete_news_id=$_GET['delete_news_id'];
$delete_category_id=$_GET['delete_category_id'];
$select_category_id=$_GET['select_category_id'];
$delete_product_id=$_GET['delete_product_id'];
$action = $_REQUEST['action'];

$delete_child_tab_id = $_REQUEST['delete_child_tab_id'];


if($delete_id != ""){

	$query = "delete from page_contents where id='".$delete_id."'";
	if(mysql_query($query))
	{
	 	echo 'Suceessfully deleted';
	}
	else
	{
	 echo mysql_error();
	}
}



if($menus_id != ""){

$sel_query = "select * from `menu_page_tbl` where `parent_id` = '$menus_id'";

$exec_Sel_auery = mysql_query($sel_query);

$num_of_rows = mysql_num_rows($exec_Sel_auery);

if($num_of_rows == 0)
{
	$query = "delete from menu_page_tbl where id='".$menus_id."'";
	if(mysql_query($query))
	{
	 	echo 'Suceessfully deleted';
	}
	else
	{
	 echo mysql_error();
	}
}else if($num_of_rows > 0)
{

     echo 'This menu has submenus.Hence cannot be deleted here.';

}
}

if($submenus_id != ""){

  $sel_sub_menu_query = "select * from `page_contents` where `Sub_Parent_ID` = '$submenus_id'";

$exec_sub_menu_auery = mysql_query($sel_sub_menu_query);

$num_of_rows_sub_menu = mysql_num_rows($exec_sub_menu_auery);

if($num_of_rows_sub_menu == 0)
{

	$query = "delete from page_contents where id='".$submenus_id."'";
	
	if(mysql_query($query))
	{
	 	echo 'Suceessfully deleted';
	}
	else
	{
	 echo mysql_error();
	}
	
}else if($num_of_rows_sub_menu > 0)
{

     echo 'This menu has submenus.Hence cannot be deleted here.';

}
}

if($deletetab_id != ""){

	$query = "delete from tabs_tbl where Tab_ID ='".$deletetab_id."'";
	if(mysql_query($query))
	{
	 	echo 'Suceessfully deleted';
	}
	else
	{
	 echo mysql_error();
	}
}

if($delete_child_tab_id != "" && $action == "delete_child_tab"){

	 $query = "delete from `childtaps_tpl` where `tap_id` = '$delete_child_tab_id' ";

	if(mysql_query($query))
	{
	 	echo 'Suceessfully deleted';
	}
	else
	{
	 echo mysql_error();
	}
}

if($delete_news_id != ""){

	 $query = "delete from `news_tbl1` where `news_id` = '$delete_news_id' ";

	if(mysql_query($query))
	{
	 	echo 'Suceessfully deleted';
	}
	else
	{
	 echo mysql_error();
	}
}

if($delete_category_id != ""){

	 $query = "delete from `prod_category` where `id` ='$delete_category_id'";

	if(mysql_query($query))
	{
	 	echo 'Suceessfully deleted';
	}
	else
	{
	 echo mysql_error();
	}
}

if($select_category_id != ""){
	
	 $query = "select * from `products` where `prod_category` ='$select_category_id'";
	 $prod_count=mysql_query($query);
     $rows = mysql_num_rows($prod_count);
	 if($rows > 0) {
	 echo 'products exists for this category,delete products and retry';
	 } else {
	 	$query = "delete from `prod_category` where `id` ='$select_category_id'";
		if(mysql_query($query))
		{
			echo 'Suceessfully deleted';
		}
		else
		{
		 echo mysql_error();
		}
	 }
}



if($delete_product_id != ""){

	 $query = "delete from `products` where `prod_id` ='$delete_product_id'";

	if(mysql_query($query))
	{
	 	echo 'Suceessfully deleted';
	}
	else
	{
	 echo mysql_error();
	}
}

if($_REQUEST["file_name"]!="" && $_REQUEST["action"]=="upload"){
	
	$userfile = $_REQUEST["file_name"]; 

	echo $fileName = $_FILES[$userfile]['name'];
			$empty_space = '/ /';
			$replace = '-';
			$fileName = preg_replace($empty_space,$replace,$fileName);
			$tmpName = $_FILES[$userfile]['tmp_name'];
			$fileSize = $_FILES[$userfile]['size'];
			$fileType = $_FILES[$userfile]['type'];
			if (($_FILES[$userfile]["type"] == "image/gif") ||
			 ($_FILES[$userfile]["type"] == "image/jpeg") || 
			 ($_FILES[$userfile]["type"] == "image/pjpeg") || ($_FILES[$userfile]["type"] == "image/png"))
			{
				$dir = 'user_images/';
				if(!is_dir($dir))
				{
				mkdir('user_images/');
				}
				$uploadDir = 'user_images/';
				$filePath =  $uploadDir . $fileName;
				$img = move_uploaded_file($tmpName, $filePath);
				if($img){
					echo 'Uploaded Sucessfully';
				}
				else{
					echo 'Upload in error';
				}
			}

}
	
			
?>
<style type="text/css">
<!--
.style3 {font-size: 12px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif;}
.tableover
{
background-color:#ADD8E6;
font-family:Verdana;
font-size:11px;
font-weight:bold;
color:#333333;
height:18px;
padding-left:3px;
text-decoration: none;

}

.dataclass {
   font-family:Verdana;
   font-size:11px;
   color:#333333;
   height:18px;
   padding-left:3px;
   
}
.style4 {font-size: 12px; color: #333333; font-family: Verdana, Arial, Helvetica, sans-serif; font-weight: bold; }
-->
</style>
<body>
</body>
</html>
