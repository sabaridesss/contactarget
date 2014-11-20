<?php
ini_set('max_execution_time', 5000);
set_time_limit(0);
ini_set('display_errors',"1");
 if(ini_set('max_execution_time', 5000) === false)
     {
      echo "ini_set is now working";
	  echo "<br/>";
     }
	 else
	 {
	 echo "working";
	 echo "<br/>";
	 }
	 echo 'Time Limit = ' . ini_get('max_execution_time');
	 echo "<br/>";
	 if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0)
{
    @set_time_limit(300);
}
else
{
echo "set_time_limit false";
}
	 exit;
?>