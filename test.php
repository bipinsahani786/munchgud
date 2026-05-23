<?php
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3307;dbname=munchgud", 'root', 'root_password');
    $stmt = $pdo->query("SELECT id, name, slug FROM products");
    print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
