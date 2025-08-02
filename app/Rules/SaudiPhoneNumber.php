<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SaudiPhoneNumber implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // استبدال الفراغ ب ولا شي

        $value = str_replace(' ', '', $value);
        // هون بنطابق الجزء الاول مع ال $value
        if (!preg_match('/^(\+9665|05|5)[0-9]{8}$/', $value)) {
            $fail(__('validation.saudi_phone'));
        }

    }
}
