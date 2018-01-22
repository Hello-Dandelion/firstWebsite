
		<?php
			include "common.php";
			include "linksql.php"; 
	//--------------------------------分页--------------------------------------------
			$result_num = mysql_query("select count(*) from article1");
			$row = mysql_fetch_array($result_num);
			//print_r($row);
			//计算总页数
			$showpage = 5;
			$total = intval($row[0]/$showpage);
			//echo $total;
			if($row[0] % $showpage) $total++;
			//设置页数
			if(isset($_GET['page'])){
				$page = intval($_GET['page']);
			}else{
				//设置为第一页
				$page = 1;
			}
			
			//echo $page;
			$first=1;
			$prev=$page-1;
			$next=$page+1;
			$last=$total;
			//计算记录偏移量
			$offset = $showpage*($page-1);
			//读取指定记录数
			$result_article = mysql_query("select * from article1 order by id desc limit $offset,$showpage",$connect);
		?>	
		
		<div class="leftmsg">
			<div class="banner" id="banner">
				<ul class="img">
					<li style="display: block;"><img src="../img/banner0.png"/></li>
					<li><img src="../img/banner1.png"/></li>
					<li><img src="../img/banner2.png"/></li>
					<li><img src="../img/banner3.png"/></li>
					<li><img src="../img/banner4.png"/></li>
					<li><img src="../img/banner5.png"/></li>
				</ul>
				<ol class="number">
					<li class="active">1</li>
					<li>2</li>
					<li>3</li>
					<li>4</li>
					<li>5</li>
					<li>6</li>
				</ol>
				<a href="javascript:;" class="left">&lt;</a>
				<a href="javascript:;" class="right">&gt;</a>
			</div>
			<p class="title">最新美文</p>
			<ul>
				<?php 
					while($row = mysql_fetch_array($result_article)){ ?>
				<li>
					<a class="curimg" href="article.php?show=<?=$row['id']?>"><img src="<?=$row['img']?>"></img></a>
					<div>
						<a href="article.php?show=<?=$row['id']?>" target="_blank"><?=$row['title']?></a>
						<p>作者：<span class="author"><?=$row['author']?></span>&nbsp;&nbsp;&nbsp;时间：<?=$row['time']?>&nbsp;&nbsp;&nbsp;浏览：( <?=$row['look']?> )</p>
						<p><?=$row['hidden']?></p>
					</div>
				</li>
				<?php }?>
			</ul>
			<ul class="pagenums" id="pagenums">
				<li class='change first'><a href='homepage.php?page=<?=$first?>'>首页</a>

				<?php if($page==1){ ?>
				<li class='updown'><a href='homepage.php?page=1'>上一页</a></li>
				<?php }else { ?>
				<li class='updown'><a href='homepage.php?page=<?=$prev?>'>上一页</a></li>
				<?php }?>
					
				<?php for($i=$page; $i <= $total ; $i++) { ?>
				<li><a href='homepage.php?page=<?=$i?>'><?=$i?></a></li>
				<?php }?>
				
				
					
				<?php if($next > $total){?>
					<li	 class='updown'><a href='homepage.php?page=<?=$total?>'>下一页</a></li>
				<?php }else { ?>
					<li	 class='updown'><a href='homepage.php?page=<?=$next?>'>下一页</a></li>
				<?php }?>
					
				<?php if($page==$total){ ?>
				<li class='change end'><a href='homepage.php?page=<?=$total?>'>尾页</a></li>
				<?php }else { ?>
				<li class='change end'><a href='homepage.php?page=<?=$last?>'>尾页</a></li>
				<?php }?>
				<li class='allpages'>共 <span class='showpages'><?=$page?> </span>/ <?=$total?> 页</li>
			</ul>
		</div>
		
		<script type="text/javascript" src="../js/banner.js"></script>
		<script type="text/javascript">
			var request = new XMLHttpRequest();
			request.open('get','homepage.php',false);
			request.setRequestHeader('Content-type','application/x-www-form-urlencoded');
			request.send();
			//alert(request.responseText);
		</script>
		<?php include "footer.php"; ?>
