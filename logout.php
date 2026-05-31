<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// تفريغ وتدمير الجلسة تماماً
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// التوجيه المزدوج لضمان الطرد الفوري لصفحة اللوجن
echo '<script type="text/javascript">window.location.href="login.php";</script>';
header("Location: login.php");
exit();