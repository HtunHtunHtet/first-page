<?php

declare(strict_types=1);

use Application\Database;

require_once realpath('vendor/autoload.php');

$database = new Database();
$database->connect();
$mysqli =  $database->getMySqli();

$stmt = $mysqli->prepare("SELECT p.id, p.name, p.description, p.price, q.quantity FROM `product` p INNER JOIN `product_quantity` q ON p.id = q.product_id");
$stmt->execute();
$stmt->bind_result( $id, $name, $description, $price, $quality);

?>
<!DOCTYPE html>
<html lang="en">
    <?php require ('src/includes/header.inc.php') ?>
    <body>
        <?php require ('src/includes/navbar.inc.php')?>
        <div class="container">
            <div class="col-md-6 offset-md-3">
                <div class="card mt-2">
                    <div class="card-header text-end">
                        <a href="add_product.php" class="btn btn-outline-primary ">Add product</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive mt-2">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price Per Item (SGD)</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while($stmt->fetch()) { ?>
                                    <tr>
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $description ?></td>
                                        <td><?php echo ($price/100) ?></td>
                                        <td><?php echo $quality?></td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<?php $database->closeConnection(); ?>
