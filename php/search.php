<?php
require 'conn.php';
require 'frame.html';
?>

<head>
    <script src="JS/search.js"></script>
    <title>Search</title>
</head>

<body>
    <main>
        <div class="atc_frame_r" id='edit'>
            <div class="spoke"></div>

            <div class="artical">
                <!--搜索栏-->
                <div>
                    <input class="search" type="text" placeholder="输入关键词搜索" onkeyup="showHint(this.value)">
                    <div id="search_icon"></div>
                </div>
                <div id="result"></div>
            </div>
        </div>

    </main>
</body>
