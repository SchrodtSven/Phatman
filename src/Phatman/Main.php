<?php

declare(strict_types=1);
/**
 *  Testing parser foo
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

require_once 'Autoload.php';

use SchrodtSven\Phatman\Lexer;
use SchrodtSven\Phatman\PhatmanParser;
use SchrodtSven\Phatman\Helpers\StringBuilder;
use SchrodtSven\Phatman\ParseException;

class Main
{


  private string $sFailed;
  private string $sPassed;

  public function main(array $args)
  {
    // Function call.
    $this->test("a()", "a()");
    $this->test("a(b)", "a(b)");
    $this->test("a(b, c)", "a(b, c)");
    $this->test("a(b)(c)", "a(b)(c)");
    $this->test("a(b) + c(d)", "(a(b) + c(d))");
    $this->test("a(b ? c : d, e + f)", "a((b ? c : d), (e + f))");

    // Unary precedence.
    $this->test("~!-+a", "(~(!(-(+a))))");
    $this->test("a!!!", "(((a!)!)!)");

    // Unary and binary predecence.
    $this->test("-a * b", "((-a) * b)");
    $this->test("!a + b", "((!a) + b)");
    $this->test("~a ^ b", "((~a) ^ b)");
    $this->test("-a!",    "(-(a!))");
    $this->test("!a!",    "(!(a!))");

    // Binary precedence.
    $this->test("a = b + c * d ^ e - f / g", "(a = ((b + (c * (d ^ e))) - (f / g)))");

    // Binary associativity.
    $this->test("a = b = c", "(a = (b = c))");
    $this->test("a + b - c", "((a + b) - c)");
    $this->test("a * b / c", "((a * b) / c)");
    $this->test("a ^ b ^ c", "(a ^ (b ^ c))");

    // Conditional operator.
    $this->test("a ? b : c ? d : e", "(a ? b : (c ? d : e))");
    $this->test("a ? b ? c : d : e", "(a ? (b ? c : d) : e)");
    $this->test("a + b ? c * d : e / f", "((a + b) ? (c * d) : (e / f))");

    // Grouping.
    $this->test("a + (b + c) + d", "((a + (b + c)) + d)");
    $this->test("a ^ (b + c)", "(a ^ (b + c))");
    $this->test("(!a)!",    "((!a)!)");

    // Show the results.
    if ($this->sFailed == 0) {
      print("Passed all " . $this->sPassed . " tests.");
    } else {
      print("----");
      print("Failed " . $this->sFailed . " out of " +
        ($this->sFailed . $this->sPassed) + " tests.");
    }
  }

  /**
   * Parses the given chunk of code and verifies that it matches the expected
   * pretty-printed result.
   */
  public function test(string $source, string $expected)
  {
    $lexer = new Lexer($source);
    $parser = new PhatmanParser($lexer);

    try {
      $result = $parser->parseExpression();
      $builder = new StringBuilder();
      $result->pprint($builder);
      $actual = (string) $builder;

      if ($expected == $actual) {
        $this->sPassed++;
      } else {
        $this->sFailed++;
        print("[FAIL] Expected: " . $expected);
        print("         Actual: " . $actual);
      }
    } catch (ParseException $e) {
      $this->sFailed++;
      print("[FAIL] Expected: " . $expected);
      print("[Message:] " . $e->getMessage());
    }
  }
}

$main = new Main();
$main->main([]);
