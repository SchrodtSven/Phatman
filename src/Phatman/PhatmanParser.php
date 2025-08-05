<?php

declare(strict_types=1);
/**
 * Extends the generic Parser class with support for parsing the actual Bantam grammar.
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman;

use SchrodtSven\Phatman\Precedence;
use SchrodtSven\Phatman\Parselets\NameParselet;
use SchrodtSven\Phatman\Parselets\AssignParselet;
use SchrodtSven\Phatman\Parselets\ConditionalParselet;
use SchrodtSven\Phatman\Parselets\GroupParselet;
use SchrodtSven\Phatman\Parselets\CallParselet;
use SchrodtSven\Phatman\Parselets\PrefixParselet;
use SchrodtSven\Phatman\Parselets\PostfixOperatorParselet;
use SchrodtSven\Phatman\Parselets\PrefixOperatorParselet;
use SchrodtSven\Phatman\Parselets\BinaryOperatorParselet;

class PhatmanParser extends Parser
{
  public function __construct(Lexer $lexer)
  {
    parent::__construct($lexer);

    // Register all of the parselets for the grammar.

    // Register the ones that need special parselets.
    $this->registerPre(TokenType::NAME,       new NameParselet());
    $this->registerIn(TokenType::ASSIGN,     new AssignParselet());
    $this->registerIn(TokenType::QUESTION,   new ConditionalParselet());
    $this->registerPre(TokenType::LEFT_PAREN, new GroupParselet());
    $this->registerIn(TokenType::LEFT_PAREN, new CallParselet());

    // Register the simple operator parselets.
    $this->prefix(TokenType::PLUS,      Precedence::PREFIX);
    $this->prefix(TokenType::MINUS,     Precedence::PREFIX);
    $this->prefix(TokenType::TILDE,     Precedence::PREFIX);
    $this->prefix(TokenType::BANG,      Precedence::PREFIX);

    // For kicks, we'll make "!" both prefix and postfix, kind of like ++.
    $this->postfix(TokenType::BANG,     Precedence::POSTFIX);

    $this->infixLeft(TokenType::PLUS,     Precedence::SUM);
    $this->infixLeft(TokenType::MINUS,    Precedence::SUM);
    $this->infixLeft(TokenType::ASTERISK, Precedence::PRODUCT);
    $this->infixLeft(TokenType::SLASH,    Precedence::PRODUCT);
    $this->infixRight(TokenType::CARET,   Precedence::EXPONENT);
  }

  /**
   * Registers a postfix unary operator parselet for the given token and
   * Precedence::
   */
  public function postfix(TokenType $token, int $precedence)
  {
    $this->registerIn($token, new PostfixOperatorParselet($precedence));
  }

  /**
   * Registers a prefix unary operator parselet for the given token and
   * Precedence::
   */
  public function prefix(TokenType $token, int $precedence)
  {
    $this->registerPre($token, new PrefixOperatorParselet($precedence));
  }

  /**
   * Registers a left-associative binary operator parselet for the given token
   * and Precedence::
   */
  public function infixLeft(TokenType $token, int $precedence)
  {
    $this->registerIn($token, new BinaryOperatorParselet($precedence, false));
  }

  /**
   * Registers a right-associative binary operator parselet for the given token
   * and Precedence::
   */
  public function infixRight(TokenType $token, int $precedence)
  {
    $this->registerIn($token, new BinaryOperatorParselet($precedence, true));
  }
}
