<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// كود الحماية: لو الطالب مش مسجل دخول يرجعه لصفحة اللوچن
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        /* شريط علوي كلاسيكي وبسيط باللون الأسود الرمادي */
        .navbar {
            background-color: #222222;
            color: white;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h2 {
            margin: 0;
            font-size: 20px;
        }

        .nav-info span {
            font-size: 14px;
            margin-right: 15px;
        }

        .logout-btn {
            color: #ff9999;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .logout-btn:hover {
            text-decoration: underline;
        }

        /* حاوية المحتوى */
        .container {
            padding: 30px;
            max-width: 900px;
            margin: 0 auto;
        }

        .welcome-card {
            background-color: #ffffff;
            border: 1px solid #cccccc;
            padding: 20px;
            margin-bottom: 30px;
        }

        .welcome-card h3 {
            margin-top: 0;
            color: #333;
        }

        /* جدول الخيارات التعليمي المعتمد في الجامعات */
        .menu-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
        }

        .menu-table th, .menu-table td {
            border: 1px solid #cccccc;
            padding: 12px;
            text-align: left;
        }

        .menu-table th {
            background-color: #eaeaea;
            color: #333333;
            font-size: 15px;
        }

        .menu-table td strong {
            color: #333333;
        }

        .control-link {
            color: #0066cc;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }

        .control-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- الهيدر العلوي للنظام -->
    <div class="navbar">
        <h2>News System Dashboard</h2>
        <div class="nav-info">
            <span>Welcome, <strong><?php echo $_SESSION['user_name']; ?></strong></span>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="welcome-card">
            <h3>Control Panel Overview</h3>
            <p>Welcome to your final project management area. Use the kashida grid below to easily control and update categories and news articles.</p>
        </div>

        <!-- جدول الخيارات والروابط الكلاسيكي -->
        <table class="menu-table">
            <thead>
                <tr>
                    <th>System Modules</th>
                    <th>Available Management Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Categories Control</strong></td>
                    <td>
                        <a href="add_category.php" class="control-link">Add Category</a> | 
                        <a href="view_categories.php" class="control-link">View Categories</a>
                    </td>
                </tr>
                <tr>
                    <td><strong>News Articles Control</strong></td>
                    <td>
                        <a href="add_news.php" class="control-link">Add News</a> | 
                        <a href="view_news.php" class="control-link">View All News</a> | 
                        <a href="view_deleted_news.php" class="control-link">Trash (Deleted News)</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>