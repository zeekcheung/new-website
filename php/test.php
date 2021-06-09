<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="clementCheung">
    <meta name="description" content="Articals written by Clement Cheung.">
    <link rel="stylesheet" href="../css/artical.min.css">
    <link rel="shortcut icon" href="Icons/bookmark.svg">
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
                <li><a href="index.html">About</a></li>
                <li class="active"><a href="article.html">Artical</a></li>
                <li><a href="Instagram.html">Instagram</a></li>
                <li><a href="Game.html">Game</a></li>
            </ul>
            <ul class="icons">
                <li><a href="https://github.com/clementchueng" class="icon fa-github"></a></li>
                <li><a href="#" class="icon fa-twitter"></a></li>
                <li><a href="#" class="icon fa-facebook"></a></li>
            </ul>
        </nav>

        <!-- 主要内容 -->
        <main id="main">
            <!-- 文章 -->
            <section class="posts">
                <?php
                session_start();
                require 'conn.php';
                // header("content-type:text/html;charset=gbk");
                // 图片路径
                $path = array(
                    "HTML" => "../images/HTML.png",
                    "CSS" => "../images/CSS.png",
                    "JAVASCRIPT" => "../images/JAVASCRIPT.png",
                    "C" => "../images/C.png",
                    "JAVA" => "../images/JAVA.png",
                    "PYTHON" => "../images/PYTHON.jfif",
                    "GIT" => "../images/GIT.png",
                    "BROWSER" => "../images/BROWSER.jfif",
                    "INTERNET" => "../images/INTERNET.jfif"
                );

                $page = isset($_GET['p']) ? $_GET['p'] : 1;
                $pageSize = 9;
                $showPage = 9;

                $sql = "SELECT * FROM article WHERE title is not null LIMIT " . ($page - 1) * $pageSize . ",{$pageSize}";
                $result = mysqli_query($link, $sql);
                if (!$result)
                    echo mysqli_error($link);

                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <article>
                        <header>
                            <!-- 发表日期 -->
                            <span class="date"><?php echo $row['date'] ?></span>
                            <!-- 标题 -->
                            <h2><a href="view.php?ID=<?php echo $row['ID']; ?>"><?php echo $row['title'] ?></h2>
                        </header>
                        <!-- 封面 -->
                        <a href="view.php?ID=<?php echo $row['ID']; ?>" class="image fit"><img src="<?php echo $path[$row['tag']] ?>" alt="<?php echo $row['tag'] ?>" /></a>
                        <!-- 概要内容 -->
                        <p><?php echo mb_substr($row['content'], 0, 20, 'gbk') ?></p>
                        <!-- 查看完整内容 -->
                        <ul class="actions">
                            <li><a href="view.php?ID=<?php echo $row['ID']; ?>" class="button">查看原文</a></li>
                        </ul>
                    </article>
                <?php
                }

                //获取数据总数
                $total_sql = "SELECT COUNT(*) FROM artical";
                $total_result = mysqli_fetch_array(mysqli_query($link, $total_sql));
                $total = $total_result[0];

                //计算页数
                $total_pages = ceil($total / $pageSize);

                $page_banner = "<div class='pagination'>";

                //计算偏移量
                $pageoffset = ($showPage - 1) / 2;
                if ($page > 1) {
                    $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=1' class='page active'>prev</a>";
                    $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=" . ($page - 1) . "' class='page'><i style='font-size:16px' class='fa'>&#xf100</i></a>";
                } else {
                    $page_banner .= "<a page disable'>prev</a>";
                    $page_banner .= "<a page disable'><i style='font-size:16px' class='fa'>&#xf100</i></a>";
                }
                //初始化数据
                $start = 1;
                $end = $total_pages;

                if ($total_pages > $showPage) {
                    if ($page > $pageoffset + 1) {
                        $page_banner .= "...";
                    }

                    if ($page > $pageoffset) {
                        $start = $page - $pageoffset;
                        $end = $total_pages > $page + $pageoffset ? $page + $pageoffset : $total_pages;
                    } else {
                        $start = 1;
                        $end = $total_pages > $showPage ? $showPage : $total_pages;
                    }

                    if ($page + $pageoffset > $total_pages) {
                        $start = $start - ($page + $pageoffset - $end);
                    }
                }

                for ($i = $start; $i <= $end; $i++) {
                    if ($page == $i) {
                        $page_banner .= "<a class='page active'>{$i}</a>";
                    } else {
                        $page_banner .= "<a class='page active' href='" . $_SERVER['PHP_SELF'] . "?p=" . $i . "'>{$i}</a>";
                    }
                }

                //尾部省略
                if ($total_pages > $showPage && $total_pages > $page + $pageoffset) {
                    $page_banner .= "...";
                }

                if ($page < $total_pages) {
                    $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=" . ($page + 1) . "' class='page'><i style='font-size:16px' class='fa'>&#xf101</i></a>";
                    $page_banner .= "<a href='" . $_SERVER['PHP_SELF'] . "?p=" . ($total_pages) . "' class='page'>end</a>";
                } else {
                    $page_banner .= "<a class='page disable'><i style='font-size:16px' class='fa'>&#xf101</i></a>";
                    $page_banner .= "<a class='page disable'>end</a>";
                }

                $page_banner .= "</div>";
                ?>

            </section>

            <!-- 页码 -->
            <footer>
                <?php echo $page_banner ?>
            </footer>
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
    <script src="../js/jquery.scrollex.min.js"></script>
    <script src="../js/jquery.scrolly.min.js"></script>
    <script src="../js/skel.min.js"></script>
    <script src="../js/util.min.js"></script>
    <script src="../js/main.min.js"></script>
</body>

</html>