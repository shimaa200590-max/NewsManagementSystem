<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$conn = mysqli_connect("127.0.0.1:3307", "root", "", "news_system");

if (!$conn) {
    die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());
}
?>