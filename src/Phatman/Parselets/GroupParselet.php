<?php

declare(strict_types=1);
/**
 * Parses parentheses used to group an expression, like 
 *      "a * (b + c)"
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
use SchrodtSven\Phatman\TokenType;

class GroupParselet implements PrefixParselet
{
  public function parse(Parser $parser, Token $token): Expression
  {
    $expression = $parser->parseExpression();
    $parser->consume(TokenType::RIGHT_PAREN);
    return $expression;
  }
}
