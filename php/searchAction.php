<?php
require 'conn.php';

if (!empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $query = "SELECT * FROM artical Where title LIKE '%{$keyword}%' Limit 5";
    $result = mysqli_query($link, $query);
    if (!$result) {
        echo mysqli_error($link);
    }

    while ($row = mysqli_fetch_array($result)) {
        $row['title'] = str_replace($keyword, '<font color="red">' . $keyword . '</font>', $row['title']);
?>
        <a href="view.php?ID=<?php echo $row['ID']; ?>"><?php echo $row['title']; ?></a>
<?php
    }
}
?>