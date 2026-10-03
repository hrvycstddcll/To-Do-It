<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mission = trim($_POST['mission'] ?? '');
    $status = 'incomplete';

    if ($mission !== '') {
        try {
            $stmt = $conn->prepare("INSERT INTO task (task, status) VALUES (?, ?)");
            $stmt->bind_param("ss", $mission, $status);
            $stmt->execute();
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            die("Could not save the mission.");
        }
    }
}

header("Location: index.php");
exit;
?>