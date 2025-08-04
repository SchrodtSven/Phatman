<?php

declare(strict_types=1);
/**
 *  Enum defining token types
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */
namespace SchrodtSven\Phatman;

enum TokenType: string
{
    case LEFT_PAREN = '(';
    case RIGHT_PAREN =  ')';
    case COMMA      =',';
    case ASSIGN     ='=';
    case PLUS       ='+';
    case MINUS      ='-';
    case ASTERISK   ='*';
    case SLASH      ='/';
    case CARET      ='^';
    case TILDE      ='~';
    case BANG       ='!';
    case QUESTION   ='?';
    case COLON      =':';
    case NAME = null;
    case EOF = null;
  
}