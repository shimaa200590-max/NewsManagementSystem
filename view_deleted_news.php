<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$query = "SELECT news.*, categories.name AS cat_name, users.name AS user_name 
          FROM news 
          LEFT JOIN categories ON news.category_id = categories.id
          LEFT JOIN users ON news.user_id = users.id
          WHERE news.is_deleted = 1 ORDER BY news.id DESC";

$result = mysqli_query($conn, $query);

// لو الاستعلام المتقدم ما جاب بيانات نتيجة خلل الحقول، بنجيب الاحتياطي فوراً
if (!$result) {
    $query = "SELECT * FROM news WHERE is_deleted = 1 ORDER BY id DESC";
    $result = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Deleted News Articles</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
        .navbar { background: #222222; padding: 15px; color: white; display: flex; justify-content: space-between; }
        .navbar a { color: white; text-decoration: none; font-weight: bold; }
        .container { padding: 30px; max-width: 1100px; margin: 0 auto; }
        .table-box { background: white; border: 1px solid #cccccc; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #cccccc; padding: 10px; text-align: center; font-size: 14px; }
        th { background-color: #eaeaea; color: #cc0000; }
    </style>
</head>
<body>
    <div class="navbar">
        <span style="font-weight:bold;">Trash Can (Deleted News)</span>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
    <div class="container">
        <div class="table-box">
            <h2>Deleted News (Hidden from System)</h2>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Details</th>
                    <th>Image</th>
                    <th>Original Publisher</th>
                </tr>
                <?php if($result && mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo isset($row['cat_name']) ? $row['cat_name'] : 'Uncategorized'; ?></td>
                        <td><?php echo $row['details']; ?></td>
                        <td><img src="uploads/<?php echo $row['image']; ?>" width="70"></td>
                        <td><?php echo isset($row['user_name']) ? $row['user_name'] : 'Admin'; ?></td>
                    </tr>
                    <?php } ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="color:#666; padding: 20px;">Trash is empty. No deleted news articles found.</td>
                    </tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>