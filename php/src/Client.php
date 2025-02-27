<?php

namespace Sutyp\Jwt;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Client
{
    public $publicKey;

    public $decoded;

    function __construct()
    {
        $this->publicKey = (new PublicKey)->getPublicKey();
    }

    /**
     * @param string $jwt
     * 
     * @throws InvalidArgumentException
     * @throws DomainException
     * @throws UnexpectedValueException
     * @throws SignatureInvalidException
     * @throws BeforeValidException
     * @throws BeforeValidException
     * @throws ExpiredException
     * 
     * @return self 
     */
    function validateJWT($jwt): self
    {
        $decoded = JWT::decode($jwt, new Key($this->publicKey, 'RS256'));
        $decodedArray = (array) $decoded;
        $this->decoded = $decodedArray;
        return $this;
    }

    function getDecoded()
    {
        return $this->decoded;
    }
}
