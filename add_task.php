<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company = $_POST['company'];
    $module = $_POST['module'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (company, module, subject, description, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$company, $module, $subject, $description, $status]);

    header("Location: view_tasks.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Görev Ekle</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="task-form">
        <h2>Yeni Görev Ekle</h2>
        <form method="POST">
            <input type="text" name="company" placeholder="Şirket Adı" required><br>
            <input type="text" name="module" placeholder="Modül" required><br>
            <input type="text" name="subject" placeholder="Konu" required><br>
            <textarea name="description" placeholder="Açıklama" required></textarea><br>
            <select name="status">
                <option value="Açık">Açık</option>
                <option value="Kapalı">Kapalı</option>
            </select><br>
            <input type="submit" value="Görev Ekle">
        </form>
    </div>
</body>
</html>
