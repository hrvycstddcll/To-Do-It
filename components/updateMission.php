<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
    $mission = trim($_POST['mission'] ?? '');

    if ($id && $mission !== '') {
        try {
            $stmt = $conn->prepare("UPDATE task SET task = ? WHERE id = ?");
            $stmt->bind_param("si", $mission, $id);
            $stmt->execute();
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            die("Could not update the mission.");
        }
    }
}

header("Location: " . BASE_URL . "/index.php");
exit;
?>