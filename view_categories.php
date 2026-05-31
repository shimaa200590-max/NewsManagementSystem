<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$result = mysqli_query($conn, "SELECT * FROM categories");
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>عرض الفئات</title>
    <style>table, th, td { border: 1px solid black; border-collapse: collapse; padding: 8px; }</style>
</head>
<body>
    <a href="dashboard.php">العودة للوحة التحكم</a>
    <h2>جميع الفئات المخزنة</h2>
    <table>
        <tr>
            <th>رقم الفئة (ID)</th>
            <th>اسم الفئة</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>