<?php

if (!function_exists('currency_format')) {
    if (!defined('CUR_FORMAT_COMMA')) {
        define('CUR_FORMAT_COMMA', '%s,%s');
    }
    if (!defined('CUR_FORMAT_SUP')) {
        define('CUR_FORMAT_SUP', '%s<sup>%s</sup>');
    }
    /**
     * Format price
     * 
     * @param  int $amount
     * @param  int $decimals
     * @param  string  $delimiter
     * @return string
     */
    function currency_format($amount, $format = CUR_FORMAT_COMMA, $decimals = 2, $delimiter = '&thinsp;')
    {
        $amount = str_replace(',', '.', $amount / config('commerce.currency.basic'));
        $amount = number_format($amount, $decimals, '.', ' ');
        
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $browers = array_unique([
                strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== -1,
                strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') !== -1,
            ]);
            
            if (in_array(false, $browers))  {
                $amount = str_replace(' ', $delimiter, $amount);
            }
        }
        
        $amount = explode('.', $amount);
        if (count($amount) > 1 && $amount[1] != str_repeat('0', $decimals)) {
            $amount = sprintf($format, $amount[0], $amount[1]);
        } else {
            $amount = $amount[0];
        }
        
        return $amount;
    }
}
