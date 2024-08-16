<?php

namespace core;

class Registry
{
    use TSingleton;

    protected static array $properties = [];

    public function setProperty($key, $value)
    {
        self::$properties[$key] = $value;
    }

    public function getProperty($key)
    {
        return self::$properties[$key] ?? null;
    }

    public function getProperties(): array
    {
        return self::$properties;
    }
}