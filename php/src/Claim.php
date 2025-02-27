<?php

namespace Sutyp\Jwt;

class Claim
{
    public $iss = 'sutyp-concesionarias-api';
    public $aud = 'sutyp-internal-backend';
    public $sub = 'sutyp-system-user';

    function getIssuer()
    {
        return $this->iss;
    }

    function getAudience()
    {
        return $this->aud;
    }

    function getSubject()
    {
        return $this->sub;
    }
}
