<?php

declare(strict_types=1);
/**
 * Simple parselet for a named variable like "abc".
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */


namespace SchrodtSven\Phatman\Parselets;
use SchrodtSven\Phatman\Expressions\Expression;
use SchrodtSven\Phatman\Expressions\NameExpression;
use SchrodtSven\Phatman\Parser;
use SchrodtSven\Phatman\Token;

class NameParselet implements PrefixParselet
{
  public function parse(Parser $parser, Token $token): Expression
  {
    return new NameExpression($token->getText());
  }
}
