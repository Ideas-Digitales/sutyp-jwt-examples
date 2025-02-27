<?php

require('./vendor/autoload.php');

use Firebase\JWT\JWT;

require('Claim.php');
require('PrivateKey.php');

class Server
{
    public $dateTime;

    public $milliseconds;

    public $privateKey;
    public $payload = [];

    public $jwt;

    function __construct()
    {
        $claim = new Claim;

        $iss = $claim->getIssuer();
        $aud = $claim->getAudience();
        $sub = $claim->getSubject();

        $dateTime = new DateTime();

        $milliseconds = $dateTime->format('U') * 1000 + $dateTime->format('v');

        $exp = floor($milliseconds / 1000) + 3600;

        $this->privateKey = (new PrivateKey)->getPrivateKey();

        $this->payload =
        [
            'iss' => $iss,
            'aud' => $aud,
            'sub' => $sub,
            'exp' => $exp,
            'iat' => floor($milliseconds / 1000)
        ];

        $this->jwt = JWT::encode($this->payload, $this->privateKey, 'RS256');
    }

    function getJWT()
    {
        return $this->jwt;
    }
}
