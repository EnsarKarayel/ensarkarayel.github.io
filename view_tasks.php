<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit();
}

include 'includes/db_connection.php';

// Veritabanından verileri çekme
$sql = "SELECT * FROM tasks";  // Burada 'tasks' tablosu olduğunu varsayıyoruz
$stmt = $conn->query($sql);
$tasks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Görevler</title>
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

    <?php include 'includes/footer.php'; ?> <!-- Footer ekledik -->
</body>
</html>
