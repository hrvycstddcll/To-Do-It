<?php

require_once __DIR__ . '/config.php';

$tasks = [];

try {
    $result = $conn->query(
        "SELECT id, task, status, created_at
         FROM task
         ORDER BY (status = 'complete') ASC, id DESC"
    );
    $tasks = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
} catch (mysqli_sql_exception $e) {
    $tasks = [];
}