<?php

namespace MgahedMvc\Validation\Rules;

use MgahedMvc\Validation\Rules\Contract\Rule;

class MinRule implements Rule
{
    protected int $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    public function apply($field, $value, $data = [])
    {
        return strlen($value) > $this->min;
    }

    public function __toString()
    {
        return "%s must be at least {$this->min} characters long";
    }

    public function message($field)
    {
        // TODO: Implement message() method.
    }
}