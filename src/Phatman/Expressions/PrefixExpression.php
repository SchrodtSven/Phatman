<?php

declare(strict_types=1);
/**
 *  Class representing a  prefix unary arithmetic expression like 
 *      "!a" or "-b".
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

class  PrefixExpression implements Expression
{
  public function __construct(private TokenType $mOperator, private Expression $mRight) {}

  public function pprint(StringBuilder $builder): void
  {
    $builder->append("(")->append($this->mOperator ->punctuator());
    $this->mRight->pprint($builder);
    $builder->append(")");
  }
}
