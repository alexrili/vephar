<?php

if (!function_exists("toCamelCase")) {
    function toCamelCase($str)
    {
        $str = ctype_upper($str) ? strtolower($str) : $str;
        $str =  preg_replace_callback('/_([a-z])/', "_strToUpper", $str);
        return lcfirst(str_replace("_", "", $str));
    }
    function _strToUpper($letter)
    {
         return strtoupper($letter[1]);
    }
}

if (! function_exists('is_object_array')) {
    /**
     * @param $value
     * @return bool
     */
    function is_object_array($value)
    {
        return count(array_filter(array_keys($value), 'is_string')) > 0;
    }
}
