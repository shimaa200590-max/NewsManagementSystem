<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

$categories = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $get_news = mysqli_query($conn, "SELECT * FROM news WHERE id='$id'");
    $news_data = mysqli_fetch_assoc($get_news);
}

if (isset($_POST['update_news'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $details = $_POST['details'];
    

    if (!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image_name);
    } else {
        $image_name = $_POST['old_image']; 
    }

    $query = "UPDATE news SET title='$title', category_id='$category_id', details='$details', image='$image_name' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        header("Location: view_news.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head><title>تعديل الخبر</title></head>
<body>
    <h2>تعديل الخبر</h2>
    <form action="edit_news.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $news_data['id']; ?>">
        <input type="hidden" name="old_image" value="<?php echo $news_data['image']; ?>">

        <label>عنوان الخبر:</label><br>
        <input type="text" name="title" value="<?php echo $news_data['title']; ?>" required><br><br>

        <label>الفئة:</label><br>
        <select name="category_id" required>
            <?php while($cat = mysqli_fetch_assoc($categories)) { 
                $selected = ($cat['id'] == $news_data['category_id']) ? "selected" : "";
            ?>
                <option value="<?php echo $cat['id']; ?>" <?php echo $selected; ?>><?php echo $cat['name']; ?></option>
            <?php } ?>
        </select><br><br>

        <label>تفاصيل الخبر:</label><br>
        <textarea name="details" rows="5" cols="40" required><?php echo $news_data['details']; ?></textarea><br><br>

        <label>الصورة الحالية:</label><br>
        <img src="uploads/<?php echo $news_data['image']; ?>" width="100"><br>
        <label>رفع صورة جديدة (اختياري):</label><br>
        <input type="file" name="image"><br><br>

        <button type="submit" name="update_news">تحديث الخبر</button>
    </form>
</body>
</html>