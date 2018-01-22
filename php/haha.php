<?php  
include("linksql.php");
$sql_likes = "select * from likes ORDER BY id limit 7";  
$result_likes = mysql_query($sql_likes,$connect);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Document</title>
	<style>
		.hot .tags{
			height: 340px;
		}
		.hot .tags li{
			margin-top: 10px;
			margin-left: 2%;
			width: 96%;
			height: 40px;
			border: 1px solid #eee;
			border-radius:3px ;
			box-shadow: 1px 1px 1px #eee;
		}
		.hot .tags li .name{
			margin-top: 8px;
			float: left;
			padding-left: 5px;
			font-size: 16px;
		}
		.hot .tags li .hand{
			margin-top: 7px;
			float: right;
			padding-right: 5px;
		}
		.hot .tags li:hover{
			border: 1px solid #77B00A;
			box-shadow: 1px 1px 1px #77B00A;
		}
	</style>
</head>
<body>
	<div class="hot">
		<p class="tage">热门集赞</p>
		<ul class="tags" id="tags">
			<?php while($row=mysql_fetch_array($result_likes)){ ?>
			<li>
				<span class="name"><?=$row['name']?></span>
				<div class="hand">
					<img class="good" src="../img/good.png" />&nbsp;<span class="goodnum"><?php echo $row['goodnum']; ?></span>&nbsp;<img class="bad" src="../img/bad.png"/>&nbsp;<span class="badnum"><?php echo $row['badnum']; ?></span>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>
	<script type="text/javascript">
		document.ready = function(){
			function $(id){
				return document.getElementById(id);
			}
			var good = $('tags').getElementsByClassName('good');
			var bad = $('tags').getElementsByClassName('bad');
			var goodnum = $('tags').getElementsByClassName('goodnum');
			var badnum = $('tags').getElementsByClassName('badnum');
			for (var i = 0; i < good.length; i++) {
				good[i].index = i;
				good[i].onclick = function(){
					for (var i = 0; i < good.length; i++) {
					}
					var request = new XMLHttpRequest();
					request.open('post','like.php',false);
					request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
					request.send('goodnum='+goodnum[this.index].innerHTML+'&index='+this.index+'&style=like');
					goodnum[this.index].innerHTML =  request.responseText ;
					alert(request.responseText);
				}
			}
			for (var i = 0; i < bad.length; i++) {
				bad[i].index = i;
				bad[i].onclick = function(){
					for (var i = 0; i < bad.length; i++) {
					}
				var request = new XMLHttpRequest();
				request.open('post','like.php',false);
				request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				request.send('badnum='+badnum[this.index].innerHTML+'&style=dislike');
				badnum[this.index].innerHTML =  request.responseText ;
				//alert(this.index);
				}
			}
		}
		</script>
</body>
</html>
