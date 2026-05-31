<?php
session_start(); // هاد السطر السحري الناقص اللي هيحل كل المشكلة!
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>لوحة تحكم إدارة الأخبار</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .navbar { background: #f4f4f4; padding: 15px; margin-bottom: 20px; }
        .navbar a { margin-left: 15px; text-decoration: none; color: #333; font-weight: bold; }
        .navbar a:hover { color: blue; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>

    <h2>مرحباً بك يا <?php echo $_SESSION['user_name']; ?> في لوحة التحكم</h2>
    
    <div class="navbar">
        <a href="dashboard.php">الرئيسية</a> |
        <a href="add_category.php">إضافة فئة</a> |
        <a href="view_categories.php">عرض الفئات</a> |
        <a href="add_news.php">إضافة خبر</a> |
        <a href="view_news.php">عرض جميع الأخبار</a> |
        <a href="view_deleted_news.php">عرض الأخبار المحذوفة</a> |
        <a href="logout.php" style="color: red; font-weight: bold;">تسجيل الخروج</a>
    </div>

    <h3>تعليمات النظام</h3>
    <p>الرجاء استخدام القائمة في الأعلى للتنقل وإدارة الأخبار والفئات بنجاح.</p>

</body>
</html>