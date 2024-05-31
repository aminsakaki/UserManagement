<?php 

spl_autoload_register(function ($class) {
    require __DIR__ . "/App/$class.php";
});

$a=(substr(parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH), -10));
$b = str_replace($a,'',$_SERVER['PHP_SELF']);
$c= str_replace($b,'',$_SERVER["REQUEST_URI"]);

$parts = explode("/", $c);
if ($parts[1] != "users") {
    http_response_code(404);
    exit;
}

$id = $parts[2] ?? null;

$model=new UserGateway();
$controller=new UserController($model);
$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);