<?php
include 'db.php';

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // لتسهيل الفهم نضعها مباشرة أو نستخدم md5

    // فحص إذا كان البريد موجود مسبقاً
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "البريد الإلكتروني مسجل مسبقاً!";
    } else {
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "حدث خطأ أثناء التسجيل.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>إنشاء حساب جديد</title>
</head>
<body>
    <h2>إنشاء حساب جديد</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="register.php" method="POST">
        <label>الاسم:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>البريد الإلكتروني:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>كلمة المرور:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit" name="register">إنشاء حساب</button>
    </form>
    <p>لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول من هنا</a></p>
</body>
</html>