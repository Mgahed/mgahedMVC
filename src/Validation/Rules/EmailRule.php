<?php

namespace MgahedMvc\Validation\Rules;

use MgahedMvc\Validation\Rules\Contract\Rule;

class EmailRule implements Rule
{
    public function apply($field, $value, $data = [])
    {
        return preg_match('/^[\w\-\.]+@([\w\-]+\.)+[\w\-]{2,4}$/', $value);
    }

    public function __toString()
    {
        return "%s must be a valid email address";
    }

    public function message($field)
    {
        // TODO: Implement message() method.
    }
}