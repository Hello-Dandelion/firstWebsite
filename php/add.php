<?php
	include "linksql.php";
	$tel = test_input($_POST['usertel']);
	$pwd = test_input($_POST['password']);
	$select_result = mysql_query("select * from user where usertel = '$tel' ");
	if(mysql_num_rows($select_result) != 0){
		echo "<script>alert('电话号码已被注册');history.go(-1);</script>";
	}
	else{
		$insert_db = "insert into user (userid,usertel,password) values (null,'$tel','$pwd')";
		mysql_query($insert_db);
		if(mysql_affected_rows($connect) != 0){
			echo "<script>alert('注册成功');history.go(-1);</script>";
		}	 
	}
	function test_input($data){
		$data = trim($data);
		return $data;
	}
?>
