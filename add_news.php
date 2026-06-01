<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$categories = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_POST['add_news'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category_id = $_POST['category_id'];
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $folder = "uploads/" . $image_name;

    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    if (empty($category_id)) {
        $check_cat = mysqli_query($conn, "SELECT id FROM categories LIMIT 1");
        if ($cat_row = mysqli_fetch_assoc($check_cat)) {
            $category_id = $cat_row['id'];
        } else {
            $category_id = 1;
        }
    }

    if (move_uploaded_file($image_tmp, $folder)) {
        $query = "INSERT INTO news (title, category_id, details, image, user_id, is_deleted) 
                  VALUES ('$title', '$category_id', '$details', '$image_name', '$user_id', 0)";
        
        if (mysqli_query($conn, $query)) {
            $msg = "News article published successfully!";
        } else {
            $error = "Database error: " . mysqli_error($conn);
        }
    } else {
        $error = "Failed to upload image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Add News</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
        .navbar { background: #222222; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; color: white; }
        .navbar h2 { margin: 0; font-size: 20px; }
        .navbar a { color: white; text-decoration: none; font-size: 14px; font-weight: bold; margin-left: 15px; }
        .container { padding: 30px; max-width: 600px; margin: 0 auto; }
        .form-box { background: white; border: 1px solid #cccccc; padding: 25px; }
        .input-control { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #cccccc; box-sizing: border-box; }
        .btn-submit { background-color: #222222; color: white; padding: 10px; border: none; width: 100%; font-weight: bold; cursor: pointer; }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>News System</h2>
        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="view_news.php">View All News</a>
        </div>
    </div>
    <div class="container">
        <div class="form-box">
            <h2>Add New Article</h2>
            <?php if(isset($msg)) echo "<p style='color:green; font-weight:bold;'>$msg</p>"; ?>
            <?php if(isset($error)) echo "<p style='color:red; font-weight:bold;'>$error</p>"; ?>
            
            <form action="add_news.php" method="POST" enctype="multipart/form-data">
                <label>Article Title:</label>
                <input type="text" name="title" class="input-control" required>

                <label>Category:</label>
                <select name="category_id" class="input-control" required>
                    <option value="">Select Category</option>
                    <?php if($categories && mysqli_num_rows($categories) > 0): ?>
                        <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                            <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
                        <?php } ?>
                    <?php endif; ?>
                </select>

                <label>News Details:</label>
                <textarea name="details" class="input-control" style="height: 120px;" required></textarea>

                <label>Article Image:</label>
                <input type="file" name="image" class="input-control" required>

                <button type="submit" name="add_news" class="btn-submit">Publish News</button>
            </form>
        </div>
    </div>
</body>
</html>