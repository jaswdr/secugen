<?php

namespace Jaschweder\FingerprintImage;

use Exception;
use ArrayAccess;

class Enum implements ArrayAccess
{
    public function isValid($value)
    {
        return in_array($value, $this->toArray());
    }

    public function toArray()
    {
        return (new ReflectionClass(__CLASS))->getConstants();
    }

    public bool offsetExists ($offset)
    {
        return array_key_exists($offset, $this->toArray());
    }

    publicoffsetGet ($offset)
    {
        return $this->toArray()[$offset];
    }

    public void offsetSet ($offset ,$value)
    {
        throw new Exception("Enum values need to be set has constants");
    }

    public void offsetUnset ($offset)
    {
        throw new Exception("Enum values are constants and can't be unset");
    }

}
