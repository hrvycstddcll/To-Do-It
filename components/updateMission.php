<?php
require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
    $mission = trim($_POST['mission'] ?? '');
    $status = $_POST['status'] ?? '';

    if ($id && $mission !== '' && in_array($status, ['incomplete', 'complete'], true)) {
        try {
            $stmt = $conn->prepare("UPDATE task SET task = ?, status = ? WHERE id = ?");
            $stmt->bind_param("ssi", $mission, $status, $id);
            $stmt->execute();
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            die("Could not update the mission.");
        }
    }
}

header("Location: index.php");
exit;
?>