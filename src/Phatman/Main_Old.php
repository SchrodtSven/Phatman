<?php

declare(strict_types=1);
require_once 'Autoload.php';

use SchrodtSven\Phatman\TokenType;
print(getcwd());

#exit();
print(TokenType::EOF->punctuator());