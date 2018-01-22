<?php
header("Content-type: text/html; charset=utf-8");
include_once "linksql.php";

if(isset($_GET['img_path'])){
    if(empty($_GET['img_path'])){
        echo "<script>alert('请选择上传文件');history.go(-1);</script>";
    }else{
        $pic = $_GET['img_path'];
        $date = date('Y-m-d', time());
        $res = mysql_query("insert into uploadpic (id,url,time) values ('0','$pic','$date')");
        if($res){
            echo '上传成功';
			header('location:picture.php');
        }else{
            echo "<script>alert('上传失败');history.go(-1);</script>";
        }
    }
    die;
}

if (isset($_FILES)) {
    
    $allowedExt = array('.png', '.jpg', '.gif', '.jpeg');
    $type = judge_type($_FILES['file']['type']);
    if (!in_array($type,$allowedExt)) {
        echo $type;
        die("<script>alert('文件类型不合法，请重新选择上传图片');</script>");
    }
    $pic = '../uploadpic/' . str_shuffle(time()) . $type;   
    $res = move_uploaded_file($_FILES['file']['tmp_name'], $pic);   
    if ($res) {
        echo "<script>window.parent.document.getElementById('choosepic').value='$pic';</script>";
        echo "<script>window.parent.document.getElementById('img_show').src='$pic';</script>";
    } else {
        echo "<script>alert('error');history.go(-1);</script>";
    }
	
	if ($_FILES['file']['size'] > 204800) {
        die("<script>alert('文件超过制大小');</script>");
    }
	
} else {
    echo "<script>alert('非法访问');history.go(-1);</script>";
}



function judge_type($f) {
    if ($f == 'image/png') {
        return '.png';
    } elseif ($f == 'image/jpg') {
        return '.jpg';
    } elseif ($f == 'image/gif') {
        return '.gif';
    } else if($f == 'image/jpeg') {
        return '.jpeg';
    }
}

?>