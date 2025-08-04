<?php

declare(strict_types=1);
/**
 *  Class representing a ternary conditional expression like 
 *    "a ? b : c"
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

/**
 * A 
 */
class  ConditionalExpression implements Expression
{
  public function __construct(
    private  Expression $mCondition,
    private  Expression $mThenArm,
    private  Expression $mElseArm
  ) {}

  public function pprint(StringBuilder $builder): void
  {
    $builder->append("(");
    $this->mCondition->pprint($builder);
    $builder->append(" ? ");
    $this->mThenArm->pprint($builder);
    $builder->append(" : ");
    $this->mElseArm->pprint($builder);
    $builder->append(")");
  }
}
