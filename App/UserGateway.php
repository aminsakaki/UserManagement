<?php 
class UserGateway{
    public $connection;

    public function __construct() 
    {
        $this->connection = mysqli_connect('localhost', 'root', '', 'mvc'); 

        if ($this->connection->connect_error) {                                
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
}