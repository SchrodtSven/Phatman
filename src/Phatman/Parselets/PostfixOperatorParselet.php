<?php

declare(strict_types=1);
/**
 * Generic infix parselet for an unary arithmetic operator.
 * Parses postfix unary "?" expressions.
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
use SchrodtSven\Phatman\Expressions\PostfixExpression;
use SchrodtSven\Phatman\Parselets\InfixParselet;

class PostfixOperatorParselet implements InfixParselet
{
  public function __construct(private int $mPrecedence) {}

  public  function parse(Parser $parser, Expression $left, Token $token): Expression
  {
    return new PostfixExpression($left, $token->getType());
  }

  public function  getPrecedence(): int
  {
    return $this->mPrecedence;
  }
}
