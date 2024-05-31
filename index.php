<?php 

$parts = explode("/", $_SERVER["REQUEST_URI"]);
if ($parts[2] != "users") {
    http_response_code(404);
    exit;
}

$id = $parts[3] ?? null;