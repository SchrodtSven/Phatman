<?php

declare(strict_types=1);
/**
 * Generic prefix parselet for an unary arithmetic operator. 
 * 
 * Parses prefix unary "-", "+", "~", and "!" expressions.
 * 
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
use SchrodtSven\Phatman\Expressions\PrefixExpression;

class PrefixOperatorParselet implements PrefixParselet
{
  public function __construct(private int $mPrecedence) {}

  public function parse(Parser $parser, Token $token): Expression
  {
    // To handle right-associative operators like "^", we allow a slightly
    // lower precedence when parsing the right-hand side. This will let a
    // parselet with the same precedence appear on the right, which will then
    // take *this* parselet's result as its left-hand argument.
    $right = $parser->parseExpression($this->mPrecedence);

    return new PrefixExpression($token->getType(), $right);
  }

  public function  getPrecedence()
  {
    return $this->mPrecedence;
  }
}
