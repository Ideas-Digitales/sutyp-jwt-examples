<?php

use Sutyp\Jwt\Client;
use Sutyp\Jwt\Server;

require_once __DIR__ . '/vendor/autoload.php';

header('Content-type: application/json');

$server = new Server;

$jwt = $server->getJWT();

$client = new Client($jwt);

if ($client)
{
    $decoded = $client->getDecoded();

    echo json_encode(array
    (
        'message' => 'Token is valid.',
        'jwt' => $decoded,
    ), JSON_PRETTY_PRINT);
}
else
{
    echo json_encode(array('message' => 'Token is invalid.'));
}
