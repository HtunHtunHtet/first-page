<?php

declare(strict_types=1);

use Application\Entities\Database;

require_once realpath('vendor/autoload.php');

$database = new Database('127.0.0.1', 'root', 'root', 8889,'search_rest');
$database->connect();;

$database->closeConnection();

?>
