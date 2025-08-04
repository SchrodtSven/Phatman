<?php

declare(strict_types=1);
/**
 * 
 * A very primitive lexer. Takes a string and splits it into a series of
 * Tokens. Operators and punctuation are mapped to unique keywords. Names,
 * which can be any series of letters, are turned into NAME tokens. All other
 * characters are ignored (except to separate names). Numbers and strings are
 * not supported. This is really just the bare minimum to give the parser
 * something to work with.

 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman;
use SchrodtSven\Phatman\TokenType;
use SchrodtSven\Phatman\Token;
use SchrodtSven\Phatman\Helpers\TypeDetector;

// @FIXME  implements \Iterator 
class Lexer
{
    private array $mPunctuators = [];
     
    private int $mIndex = 0;
  /**
   * Creates a new Lexer to tokenize the given string.
   * @param text String to tokenize.
   */
  public function __construct( private  string $mText) 
  {
    
   
    
    // Register all of the TokenTypes that are explicit punctuators.
    foreach (TokenType::cases() as $type) {
      $punctuator = $type->punctuator();
      if (!is_null($punctuator)) {
        $this->mPunctuators[$punctuator] = $type;
      }
    }
  }
  
 
  public function hasNext() {
    return true;
  }

  public function next(): Token {
    while ($this->mIndex < strlen($this->mText)) {
      $c = $this->mText[$this->mIndex++];
      
      if (str_contains($this->mText, $c)) {
        // Handle punctuation.
        return new Token($this->mPunctuators[$c], $c);
      } else if (TypeDetector::isAlpha($c)) {
        // Handle names.
        $start = $this->mIndex - 1;
        while ($this->mIndex < strlen($this->mText)) {
          if (TypeDetector::isAlpha($this->mText[$this->mIndex])) break;
          $this->mIndex++;
        }
        
        $name = substr($this->mText, $start, $this->mIndex);
        return new Token(TokenType::NAME, $name);
      } else {
        // Ignore all other characters (whitespace, etc.)
      }
    }
    
    // Once we've reached the end of the string, just return EOF tokens. We'll
    // just keeping returning them as many times as we're asked so that the
    // parser's lookahead doesn't have to worry about running out of tokens.
    return new Token(TokenType::EOF, "");
  }


  

}