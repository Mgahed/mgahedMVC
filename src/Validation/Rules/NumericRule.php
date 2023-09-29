<?php

namespace MgahedMvc\Validation\Rules;

use MgahedMvc\Validation\Rules\Contract\Rule;

class NumericRule implements Rule
{

    public function apply($field, $value, $data = [])
    {
        // ex. 1, 1.5, -1, -1.05
        return preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $value);
    }

    public function __toString()
    {
        return '%s must be numeric';
    }

    public function message($field)
    {
        // TODO: Implement message() method.
    }
}