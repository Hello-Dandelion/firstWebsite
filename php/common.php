<?php  
include("linksql.php");   //引入数据库连接文件 
//------------------搜索数据表content按id降序排列----------------------
$sql_comment = "select * from comment ORDER BY id DESC limit 9";  
$result_comment = mysql_query($sql_comment,$connect); 
//---------------------搜索数据表content按id----------------------------
$sql_likes = "select * from likes ORDER BY id limit 1";  
$result_likes = mysql_query($sql_likes,$connect); 
//------------------------------显示访问量前5个文章------------------------
$sql_article = "select * from article1 order by look desc limit 5";
$result_article = mysql_query($sql_article,$connect);
//--------------------------根据id找到对应的5篇文章----------------------------
$sql_article = "select * from article1 order by id";
$result_articleid = mysql_query($sql_article,$connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Dandelion蒲公英</title>
		<link rel="shortcut icon" href="../img/aa.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/common.css" />
		<link rel="stylesheet" href="../css/homepage.css" />
		<link rel="stylesheet" href="../css/backpack.css" />
		<link rel="stylesheet" href="../css/heart.css" />
		<link rel="stylesheet" href="../css/message.css" />
		<link rel="stylesheet" href="../css/picture.css" />
		<link rel="stylesheet" href="../css/article.css" />
	</head>
	<body>
		<div class="bg_mask"  id="bg_mask" ></div>
		<img src="../img/headerbg.png" class="img-responsive" />
		
		<div class="navbar navbar-default nav" role="navigation" >
			<div class="container" >
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle = "collapse" data-target = ".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="homepage.php" style="padding: 0;"><img src="../img/logo.png" style="height: 100%;"/></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav nav-all nav-left" id="nav">
						<li><a href="homepage.php">首页</a></li>
						<li><a href="backpack.php">背包</a></li>
						<li><a href="heart.php">心旅</a></li>
						<li><a href="message.php">留言板</a></li>
						<li><a href="picture.php">照片墙</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right nav-all nav-right" id="nav-right">
						<li id="showname"><?php echo 'Hi '.$_COOKIE['userTel']; ?></li>&nbsp;&nbsp;
						<li id="login-btn">登录/注册</li>
					</ul>
				</div>
			</div>
		</div>

		<div class="rightmsg">
			<p id="showtime" class="showtime"></p>
			<div class="hot">
				<p class="tage">热门文章</p>
				<ul class="article">
					<?php while($row = mysql_fetch_array($result_article)) {?>
					<li>
						<a href="article.php?show=<?=$row['id']?>"><?=$row['title']?></a>
						<p>时间:<?=$row['time']?>&nbsp;&nbsp;&nbsp;&nbsp;浏览( <?=($row['look']+1)?> )</p>
					</li>
					<?php }?>
				</ul>
			</div>
			
			<div class="hot">
				<p class="tage">热门集赞</p>
				<ul class="tags">
					<li>
						<span class="name">九寨沟</span>
						<div class="hand" id="hand">
							<?php while($row=mysql_fetch_array($result_likes)){ ?>
							<img id="good" style="cursor: pointer;" src="../img/good.png" />&nbsp;<span id="goodnum"><?php echo $row[2]; ?></span>&nbsp;&nbsp;&nbsp;<img id="bad" style="cursor: pointer;" src="../img/bad.png"/>&nbsp;<span id="badnum"><?php echo $row[3]; ?></span>
							<?php } ?>
						</div>
					</li>
					
				</ul>
			</div>
			
			<div class="hot">
				<p class="tage">最新评论</p>
				<ul class="comment">
					<li>
						<?php while($row=mysql_fetch_array($result_comment)){ ?>
						<span class="name" ><?=$row['showtel'] ?></span>&nbsp;&nbsp;&nbsp;评论时间：<span class="time"><?=$row['time'] ?></span>
						<p class="content" title="<?=$row['content'] ?>"><?=$row['content'] ?></p>
						<?php } ?>
					</li>
					
				</ul>
			</div>
		</div>	
		<div class="bg_mask"  id="bg_mask" ></div>
		<div id="boxmsg" class="boxmsg">
			<div class="tab">
				<a class="act" id="login">登 录</a><a id="register">注 册</a>
			</div>
			<form action="check.php" method="post" class="myform" id="loginmsg" style="display: block;">
				<input type="tel" name="usertel" id="logintel" class="inputs"  placeholder="请输入您的手机号码" style="outline: none;"/>
				<input type="password" name="password" id="loginpwd" class="inputs" placeholder="请输入6位数字密码" style="outline: none;"/>
				<input type="checkbox" name="checkbox" id="check" class="inputs check"/>
				<p class="checkmsg" >一周内免登录</p>
				<div class="goouter"><input type="submit"  value="" class="inputs go" id="loginGo"/></div>
			</form>
			
			<form action="add.php" method="post" class="myform" id="registermsg" style="display: none;">
				<input type="tel" name="usertel" id="regtel" class="inputs" placeholder="请输入您的手机号码" style="outline: none;"/>
				<input type="password" name="password" id="regpwd" class="inputs" placeholder="请设置6位数字密码" style="outline: none;"/>
				<div class="goouter"><input type="submit" value="" class="inputs go" id="registerGo"/></div>
			</form>
			<p class="errormsg"></p>
			<span class="closebtn" id="closebtn1"></span>
		</div>


		<a id="backtop" href="javascript:;" style="display: none;"></a>

		<script type="text/javascript" src="../js/jquery-2.1.0.js" ></script>
		<script type="text/javascript" src="../js/bootstrap.min.js" ></script>
		<script type="text/javascript" src="../js/common.js" ></script>
		<script type="text/javascript">
			
			function $(id){
				return document.getElementById(id);
			}
			$('good').onclick = function(){
				var request = new XMLHttpRequest();
				request.open('post','like.php',false);
				request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				request.send('goodnum='+$('goodnum').innerHTML+'&style=like');
				$('goodnum').innerHTML =  request.responseText ;
//				alert(request.responseText);
//				alert($('goodnum').innerHTML)
			}
			$('bad').onclick = function(){
				var request = new XMLHttpRequest();
				request.open('post','like.php',false);
				request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				request.send('badnum='+$('badnum').innerHTML+'&style=dislike');
				$('badnum').innerHTML = request.responseText;
//				alert(request.responseText);
			}
		</script>