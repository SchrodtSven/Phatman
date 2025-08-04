<?php

declare(strict_types=1);
/**
 *  Expression interface
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman\Expressions;

interface Expression {
  /**
   * Pretty-print the expression to a string.
   * @FIXME - implement Stringbuilder equivalent
   */
    public function print($builder);
}
