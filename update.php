<?php
require 'db.php';


$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM transactions WHERE id = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item = $_POST['item'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
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
        <form method="post">
            <label for="item">Item:</label>
            <input type="text" id="item" name="item" value="<?= $data['item'] ?>"><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?= $data['price'] ?>"><br>
            <label for="qty">Qty:</label>
            <input type="number" id="qty" name="qty" value="<?= $data['qty'] ?>"><br>
            <button type="submit">Update</button>
        </form>
        <a href="read.php">Back to Transactions</a>
    </div>
</body>
</html>