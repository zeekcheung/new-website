<?php
session_start();
$_SESSION['name'] = $name = isset($_POST['name']) ? $_POST['name'] : "";
$_SESSION['password'] = $password = isset($_POST['password']) ? $_POST['password'] : "";
$_SESSION['re_password'] = $re_password = isset($_POST['re_password']) ? $_POST['re_password'] : "";

if ($password == $re_password) {
    include("conn.php");
    $sql_select = "SELECT name FROM admin WHERE name = '$name'"; //执行SQL语句
    $result = mysqli_query($link, $sql_select);

    //判断管理员是否已存在
    if (mysqli_fetch_lengths($result)) {
        header("Location:register.php?err=1"); //管理员已存在，显示提示信息
    } else {
        $sql_insert = "INSERT INTO admin(name,password) VALUES('$name','$password')";
        mysqli_query($link, $sql_insert);
        header("Location:login.php");
    }
} else {
    header("Location:register.php?err=2");
}
