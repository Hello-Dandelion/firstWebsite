<?php
	include "linksql.php";
	if($_POST['refresh'] == 'yes'){
	 	echo $_POST['looknum'];
	 	mysql_query("update article1 set look=look+1 where look = '{$_POST['looknum']}' ");
		$result_look = mysql_query("select * from article1 order by id");
		$row = mysql_fetch_array($result_look);
		//echo $row['look'];
	}
?>
	
	