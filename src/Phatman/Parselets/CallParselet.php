<?php

declare(strict_types=1);
/**
 * Parselet to parse a function call like "a(b, c, d)".
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

class CallParselet implements InfixParselet {
  public  function parse(Parser $parser, Expression $left, Token $token): Expression {
    // Parse the comma-separated arguments until we hit, ")".
    List<Expression> args = new ArrayList<Expression>();
    
    // There may be no arguments at all.
    if (!parser.match(TokenType.RIGHT_PAREN)) {
      do {
        args.add(parser.parseExpression());
      } while (parser.match(TokenType.COMMA));
      parser.consume(TokenType.RIGHT_PAREN);
    }
    
    return new CallExpression(left, args);
  }

  public function  getPrecedence() {
    return Precedence::CALL;
  }
}