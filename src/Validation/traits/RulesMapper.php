<?php

namespace MgahedMvc\Validation\traits;

use MgahedMvc\Validation\Rules\AlphaNumericalRule;
use MgahedMvc\Validation\Rules\BetweenRule;
use MgahedMvc\Validation\Rules\EmailRule;
use MgahedMvc\Validation\Rules\MaxRule;
use MgahedMvc\Validation\Rules\MinRule;
use MgahedMvc\Validation\Rules\RequiredRule;

trait RulesMapper
{
    protected static array $map = [
        'required' => RequiredRule::class,
        'alnum' => AlphaNumericalRule::class,
        'max' => MaxRule::class,
        'min' => MinRule::class,
        'between' => BetweenRule::class,
        'email' => EmailRule::class,
    ];

    public static function resolve($rule, $options = [])
    {
        return new static::$map[$rule](...$options);
    }
}