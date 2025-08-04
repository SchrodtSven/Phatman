
<?php

declare(strict_types=1);
/**
 * One of the two interfaces used by the Pratt parser. 
 * 
 * A PrefixParselet is associated with a token that appears at the beginning of an expression. 
 * 
 * Its function parse() method will be called with the consumed leading token, and the
 * parselet is responsible for parsing anything that comes after that token.
 * 
 * This interface is also used for single-token expressions like variables, in
 * which case function parse() simply doesn't consume any more tokens.
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

interface PrefixParselet
{
    public function parse(Parser $parser, Token $token): Expression;
}