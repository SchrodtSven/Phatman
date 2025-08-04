<?php

declare(strict_types=1);
/**
 *  Class representing a postfix unary arithmetic expression like 
 *      "a!"
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

class  PostfixExpression implements Expression
{
  public function __construct(private Expression $mLeft, private  TokenType $mOperator) {}

  public function pprint(StringBuilder $builder): void
  {
    $builder->append("(");
    $this->mLeft->pprint($builder);
    $builder->append($this->mOperator->punctuator())->append(")");
  }
}
