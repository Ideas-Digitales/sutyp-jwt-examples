<?php

use Sutyp\Jwt\Client;
use Sutyp\Jwt\Server;

require_once __DIR__ . '/vendor/autoload.php';

header('Content-type: application/json');

// JWT Generado por SUTyP
$server = new Server;
$jwt = $server->getJWT();

// Solicitud HTTP desde SUTyP con el JWT generado

// JWT Validado por la concesionaria
$client = new Client();

if ($client)
{
    echo json_encode(array
    (
        'message' => 'Token is valid.',
        'jwt' => $client->validateJWT($jwt)->getDecoded(),
    ), JSON_PRETTY_PRINT);
}
else
{
    echo json_encode(array('message' => 'Token is invalid.'));
}
