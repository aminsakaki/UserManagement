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

    public function insert($userInput) 
    {

    $name=mysqli_real_escape_string($this->connection,$userInput['name']);
    $email=mysqli_real_escape_string($this->connection,$userInput['email']);
    $phone=mysqli_real_escape_string($this->connection,$userInput['phone']);

        if(empty(trim($name))){

            return Response::validate('enter your name');
        }elseif(empty(trim($email))){
            return Response::validate('enter your email');
        }elseif(empty(trim($phone))){
            return Response::validate('enter your phone');
        }
        else
        {
            $query="INSERT INTO users (name,email,phone) VALUES ('$name','$email','$phone')";
            $result=mysqli_query($this->connection,$query);
            if($result){           
                return mysqli_insert_id($this->connection);  
            }
            else{
                return false;
            }
        }
    }

    public function get($where = "") 
    {

        $query = "SELECT * FROM users";

        if (strlen($where)) {                 
            $query .= " WHERE " . $where;       
        }

        $results = $this->connection->query($query);
        return $results;
    }
    
}