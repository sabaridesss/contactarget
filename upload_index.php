<?php

if(isset($_POST['Submit'])){

  		rename("user_images/temp/","user_images/2/");
	
}

?>
<div>
<body>
<form action="" method="post" enctype="multipart/form-data">
<table width="650" border="0" cellpadding="5">
  <tr>
    <td colspan="3">Upload Image </td>
  </tr>
  <tr>
    <td width="111">Upload</td>
    <td width="218"><input type="file" name="file" id="file" /></td>
    <td width="283"><input type="submit" name="Submit" value="Submit" /></td>
  </tr>
</table>
</form>
</body>
<div>

