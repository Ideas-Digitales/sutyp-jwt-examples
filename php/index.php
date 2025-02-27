<?php

header('Content-type: application/json');

require('src/Server.php');
require('src/Client.php');

$server = new Server;

$jwt = $server->getJWT();

$client = new Client($jwt);

if ($client)
{
    $decoded = $client->getDecoded();

    echo json_encode(array
    (
        'token_verified' => array
        (
            'iss' => $decoded['iss'],
            'aud' => $decoded['aud'],
            'sub' => $decoded['sub'],
            'exp' => $decoded['exp'],
            'iat' => $decoded['iat']
        ),
        'message' => 'Token is valid.'
    ));
}
else
{
    echo json_encode(array('message' => 'Token is invalid.'));
}
