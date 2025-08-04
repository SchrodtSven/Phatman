<?php

declare(strict_types=1);
/**
 * Parses assignment expressions like "a = b". 
 * 
 * The left side of an assignment expression must be a simple name like "a", 
 * and expressions are right-associative. 
 * 
 * (In other words, "a = b = c" is parsed as "a = (b = c)").
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman\Parselets;

use SchrodtSven\Phatman\Expressions\AssignExpression;
use SchrodtSven\Phatman\Expressions\Expression;
use SchrodtSven\Phatman\Parser;
use SchrodtSven\Phatman\Token;
use SchrodtSven\Phatman\Expressions\NameExpression;
use SchrodtSven\Phatman\ParseException;
use SchrodtSven\Phatman\Precedence;

class AssignParselet implements InfixParselet {
  public  function parse(Parser $parser, Expression $left, Token $token): Expression {
    $right = $parser->parseExpression(Precedence::ASSIGNMENT - 1);
    
    if (!($left instanceof NameExpression)) throw new ParseException(
        "The left-hand side of an assignment must be a name.");
    
        //@FIXME
    //$name = ((NameExpression)$left)->getName();
        $name ='';
    return new AssignExpression($name, $right);
  }

  public function  getPrecedence(): int { return Precedence::ASSIGNMENT; }
}