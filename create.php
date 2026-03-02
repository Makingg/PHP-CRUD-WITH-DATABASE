<?php
require 'db.php';
 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $total = $price * $qty;
 
 
    $sql = "INSERT INTO transactions (item, price, qty, total)
            VALUES (:item, :price, :qty, :total)";
 
 
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':item' => $item,
        ':price' => $price,
        ':qty' => $qty,
        ':total' => $total
    ]);
 
 
    header("Location: read.php");
}
?>