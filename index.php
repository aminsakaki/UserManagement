<?php 

spl_autoload_register(function ($class) {
    require __DIR__ . "/App/$class.php";
});

$parts = explode("/", $_SERVER["REQUEST_URI"]);
if ($parts[2] != "users") {
    http_response_code(404);
    exit;
}

$id = $parts[3] ?? null;

$model=new UserGateway();
$controller=new UserController($model);