		<?php include"common.php"; ?>
		<div class="left">
			<?php
				include "linksql.php"; 
				if($_GET['show']){
					mysql_query("update article1 set look=look+1 where id = '{$_GET['show']}' ");
					$result_id = mysql_query("select * from article1 where id = '{$_GET['show']}'",$connect);
					$result_look = mysql_query("select * from article1 order by id");
					$row = mysql_fetch_array($result_id);
				}else{
					echo "<script>alert('Error:Not Find!');</script>";
				}
			?>
			<h2 class="titleart"><?=$row['title']?></h2>
			<p class="msg">作者：<span class="author"><?php echo $row['author']?></span>&nbsp;&nbsp;更新时间：<time><?=$row['time']?>&nbsp;&nbsp;<span>浏览：<span id="looknum">( <?=$row['look']?> )</span></p>
			<p class="hr"></p>
			<div class="content">
				<img src="<?=$row['img']?>"/>
				<?=$row['content']?>
			</div>
			<p class="notices">蒲公英(Dandelion)温馨提示:未经允许不得转载</p>
			
			<div class="sharecon">分 享
				<a class="sharea" href="#" title="分享到QQ好友"><img src="../img/share1.png"/></a>
				<a class="sharea" href="#" title="分享到新浪微博"><img src="../img/share2.png"/></a>
				<a class="sharea" href="#" title="分享到QQ空间"><img src="../img/share3.png"/></a>
				<a class="sharea" href="#" title="分享到QQ微信"><img src="../img/share4.png"/></a>
				<a class="sharea" href="#" title="分享到腾讯微博"><img src="../img/share5.png"/></a>
			</div>
			
			<p class="tage">相关推荐</p>
			<p class="hr"></p>
			<ul>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">6</a></li>
				<li><a href="#">7</a></li>
			</ul>
			<p class="tage">您的评论</p>
			<p class="hr"></p>
			<?php
				include "linksql.php";
				date_default_timezone_set('Asia/Shanghai');
				$date = date('Y-m-d H:i:s',time());
				if(isset($_POST['usertel'])&&isset($_POST['showtel'])&&isset($_POST['content'])){
					$insert = " insert into comment (id,usertel,showtel,time,content) values (null,'{$_POST['usertel']}','{$_POST['showtel']}','$date','{$_POST['content']}')";
					mysql_query($insert);
					header('location:article.php');
				}
			?>
			
			<textarea id="comment" placeholder="您的评论一针见血" style="resize: none;outline: none;"></textarea>
			<p class="subtn" ><input type="submit" name="submit" id="commentbtn" class="submit" value="提 交" /></p>
		</div>
		
		
		<script type="text/javascript">
			function $(id){
				return document.getElementById(id);
			}
			$('commentbtn').onclick = function(){
				if($('comment').value == ''){
					alert('评论不能为空！');
					return false;
				}
				//对用户电话号码的保护--------google has a problem-------
				var tel = $('logintel').value;
//				var tel = '15775692246';
				var showtel = tel.substr(0,3)+'****'+tel.substr(7);
				//------------------------------------------
				var request = new XMLHttpRequest();
				request.open('post','article.php',false);
				request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				request.send('content='+$('comment').value+'&usertel='+$('logintel').value+'&showtel='+showtel);
				//alert(request.responseText);
				$('comment').value = '';
				
//				var tel = "18827768782";
//				var reg = /^(\d{3})\d{4}(\d{4})$/;
//				tel = tel.replace(reg, "$1****$2");
//				alert(tel);
			}
			//alert(1);
			var request = new XMLHttpRequest();
			request.open('get','article.php',false);
			request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			request.send();
		</script>
		<?php include "footer.php"; ?>
