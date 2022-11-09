<?php

declare(strict_types=1);

use Application\Entities\Database;

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
    <head>
        <title>First Page</title>
    </head>
    <body>
        <table>
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
            <?php }   ?>
            </tbody>
        </table>
    </body>
</html>



<?php $database->closeConnection(); ?>
