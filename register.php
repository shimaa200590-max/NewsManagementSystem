<?php
include 'db.php';
$error = "";
$msg = "";

if (isset($_POST['register'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        // فحص إلكتروني لو الإيميل مسجل من قبل
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "This email is already registered!";
        } else {
            // تشفير كلمة المرور أماناً وحفظ البيانات
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            if (mysqli_query($conn, $query)) {
                $msg = "Account created successfully! You can login now.";
            } else {
                $error = "Registration failed. Database error.";
            }
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Create New Account</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 30px; border: 1px solid #cccccc; width: 360px; box-shadow: 0px 4px 10px rgba(0,0,0,0.05); }
        .login-box h2 { margin-top: 0; color: #222222; text-align: center; margin-bottom: 20px; }
        .input-control { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #cccccc; box-sizing: border-box; }
        .btn-submit { background-color: #222222; color: white; padding: 10px; border: none; width: 100%; font-weight: bold; cursor: pointer; font-size: 15px; }
        .btn-submit:hover { background-color: #444444; }
        .switch-link { text-align: center; margin-top: 15px; font-size: 13px; color: #555555; }
        .switch-link a { color: #0066cc; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Create Account</h2>
        <?php if(!empty($error)) echo "<p style='color:red; font-weight:bold; text-align:center;'>$error</p>"; ?>
        <?php if(!empty($msg)) echo "<p style='color:green; font-weight:bold; text-align:center;'>$msg</p>"; ?>
        
        <form action="register.php" method="POST">
            <label>Full Name:</label>
            <input type="text" name="name" class="input-control" required>

            <label>Email Address:</label>
            <input type="email" name="email" class="input-control" required>

            <label>Password:</label>
            <input type="password" name="password" class="input-control" required>

            <button type="submit" name="register" class="btn-submit">Sign Up</button>
        </form>
        
        <div class="switch-link">
            Already have an account? <a href="login.php">Login Here</a>
        </div>
    </div>
</body>
</html>