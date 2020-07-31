<?php

namespace App\Support;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    /**
     * @param string $attribute
     * @param mixed  $value
     * @param        $parameters
     * @return bool
     */
    public function validatePasswordCheck($attribute, $value, $parameters)
    {
        $guard = @$parameters[0] ?? 'web';

        return Hash::check($value ,auth($guard)->user()->password);
    }
}
