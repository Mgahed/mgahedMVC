<?php

namespace MgahedMvc\Validation\Rules;

use MgahedMvc\Validation\Rules\Contract\Rule;

class MinValueRule implements Rule
{
    protected int $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    public function apply($field, $value, $data = [])
    {
        return $value > $this->min;
    }

    public function __toString()
    {
        return "%s must be greater than {$this->min}";
    }

    public function message($field)
    {
        // TODO: Implement message() method.
    }
}