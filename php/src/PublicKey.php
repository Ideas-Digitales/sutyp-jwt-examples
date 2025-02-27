<?php

namespace Sutyp\Jwt;

class PublicKey
{
    public $key;

    function __construct()
    {
        $this->key = file_get_contents(__DIR__ .'/../keys/public.pem');
    }

    function getPublicKey()
    {
        return $this->key;
    }
}
