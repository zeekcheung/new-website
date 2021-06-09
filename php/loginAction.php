<?php
session_start();
$name = isset($_POST['name']) ? $_POST['name'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$remember = isset($_POST['remember']) ? $_POST['remember'] : "";

//判断用户名和密码是否为空
if (!empty($name) && !empty($password)) {
    include("conn.php");

    $sql = "select name,password from admin where name='$name' and password='$password'";
    $query = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($query);

    //判断用户名和密码是否正确
    if ($name == $row['name'] && $password == $row['password']) {
        //创建session
        $_SESSION['name'] = $name;

        if ($remember == "on") {
            //创建cookie,用户信息7天后过期
            setcookie("name", $name, time() + 7 * 24 * 3600);
            //写入日志
            $ip = $_SERVER['REMOTE_ADDR'];
            $date = date('Y-m-d H:m:s');
            $info = sprintf("当前访问用户：%s,IP地址：%s,时间：%s /n", $name, $ip, $date);
            $sql_logs = "INSERT INTO logs(name,ip,date) VALUES('$name','$ip','$date')";
            //日志写入文件，如实现此功能，需要创建文件目录logs
            $f = fopen('./logs/' . date('Ymd') . '.log', 'a+');
            fwrite($f, $info);
            fclose($f);
        }

        //跳转到admin.php页面
        header("Location:admin.php");
    } else {
        //用户名或密码错误，err赋值为1
        header("Location:login.php?err=1");
    }
} else {
    //用户名或密码为空，err赋值为2
    header("Location:login.php?err=2");
}
