<?php
	include "linksql.php";
	if($_POST['state']=='yes'){
		//echo "yes";
		$expire = time()+60*60*24*7;
		setcookie('userTel',$_POST['usertel'],$expire);
		setcookie('userPwd',$_POST['password'],$expire);
		echo $_COOKIE['useTel'];
	}else{
		
	}
?>