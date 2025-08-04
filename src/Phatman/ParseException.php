<?php

declare(strict_types=1);
/**
 * ParseException
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman;

use ErrorException;

class ParseException extends \RuntimeException {
  public function __construct(string $message)
  {
    
  }
}