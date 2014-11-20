<?php

include("smarty_config.php");
//include("top_menu.php");

if( $_SESSION["username"]=="" ) {
	header("Location:index.php");		
} 
include("cfg/MYSQL.php");

//connect to the database
db_connect(DB_HOST,DB_USER,DB_PASS) or die (db_error());

db_select_db(DB_NAME) or die (db_error());


	

?>

<?php

$uid = $_GET[uid];

$_SESSION[uid] = $uid;

//echo $uid;

//$uid=57;

$result = "select * from projects where uid = '$uid'";

$q = mysql_query($result);

if($q)

{

$row= mysql_fetch_array($q);

}

if($row[approved] == "y")

{

$approved = "Yes";

}

else if($row[approved] == "n")

{



$approved = "No";

}

if($row[found_3party] == "y")

{

$found = "Yes";

}

else if($row[found_3party] == "n")

{

$found = "No";

}

//}
if($row['date'] != "" )
{
$end = $row['date'];

$start = date("Y-m-d");
$days = (strtotime($start) - strtotime($end) ) / (60 * 60 * 24);
//$days_left = date("d/m/Y")- $row['date'];
   if($days > 1)
   {
    $days = $days."&nbsp;days";
   }
   else
   { 
    $days = $days."&nbsp;day";
   }
}
else
{
$days = "Not Available";
}

?>

		  <?php

$uid = $_GET[uid];

echo "<form name='form1' method='post' action='link_update.php?uid=$uid' onsubmit='return formValidator()'>";





//$uid = $_GET[uid];

//echo $uid;

$result = "select * from projects where uid = '$uid'";

$q = mysql_query($result);

if($q)

{

$row= mysql_fetch_array($q);

}



?>
<?php include ('common/header.php')?>

<table width="1200px" border="0" cellpadding="0">
 
  <tr>
	<td></td>
  </tr>
  <tr>
	<td align="center" class="top">
	<?php include('common/top_menu.php') ?>
<div class="wholesite-inner">
<!--welcome admin start here-->
<div class="welcome-admin"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" align="left" valign="middle">Welcome&nbsp;<? echo $_SESSION['username'];?></td>
    <td width="55%" align="center" valign="middle"><strong><font color="#FF0000">
      <?=$msg?>
    </font></strong></td>
    <td width="25%" align="right" valign="middle">&nbsp;</td>
  </tr>
</table>
</div>
<div class="content">
      <table width="75%" height="39" border="0" align="center">
        <tr>
          <td align="right">[<a style='text-decoration: none;color:#FF0000'; href="link_exchange.php">Projects</a>][<a style='text-decoration: none;color:#FF0000'; href="new_links.php">Add New Link</a>] </td>
        </tr>
      </table>

<table width="85%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" class="login-top">Link Details</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="login-inner"><table width="100%" border="0" align="center" cellpadding="5" >
      <tr>
        <td width="17%" align="right" valign="top" id="title_name"><span style="color:#FF6600">* </span>Category&nbsp;</td>
        <td width="83%" align="left"><select name="cat" id="cat" class="login-texbox1">
          <option value="Select" selected="selected" >Please select</option>
          <?php if($row[category] == "IT Software Consulting"){?>
          <option value="IT Software Consulting" selected="selected">IT Software Consulting</option>
          <?php }else{ ?>
          <option value="IT Software Consulting">IT Software Consulting</option>
          <?php } ?>
          <?php if($row[category] == "Software development"){?>
          <option value="Software development" selected="selected">Software development</option>
          <?php }else{ ?>
          <option value="Software development">Software development</option>
          <?php } ?>
          <?php if($row[category] == "Web Design and Development"){?>
          <option value="Web Design and Development" selected="selected">Web Design and Development</option>
          <?php }else{ ?>
          <option value="Web Design and Development">Web Design and Development</option>
          <?php } ?>
          <?php if($row[category] == "BPO Services"){?>
          <option value="BPO Services" selected="selected">BPO Services</option>
          <?php }else{ ?>
          <option value="BPO Services">BPO Services</option>
          <?php } ?>
          <?php if($row[category] == "Medical Transcription and Billing"){?>
          <option value="Medical Transcription and Billing" selected="selected">Medical Transcription and Billing</option>
          <?php }else{ ?>
          <option value="Medical Transcription and Billing">Medical Transcription and Billing</option>
          <?php } ?>
          <?php if($row[category] == "Arts"){?>
          <option value="Arts" selected="selected">Arts</option>
          <?php }else{ ?>
          <option value="Arts">Arts</option>
          <?php } ?>
          <?php if($row[category] == "Education"){?>
          <option value="Education" selected="selected">Education</option>
          <?php }else{ ?>
          <option value="Education" >Education</option>
          <?php } ?>
          <?php if($row[category] == "SEO and SEM"){?>
          <option value="SEO and SEM" selected="selected">SEO and SEM</option>
          <?php }else{ ?>
          <option value="SEO and SEM">SEO and SEM</option>
          <?php } ?>
          <?php if($row[category] == "E-Commerce Service"){?>
          <option value="E-Commerce Service" selected="selected">E-Commerce Service</option>
          <?php }else{ ?>
          <option value="E-Commerce Service">E-Commerce Service</option>
          <?php } ?>
          <?php if($row[category] == "Web Hosting"){?>
          <option value="Web Hosting" selected="selected">Web Hosting</option>
          <?php }else{ ?>
          <option value="Web Hosting">Web Hosting</option>
          <?php } ?>
          <?php if($row[category] == "Entertainment"){?>
          <option value="Entertainment" selected="selected">Entertainment</option>
          <?php }else{ ?>
          <option value="Entertainment">Entertainment</option>
          <?php } ?>
          <?php if($row[category] == "Data Processing"){?>
          <option value="Data Processing" selected="selected">Data Processing</option>
          <?php }else{ ?>
          <option value="Data Processing">Data Processing</option>
          <?php } ?>
          <?php if($row[category] == "Products and Media"){?>
          <option value="Products and Media" selected="selected">Products and Media</option>
          <?php }else{ ?>
          <option value="Products and Media">Products and Media</option>
          <?php } ?>
          <?php if($row[category] == "Other Services"){?>
          <option value="Other Services" selected="selected">Other Services</option>
          <?php }else{ ?>
          <option value="Other Services">Other Services</option>
          <?php } ?>
        </select></td>
      </tr>
      <tr>
        <td align="right" valign="top" id="title_name"><span style="color:#FF6600">*</span> Title</td>
        <td align="left"><input type="text" name="title1" width="500" id="title1" class="login-texbox1" value="<?php echo $row[title];?>" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span style="color:#FF6600">* </span>Url</td>
        <td align=""><input type="text" name="url1" width="500" id="url1" class="login-texbox1" value="<?php echo $row[url]; ?>" />
                  <span style="font-size:small;color:#FF6600"> Example : http://www.google.com </span></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;<span style="color:#FF6600">* </span>Date</td>
        <td align=""><input type="text" name="date" width="500" id="date" class="login-texbox" value="<?php echo $row['date'];?>" />
                &nbsp;<img src="./calendar/calendar.gif" id="f_trigger_c" style="cursor:hand;" title="Date selector"  height="14" width="20"/>
                <script type="text/javascript">
Calendar.setup({
inputField : "date",
ifFormat : "%d-%m-%Y",
button : "f_trigger_c",
singleClick : true
});
          </script></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span style="color:#FF6600">* </span> Description</td>
        <td align=""><textarea name="desc1" rows="10" cols="60" id="desc1" class="login-textarea1"><?php echo $row[description]; ?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><?php if($row[approved] == "y"){?>
                  <p>
                    <input type="checkbox" name="approved" value="checkbox" id="approved" checked="checked" />
                    Approved</p>
                <?php }else{ ?>
                <p>
                    <input type="checkbox" name="approved" value="checkbox" id="approved">
                  &nbsp;Approved</p>
                <?php } ?></td>
      </tr>
      <tr>
        <td align="right" valign="top"><span style="color:#FF6600">* </span>Title (3rd Party) </td>
        <td align=""><input type="text" name="title2" id="title2" class="login-texbox" value="<?php echo $row[title_3party]; ?>" /></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;<span style="color:#FF6600">* </span>Url (3rd Party)</td>
        <td align=""><input type="text" name="url2" id="url2" class="login-texbox" value="<?php echo $row[url_3party]; ?>" />
                  <span style="font-size:small;color:#FF6600"> Example : http://www.google.com </span></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;<span style="color:#FF6600">* </span>Description (3rd Party)</td>
        <td align=""><textarea name="desc2" rows="10" cols="60" id="desc2" class="login-textarea1"><?php echo $row[desc_3party]; ?></textarea></td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align=""><?php if($row[found_3party] == "y"){?>
                  <p>
                    <input type="checkbox" name="found2" value="checkbox" id="found2" checked="checked" />
                    Found  </p>
                <?php }else{ ?>
                  <p>
                    <input type="checkbox" name="found" value="checkbox" id="found5" />
                    Found  </p>
                <?php } ?>
        </td>
      </tr>
      <tr>
        <td align="right" valign="top">&nbsp;</td>
        <td align="">
    <input type="submit" name="submit" value="Submit" class="submit">

    <input type="submit" name="new" value="New" onClick="return newform()" class="submit">

    <input name="delete" type="submit" value="Delete" onClick="return delform()" class="submit">

    <input type="submit" name="cancel" value="Cancel" onClick="return redirect_link()" class="submit">
        </td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td valign="top" class="welcome-admin" id="title_name">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
</div>
<!--welcome admin end here-->
</div>
<!--footer start here-->
<?php include('common/footer.php'); ?>
<!--footer end here--></td>
  </tr>
</table>
</form>


</div>
</center>
</body>
</html>


