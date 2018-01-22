<?php
	
	$connect = mysql_connect('localhost','root','') or die("数据库服务器连接失败");
	mysql_select_db('usermsg',$connect) or die("数据库连接失败");
	mysql_query("set names utf8");
	//清除user表中数据
	//mysql_query("truncate user");	
?>