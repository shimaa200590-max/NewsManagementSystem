<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>View Categories</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
        .navbar { background: #222222; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .navbar h2 { margin: 0; font-size: 20px; }
        .navbar a { color: white; text-decoration: none; font-weight: bold; font-size: 14px; }
        .container { padding: 30px; max-width: 700px; margin: 0 auto; }
        .table-box { background: white; border: 1px solid #cccccc; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #cccccc; padding: 10px; text-align: center; font-size: 14px; }
        th { background-color: #eaeaea; color: #333; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>News System Dashboard</h2>
        <a href="dashboard.php">📊 Back to Dashboard</a>
    </div>
    <div class="container">
        <div class="table-box">
            <h2>Stored System Categories</h2>
            <table>
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($result && mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                        </tr>
                        <?php } ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" style="color:#666; padding: 15px;">No categories found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>