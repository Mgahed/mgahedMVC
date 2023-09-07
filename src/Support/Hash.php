<?php

namespace MgahedMvc\Support;

class Hash
{
    public static function make($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }

    // token
    public static function token()
    {
        return bin2hex(random_bytes(32));
    }
}