<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

if (isset($_POST['add_cat'])) {
    $cat_name = $_POST['cat_name'];
    $query = "INSERT INTO categories (name) VALUES ('$cat_name')";
    if (mysqli_query($conn, $query)) {
        $msg = "Category added successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
        .navbar { background: #222222; padding: 15px; color: white; display: flex; justify-content: space-between; }
        .navbar a { color: white; text-decoration: none; font-weight: bold; }
        .container { padding: 30px; max-width: 500px; margin: 0 auto; }
        .form-box { background: white; border: 1px solid #cccccc; padding: 25px; }
        .input-control { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #cccccc; box-sizing: border-box; }
        .btn-submit { background-color: #222222; color: white; padding: 10px; border: none; width: 100%; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="navbar">
        <span style="font-weight:bold;">News System</span>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
    <div class="container">
        <div class="form-box">
            <h2>Add New Category</h2>
            <?php if(isset($msg)) echo "<p style='color:green; font-weight:bold;'>$msg</p>"; ?>
            <form action="add_category.php" method="POST">
                <label>Category Name:</label>
                <input type="text" name="cat_name" class="input-control" placeholder="e.g. Sports, Politics" required>
                <button type="submit" name="add_cat" class="btn-submit">Save Category</button>
            </form>
        </div>
    </div>
</body>
</html>