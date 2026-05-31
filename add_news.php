<?php
include 'db.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }

// جلب الفئات لعرضها في القائمة المنسدلة (Select Box)
$categories = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_POST['add_news'])) {
    $title = $_POST['title'];
    $category_id = $_POST['category_id'];
    $details = $_POST['details'];
    $user_id = $_SESSION['user_id']; // المستخدم الحالي

    // معالجة رفع الصورة التقليدية
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $folder = "uploads/" . $image_name;

    // إنشاء مجلد uploads إن لم يكن موجوداً
    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    if (move_uploaded_file($image_tmp, $folder)) {
        $query = "INSERT INTO news (title, category_id, details, image, user_id) 
                  VALUES ('$title', '$category_id', '$details', '$image_name', '$user_id')";
        if (mysqli_query($conn, $query)) {
            $msg = "تم نشر الخبر بنجاح!";
        }
    } else {
        $error = "فشل في رفع الصورة.";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head><title>إضافة خبر</title></head>
<body>
    <a href="dashboard.php">العودة للوحة التحكم</a>
    <h2>إضافة خبر جديد</h2>
    <?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    
    <form action="add_news.php" method="POST" enctype="multipart/form-data">
        <label>عنوان الخبر:</label><br>
        <input type="text" name="title" required><br><br>

        <label>الفئة:</label><br>
        <select name="category_id" required>
            <option value="">اختر الفئة</option>
            <?php while($cat = mysqli_fetch_assoc($categories)) { ?>
                <option value="<?php echo $cat['id']; ?>"><?php echo $cat['name']; ?></option>
            <?php } ?>
        </select><br><br>

        <label>تفاصيل الخبر:</label><br>
        <textarea name="details" rows="5" cols="40" required></textarea><br><br>

        <label>صورة الخبر:</label><br>
        <input type="file" name="image" required><br><br>

        <button type="submit" name="add_news">نشر الخبر</button>
    </form>
</body>
</html>