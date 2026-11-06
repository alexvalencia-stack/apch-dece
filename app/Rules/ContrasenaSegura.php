<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class ContrasenaSegura implements ValidationRule
{
    public const LONGITUD_MINIMA = 8;

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $contrasena = (string) $value;

        $esSegura = mb_strlen($contrasena) >= self::LONGITUD_MINIMA
            && preg_match('/\p{Ll}/u', $contrasena) === 1
            && preg_match('/\p{Lu}/u', $contrasena) === 1
            && preg_match('/[^\p{L}\p{N}\s]/u', $contrasena) === 1;

        if (! $esSegura) {
            $fail('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un carácter especial.');
        }
    }
}
