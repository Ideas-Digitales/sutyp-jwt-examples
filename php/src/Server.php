<?php

namespace Sutyp\Jwt;

use Firebase\JWT\JWT;
class Server
{
    public $dateTime;

    public $milliseconds;

    public $privateKey;
    public $payload = [];

    public $jwt;

    private $claim;

    function __construct()
    {
        $this->claim = new Claim();
    }

    function getJWT()
    {
        $dateTime = new \DateTime();
        $milliseconds = $dateTime->format('U') * 1000 + $dateTime->format('v');
        $exp = floor($milliseconds / 1000) + 3600;
        $this->privateKey = (new PrivateKey)->getPrivateKey();

        $this->payload =
        [
            'iss' => $this->claim->getIssuer(),
            'aud' => $this->claim->getAudience(),
            'sub' => $this->claim->getSubject(),
            'exp' => $exp,
            'iat' => floor($milliseconds / 1000)
        ];

        $this->jwt = JWT::encode($this->payload, $this->privateKey, 'RS256');
        return $this->jwt;
    }
}
