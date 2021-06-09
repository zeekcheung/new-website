<?php
session_start();
require 'frame.html';
require 'conn.php';

if (!empty($_GET['ID'])) {
    $ID = $_GET['ID'];
}

if (!empty($_POST['submit'])) {
    $title = $_POST['title'];          //获取title表单内容
    $content = $_POST['content'];      //获取content表单内容  

    if (!strlen($title)) {
        echo "<script>alert('标题未填写！');location.href='<?PHP echo $_POST[SELF] ?>'</script>";
    } else if (!strlen($content)) {
        echo "<script>alert('内容为空！');location.href='<?PHP echo $_POST[SELF] ?>'</script>";
    } else {
        $sql = "update artical set title='$title', content='$content' where ID='$ID'";
        $query = mysqli_query($link, $sql);

        if (!$query) {
            echo (mysqli_error($link));
        } else {
            echo "<script>location.href='admin.php'</script>";
        }
    }
}
?>

<head>
    <title>Alter</title>
</head>

<body>
    <main>
        <div class="atc_frame_r" id='edit'>
            <div class="spoke"></div>

            <div class="artical">
                <form role="form" action="edit.php?ID=<?php echo $_GET['ID'] ?>" method="POST">

                    <span class="write">title:</span><br>
                    <textarea rows="2" cols="100" name="title"></textarea><br><br>

                    <span class="write">content:</span><br>
                    <textarea rows="10" cols="100" name="content"></textarea><br><br>
                    <div style="float: right;"><input type="submit" name="submit" value="submit"></div>
                </form>
            </div>
        </div>
    </main>
</body>
