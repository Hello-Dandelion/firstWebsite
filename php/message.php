		<?php  
		include "linksql.php";   //引入数据库连接文件 
		$sql = "select * from words ORDER BY id DESC limit 10";  //搜索数据表content前十条数据并按id降序排列
		$result = mysql_query($sql,$connect); 
		?>

		<?php include"common.php"; ?>
		<div class="leftmsg">
			<img class="shareimg" src="../img/wordsbg.png" />
			
				<textarea id="text" class="text" name="txt" placeholder="留下你的心声，分享你的快乐" style="resize: none;outline: none;"></textarea>
				<input type="button" id="send" class="send" value="发 表">
			
			<ul class="sharecontent" id="sharecontent">
				<?php 
				include 'linksql.php';
				if(isset($_POST['txt'])&&isset($_POST['time'])){
					$insert_db = "insert into words (id,time,content) values (null, '{$_POST['time']}','{$_POST['txt']}' )";
					mysql_query($insert_db);
				}
				if(mysql_affected_rows($connect) != 0){
					echo "<script>alert('发表成功')</script>";
					//echo "<script>history.go(-1);</script>";
				}	 
				while($row=mysql_fetch_array($result)) { ?>
				<li>留言时间:<?php echo $row[1]; ?><p class="msgp"><?php echo $row[2]; ?></p></li>
				<?php } ?> 
			</ul>
			
		</div>
		
		<script type="text/javascript">
			var text = document.getElementById('text');
			var sendBtn = document.getElementById('send');
			var oUl = document.getElementById('sharecontent');
			sendBtn.onclick = function(){
				var oDate = new Date();
				var month = oDate.getMonth()+1;
				oDate.innerHTML= oDate.getFullYear()+'-'+show(month)+'-'+ show(oDate.getDate()) +' '+
					show(oDate.getHours())+':'+show(oDate.getMinutes())+':'+show(oDate.getSeconds());
				function show(n){
					if (n<10) {
						return '0'+n;
					} else{
						return ''+n;
					}
				}
				var time = document.createElement('li');
				var content = document.createElement('p');
				
				time.innerHTML = "留言时间： "+oDate.innerHTML;
				content.innerHTML = text.value;
				//alert(time.innerHTML);
				text.value = "";
				
				if(content.innerHTML == ''){
					alert('内容不能为空');
					return false;
				}
				//添加子节点li和p
				if (oUl.children.length > 0) {
					time.insertBefore(content,time.children[0]);
					oUl.insertBefore(time,oUl.children[0]);
					
				} else{
					time.appendChild(content);
					oUl.appendChild(time);
					
				}
				var request = new XMLHttpRequest();
				request.open("POST","message.php",true);
				request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				request.send('time=' + oDate.innerHTML + '&txt=' + content.innerHTML);
				//alert(request.responseText);
			}
		</script>
		<?php include "footer.php"; ?>