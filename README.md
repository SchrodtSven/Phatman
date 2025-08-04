# Phatman [^label]

Porting/re-implementing [<i>bantam</i>](https://github.com/munificent/bantam) a demo of Pratt parsing by Bob Nystrom to <kbd>PHP 8.4+</kbd>

Thank you very much Bob - I learned a lot by reading your great article [Pratt Parsers: Expression Parsing Made Easy](http://journal.stuffwithstuff.com/2011/03/19/pratt-parsers-expression-parsing-made-easy/)


## Disclaimer 

** Status: just started - won't run w/o errors **

I just started this little repo - if you are curious about it look again in a few days

## Files 


```sh
├── doq
├── dta
├── LICENSE
├── README.md
├── src
│   └── Phatman
│       ├── Autoload.php
│       ├── BantamParser.php
│       ├── dir.php
│       ├── Expressions
│       │   ├── AssignExpression.php
│       │   ├── CallExpression.php
│       │   ├── ConditionalExpression.php
│       │   ├── Expression.php
│       │   ├── NameExpression.php
│       │   ├── OperatorExpression.php
│       │   ├── PostfixExpression.php
│       │   └── PrefixExpression.php
│       ├── Lexer.php
│       ├── Main.php
│       ├── ParseException.php
│       ├── Parselets
│       │   ├── AssignParselet.php
│       │   ├── BinaryOperatorParselet.php
│       │   ├── CallParselet.php
│       │   ├── ConditionalParselet.php
│       │   ├── GroupParselet.php
│       │   ├── InfixParselet.php
│       │   ├── NameParselet.php
│       │   ├── PostfixOperatorParselet.php
│       │   ├── PrefixOperatorParselet.php
│       │   └── PrefixParselet.php
│       ├── Parser.php
│       ├── Precedence::php
│       ├── Token.php
│       └── TokenType.php
└── test
```




[^label]: 
## Useless knowledge

### Why this name? 
<i>Bantam</i> is an anagram of <i>Batman</i>> - because I do not like Detective Comics as much as Marvel, I decided to call it <i>Phatman</i>, starting with Ph like in PHP although the parser is rather tiny.