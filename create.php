<?php
require 'db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    
    if ($price < 0 || $qty < 0) {
        $error = "Error: Price and quantity must not be negative.";
    } else {
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
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Transaction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Add New Transaction</h2>
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <label for="item">Item:</label>
            <input type="text" id="item" name="item" required><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" min="0" step="0.01" required><br>
            <label for="qty">Qty:</label>
            <input type="number" id="qty" name="qty" min="0" required><br>
            <button type="submit">Add</button>
        </form>
        <a href="read.php">Back to Transactions</a>
    </div>
</body>
</html>
