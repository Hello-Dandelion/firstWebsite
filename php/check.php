<?php
	include "linksql.php";
	$tel = test_input($_POST['usertel']);
	$pwd = test_input($_POST['password']);
	
	$select_result = mysql_query("select * from user where usertel = '$tel'&& password = '$pwd' ");
	if(!mysql_fetch_array($select_result)){
		echo "<script>alert('电话号和密码不匹配');history.go(-1);</script>";
	}else{
		echo "<script>history.go(-1);</script>";
	}
	function test_input($data){
		$data = trim($data);
		return $data;
	}
?>