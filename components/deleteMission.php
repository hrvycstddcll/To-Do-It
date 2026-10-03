<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);

    if ($id) {
        try {
            $stmt = $conn->prepare("DELETE FROM task WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            die("Could not delete the mission.");
        }
    }
}

header("Location: " . BASE_URL . "/index.php");
exit;
?>