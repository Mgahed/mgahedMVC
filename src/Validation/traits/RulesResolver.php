<?php

namespace MgahedMvc\Validation\traits;

trait RulesResolver
{
    public static function resolveRules($rules)
    {
        if (is_string($rules) && str_contains($rules, '|')) {
            $rules = explode('|', $rules);
        }
        return array_map(function ($rule) {
            if (is_string($rule)) {
                return static::getRuleFromString($rule);
            }
            return $rule;
        }, $rules);
    }

    public static function getRuleFromString(string $rule)
    {
        return RulesMapper::resolve(
            ($exploded = explode(':', $rule))[0],
            explode(',', end($exploded))
        );
    }
}