<?php

namespace MgahedMvc\Validation;

use MgahedMvc\Validation\Rules\AlphaNumericalRule;
use MgahedMvc\Validation\Rules\BetweenRule;
use MgahedMvc\Validation\Rules\Contract\Rule;
use MgahedMvc\Validation\Rules\MaxRule;
use MgahedMvc\Validation\Rules\MinRule;
use MgahedMvc\Validation\Rules\RequiredRule;

class Validator
{
    use traits\RulesResolver;

    protected array $data = [];
    protected array $aliases = [];
    protected array $rules = [];
    protected ErrorBag $errorBag;

    // make
    public function make($data, $rules = [])
    {
        if (count($rules)) {
            $this->setRules($rules);
        }
        $this->data = $data;
        $this->errorBag = new ErrorBag();
        $this->validate();
    }

    protected function validate()
    {
        foreach ($this->rules as $field => $rules) {
            foreach ($this->resolveRules($rules) as $rule) {
                $this->applyRule($field, $rule);
            }
        }
    }

    private function applyRule($field, Rule $rule)
    {
        if (!$rule->apply($field, $this->getFieldValue($field), $this->data)) {
            $this->errorBag->add($field, Message::generate($rule, $field, $this->alias($field)));
        }
    }

    // getFieldValue
    public function getFieldValue($field)
    {
        return $this->data[$field] ?? null;
    }

    // setRules
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    // passes
    public function passes()
    {
        return empty($this->errors());
    }

    // errors
    public function errors($key = null)
    {
        return $key ? $this->errorBag->errors[$key] : $this->errorBag->errors;
    }

    // alias for errors
    public function alias($field)
    {
        return $this->aliases[$field] ?? $field;
    }

    // set aliases
    public function setAliases(array $aliases)
    {
        $this->aliases = $aliases;
    }
}