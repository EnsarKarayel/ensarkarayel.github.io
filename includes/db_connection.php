<?php
$host = 'tasks-service-tasks.e.aivencloud.com';
$port = '10733';
$dbname = 'tasksdb';
$user = 'avnadmin';
$password = 'AVNS_JtfhSLQbopTHYXC8KH-';

$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conn = pg_connect($conn_string);


if (!$conn) {
    echo "Error: Unable to connect to PostgreSQL.";
} else {
    echo "Connection successful!";
}

// Don't forget to close the connection when done
pg_close($conn);

// try {
//     $conn = new PDO($dsn, $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo 'Connection failed: ' . $e->getMessage();
// }
// ?>
