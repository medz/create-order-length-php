<?php

namespace Medz\Component\CreateOrderLength;

class CreateOrderLength
{
    const DEFAULT_KEYS = [
        '1', '2', '3', '4', '5', '6', '7', '8', '9', '0',
        'q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p',
        'a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'z',
        'x', 'c', 'v', 'b', 'n', 'm',
    ];

    protected $keys = [];

    protected $length = 0;

    protected $callable;

    public function __construct($length = 1, callable $callable = null, array $keys = self::DEFAULT_KEYS)
    {
        $this->setLength($length);

        if ($callable !== null) {
            $this->setCallable($callable);
        }

        $this->setKeys($keys);
    }

    public function setLength($length)
    {
        $length = intval($length);
        if ($length < 1) {
            throw new \Exception('set create length < 1.');
        }

        $this->length = $length;
    }

    public function setCallable(callable $callable)
    {
        $this->callable = $callable;
    }

    public function setKeys(array $keys)
    {
        $THIS->keys = $keys;
    }
}
