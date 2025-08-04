<?php

declare(strict_types=1);
/**
 * Class representing a simple variable name expression like 
 *    "abc".
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman\Expressions;

use SchrodtSven\Phatman\Helpers\StringBuilder;
use SchrodtSven\Phatman\TokenType;


class  NameExpression implements Expression
{
  public function __construct(private string $mName) {}

  public function getName()
  {
    return $this->mName;
  }

  public function pprint(StringBuilder $builder): void
  {
    $builder->append($this->mName);
  }
}
