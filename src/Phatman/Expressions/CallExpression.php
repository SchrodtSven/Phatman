<?php

declare(strict_types=1);
/**
 * Class representing a function call like: 
 *  "foo(bar, baz, moo)"
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

class CallExpression implements Expression
{
  public function __construct(private Expression $mFunction, private array $mArgs) {}

  public function pprint(StringBuilder $builder)
  {
    $this->mFunction->pprint($builder);
    $builder->append("(");
    for ($i = 0; $i < count( $this->mArgs); $i++) {
      $this->mArgs[$i]->pprint($builder);
      if ($i < count( $this->mArgs) - 1) $builder->append(", ");
    }
    $builder->append(")");
  }
}
