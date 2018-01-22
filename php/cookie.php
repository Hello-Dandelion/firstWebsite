<?php
	$expire = time()+60*60*24*7;
	setcookie('userTel',$_POST['usertel'],$expire);
	echo $_COOKIE['userTel'];
?>
