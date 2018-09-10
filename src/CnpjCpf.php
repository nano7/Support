<?php namespace Nano7\Support;

class CnpjCpf
{
    /**
     * Validar CNPJ ou CPF.
     *
     * @param $value
     * @return bool
     */
    public static function validate($value)
    {
        switch (strlen($value)) {
            case 14:
                return self::validateCnpj($value);
            case 11:
                return self::validateCpf($value);
            default:
                return false;
        }
    }

    /**
     * Validar CNPJ.
     *
     * @param $value
     * @return bool
     */
    public static function validateCnpj($value)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string)$value);

        // Valida tamanho
        if (strlen($cnpj) != 14) {
            return false;
        }

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;

        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    /**
     * Validar CPF.
     *
     * @param $value
     * @return bool
     */
    public static function validateCpf($value)
    {
        $cpf = preg_replace('/[^0-9]/', '', (string) $value);

        // Valida tamanho
        if (strlen($cpf) != 11) {
            return false;
        }

        // Calcula e confere primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
            $soma += $cpf{$i} * $j;
        }

        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        // Calcula e confere segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
            $soma += $cpf{$i} * $j;
        }
        $resto = $soma % 11;

        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
    }
}