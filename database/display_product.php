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


        $sql = "SELECT id, name, buying_price, selling_price FROM products WHERE display = 'Yes'";
        $result = $conn->query($sql);
    ?>

    <h2>DISPLAY</h2>
    <table border="1" style="width:50px; text-align: center;"> 
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
</body>
</html>

<?php
$conn->close();
?>