<?php
require 'db.php';

$error = '';

$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM transactions WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    
    if ($price < 0 || $qty < 0) {
        $error = "Error: Price and quantity must not be negative.";
    } else {
        $total = $price * $qty;


        $sql = "UPDATE transactions 
                SET item=:item, price=:price, qty=:qty, total=:total
                WHERE id=:id";


        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':item' => $item,
            ':price' => $price,
            ':qty' => $qty,
            ':total' => $total,
            ':id' => $id
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
    <title>Edit Transaction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Transaction</h2>
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <label for="item">Item:</label>
            <input type="text" id="item" name="item" value="<?= $data['item'] ?>"><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" min="0" step="0.01" value="<?= $data['price'] ?>"><br>
            <label for="qty">Qty:</label>
            <input type="number" id="qty" name="qty" min="0" value="<?= $data['qty'] ?>"><br>
            <button type="submit">Update</button>
        </form>
        <a href="read.php">Back to Transactions</a>
    </div>
</body>
</html>
