<?php
include("conn.php");

if (!empty($_GET['ID'])) {
    $ID = $_GET['ID'];
    $sql = "delete from artical where id='$ID' ";
    if (mysqli_query($link, $sql)) {
        echo "<script>location.href='admin.php'</script>";
    } else {
        echo mysqli_error($link);
    }
}
