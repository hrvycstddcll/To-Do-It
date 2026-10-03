<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "to_do_itdb";

// Connect without selecting a database so it can be created if missing.
$conn = new mysqli($hostname, $username, $password);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Database name goes inside backticks, so allow only identifier-safe characters.
if (!preg_match('/^[A-Za-z0-9_]+$/', $database)) {
    die("Invalid database name.");
}

$createDb = "CREATE DATABASE IF NOT EXISTS `$database`";
if ($conn->query($createDb) === false) {
    die("Could not create database `$database`: " . $conn->error);
}

if (!$conn->select_db($database)) {
    die("Could not select database `$database`: " . $conn->error);
}

// IF NOT EXISTS leaves an existing table untouched.
$createTable = "CREATE TABLE IF NOT EXISTS `task` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `task` VARCHAR(255) NOT NULL,
    `status` TEXT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

if ($conn->query($createTable) === false) {
    die("Could not create table `task`: " . $conn->error);
}

// Absolute base URL for this app, e.g. "/simple_crud".
// Handlers live in components/, so a relative "index.php" would resolve to
// /simple_crud/components/index.php and 404.
$appRoot = str_replace('\\', '/', dirname(__DIR__));
$docRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'] ?? ''));
$basePath = ($docRoot && str_starts_with($appRoot, $docRoot))
    ? rtrim(substr($appRoot, strlen($docRoot)), '/')
    : rtrim(dirname($_SERVER['SCRIPT_NAME'] ?? ''), '/');
define('BASE_URL', $basePath === '' ? '' : $basePath);
?>