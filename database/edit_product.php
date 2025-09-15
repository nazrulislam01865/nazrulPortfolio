

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <?php

        $servername = "localhost";
        $username = "root";  
        $password = "";      
        $dbname = "product_db";  


        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $message = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $name = $conn->real_escape_string($_POST['name']);
            $buying_price = floatval($_POST['buying_price']);
            $selling_price = floatval($_POST['selling_price']);
            $display = isset($_POST['display']) ? 'Yes' : 'No';

            $sql = "UPDATE products SET name='$name', buying_price='$buying_price', selling_price='$selling_price', display='$display' WHERE id=$id";

            if ($conn->query($sql) === TRUE) {
                $message = "Record updated successfully";
            } else {
                $message = "Error updating record: " . $conn->error;
            }
        }


        $product = null;
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT * FROM products WHERE id = $id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $product = $result->fetch_assoc();
            } else {
                die("Product not found");
            }
        } 
    ?>
    <h2>EDIT PRODUCT</h2>
    <?php if ($message) echo $message; ?>
    <?php if ($product): ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>"><br>
            Name: <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br>
            Buying Price: <input type="number" name="buying_price"  value="<?php echo $product['buying_price']; ?>" required><br>
            Selling Price: <input type="number" name="selling_price"  value="<?php echo $product['selling_price']; ?>" required><br>
            Display: <input type="checkbox" name="display" value="Yes" <?php echo ($product['display'] == 'Yes') ? 'checked' : ''; ?>><br>
            <input type="submit" value="SAVE">
        </form>
        <br><a href="./display_product.php">Back to Display</a>
    <?php else: ?>
        <p>No product selected for editing or product not found.</p>
        <br><a href="./display_product.php">Back to Display</a>
    <?php endif; ?>
</body>
</html>

<?php
$conn->close();
?>