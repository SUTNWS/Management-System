<?php
header("Content-Type:text/html;charset=utf-8");
$name = $_POST['name'];
$password = $_POST['password'];

if (!$name || !$password) {
  echo "请将信息输入完整";
  exit;
}
else {
  $mysqli = new mysqli('localhost','root','root','management');
  $mysqli->set_charset("utf-8");
  $sql = "select * from login where name='{$name}'";
  $result = $mysqli->query($sql);
  $arr = $result->fetch_assoc();
  if (!$arr) {
    echo "该用户尚未注册";
    exit;
  }
  else {
    if ($arr['password'] == $password) {
      echo "<script>window.location.href='./index.html';</script>";
    }
    else {
      echo "密码错误,请重新登录";
      exit;
    }
  }
}
