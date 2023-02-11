<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ValidateNestedArray implements Rule
{
    protected $rules;
    public function __construct($rules)
    {
        $this->rules = $rules;
    }
    public function passes($attribute, $value)
    {
        $validator = Validator::make($value, $this->rules);
        return $validator->passes();
    }
    public function message()
    {
        return 'The validation failed for the nested array.';
    }
}
