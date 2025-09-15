

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        label { margin: 10px 0; }
        input[type="text"], input[type="number"] { width: 200px; padding: 5px; }
        input[type="submit"] { margin-top: 10px; padding: 5px 10px; }
        .message { color: green; margin-top: 10px; }
        .error { color: red; }
    </style>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";  
        $password = "";      
        $dbname = "product_db";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }




        $message = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $buying_price = floatval($_POST['buying_price']);
            $selling_price = floatval($_POST['selling_price']);
            $display = isset($_POST['display']) ? 'Yes' : 'No';

            $sql = "INSERT INTO products (name, buying_price, selling_price, display) 
                    VALUES ('$name', '$buying_price', '$selling_price', '$display')";

            if (mysqli_query($conn, $sql)) {
                $message = "New record created successfully";
            } else {
                $message = "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_close($conn);
    ?>
    <h2>ADD PRODUCT</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>Name:</label> <br><input type="text" name="name"><br>
        <label>Buying Price:</label><br> <input type="number" name="buying_price" ><br>
        <label>Selling Price:</label> <br> <input type="number" name="selling_price" ><br>
        <input type="checkbox" name="display" value="Yes"><label>Display:</label> <br>
        <?php if ($message): ?>
            <div class="<?php echo strpos($message, 'Error') === 0 ? 'error' : 'message'; ?>"><?php echo $message; ?></div>
        <?php endif; ?>
        <input type="submit" value="SAVE">
    </form>
</body>
</html>