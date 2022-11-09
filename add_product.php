<?php

declare(strict_types=1);

use Application\Entities\Database;

require_once realpath('vendor/autoload.php');

$database = new Database();
$database->connect();
$mysqli =  $database->getMySqli();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = (string)$_POST['name'];
    $quantity = (int)$_POST['quantity'];
    $price  = (int)($_POST['price'] * 100);
    $description = (string)$_POST['description'];

    //add product
    $stmt = $mysqli ->prepare("INSERT INTO product (name, price, description ) values (?, ?, ?)");
    $stmt->bind_param( 'sis', $name,  $price, $description);
    $stmt->execute();

    //update product quantity
    $stmt = $mysqli ->prepare("INSERT INTO product_quantity(product_id, quantity) VALUE (LAST_INSERT_ID(), ?)");
    $stmt->bind_param( 'i', $quantity);
    $stmt->execute();

    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>First Page - Add product</title>
    </head>
    <body>
        <form method="post" name="productForm" >
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" placeholder="Product Name" required>
            <br/>

            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" step="1" required>
            <br/>

            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.1" required>
            <br/>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required ></textarea>
            <br/>

            <input type="submit" value="Submit" name="submit">
        </form>
    </body>
</html>

<?php $database->closeConnection(); ?>
