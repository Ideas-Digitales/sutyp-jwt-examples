<?php

class PublicKey
{
    public $key;

    function __construct()
    {
        $this->key = file_get_contents('./keys/public.pem');
    }

    function getPublicKey()
    {
        return $this->key;
    }
}
