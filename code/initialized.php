<?php 
/**
 * Enable error reporting.
 */
error_reporting(E_ALL);

/**
 * Introduce code library path.
 */
// for *unix system this path will work fine 

set_include_path(get_include_path() . ':' . __DIR__ . '/lib/');

// for windows system this path will work fine
//set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '\lib');


//echo get_include_path(); exit(); to check the path

if(!function_exists('classAutoLoader')){
    
    /**
     * Autoloader for code library. 
     * Checks namespaces and loads classes automatically.
     * @param $class class names with namespace
     */
    
    function classAutoLoader($class){
        $class = ltrim($class, '\\');
        $file  = '';
        $namespace = '';
    
        if ($endOfNs = strrpos($class, '\\')) {
            $namespace = substr($class, 0, $endOfNs);
            $class = substr($class, $endOfNs + 1);
            $file  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        
        $file .= str_replace('_', DIRECTORY_SEPARATOR, $class) . '.php';
        
        require_once $file;
    }
}

/**
 * Register given functions /classes with the help of spl_autoload_register.
 */

spl_autoload_register('classAutoLoader');
?>
