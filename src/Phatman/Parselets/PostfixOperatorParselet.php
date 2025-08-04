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

class PostfixOperatorParselet implements InfixParselet {
  public PostfixOperatorParselet(int precedence) {
    mPrecedence = precedence;
  }
  
  public  function parse(Parser $parser, Expression $left, Token $token): Expression {
    return new PostfixExpression(left, token.getType());
  }

  public function  getPrecedence() {
    return mPrecedence;
  }
  
  private final int mPrecedence;
}