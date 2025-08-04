<?php

declare(strict_types=1);
/**
 * A partial re-implementation of java.lang.StringBuilder 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 * @todo, 
 * @fixme implement me
 */

namespace SchrodtSven\Phatman\Helpers;

use Stringable;

class TypeDetector
{
    public static function isAlpha(string $c): bool
    {
        return ($c >= 'a' && $c <= 'z') ||
            ($c >= 'A' && $c <= 'Z') ||
            $c == '_';
    }

    private static function isAlphaNumeric(string $c): bool
    {
        return self::isAlpha($c) || self::isDigit($c);
    }

    private static function isDigit(string $c): bool
    {
        return $c >= '0' && $c <= '9';
    }
}
