
		<?php include "common.php"; ?>
		<div class="leftmsg">
			<p class="dot">今日推荐</p>
			<span class="smalltitle">四川旅游景点之稻城亚丁风光</span><span class="arrow"></span>
			<video src="../video/video1.mp4" controls="controls"></video>
			
			<form action="heart.php" method="get" class="bs-example bs-example-form" role="from">
				<div class="input-group">
					<input type="text" name="search" class="form-control" placeholder="输入您要搜索的关键词" />
					<span class="input-group-addon" ><input type="submit" value="搜 索" /></span>
				</div>
			</form>
			<?php
				include_once "linksql.php";
				if(isset($_GET['search'])){
					$sql_count = mysql_query("select count(*) from article1 where title like '%{$_GET['search']}%' ");
					$row_count = mysql_fetch_array($sql_count);
					
					$sql=mysql_query("select * from article1 where title like '%{$_GET['search']}%' ");
					$num = mysql_num_rows($sql);
					//echo $num;
//					$sql=mysql_query("select * from article1 where title like '%{$_GET['search']}%' ");
//					$info = array();
//					while($row = mysql_fetch_assoc($sql)){
//						$info[] = $row['id'];
//					}
//					print_r($info);
					$shownum = 6;
					$total = intval($row_count[0]/$shownum);
					//echo $total;
					if($row_count[0] % $shownum) $total++;
					if(isset($_GET['more'])){
						$page = intval($_GET['more']);
						//echo $page;
					}else{
						$page = 1;
					}
					$next = $page+1;
					$offset = $shownum*($page-1);
					$result_search = mysql_query("select * from article1 where title like '%{$_GET['search']}%' order by id desc limit $offset,$shownum ");
					//echo var_dump($result_search);
			?>
			<p class="dot">关于 <b>" <?=$_GET['search']?> "</b> 的搜索结果</p>
			<ul class="searchcon">
				<?php 
				if($num != 0){
				while($row = mysql_fetch_array($result_search)){  ?>
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
			<?php if($page == $total){ ?>
				<a href="heart.php?more=<?=$total?>&&search=<?=$_GET['search']?>" class="more" id="more">more</a> 
			<?php }else{?>
				<a href="heart.php?more=<?=$next?>&&search=<?=$_GET['search']?>" class="more" id="more">more</a> 
			<?php }}else{?>
			<div class="errorbox">
				<img class="error" src="../img/404.png" />
				<p>抱歉！没有找到符合条件的 <span>" <?=$_GET['search']; ?> "</span> 相关内容</p>
				<p>您可以简化、缩短关键词或减少筛选范围再进行搜索</p>
			</div>
			<?php }}?>
		</div>
		
		
		<script type="text/javascript">
			var request = new XMLHttpRequest();
			request.open('get','heart.php',false);
			request.send();
			//alert(request.responseText);
		</script>	
		<?php include "footer.php"; ?>