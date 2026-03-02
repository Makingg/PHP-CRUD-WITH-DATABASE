<?php
require 'db.php';
$stmt = $pdo->query("SELECT * FROM transactions ORDER BY id DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Transaction List</h2>
        <a href="main.php" class="button-primary">Add New</a>
        
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['item'] ?></td>
                        <td>$<?= number_format($row['price'], 2) ?></td>
                        <td><?= $row['qty'] ?></td>
                        <td>$<?= number_format($row['total'], 2) ?></td>
                        <td>
                            <a href="update.php?id=<?= $row['id'] ?>">Edit</a> |
                            <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>