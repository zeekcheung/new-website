<?php
session_start();
require 'php/conn.php';

header("content-type:text/html,charset:gbk");
mysqli_query($link, "set names gbk");

// 图片路径
$path = array(
    "HTML" => "../images/article/HTML.svg",
    "CSS" => "../images/article/CSS.svg",
    "JAVASCRIPT" => "../images/article/JAVASCRIPT.svg",
    "C" => "../images/article/C.svg",
    "JAVA" => "../images/article/JAVA.svg",
    "PYTHON" => "../images/article/PYTHON.svg",
    "GIT" => "../images/article/GIT.svg",
    "BROWSER" => "../images/article/BROWSER.svg",
    "INTERNET" => "../images/article/INTERNET.svg"
);

$id = $_GET['ID'];
$sql = "SELECT * FROM article WHERE id = $id";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);

if ($row) {
    $title = stripslashes($row['title']);
    $content = stripslashes($row['content']);
    $date = $row['date'];
    $tag = $row['tag'];
    $path = $path[$tag];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="gbk">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="clementCheung">
    <meta name="description" content="Articals written by Clement Cheung.">
    <link rel="stylesheet" href="css/show.min.css">
    <link rel="shortcut icon" href="Icons/article.svg">
    <title>Articals</title>
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
                <li><a href="index.html">ABOUT</a></li>
                <li><a href="article.html">ARTICLE</a></li>
                <li><a href="Instagram.html">INSTAGRAM</a></li>
                <li><a href="login.html">LOGIN</a></li>
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
                    <span class="date"><?php echo $date ?></span>

                </header>

                <h2>
                    <title><?php echo $title ?></title>
                </h2>
                <div class="image main"><img src="<?php echo $path ?>" alt="<?php echo $tag ?>" style="margin:0 auto; width:70%" /></div>
                <p><?php echo $content ?></p>
            </section>
        </main>

        <!-- 页脚 -->
        <footer id="footer">
            <!-- 发送邮件 -->
            <section>
                <form action="php/sendEmail.php" method="POST">
                    <div class="field">
                        <label for="name">NAME</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="field">
                        <label for="email">EMAIL</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="field">
                        <label for="message">MESSAGE</label>
                        <input type="text" name="message" id="message">
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="SEND EMAIL"></li>
                    </ul>
                </form>
            </section>

            <!-- 联系方式 -->
            <section class="split contact">
                <section class="alt">
                    <h3>ADDRESS</h3>
                    <p><?php echo iconv("utf-8", "gbk", "广东省") ?></p>
                </section>
                <section>
                    <h3>PHONE</h3>
                    <p>+86 13727819601</p>
                </section>
                <section>
                    <h3>EMAIL</h3>
                    <p>clementchueng@gmail.com</p>
                </section>
                <section>
                    <h3>MEDIA</h3>
                    <ul class="icons alt">
                        <li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
                    </ul>
                </section>
            </section>
        </footer>

        <!-- 版权说明 -->
        <div id="copyright">
            <ul>
                <li>&copy; ClementCheung</li>
            </ul>
        </div>
    </div>

    <!-- js -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.scrollex.min.js"></script>
    <script src="js/jquery.scrolly.min.js"></script>
    <script src="js/skel.min.js"></script>
    <script src="js/util.min.js"></script>
    <script src="js/main.min.js"></script>
</body>

</html>