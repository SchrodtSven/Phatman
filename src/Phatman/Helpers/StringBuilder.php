<?php

declare(strict_types=1);
/**
 *  An assignment expression like "foo = bar".
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 */

namespace SchrodtSven\Phatman\Helpers;

use Stringable;

class StringBuilder
{
    private string $content = '';
    public function append(mixed $txt): self
    {
        //@TODO implement me
        $this->content .= $txt;
        return $this;
    }

}