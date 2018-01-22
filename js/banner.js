//banner
var imgs = document.getElementById('banner').getElementsByClassName('img')[0];
var imgsLi = imgs.getElementsByTagName('li');
console.log(imgsLi.length);

var nums = document.getElementById('banner').getElementsByClassName('number')[0];
var numsLi = nums.getElementsByTagName('li');
var leftBtn = document.getElementById('banner').getElementsByClassName('left')[0];
var rightBtn = document.getElementById('banner').getElementsByClassName('right')[0];
var index = 0;
var timer = null;
for (var i = 0; i < numsLi.length; i++) {
	numsLi[i].index = i;
	numsLi[i].onclick = function(){
		tab(this.index);
	}
	console.log(imgsLi[i]);
	imgsLi[i].onmouseover = function(){
		leftBtn.style.backgroundColor = 'rgba(0,0,0,0.4)';
		rightBtn.style.backgroundColor = 'rgba(0,0,0,0.4)';
		clearInterval(timer);
	}
	imgsLi[i].onmouseout = function(){
		timer = setInterval(run,3000);
		leftBtn.style.background = 'none';
		rightBtn.style.background = 'none';
	}
}
leftBtn.onmouseover = function(){
	leftBtn.style.backgroundColor = 'rgba(0,0,0,0.4)';
}
rightBtn.onmouseover = function(){
	rightBtn.style.backgroundColor = 'rgba(0,0,0,0.4)';
}
leftBtn.onclick = function(){
	index--;
	if (index<0) {
		index = imgsLi.length-1;
	}
	tab(index);
}
rightBtn.onclick = function(){
	index++;
	if (index == imgsLi.length) {
		index = 0;
	}
	tab(index);
}

timer = setInterval(run,3000);
function run(){
	index++;
	if (index == imgsLi.length) {
		index = 0;
	}
	tab(index);
}
function tab(curIndex){
	for (var i = 0; i < numsLi.length; i++) {
			numsLi[i].className = '';
			imgsLi[i].style.display = 'none';
		}
		numsLi[curIndex].className = 'active';
		imgsLi[curIndex].style.display = 'block';
		index = curIndex;
}