<?php
include_once 'util/db_connection.php';

try {
    $conn = getDatabase();
    echo "Database connection successful with PDO!";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
