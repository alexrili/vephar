<?php

if (!function_exists("toCamelCase")) {
    /**
     * @param $str
     * @return string
     */
    function toCamelCase($str)
    {
        $str = ctype_upper($str) ? strtolower($str) : $str;
        $str = preg_replace_callback('/_([a-z])/', function ($letter) {
            return strtoupper($letter[1]);
        }, $str);
        return lcfirst(str_replace("_", "", $str));
    }
}

if (!function_exists("toSnakeCase")) {
    /**
     * @param $input
     * @return string
     */
    function toSnakeCase($input)
    {

        if (preg_match('/[A-Z]/', $input) === 0) {
            return $input;
        }
        $pattern = '/([a-z])([A-Z])/';
        return  strtolower(preg_replace_callback($pattern, function ($a) {
            return $a[1] . "_" . strtolower($a[2]);
        }, $input));
    }
}

if (!function_exists('is_object_array')) {
    /**
     * @param $value
     * @return bool
     */
    function is_object_array($value)
    {
        return count(array_filter(array_keys($value), 'is_string')) > 0;
    }
}
