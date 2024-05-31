<?php 
class UserController{

    public function __construct(private UserGateway $user)
    {

    }

    public function processRequest(string $method, ?string $id)
    {
        if($id){
            switch($method){
                case "PUT":
                    $this->update($id);
                    break;
                case "DELETE":
                    $this->delete($id);
                    break; 
                default:
                    Response::notAllowed($method);     
            }
        }  
        
        else{
            switch($method){
                case "GET":
                    $this->index();
                    break;
                case "POST":
                    $this->store();
                    break;
                default:
                    Response::notAllowed($method);     
            }
        }
    }

    public function index()
    {

    }

    public function store()
    {

    }

    public function update($id)
    {

    }

    public function delete($id)
    {

    }


}    