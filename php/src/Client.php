<?php

namespace Sutyp\Jwt;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Client
{
    public $publicKey;

    public $decoded;

    function __construct($jwt)
    {
        $this->publicKey = (new PublicKey)->getPublicKey();

        try
        {
            $decoded = JWT::decode($jwt, new Key($this->publicKey, 'RS256'));

            $decodedArray = (array) $decoded;

            $this->decoded = $decodedArray;

            return true;
        }
        catch (\Exception $e)
        {
            echo('Invalid token: ' . $e);

            return false;
        }
    }

    function getDecoded()
    {
        return $this->decoded;
    }
}
