<?php

declare(strict_types=1);
/**
 * A partial re-implementation of java.lang.StringBuilder 
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/Phatman
 * @package Phatman
 * @version 0.1
 * @since 2025-08-04
 * @todo, 
 * @fixme implement me
 */

namespace SchrodtSven\Phatman\Helpers;

use Stringable;

class StringBuilder
{
    private string $content = '';
    public function append(mixed $txt): self
    {
        
        $this->content .= $txt;
        return $this;
    }

}