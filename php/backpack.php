
		<?php include "common.php"; ?>
		
		<div class="leftmsg">
			<div class="area">
				<p class="classify">景点划分</p>
				<p class="hr"></p>
				<div class="areashow">
					<ul class="areadetail" id="areadetail">
					<?php
						include_once 'linksql.php';
						$sql = 'select * from area where level = 1';
						$result = mysql_query($sql);
						$info = array();
						while($row = mysql_fetch_assoc($result)){
							$info[] = $row;
						}
						//echo print_r($info);
						foreach($info as $v){						
						?>
					<li class="subli"><?php echo $v['province']?>
						<ul class="provinces">
							<?php 
							$sql2 = "select * from area where pid = {$v['id']}";
							$result2 = mysql_query($sql2);
							while($row2 = mysql_fetch_assoc($result2)){ ?>
							<li><a href="backpack.php?area=<?=$row2['province']?>"><?=$row2['province']?></a></li>
						<?php }?>
						</ul>
					</li>
				<?php }?>
				</div>
				
				<embed src="../img/China.swf" wmode='transparent'></embed>
			</div>
			<?php
				include "linksql.php"; 
				if(isset($_GET['area'])){
				$result_spots = mysql_query("select * from spots where province = '{$_GET['area']}' ",$connect);
				//var_dump($result_spots);
				$curnum = intval($result_spots);
				$row = mysql_fetch_array($result_spots);
				//var_dump($curnum);
			?>
			<p><span class="viewspot">&lt;<?=$row['province']?>&gt</span>著名景点</p>
			<div class="panel-group" id="accordion">
				<?php 
				$i=0;
				do{$i++ ;?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle = "collapse" data-parent = "#accordion" href="#collapse<?=$i?>">
								NO.<?=$row['ranking']?>&nbsp;&nbsp;<?=$row['place']?>
							</a>
						</h4>
					</div>
					<div id="collapse<?=$i?>" class="panel-collapse collapse">
						<div class="panel-body">
							<img src="<?=$row['img']?>"/>
							<?=$row['content']?>
							<ul>
								<?=$row['introduce']?>
							</ul>
						</div>
					</div>
				</div>
				<?php } while($row = mysql_fetch_array($result_spots));  }?>
			</div>
		</div>
		
		
		<script type="text/javascript">
		document.ready = function(){
			var subLi = document.getElementById('areadetail').getElementsByClassName('subli');
//			alert(subLi);
			var provinces = document.getElementById('areadetail').getElementsByClassName('provinces');
			for (var i = 0; i < subLi.length; i++) {
				console.log(subLi.length);
				subLi[i].index = i;
				subLi[i].onmouseover = function(){
					provinces[this.index].style.display = 'block';
					provinces[this.index].style.top = provinces[this.index].offsetHeight*[this.index]+"px";
				}	
				subLi[i].onmouseout = function(){
					provinces[this.index].style.display = 'none';
				}
			}
			var request = new XMLHttpRequest();
			request.open("get","backpack.php",false);
			request.send();
		}
		</script>
		<?php include "footer.php"; ?>