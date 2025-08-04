<?php

declare(strict_types=1);
/**
 * Parselet for the condition or "ternary" operator, like 
 *      "a ? b : c".
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

class ConditionalParselet implements InfixParselet {
  public  function parse(Parser $parser, Expression $left, Token $token): Expression {
    Expression thenArm = parser.parseExpression();
    parser.consume(TokenType.COLON);
    Expression elseArm = parser.parseExpression(Precedence::CONDITIONAL - 1);
    
    return new ConditionalExpression(left, thenArm, elseArm);
  }

  public function  getPrecedence() {
    return Precedence::CONDITIONAL;
  }
}