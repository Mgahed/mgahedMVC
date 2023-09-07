<?php

namespace MgahedMvc\Validation;

class ErrorBag
{
    protected array $errors = [];

    public function __get($key)
    {
        if (property_exists($this, $key)) {
            return $this->$key;
        }
        return null;
    }

    public function add($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    public function all()
    {
        return $this->errors;
    }

    public function first($field)
    {
        return $this->errors[$field][0] ?? '';
    }
}