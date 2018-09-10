<?php namespace Nano7\Support;

class Num
{
    /**
     * Returns the percentage of a fraction of a total value.
     *
     * @param $npart
     * @param $value
     * @param int $dec
     * @param int $round
     * @return float|int
     */
    public static function percentage($npart, $value, $dec = 2, $round = PHP_ROUND_HALF_UP)
    {
        if ($value <= 0) {
            return 0;
        }

        return round(($npart * 100) / $value, $dec, $round);
    }

    /**
     * Returns the value of a percentage of a total value.
     *
     * @param $percentage
     * @param $value
     * @param int $dec
     * @param int $round
     * @return float
     */
    public static function percent($percentage, $value, $dec = 2, $round = PHP_ROUND_HALF_UP)
    {
        return round(($value * $percentage) / 100, $dec, $round);
    }

    /**
     * Calulcar digito com modulo 11 para CNPJ e CPF.
     *
     * @param $value
     * @return int
     */
    public static function digit11($value)
    {
        $soma = 0;
        $len = strlen($value);


        for ($i = 1; $i <= $len; $i++) {
            $soma = $soma + (intval($value[$i-1]) * ((($len + 1) - $i) + 1));
        }
        $resto = $soma - (intval($soma / 11) * 11);

        $val = (($resto < 2) ? 0 : (11 - $resto));

        return $val;
    }
}