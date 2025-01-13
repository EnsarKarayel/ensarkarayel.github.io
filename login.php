<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/db_connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Basit bir kullanıcı doğrulama (Bu kısmı geliştirebilirsiniz)
    if ($username == "admin" && $password == "password") {
        $_SESSION['loggedin'] = true;
        header("Location: index.php");
        exit();
    } else {
        $error = "Hatalı kullanıcı adı veya şifre!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login-form">
        <h2>Giriş Yap</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required><br>
            <input type="password" name="password" placeholder="Şifre" required><br>
            <input type="submit" value="Giriş Yap">
        </form>
        <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    </div>
</body>
</html>
