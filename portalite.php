<?php

function pl_get(array $array, string $key, mixed $default = null): mixed 
{
    $keys = explode('.', $key);
    $value = $array;
    
    foreach ($keys as $key) {
        if (is_array($value) && array_key_exists($key, $value)) {
            $value = $value[$key];
        } else {
            return $default;
        }
    }

    return $value;
}

function pl_config(string $key, mixed $default = null): mixed
{
    $config = require 'config.php';

    return pl_get($config, $key, $default);    
}

