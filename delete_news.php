<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // تغيير الحالة إلى 1 (محذوف) بدلاً من DELETE المباشر
    $query = "UPDATE news SET is_deleted = 1 WHERE id = '$id'";
    mysqli_query($conn, $query);
}

header("Location: view_news.php");
exit();
?>