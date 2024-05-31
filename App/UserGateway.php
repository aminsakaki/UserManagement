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

    public function update($inputs,$user){

        $id=$user['id'];

        if($inputs['name']){
            $name=mysqli_real_escape_string($this->connection,$inputs['name']);
        }else{
            $name=$user['name'];
        }
        
        if($inputs['email']){
            $email=mysqli_real_escape_string($this->connection,$inputs['email']);
        }else{
            $email=$user['email'];
        }

        if($inputs['phone']){           
            $phone=mysqli_real_escape_string($this->connection,$inputs['phone']);
        }else{
            $phone=$user['phone'];
        }

        $query="UPDATE users SET name='$name' ,email ='$email',phone='$phone' WHERE id='$id'";
        $result=mysqli_query($this->connection,$query);

        $query2="SELECT * FROM users WHERE id = $id";
        $result2=mysqli_query($this->connection,$query2);
        if($result){
            $res=mysqli_fetch_assoc($result2);  
        }else{
            return Response::error();
        }
        return $res;
    }

    public function show(string $id)
    {

        $query="SELECT * FROM users WHERE id = $id";
        $result=mysqli_query($this->connection,$query);
        if($result){
            $res=mysqli_fetch_assoc($result);  
        }else{
            return Response::error();
        }
        return $res;
        
    }

}