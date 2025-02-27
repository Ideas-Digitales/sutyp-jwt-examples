<?php

namespace Sutyp\Jwt;

class PrivateKey
{
    public $key;

    function __construct()
    {
        $this->key = file_get_contents(__DIR__ . '/../keys/private.pem');
    }

    function getPrivateKey()
    {
        return $this->key;
    }
}
