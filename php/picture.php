
		<?php include "common.php"; ?>
		<div class="file" id="file">
			<form action="upload.php" method="post" enctype="multipart/form-data" id="form1">
				<span>选择图片<input type="file" name="file" onchange="send_img()" /></span>
				<input type="hidden" name="img_path" value="" id="choosepic" />
				<?php
					$result = mysql_query("select * from uploadpic order by id desc");
					$row = mysql_fetch_array($result);
				?>
				<img class="img" id="img_show" src="../img/up.jpg" />
				<input type="button" onclick="getimg()" value="确 认"/> 
			</form>
			<p></p>
			<button id="closebtn">关 闭</button>
		</div>	
		
		<div class="leftmsg">
			<span class="smalltitle">晒图吧</span><span class="arrow"></span>
			<p class="p"><span class="updownbtn" id="uploadbtn">上传图片</span></p>
			
			<div class="picbox">
				<?php
				$results = mysql_query("select * from uploadpic order by id desc limit 15");
				while($row = mysql_fetch_assoc($results)){
				?>
				
				<div class="pic">
					<img src="<?=$row['url']?>"/>
					<p class="time"><?=$row['time']?></p>
				</div>
				<?php }?>
			</div>
		</div>
		<div id="ajax_img"></div>

		<script type="text/javascript">
		
		function send_img() {
	        $('ajax_img').innerHTML = '<iframe name="img_fra" style="width:0;height:0"></iframe>';
	        $('form1').setAttribute('target', 'img_fra');  //提交在iframe中打开
	        $('form1').submit();
    	}

    	function getimg(){
    		$('form1').setAttribute('method', 'get'); 
    		$('form1').setAttribute('target', '');  
	        $('form1').submit();
    	}

			function $(id){
				return document.getElementById(id);
			}
			$('uploadbtn').onclick = function(){
				//alert(1)
				$('bg_mask').style.display = 'block';
				$('file').style.display = 'block';
			}
			
			$('closebtn').onclick = function(){
				$('bg_mask').style.display = 'none';
				$('file').style.display = 'none';
			}
			
			/*//瀑布流
			function change(){
				var imgbox = $('images').getElementsByClassName('picbox');
				var imgBoxW = imgbox[0].offsetWidth;
				//获取第一行可以放图片的个数
				var num = Math.floor($('images').offsetWidth/imgBoxW);
				$('images').style.cssText = 'width: '+ imgBoxW*num +'px';
				var picHArr = [];
				var imgArr = [];
				for (var i = 0; i < imgbox.length; i++) {
					var imgboxH = imgbox[i].offsetHeight;
					imgArr.push(imgbox[i]);
					if (i < num) {
						picHArr[i] = imgboxH;
					} else{
						//找出最小高度的图片
						var minH = Math.min.apply(null,picHArr);
						var minHIndex = getMinHIndex(picHArr,minH);
						//为下一行的每一张图片设置样式
						imgbox[i].style.position = "absolute";
						imgbox[i].style.top = minH + "px";
						imgbox[i].style.left = imgbox[minHIndex].offsetLeft + "px";
						picHArr[minHIndex] += imgbox[i].offsetHeight;
					}
				}
			}
			function getMinHIndex(arr,minH){
				for (var i = 0; i < arr.length; i++) {
					if(arr[i] == minH){
						return i;
					}
				}
			}*/
		</script>
		<?php include "footer.php"; ?>
