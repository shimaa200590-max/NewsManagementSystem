<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

if (isset($_POST['add_cat'])) {
    $cat_name = $_POST['cat_name'];
    $query = "INSERT INTO categories (name) VALUES ('$cat_name')";
    if (mysqli_query($conn, $query)) {
        $msg = "تم إضافة الفئة بنجاح!";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head><title>إضافة فئة</title></head>
<body>
    <a href="dashboard.php">العودة للوحة التحكم</a>
    <h2>إضافة فئة جديدة</h2>
    <?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
    <form action="add_category.php" method="POST">
        <label>اسم الفئة (مثل: أخبار رياضية، سياسية...):</label><br>
        <input type="text" name="cat_name" required><br><br>
        <button type="submit" name="add_cat">حفظ الفئة</button>
    </form>
</body>
</html>