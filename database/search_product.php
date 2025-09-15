<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
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


        $search_name = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_name'])) {
            $search_name = $conn->real_escape_string($_POST['search_name']);
            $sql = "SELECT id, name, buying_price, selling_price FROM products WHERE display = 'Yes' AND name LIKE '%$search_name%'";
        } else {
            $sql = "SELECT id, name, buying_price, selling_price FROM products WHERE display = 'Yes'";
        }
        $result = $conn->query($sql);
    ?>
    <h2>DISPLAY</h2>
    <h3>SEARCH BY NAME</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="text" name="search_name" value="<?php echo htmlspecialchars($search_name); ?>" placeholder="Enter product name">
        <input type="submit" value="Search By Name">
    </form>

    <?php if ($search_name): ?>
        <h3>Search Results for "<?php echo htmlspecialchars($search_name); ?>"</h3>
    <?php endif; ?>

    <table border="1" style="width: 50px; text-align: center;">
        <tr>
            <th>NAME</th>
            <th>PROFIT</th>
            <th>edit</th>
            <th>delete</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $profit = $row["selling_price"] - $row["buying_price"];
                echo "<tr>
                        <td>" . $row["name"] . "</td>
                        <td>" . $profit . "</td>
                        <td><a href='./edit_product.php?id=" . $row["id"] . "'>edit</a></td>
                        <td><a href='./delete.php?id=" . $row["id"] . "'>delete</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No products to display</td></tr>";
        }
        ?>
    </table>
    <br><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">View All Products</a>
</body>
</html>

<?php
$conn->close();
?>