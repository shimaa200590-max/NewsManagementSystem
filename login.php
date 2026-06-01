<?php
include 'db.php';

// نفس كود السيشين والبرمجة تبعتك بدون أي تغيير
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        // التعديل اللي عملناه زمان للأحرف الكبيرة والصغيرة عشان يفتح صح
        $user_id = isset($user['id']) ? $user['id'] : (isset($user['ID']) ? $user['ID'] : null);
        $user_name = isset($user['name']) ? $user['name'] : (isset($user['Name']) ? $user['Name'] : 'User');

        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
        
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>News System - Login</title>
    <style>
        /* ستايل أكاديمي بسيط وتقليدي جداً (Simple Academic Style) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* خلفية رمادية عادية */
            margin: 0;
            padding: 0;
        }

        /* عنوان علوي عادي للمشروع */
        .project-title {
            text-align: center;
            margin-top: 60px;
            color: #333333;
            font-size: 26px;
        }

        /* صندوق الفورم التقليدي الكلاسيكي بحواف حادة */
        .login-box {
            width: 330px;
            margin: 30px auto;
            background-color: #ffffff;
            padding: 25px;
            border: 1px solid #999999; /* إطار رمادي غامق يدوي */
        }

        .login-box h3 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 18px;
            color: #333333;
            border-bottom: 1px solid #cccccc;
            padding-bottom: 8px;
        }

        /* رسالة الخطأ باللون الأحمر العادي */
        .error-msg {
            color: #cc0000;
            font-size: 13px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        /* تنسيق الحقول تحت بعضها ببساطة */
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 13px;
            font-weight: bold;
            color: #555555;
        }

        .input-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #cccccc;
            box-sizing: border-box; /* عشان العرض يظبط وميطلعش برة البوكس */
        }

        /* زر أسود كلاسيكي عادي جداً */
        .btn-login {
            background-color: #222222;
            color: #ffffff;
            padding: 10px;
            border: none;
            width: 100%;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-login:hover {
            background-color: #444444;
        }

        /* رابط التسجيل السفلي */
        .link-text {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: #666666;
        }

        .link-text a {
            color: #0066cc;
            text-decoration: none;
        }

        .link-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1 class="project-title">News Management System</h1>

    <div class="login-box">
        <h3>Sign In</h3>

        <?php if(isset($error)): ?>
            <div class="error-msg">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="input-control" required placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="input-control" required placeholder="Enter your password">
            </div>

            <button type="submit" name="login" class="btn-login">Login</button>
        </form>

        <div class="link-text">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>

</body>
</html>