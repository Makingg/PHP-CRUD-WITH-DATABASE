<?php
require 'db.php';
 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    
    if ($price < 0 || $qty < 0) {
        die("Error: Price and quantity must not be negative.");
    }
    
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
