<?php

declare(strict_types=1);
/**
 * Generic parser class - to be inherited from by PhatboyParser
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman;

use SchrodtSven\Phatman\Expressions\Expression;
use SchrodtSven\Phatman\Parselets\PrefixParselet;
use SchrodtSven\Phatman\Parselets\InfixParselet;

class Parser
{
  private array $mPrefixParselets = [];
  private array $mRead = [];
  private array $mInfixParselets = [];
  public function __construct(private array $mTokens) {}



  public function registerPre(TokenType $token, PrefixParselet $parselet)
  {
    $this->mPrefixParselets[$token] =  $parselet;
  }

  public function registerIn(TokenType $token, InfixParselet $parselet)
  {
    $this->mInfixParselets[$token] = $parselet;
  }

  public function parseExpression(int $precedence = 0): Expression
  {
    $token = $this->consume();
    $prefix = $this->mPrefixParselets[$token->getType()];

    if ($prefix == null) throw new ParseException("Could not parse \"" +
      $token->getText() + "\".");

    $left = $prefix->parse($this, $token);

    while ($precedence < $this->getPrecedence()) {
      $token = $this->consume();

      $infix = $this->mInfixParselets[$token->getType()];
      $left = $infix->parse($this, $left, $token);
    }

    return $left;
  }



  public function pmatch(TokenType $expected): bool
  {
    $token = $this->lookAhead(0);
    if ($token->getType() != $expected) {
      return false;
    }

    $this->consume();
    return true;
  }

  private function getPrecedence(): int
  {
    $parser = $this->mInfixParselets[$this->lookAhead(0)->getType()];
    if ($parser != null) return $parser->getPrecedence();

    return 0;
  }

  private function lookAhead(int $distance): Token
  { 
    // Read in as many as needed.
    while ($distance >= count($this->mRead)) {
      //@fixme mTokens->next()
      $this->mRead[] = $this->mTokens[0];
    }

    // Get the queued $token->
    return $this->mRead[$distance];
  }

  public function consume(?TokenType $expected = null)
  {
    if (is_null($expected)) {
      $this->lookAhead(0);
      unset($this->mRead[0]);
      return  $this->mRead;
    }
    $token = $this->lookAhead(0);
    if ($token->getType() != $expected) {
      throw new \RuntimeException("Expected token " . $expected .
        " and found " . $token->getType());
    }

    return $this->consume();
  }


  // JUST AS REMINDER TO BE CHECKED!
  //   private final Iterator<Token> mTokens;
  //   private final List<Token> mRead = new ArrayList<Token>();
  //   private final Map<TokenType, PrefixParselet> mPrefixParselets =
  //       new HashMap<TokenType, PrefixParselet>();
  //   private final Map<TokenType, InfixParselet> mInfixParselets =
  //       new HashMap<TokenType, InfixParselet>();
}
