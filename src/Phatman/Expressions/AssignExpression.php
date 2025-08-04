<?php

declare(strict_types=1);
/**
 *  An assignment expression like "foo = bar".
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

class AssignExpression implements Expression
{

    public function __construct(private string $mName, private Expression $mRight) {}

    public function pprint(StringBuilder $builder)
    {
        $builder->append("(")->append($this->mName)->append(" = ");
        $this->mRight->pprint($builder);
        $builder->append(")");
    }

     public function getName()
  {
    return $this->mName;
  }

}
