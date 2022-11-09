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

    //redirect
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>First Page - Add product</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <link rel="stylesheet" href="./vendor/twitter/bootstrap/dist/css/bootstrap.min.css">
    </head>
    <body>
    <div class="container">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header mt-2">
                    Add Product
                </div>
                <div class="card-body">
                    <form method="post" name="productForm" >
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name</label>
                            <input class="form-control" type="text" id="name" name="name" placeholder="Product Name" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input class="form-control" type="number" id="quantity" name="quantity" step="1" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input class="form-control" type="number" id="price" name="price" step="0.1" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required ></textarea>
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
