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
        <h2>Add Transaction</h2>
        
        <form method="post" action="create.php">
            <label for="item">Item:</label>
            <input type="text" id="item" name="item" required>
            
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
            
            <label for="qty">Quantity:</label>
            <input type="number" id="qty" name="qty" required>
            
            <button type="submit">Save</button>
        </form>
        
        <a href="read.php">View Transactions</a>
    </div>
</body>
</html>