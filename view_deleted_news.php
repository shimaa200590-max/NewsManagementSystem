<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$query = "SELECT news.*, categories.name AS cat_name, users.name AS user_name 
          FROM news 
          INNER JOIN categories ON news.category_id = categories.id
          INNER JOIN users ON news.user_id = users.id
          WHERE news.is_deleted = 1";

$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>الأخبار المحذوفة</title>
    <style>table, th, td { border: 1px solid black; border-collapse: collapse; padding: 10px; text-align: center; }</style>
</head>
<body>
    <a href="dashboard.php">العودة للوحة التحكم</a>
    <h2>الأخبار المحذوفة (المخفية من النظام)</h2>
    <table>
        <tr>
            <th>العنوان</th>
            <th>الفئة</th>
            <th>التفاصيل</th>
            <th>الصورة</th>
            <th>من قام بحذفه (الناشر الأصلي)</th>
        </tr>
        <?php if(mysqli_num_rows($result) == 0) { echo "<tr><td colspan='5'>لا توجد أخبار محذوفة.</td></tr>"; } ?>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['cat_name']; ?></td>
            <td><?php echo $row['details']; ?></td>
            <td><img src="uploads/<?php echo $row['image']; ?>" width="80"></td>
            <td><?php echo $row['user_name']; ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>