<?php
session_start();
//include("connect.php");
	include("../smarty_config.php");

$sub_catid = $_REQUEST['sub_cat'];
if($sub_catid != "")
{
		$dir = "./user_images/child_image/$sub_catid/";
		if(!is_dir($dir))
			{
			mkdir("./user_images/child_image/$sub_catid/");
			}
		
		$uploaddir = "./user_images/child_image/$sub_catid/"; 
		$file = $uploaddir . basename($_FILES['uploadfile']['name']); 
		
		if(file_exists("./user_images/child_image/$sub_catid/main.jpg")) 
		{
			if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file))
			 { 
			 	$filepath = "/songs/rt_02.gif";
				unlink($filepath);
			    echo "success"; 
			 }else{
				echo "error";
			}
		}
		else{
			if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], "./user_images/child_image/$sub_catid/main.jpg"))
			 { 
					  echo "success"; 
			 }
			 else
			 {
					echo "error";
			}
				
	   }
 
 }
?>