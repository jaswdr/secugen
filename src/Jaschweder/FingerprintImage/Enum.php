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

    public function offsetExists ($offset)
    {
        return array_key_exists($offset, $this->toArray());
    }

    public function offsetGet ($offset)
    {
        return $this->toArray()[$offset];
    }

    public function offsetSet ($offset ,$value)
    {
        throw new Exception("Enum values need to be set has constants");
    }

    public function offsetUnset ($offset)
    {
        throw new Exception("Enum values are constants and can't be unset");
    }

}
