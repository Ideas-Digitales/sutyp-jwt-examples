<?php

class PrivateKey
{
    public $key;

    function __construct()
    {
        $this->key = file_get_contents('./keys/private.pem');
    }

    function getPrivateKey()
    {
        return $this->key;
    }
}
