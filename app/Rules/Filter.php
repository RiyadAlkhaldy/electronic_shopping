<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    public function __construct(public array $forbidden = [] ){

    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // (strtolower($value) === "laravel")?$fail("this name is not allowed"):'';
        in_array(strtolower($value),$this->forbidden) ? $fail("this name is not allowed") : '';
    }
}
