<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Cpf implements ValidationRule
{
    /**
     * Valida o CPF informado.
     *
     * @param string $attribute Nome do atributo (campo) sendo validado
     * @param mixed $value Valor do campo
     * @param \Closure $fail Callback chamado quando a validação falhar
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // Remove todos os caracteres que não sejam números
        $cpf = preg_replace('/[^0-9]/', '', $value);

        // Verifica se o CPF tem exatamente 11 dígitos
        // ou se todos os dígitos são iguais (ex: 00000000000, 11111111111, etc)
        if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
            $fail('O CPF informado é inválido.');
            return;
        }

        // Valida os dois últimos dígitos verificadores do CPF
        for ($t = 9; $t < 11; $t++) {
            $soma = 0;

            // Multiplica os dígitos pelas posições decrescentes
            for ($c = 0; $c < $t; $c++) {
                $soma += $cpf[$c] * (($t + 1) - $c);
            }

            // Calcula o dígito esperado
            $digitoEsperado = ((10 * $soma) % 11) % 10;

            // Compara com o dígito do CPF
            if ((int) $cpf[$t] !== $digitoEsperado) {
                $fail('O CPF informado é inválido.');
                return;
            }
        }
        // CPF válido
    }
}
