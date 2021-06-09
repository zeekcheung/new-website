<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="clementCheung">
    <meta name="description" content="Articals written by Clement Cheung.">
    <link rel="stylesheet" href="../css/show.min.css">
    <link rel="shortcut icon" href="../Icons/article.svg">
    <title>Articals</title>

    <style>
        form {
            flex-direction: column;
            align-items: center;
        }

        form>select {
            text-align: center;
            text-align-last: center;
        }

        #title {
            text-align: center;
        }

        form>textarea {
            text-align: start;
        }

        form>input:last-child {
            margin-top: 20px;
        }
    </style>
</head>

<body class="is-loading">
    <!-- 页面内容的容器 -->
    <div id="wrapper" class="fade-in">
        <!-- logo -->
        <header id="header">
            <a href="index.html" class="logo">Clement</a>
        </header>

        <!-- 导航栏 -->
        <nav id="nav">
            <ul class="links">
                <li><a href="index.html">About</a></li>
                <li><a href="article.html">Artical</a></li>
                <li><a href="Instagram.html">Instagram</a></li>
                <li><a href="Game.html">Game</a></li>
            </ul>
            <ul class="icons">
                <li><a href="#" class="icon fa-github"></a></li>
                <li><a href="#" class="icon fa-twitter"></a></li>
                <li><a href="#" class="icon fa-facebook"></a></li>
            </ul>
        </nav>

        <!-- 主要内容 -->
        <main id="main">
            <!-- 文章 -->
            <section class="post">
                <header class="major">
                    <span class="date"><?php echo date('Y-m-d'); ?></span>

                </header>

                <form action="add.php" method="POST">
                    <select name="tag" id="tag">
                        <option value="none" selected disabled>TAG</option>
                        <option value="HTML">HTML</option>
                        <option value="CSS">CSS</option>
                        <option value="JAVASCRIPT">JAVASCRIPT</option>
                        <option value="C">C</option>
                        <option value="JAVA">JAVA</option>
                        <option value="PYTHON">PYTHON</option>
                        <option value="GIT">GIT</option>
                        <option value="BROWSER">浏览器</option>
                        <option value="INTERNET">计算机网络</option>
                    </select>
                    <input type="text" name="title" id="title" placeholder="TITLE">
                    <textarea name="content" id="content" cols="100" rows="9" placeholder="CONTENT"></textarea>
                    <input type="submit" name="submit" value="submit">
                </form>
            </section>
        </main>

        <!-- 版权说明 -->
        <div id="copyright">
            <ul>
                <li>&copy; ClementCheung</li>
            </ul>
        </div>
    </div>

    <!-- js -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.scrollex.min.js"></script>
    <script src="../js/jquery.scrolly.min.js"></script>
    <script src="../js/skel.min.js"></script>
    <script src="../js/util.min.js"></script>
    <script src="../js/main.min.js"></script>
</body>

</html>

<?php
session_start();
require 'conn.php';

if (!empty($_POST['submit'])) {
    $title = $_POST['title'];           //获取title表单内容
    // 为了插入中文，需要将字符编码转为gbk编码:iconv();
    // 为了插入标签等字符，需要对字符进行转义：addslashes($title)
    $title = iconv('utf-8', 'gbk', addslashes($title));
    $content = $_POST['content'];      //获取content表单内容 
    $content = iconv('utf-8', 'gbk', addslashes($content));
    $tag = $_POST['tag'];       // 文章标签
    $date = date('Y-m-d');      // 发布日期
    // 为了插入成功，需要统一客户端字符集
    mysqli_query($link, "set names gbk");

    if (!strlen($title)) {
        echo "<script>alert('标题未填写！')</script>;";
    } else if (!strlen($content)) {
        echo "<script>alert('内容不能为空！')</script>";
    } else if (!strlen($tag)) {
        echo "<script>alert('标签未选择！')</script>";
    } else {
        $sql = "INSERT INTO article(title,content,date,tag) VALUES('$title','$content','$date','$tag')";
        $query = mysqli_query($link, $sql);

        if ($query) {
            echo "<script>
                if(confirm('发表成功！是否回到主页？')) {
                    location.href='../index.html';
                } else {
                    location.href='add.php';
                };
            </script>";
        } else {
            $error = mysqli_error($link);
            echo "<script>alert('$error')</script>";
        }
    }
}
?>