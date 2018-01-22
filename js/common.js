function $(id){
	return document.getElementById(id);
}
window.onload = function(){
	//导航
	var curHref = location.href;
	//alert(1);
	var navLi = $('nav').getElementsByTagName('li');
	if(curHref.indexOf("homepage.php")>0){
		navLi[0].className = 'active';
	}else if(curHref.indexOf("backpack.php")>0){
		navLi[1].className = 'active';
	}else if(curHref.indexOf("heart.php")>0){
		navLi[2].className = 'active';
	}else if(curHref.indexOf("message.php")>0){
		navLi[3].className = 'active';
	}else if(curHref.indexOf("picture.php")>0){
		navLi[4].className = 'active';
	}
	
	
	
	//点击登录或注册，相互切换
	var body = document.getElementsByTagName('body')[0];
	$('login-btn').onclick =  function(){
		body.style.overflow = 'hidden';
		$('bg_mask').style.display = 'block';
		 $('boxmsg').style.display = 'block'
	}
	$('login').onclick = function(){
		$('registermsg').style.display = 'none';
		$('login').className = 'act';
		$('register').className = '';
		$('loginmsg').style.display = 'block';
		$('logintel').value = '';
		$('loginpwd').value = '';
	}
	$('register').onclick = function(){
		$('loginmsg').style.display = 'none';
		$('register').className = 'act';
		$('login').className = '';
		$('registermsg').style.display = 'block';
		$('regtel').value = '';
		$('regpwd').value = '';
	}
	$('closebtn1').onclick = function(){
		body.style.overflow = '';
		 $('boxmsg').style.display = 'none';
		$('bg_mask').style.display = 'none';
	}
	
	
	//判断---登录---的电话号和密码是否符合要求
	var errormsg = $('boxmsg').getElementsByClassName('errormsg')[0];
	var telReg = /^1(3|4|5|7|8)\d{9}$/;
	var pwdReg = /^\d{6}$/;
	
	$('logintel').onblur = function(){
		if($('logintel').value == ''){
			errormsg.innerHTML = "电话号不能为空";
		}else{
			 if(!telReg.test($('logintel').value)) {
				errormsg.innerHTML = "电话号格式错误";
			}
		}
	}
	$('loginpwd').onblur = function(){
		if($('loginpwd').value == ''){
			errormsg.innerHTML = "密码不能为空";
		}else{
			 if(!pwdReg.test($('loginpwd').value)) {
				errormsg.innerHTML = "密码只能设置6位数字";
			}
		}
	}
	//判断---注册----的电话号和密码是否符合要求
	$('regtel').onblur = function(){
		if($('regtel').value == ''){
			errormsg.innerHTML = "电话号不能为空";
		}else{
			 if(!telReg.test($('regtel').value)) {
				errormsg.innerHTML = "电话号格式错误";
			}
		}
	}
	$('regpwd').onblur = function(){
		if($('regpwd').value == ''){
				errormsg.innerHTML = "密码不能为空";
			}else{
				 if(!pwdReg.test($('regpwd').value)) {
					errormsg.innerHTML = "密码只能设置6位数字";
				}
			}
	}
	//判断登录时的checkbox是否勾选，勾选保存cookie值
	
	//--------google has a problem-------
	if ($('check').checked) {
		var request = new XMLHttpRequest();
		request.open('post','cookie.php',false);
		request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		request.send('usertel='+$('logintel').value+'&state=yes');
		
	}else{
		var request = new XMLHttpRequest();
		request.open('post','session.php',false);
		request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		request.send('usertel='+$('logintel').value+'&state=no');
		//alert(request.responseText);
	}
	//------------------------------------------
	//点击箭头退出登录或注册窗口
	$('loginGo').onclick  = function(){
		if (telReg.test($('logintel').value) && pwdReg.test($('loginpwd').value)) {
			$('boxmsg').style.display = 'none';
			$('bg_mask').style.display = 'none';
			//loginBtn.innerHTML ='Hi '+ $('logintel').value;
		}else{
			errormsg.innerHTML = "请检查您的电话号和密码"
			return false;
		}
	}
	$('registerGo').onclick = function(){
		if (telReg.test($('regtel').value) && pwdReg.test($('regpwd').value)) {
			$('boxmsg').style.display = 'none';
			$('bg_mask').style.display = 'none';
			
		}else{
			errormsg.innerHTML = "请检查您的电话号和密码"
			return false;
		}
		
	}
	
	
	

	
	//显示当期时间
	function show(n){
		if (n<10) {
			return '0'+n;
		} else{
			return ''+n;
		}
	}
	
	setInterval(tick,1000);
//	console.log(obj)
	function tick(){
		var oDate = new Date();
		var week = oDate.getDay();
		var arr = ['日','一','二','三','四','五','六'];
		week = arr[week];
//	console.log(week);
		var month = oDate.getMonth()+1;
		var obj= oDate.getFullYear()+'-'+show(month)+'-'+ show(oDate.getDate()) +'&nbsp;&nbsp;'+
			show(oDate.getHours())+':'+show(oDate.getMinutes())+':'+show(oDate.getSeconds())+'&nbsp;&nbsp;星期'+week;
			$('showtime').innerHTML = obj;
	}
	tick();
	
	//回到顶部
	var pageH = document.documentElement.clientHeight||document.body.clientHeight||window.innerHeight;
	window.onscroll = function(){
		var backTop = document.documentElement.scrollTop||document.body.scrollTop;
		//console.log(backTop)
		if (backTop >= pageH) {
			$('backtop').style.display = 'block';
		} else{
			$('backtop').style.display = 'none';
		}
	}
	$('backtop').onclick = function(){
//		alert(1)
		var timer = setInterval(function(){
			var scrolltop = document.documentElement.scrollTop||document.body.scrollTop;
			var speed = scrolltop/2;
			if (document.documentElement.scrollTop) {
				document.documentElement.scrollTop = scrolltop - speed;
			} else if(document.body.scrollTop){
				document.body.scrollTop = scrolltop - speed;
			}
			if(scrolltop == 0){
				clearInterval(timer);
			}
		},30);
	}

}