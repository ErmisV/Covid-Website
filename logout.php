<?php
	session_destroy();
	unset($_SESSION['username']);
	$_SESSION['message']="You are now logged out";
	header("location:Login_form.php");
?>
