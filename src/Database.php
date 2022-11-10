<?php

declare(strict_types=1);

namespace Application;

use mysqli;
use mysqli_sql_exception;

class Database
{
    final protected const LIVE_PW = 'htunhtet911130';
    final protected const LOCAL_PW = 'root';
    final protected const LIVE_PORT = 3306;
    final protected const LOCAL_PORT = 8889;
    final protected const IS_LIVE  = true;

    private string $server = '127.0.0.1';

    private string $user = 'root';

    private string $pass = (self::IS_LIVE) ? self::LIVE_PW : self::LOCAL_PW ;

    private int $port =  (self::IS_LIVE) ? self::LIVE_PORT : self::LOCAL_PORT;

    private string $dbName = 'first_page';

    private mysqli $mysqli;

    public function connect () : void
    {
        $this->mysqli = new mysqli(
            $this->server,
            $this->user,
            $this->pass,
            $this->dbName,
            $this->port
        );

        //if there is error, $connect_error should not be null,
        //try to change your pass or port
        if (null !== $this->mysqli->connect_error) {
            throw new mysqli_sql_exception('Errno: ', $this->mysqli->connect_errno);
            exit();
        }

        //if above stage is over, then we can consider the mysqli is connect successfully
    }

    public function closeConnection(): void
    {
        // closing mysqli connection is optional,
        // but it will increase performance for future developments
        $this->mysqli->close();
    }

    public function getMySqli(): mysqli
    {
        return $this->mysqli;
    }

}
