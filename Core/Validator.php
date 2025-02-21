<?php

namespace Core;

class Validator
{
    // Validate that a value is not empty.
     
    public static function required($value)
    {
        return !empty(trim($value));
    }

    
    // Validate that a string length is within the given range.
     
    public static function string($value, $min = 1, $max = 255)
    {
        $length = strlen(trim($value));
        return $length >= $min && $length <= $max;
    }

    
    // Validate that a value is a valid positive number.       
    public static function number($value)
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT) && $value > 0;
    }   
}
