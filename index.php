<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db_connection.php';

// Yeni görev ekleme işlemi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company = $_POST['company'];
    $module = $_POST['module'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (company, module, subject, description, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$company, $module, $subject, $description, $status]);

    // Görev ekleme işleminden sonra ana sayfaya yönlendir
    header("Location: index.php");
    exit();
}

// Görevleri çekme
$sql = "SELECT * FROM tasks";  // Burada 'tasks' tablosu olduğunu varsayıyoruz
$stmt = $conn->query($sql);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görev Yönetim Sistemi</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?> <!-- Header ekledik -->

    <div class="task-list">
        <h2>Görev Listesi</h2>
        <table>
            <thead>
                <tr>
                    <th>Şirket Adı</th>
                    <th>Modül</th>
                    <th>Konu</th>
                    <th>Açıklama</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['company']) ?></td>
                        <td><?= htmlspecialchars($task['module']) ?></td>
                        <td><?= htmlspecialchars($task['subject']) ?></td>
                        <td><?= htmlspecialchars($task['description']) ?></td>
                        <td><?= htmlspecialchars($task['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

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

    <?php include 'includes/footer.php'; ?> <!-- Footer ekledik -->
</body>
</html>
