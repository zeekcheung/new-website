<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/admin.css">
    <title>Register</title>
</head>

<body>
    <div class="block">
        <form action="registerAction.php" method="POST">
            <div class="account">
                <div></div>
                <input type="text" name="name" placeholder="请输入管理员名称" required>
            </div>

            <div class="password">
                <div></div>
                <input type="password" name="password" placeholder="请输入密码" required>
            </div>

            <div class="password">
                <div></div>
                <input type="password" name="re_password" placeholder="请再次输入密码" required>
            </div>

            <span colspan="2" class="text-center" style="color:red;font-size:10px;"></span>
            <?php
            $err = isset($_GET["err"]) ? $_GET["err"] : "";
            switch ($err) {
                case 1:
                    echo "<script>alert('用户名或密码错误!');location.href='register.php'</script>";
                    break;

                case 2:
                    echo "<script>alert('用户名和密码不能为空！');location.href='register.php'</script>";
                    break;
            }
            ?>

            <div class="register">
                <input type="submit" id="register" name="register" value="注册">
                <input type="text" id="login" name="login" value="登录">
            </div>
        </form>
    </div>
</body>

</html>
