<?php
	include "linksql.php";
	if($_POST['style'] == 'like'){
		mysql_query("update likes set goodnum=goodnum+1 where goodnum = '{$_POST['goodnum']}' " );
		$result = mysql_query("select * from likes order by id");
		$row = mysql_fetch_array($result);
		echo $row[2];
	}else{
		mysql_query("update likes set badnum=badnum+1 where badnum = ' {$_POST['badnum']}'");
		$result = mysql_query("select * from likes order by id");
		$row = mysql_fetch_array($result);
		echo $row[3];
	}
?>