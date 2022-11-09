<?php

declare(strict_types=1);

namespace Application\Entities;

use mysqli;

class Database
{
    private string $server;

    private string $user;

    private string $pass ;

    private int $port ;

    private string $dbName;

    private mysqli $mysqli;

    public function __construct(string $server, string $user, string $pass, int $port, string $dbName)
    {
        $this->server = $server;
        $this->user = $user;
        $this->pass = $pass;
        $this->port = $port;
        $this->dbName = $dbName;
    }


    public function connect () : void
    {
        $this->mysqli = new mysqli(
            $this->server,
            $this->user,
            $this->pass,
            $this->dbName,
            $this->port
        );

        if (null !== $this->mysqli->connect_error) {
            echo 'Errno: '.$this->mysqli->connect_errno;
            echo '<br>';
            echo 'Error: '.$this->mysqli->connect_error;
            exit();
        }

        echo "success";
    }

    public function closeConnection(): void
    {
        $this->mysqli->close();
        echo 'connection closed';
    }

}
