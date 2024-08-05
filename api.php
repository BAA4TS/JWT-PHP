<?php
require(dirname(__FILE__) . "/vendor/autoload.php");

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$clave = '12345678';

// Establecer el tipo de contenido como JSON
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://localhost/"); // Ajusta el origen permitido
header("Access-Control-Allow-Credentials: true"); // Permite el envío de cookies

switch ($_SERVER['REQUEST_METHOD']) {
    case "POST":
        $data_post = json_decode(file_get_contents("php://input"), true);

        if (!isset($data_post['username']) || !isset($data_post['password'])) {
            echo json_encode(["error" => "fallo 1"]);
            break;
        }

        if (empty($data_post['username']) || empty($data_post['password'])) {
            echo json_encode(["error" => "fallo 2"]);
            break;
        }

        if ($data_post['username'] != "carlos" || $data_post['password'] != "1234") {
            echo json_encode(["error" => "fallo 3"]);
            break;
        }

        if (isset($_COOKIE['JWT'])) {
            $JsonWebToken = $_COOKIE['JWT'];
            $decodedToken = JWT::decode($JsonWebToken, new Key($clave, "HS256"));
            echo json_encode($decodedToken);
            break;
        }

        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => time(),
            'nbf' => time(),
            "Nombre" => "Carlos"
        ];

        $JsonWebToken = JWT::encode($payload, $clave, "HS256");
        setcookie("JWT", $JsonWebToken, time() + (86400 * 30), "/", "", false, true);
        echo json_encode(["response" => true]);

        break;
}