<?php

declare(strict_types=1);
/**
 * Defines the different precedence levels used by the infix parsers. These
 * determine how a series of infix expressions will be grouped. For example,
 * "a + b * c - d" will be parsed as "(a + (b * c)) - d" because "*" has higher
 * precedence than "+" and "-". Here, bigger numbers mean higher Precedence::
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */
namespace SchrodtSven\Phatman;
 
class Precedence 
{
  // Ordered in increasing Precedence::
  public const int  ASSIGNMENT  = 1;
  public const int  CONDITIONAL = 2;
  public const int  SUM         = 3;
  public const int  PRODUCT     = 4;
  public const int  EXPONENT    = 5;
  public const int  PREFIX      = 6;
  public const int  POSTFIX     = 7;
  public const int  CALL        = 8;
}