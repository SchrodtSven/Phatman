<?php

declare(strict_types=1);
/**
 * - Registering AL 
 * - Including global functions
 * - Creating global $koalas (instance of Koalas\Core\Base)
 * 
 * @author Sven Schrodt<sven@schrodt.club>
 * @link https://github.com/SchrodtSven/PhascolarctosCinereus
 * @package 
 * @version 0.1
 * @since 2025-03-16
 */


namespace Koalas;

use Koalas\Core\Base;

class Bootstrap
{

    /**
     * Namespace prefix for project files
     */
    public const NAMESPACE = 'Koalas';

    /**
     * Lib prefix
     */
    public const LIB_PREFIX = 'src/';

    /**
     * Registering AL
     *
     * @return void
     */
    public function registerAutoloader()
    {
        /**
         * Registering project specific auto loading
         */
        spl_autoload_register(callback: function ($className) {

            // Check if namespace of class to be instantiated belongs to us
            if (str_starts_with($className,  Bootstrap::NAMESPACE)) {
                $file = self::LIB_PREFIX . str_replace('\\', '/', $className) . '.php';
                // Check if destination class file exists  and include it, if not - *do not break AL chain*!
                // @see https://www.php-fig.org/psr/psr-4/#2-specification : 

                // Acc. to "PSR-4: Autoloader" implementations
                // - MUST NOT throw exceptions,
                // - MUST NOT raise errors of any level, and 
                // - SHOULD NOT return a value."
                if (file_exists($file)) {
                    require_once $file;
                }
            } else {
                return;
            }
        });
    }
}
// Include global functions 
require_once 'src/Globals.php';
(new Bootstrap())->registerAutoloader();
// Instantiate base class as $koalas
$koalas = new Base();
