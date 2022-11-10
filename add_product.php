<?php

declare(strict_types=1);

use Application\Database;

require_once realpath('vendor/autoload.php');

$database = new Database();
$database->connect();
$mysqli =  $database->getMySqli();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = (empty($_POST['name'])) ? null : (string)$_POST['name'];
    $quantity = (empty($_POST['quantity'])) ? null : (int)$_POST['quantity'];
    $price  = (empty($_POST['price'])) ? null : (int)($_POST['price'] * 100);
    $description = (empty($_POST['description']))? null : (string)$_POST['description'];

    if (null === $name || null === $quantity || null === $price || null === $description ) {
        echo 'Unable to submit form , all fields are required';
        die;
    }

    //add product
    $stmt = $mysqli ->prepare("INSERT INTO product (name, price, description ) values (?, ?, ?)");
    $stmt->bind_param( 'sis', $name,  $price, $description);
    $stmt->execute();

    //update product quantity
    $stmt = $mysqli ->prepare("INSERT INTO product_quantity(product_id, quantity) VALUE (LAST_INSERT_ID(), ?)");
    $stmt->bind_param( 'i', $quantity);
    $stmt->execute();
    $stmt->close();

    //redirect
    header("Location: product.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once ('src/includes/header.inc.php')?>
    </head>
    <body>
    <?php require_once ('src/includes/navbar.inc.php')?>
        <div class="container">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-2">
                    <div class="card-header">
                        Add Product
                    </div>
                    <div class="card-body">
                        <form method="post" name="productForm" >
                            <div class="mb-3">
                                <label for="name" class="form-label">Product Name</label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Enter Product Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input class="form-control" type="number" id="quantity" name="quantity" step="1" placeholder="Enter Quantity" required>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input class="form-control" type="number" id="price" name="price" step="0.1" placeholder="Enter Price" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter Description" required ></textarea>
                            </div>
                            <input class="btn btn-primary" type="submit" value="Submit" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php $database->closeConnection(); ?>
