<?php
try {
    $dsn = "mysql:host=127.0.0.1;port=3306";
    $pdo = new PDO($dsn, "root", "");
    echo "CONNECTED_AS_ROOT\n";
    $stmt = $pdo->query("SHOW DATABASES LIKE 'lifecirc_database-01'");
    if ($stmt->fetch()) {
        echo "DB_EXISTS\n";
    } else {
        echo "DB_MISSING\n";
    }
} catch (Exception $e) {
    echo "ROOT_FAILED: " . $e->getMessage() . "\n";
    try {
        $pdo = new PDO($dsn, "Siradmin", "Sir@@@123@@");
        echo "CONNECTED_AS_SIRADMIN\n";
    } catch (Exception $e2) {
        echo "SIRADMIN_FAILED: " . $e2->getMessage() . "\n";
    }
}
