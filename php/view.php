<?php
session_start();
require 'frame.html';
require 'conn.php';

if (!empty($_GET['ID'])) {
    $ID = $_GET['ID'];
    $sql = "select * from artical where ID='$ID'";
    $query = mysqli_query($link, $sql);

    if (!$query) {
        printf("Error: %s\n", mysqli_error($link));
        exit();
    }

    $rs = mysqli_fetch_array($query);
}
?>

<head>
    <title>View</title>
</head>

<body>
    <main>
        <div class="atc_frame">
            <div class="spoke"></div>

            <div class="artical">
                <div class="title">
                    <span style="float: left;"><?php echo $rs['title']; ?></span>
                    <span style="float: right;" class="date"><?php echo $rs['date']; ?></span>
                </div>

                <div class="content">
                    <?php echo $rs['content'] ?>
                </div>

                <div class="tag">
                    <span><i></i>随笔</span>
                </div>


            </div>
        </div>
    </main>
</body>
