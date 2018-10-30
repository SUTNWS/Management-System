<?php
header("Content-Type:text/html;charset=utf-8");

$name = htmlspecialchars($_POST['name']);
$password = htmlspecialchars($_POST['password']);
$repassword = htmlspecialchars($_POST['repassword']);
//使用htmlspecialchars防护XSS
if (!$name || !$password || !$repassword) {
  echo "请将信息输入完整";
  exit;
}
elseif ($password != $repassword) {
  echo "两次输入的密码不一致";
  exit;
}//非空及重复密码判定
else {
  $mysqli = new mysqli('localhost','root','root','management');
  $mysqli->set_charset("utf-8");

  /*
  $sql = "insert into login(name,password) values('{$name}','{$password}')";
  $result = $mysqli->query($sql);
  */
  //普通方式将数据写入数据库
  $sql = "insert into login(name,password) values(?,?)";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss",$name,$password);
  $result = $stmt->execute();
  //防止SQL注入方式将数据写入数据库
  if ($result) {
    echo "<script>alert('注册成功');window.location.href='./login.html';</script>";
  }
  //使用js进行定位，也可使用header("Location")进行重定向切换界面
  else {
    echo "注册失败，请重新注册";
    exit;
  }
}
