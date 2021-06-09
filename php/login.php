<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/admin.css">
    <title>Login</title>
</head>

<body>
    <div class="block">
        <form role="form" action="loginAction.php" method="POST">
            <div class="account">
                <div></div>
                <input id="name" type="text" name="name" value="<?php echo isset($_COOKIE['admin']) ? $_COOKIE['admin'] : ""; ?>" placeholder="输入管理员账户" required>
            </div>

            <div class="password">
                <div></div>
                <input id="password" type="password" name="password" placeholder="输入管理员密码" required>
            </div>

            <div class="remember">
                <input type="checkbox" name="remember" id="remember">
                <input type="text" value="记住我" disabled="disabled">
            </div>

            <span colspan="2" class="text-center" style="color:red;font-size:10px;"></span>
            <?php
            $err = isset($_GET["err"]) ? $_GET["err"] : "";
            switch ($err) {
                case 1:
                    echo "<script>alert('用户名或密码错误!');location.href='login.php'</script>";
                    break;

                case 2:
                    echo "<script>alert('用户名和密码不能为空！');location.href='login.php'</script>";
                    break;
            }
            ?>

            <div class="login">
                <input type="submit" name="login" value="登录">
                <a href="register.php"><input type="text" value="注册" id="register"></a>
            </div>
        </form>
    </div>
</body>
