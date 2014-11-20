<?php
	//Start session
	session_start();
	//include('connect.php');
	
	include("../smarty_config.php");

	//Sanitize the value received from login field
	//to prevent SQL Injection
	if(!get_magic_quotes_gpc()) {
		$username=mysql_real_escape_string($_POST['username']);
	}else {
		$username=$_POST['username'];
	}
	
	$qry="select user_id, username from user_tbl where username='$username' and password='$_POST[password]'";
	$result=mysql_query($qry);
	if($result) {
		if(mysql_num_rows($result)>0) {
			//Login Successful
			session_regenerate_id();
			$member=mysql_fetch_assoc($result);
			$_SESSION['SESS_MEMBER_ID']=$member['user_id'];
			$_SESSION['username']=$member['username'];
				session_write_close();
			header("location: index.php");
			exit();
		}else {
			//Login failed
			header("location: login_failed.php");
			exit();
		}
	}else {
		die("Query failed");
	}
?>
