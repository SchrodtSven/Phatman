<?php

declare(strict_types=1);
/**
 * Generic infix parselet for a binary arithmetic operator. The only
 * difference when parsing, "+", "-", "*", "/", and "^" is $precedence and
 * associativity, so we can use a single parselet class for all of those.
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman\Parselets;

use SchrodtSven\Phatman\Expressions\Expression;
use SchrodtSven\Phatman\Parser;
use SchrodtSven\Phatman\Token;
use SchrodtSven\Phatman\Expressions\OperatorExpression;

class BinaryOperatorParselet implements InfixParselet
{
  public function __construct(private int $mPrecedence, private bool $mIsRight) {}

  public  function parse(Parser $parser, Expression $left, Token $token): Expression
  {
    // To handle right-associative operators like "^", we allow a slightly
    // lower $precedence when parsing the right-hand side. This will let a
    // parselet with the same $precedence appear on the right, which will then
    // take *this* parselet's result as its left-hand argument.
    $right = $parser->parseExpression(
      $this->mPrecedence - ($this->mIsRight ? 1 : 0)
    );

    return new OperatorExpression($left, $token->getType(), $right);
  }

  public function getPrecedence(): int
  {
    return $this->mPrecedence;
  }
}
