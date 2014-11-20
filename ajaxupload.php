<?php
error_reporting(0);
 define ("MAX_SIZE","1024");
 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){


$path = "uploads/"; //set your folder path
$filename = $_FILES['bottom_photoimg']['tmp_name']; //get the temporary uploaded image name
$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg","GIF","JPG","PNG"); //add the formats you want to upload
	
		$name = $_FILES['bottom_photoimg']['name']; //get the name of the image
		$size = $_FILES['bottom_photoimg']['size']; //get the size of the image
		if(strlen($name)) //check if the file is selected or cancelled after pressing the browse button. 
		{
			list($txt, $ext) = explode(".", $name); //extract the name and extension of the image
			if(in_array($ext,$valid_formats)) //if the file is valid go on.
			{
			if($size < 2098888) // check if the file size is more than 2 mb
			{
			$actual_image_name =  str_replace(" ", "_", $txt)."_".time().".".$ext; //actual image name going to store in your folder
			$tmp = $_FILES['bottom_photoimg']['tmp_name']; 
			if(move_uploaded_file($tmp, $path.$actual_image_name)) //check the path if it is fine
				{
					move_uploaded_file($tmp, $path.$actual_image_name); //move the file to the folder
					//display the image after successfully upload
					echo "<img src='uploads/".$actual_image_name."'  class='preview img_cls' > <input type='hidden' name='actual_image_name1' id='actual_image_name1' value='$actual_image_name' />";
				}
			else
				{
				echo "failed";
				}
			}
			else
			{
				echo "Image file size max 2 MB";					
			}
			}
			else
			{
				echo "Invalid file format..";	
			}
		}
		else
		{		
			echo "Please select image..!";
		}		
	exit;
	
}

?>
