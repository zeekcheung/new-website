<!-- 连接数据库 -->
<?php
$host = 'localhost';
$username = 'root';
$password = 'zz2001..';
$db_name = 'website';

$link = mysqli_connect($host, $username, $password, $db_name);

if (!$link) echo mysqli_connect_error();

?>