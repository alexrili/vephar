<?php

if (!function_exists("toCamelCase")) {
    function toCamelCase($string, $capitalizeFirstCharacter = false)
    {

        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
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
