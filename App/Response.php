<?php 

class Response
{
    public static function success($res=[],$message='عملیات با موفقیت انجام شد')
    {
        $data=[
            'status'=>200,
            'message'=>$message,
            'data'=>$res
        ];
    
        header("HTTP/1.0 200 ok");
        echo json_encode($data);
    }

    public static function error($message='مشکلی پیش آمده مجدد تلاش کنید')
    {
        $data=[
            'status'=>500,
            'message'=>$message
        ];
    
        header("HTTP/1.0 500 internal server error");
        echo json_encode($data);
    }

    public static function notFound($message = 'درخواست پیدا نشد')
    {
        $data=[
            'status'=>404,
            'message'=>$message
        ];
    
        header("HTTP/1.0 404 notfound");
        echo json_encode($data);
    }

    public static function notAllowed($requestMethod)
    {
        $data=[
            'status'=>405,
            'message'=>$requestMethod.' method not allowed'
        ];
    
        header("HTTP/1.0 405 method not allowed");
        echo json_encode($data);
    }

    public static function create($id,$message='دیتا با موفقیت ایجاد شد')
    {
        $data=[
            'status'=>201,
            'message'=>$message,
            'id'=>$id
        ];
    
        header("HTTP/1.0 201 created");
        echo json_encode($data);
    }

    public static function delete($message='حذف دیتا با موفقیت انجام شد')
    {
        $data=[
            'status'=>200,
            'message'=>$message
        ];
    
        header("HTTP/1.0 200 ok");
        echo json_encode($data);
    }

    public static function validate($message='دیتاها به درستی وارد نشده اند')
    {
        $data=[
            'status'=>422,
            'message'=>$message
        ];
    
        header("HTTP/1.0 422 unprocessable entity");
        echo json_encode($data);
        exit();
    }
}    