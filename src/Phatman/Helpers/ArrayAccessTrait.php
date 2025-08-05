<?php

declare(strict_types=1);
/**
 * A partial re-implementation of java.lang.StringBuilder 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-05
 * @todo, 
 * @fixme implement me
 */

namespace SchrodtSven\Phatman\Helpers;

use Stringable;

trait ArrayAccessTrait 
{
    public $dta = []; // container holding data
    
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->dta[] = $value;
        } else {
            $this->dta[$offset] = $value;
        }
    }

    public function offsetExists($offset): bool
    {
        return isset($this->dta[$offset]);
    }

    public function offsetUnset($offset): void
    {
        unset($this->dta[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return isset($this->dta[$offset]) ? $this->dta[$offset] : null;
    }
}
