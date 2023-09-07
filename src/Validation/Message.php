<?php

namespace MgahedMvc\Validation;

class Message
{

    public static function generate($rule, $field, $alias = null)
    {
        return str_replace(
            ['%s', '%f'],
            [$alias ?? $field, $field],
            $rule->__toString()
        );
    }
}