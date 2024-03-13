<?php

class Database
{
    private $connection;

    public function __construct($host, $user, $password, $database)
    {
        $this->connection = new mysqli($host, $user, $password, $database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);
        if ($result === TRUE) {
            return TRUE;
        }
        if ($result === FALSE) {
            throw new Exception("Error: " . $sql . "<br>" . $this->connection->error);
        }
        return $result;
    }

    public function close()
    {
        $this->connection->close();
    }

}