<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
    $status = $_POST['status'] ?? '';

    if ($id && in_array($status, ['incomplete', 'complete'], true)) {
        try {
            $stmt = $conn->prepare("UPDATE task SET status = ? WHERE id = ?");
            $stmt->bind_param("si", $status, $id);
            $stmt->execute();
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            die("Could not update the mission status.");
        }
    }
}

header("Location: " . BASE_URL . "/index.php");
exit;
?>