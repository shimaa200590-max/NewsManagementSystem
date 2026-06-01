<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$id = $_GET['id'];
$query = "SELECT * FROM news WHERE id='$id' OR ID='$id'";
$result = mysqli_query($conn, $query);
$news = mysqli_fetch_assoc($result);

$cat_query = "SELECT * FROM categories";
$cat_result = mysqli_query($conn, $cat_query);

if (isset($_POST['update_news'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];
    
    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image_name);
        $update_query = "UPDATE news SET title='$title', content='$content', category_id='$category_id', image='$image_name' WHERE id='$id' OR ID='$id'";
    } else {
        $update_query = "UPDATE news SET title='$title', content='$content', category_id='$category_id' WHERE id='$id' OR ID='$id'";
    }
    
    if (mysqli_query($conn, $update_query)) {
        header("Location: view_news.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; margin:0; padding:0; }
        .navbar { background-color: #222222; color: white; padding: 12px 20px; }
        .container { padding: 30px; max-width: 600px; margin: 0 auto; }
        .form-box { background-color: white; border: 1px solid #ccc; padding: 25px; }
        .input-control { width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; box-sizing: border-box; }
        .btn-submit { background-color: #222222; color: white; padding: 10px; border: none; width: 100%; cursor: pointer; }
    </style>
</head>
<body>
    <div class="navbar"><h2 style="margin:0;color:white;">Edit Article</h2></div>
    <div class="container">
        <div class="form-box">
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" class="input-control" value="<?php echo $news['title']; ?>" required>
                <select name="category_id" class="input-control" required>
                    <?php while($cat = mysqli_fetch_assoc($cat_result)): ?>
                        <option value="<?php echo $cat['id']; ?>" <?php if($cat['id'] == $news['category_id']) echo 'selected'; ?>><?php echo $cat['name']; ?></option>
                    <?php endwhile; ?>
                </select>
                <textarea name="content" class="input-control" style="height:100px;" required><?php echo $news['content']; ?></textarea>
                <input type="file" name="image" class="input-control">
                <button type="submit" name="update_news" class="btn-submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>