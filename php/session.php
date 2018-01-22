<?php
	session_start();
	$_SESSION['userTel'] = $_POST['usertel'];
	echo $_SESSION['userTel'];
	
?>