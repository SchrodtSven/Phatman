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



class Parser
{
    public function __construct(private $mTokens) {}



    public function registerPre(TokenType $token, PrefixParselet $parselet)
    {
        $mPrefixParselets->put($token, $parselet);
    }

    public function registerIn(TokenType $token, InfixParselet $parselet)
    {
        $mInfixParselets->put($token, $parselet);
    }

    public function parseExpression(int $precedence=0): Expression
    {
        $token = $this->consume();
        $prefix = $mPrefixParselets->get($token->getType());

        if ($prefix == null) throw new ParseException("Could not parse \"" +
            $token->getText() + "\".");

        $left = $prefix->parse($this, $token);

        while ($precedence < $this->getPrecedence()) {
            $token = $this->consume();

            $infix = $mInfixParselets->get($token->getType());
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
  
  public function consume(?TokenType $expected=null) {
    if(is_null($expected)) {
      $this->lookAhead(0);
    
    return $this->mRead->remove(0);
    }
    $token = $this->lookAhead(0);
    if ($token->getType() != $expected) {
      throw new RuntimeException("Expected token " + $expected +
          " and found " + $token->getType());
    }
    
    return $this->consume();
  }
  

  /* 
  public function $this->consume() {
    // Make sure we've read the $token->
    $this->lookAhead(0);
    
    return mRead->remove(0);
  }
  
  private Token $this->lookAhead(int distance) {
    // Read in as many as needed.
    while (distance >= mRead.size()) {
      mRead.add(mTokens.next());
    }

    // Get the queued $token->
    return mRead.get(distance);
  }

  private function getPrecedence(): int {
    $parser = $mInfixParselets->get($this->lookAhead(0).getType());
    if ($parser != null) return parser.getPrecedence();
    
    return 0;
  } */

    //   private final Iterator<Token> mTokens;
    //   private final List<Token> mRead = new ArrayList<Token>();
    //   private final Map<TokenType, PrefixParselet> mPrefixParselets =
    //       new HashMap<TokenType, PrefixParselet>();
    //   private final Map<TokenType, InfixParselet> mInfixParselets =
    //       new HashMap<TokenType, InfixParselet>();
}
