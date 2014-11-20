<?php

ob_start();
include("smarty_config.php");

// A function that will create the initial setup
// for the progress bar: You can modify this to
// your liking for visual purposes:
function create_progress() {
  // First create our basic CSS that will control
  // the look of this bar:
  echo "
<style>
#text {
  position: absolute;
  top: 100px;
  left: 50%;
  margin: 0px 0px 0px -150px;
  font-size: 18px;
  text-align: center;
  width: 300px;
}
  #barbox_a {
  position: absolute;
  top: 130px;
  left: 50%;
  margin: 0px 0px 0px -160px;
  width: 304px;
  height: 24px;
  background-color: black;
}
.per {
  position: absolute;
  top: 130px;
  font-size: 18px;
  left: 50%;
  margin: 1px 0px 0px 150px;
  background-color: #FFFFFF;
}

.bar {
  position: absolute;
  top: 132px;
  left: 50%;
  margin: 0px 0px 0px -158px;
  width: 0px;
  height: 20px;
  background-color: #0099FF;
}

.blank {
  background-color: white;
  width: 300px;
}
</style>
";

  // Now output the basic, initial, XHTML that
  // will be overwritten later:
  echo "
<div id='text'>Script Progress</div>
<div id='barbox_a'></div>
<div class='bar blank'></div>
<div class='per'>0%</div>
";

  // Ensure that this gets to the screen
  // immediately:
  flush();
}

// A function that you can pass a percentage as
// a whole number and it will generate the
// appropriate new div's to overlay the
// current ones:

function update_progress($percent) {
  // First let's recreate the percent with
  // the new one:
  echo "<div class='per'>{$percent}
    %</div>\n";

  // Now, output a new 'bar', forcing its width
  // to 3 times the percent, since we have
  // defined the percent bar to be at
  // 300 pixels wide.
  echo "<div class='bar' style='width: ",
    $percent * 3, "px'></div>\n";

  // Now, again, force this to be
  // immediately displayed:
  flush();
}

// Ok, now to use this, first create the
// initial bar info:
create_progress();

// Now, let's simulate doing some various
// amounts of work, and updating the progress
// bar as we go. The usleep commands will
// simulate multiple lines of code
// being executed.

 $email_query = "SELECT * FROM user_tbl";
	$email_result = mysql_query($email_query);
	 $email_count          =  mysql_num_rows($email_result);
	 
	 $email_count =500;
	$counti = 1;
/*	while($email_data = mysql_fetch_array($email_result))
	{*/
	for($counti=1;$counti<=$email_count;$counti++) {
echo $counti;
//echo "The number is " . $i . "<br>";
update_progress(($counti*100)/$email_count);

  sleep(1);
}

// Now that you are done, you could also
// choose to output whatever final text that
// you might wish to, and/or to redirect
// the user to another page.
?>
