<?php

declare(strict_types=1);
/**
 * One of the two parselet interfaces used by the Pratt parser. An
 * InfixParselet is associated with a token that appears in the middle of the
 * expression it parses. Its function parse() method will be called after the left-hand
 * side has been parsed, and it in turn is responsible for parsing everything
 * that comes after the token. This is also used for postfix expressions, in
 * which case it simply doesn't consume any more tokens in its function parse() call.
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

interface InfixParselet
{
    public function parse(Parser $parser, Expression $left, Token $token): Expression;
    public function getPrecedence(): int;
}
