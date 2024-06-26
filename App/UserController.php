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
        header('Access-Control-Allow-Origin:*');
        header('Content-Type:application/json;charset=utf-8');
        header('Access-Control-Allow-Method:GET');
        header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,x-Request-With');

        $query_run=$this->user->get();
        if($query_run){
            if(mysqli_num_rows($query_run) > 0){
                $res=mysqli_fetch_all($query_run,MYSQLI_ASSOC);
                return Response::success($res,'users list fetch successfully');
            }else{
                return Response::notFound('no users found');
            }
        }else{
            return Response::error('internal server error');
        }
    }

    public function store()
    {
        error_reporting(0);
        header('Access-Control-Allow-Origin:*');
        header('Content-Type:application/json;charset=utf-8');
        header('Access-Control-Allow-Method:POST');
        header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,x-Request-With');

        $inputData=json_decode(file_get_contents("php://input"),true);
            if(empty($inputData)){
                $storeUserId=$this->user->insert($_POST);
            }else{
                $storeUserId=$this->user->insert($inputData);
            }

            if($storeUserId){
                return Response::create($storeUserId,'user create successfully');
            }else{
                return Response::error('internal server error');
            }
    }

    public function update($id)
    {
        error_reporting(0);
        header('Access-Control-Allow-Origin:*');
        header('Content-Type:application/json;charset=utf-8');
        header('Access-Control-Allow-Method:PUT');
        header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,x-Request-With');

        $user=$this->user->show($id);
        if(!$user){
            return Response::notFound('user not found');
        }

        $inputData=json_decode(file_get_contents("php://input"),true);
        if(empty($inputData)){
            $updateUser=$this->user->update($_POST,$user);
        }else{
            $updateUser=$this->user->update($inputData,$user);   
        }

        if($updateUser){
            return Response::success($updateUser,'user update successfully');
        }else{
            return Response::error('internal server error');
        }
    }

    public function delete($id)
    {
        header('Access-Control-Allow-Origin:*');
        header('Content-Type:application/json;charset=utf-8');
        header('Access-Control-Allow-Method:DELETE');
        header('Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,x-Request-With');

        $user=$this->user->show($id);
        if(!$user){
            return Response::notFound('user not found');
        }

        $deleteUser=$this->user->delete($id);
        if($deleteUser){
            return Response::delete();
        }else{
            return Response::notFound();
        }
    }


}    