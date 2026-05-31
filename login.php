<?php
include 'db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة!";
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>تسجيل الدخول</title>
</head>
<body>
    <h2>تسجيل الدخول</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="login.php" method="POST">
        <label>البريد الإلكتروني:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>كلمة المرور:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit" name="login">تسجيل الدخول</button>
    </form>
    <p>ليس لديك حساب؟ <a href="register.php">أنشئ حسابك الآن</a></p>
</body>
</html>