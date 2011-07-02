<?php

/**
 * Fountain CMS Site Card Edition
 * 
 * Lightweight content management system for site cards and minisites
 * 
 * @author    Kanat Gailimov <gailimov@gmail.com>
 * @copyright Copyright (c) Kanat Gailimov (http://gailimov.info) 2011
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License v3
 */


namespace core;

require_once VENDOR_PATH . 'Smarty' . DIRECTORY_SEPARATOR . 'libs' . DIRECTORY_SEPARATOR . 'Smarty.class.php';

/**
 * Class loader
 * 
 * @author Kanat Gailimov <gailimov@gmail.com>
 */
class Loader
{
    /**
     * Paths to classes
     * 
     * @var array
     */
    private static $_paths = array(ROOT_PATH, VENDOR_PATH);

    private function __construct()
    {}

    private function __clone()
    {}

    /**
     * Registration path to class
     */
    public static function registerPath($path)
    {
        if (!in_array($path, self::$_paths))
            self::$_paths[] = $path;
    }

    /**
     * Registration functions of autoloading
     * 
     * @return void
     */
    public static function registerAutoload()
    {
        if (!spl_autoload_register(array(__CLASS__, 'load')))
            throw new \core\Exception('Could not register ' . __CLASS__ . '\'s autoload function!');
    }

    /**
     * Autoloading
     * 
     * @param  string $className Class name
     * @return void
     */
    private static function load($className)
    {
        $path = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        foreach (self::$_paths as $paths) {
            if (file_exists($paths . $path . '.php'))
                require_once $paths . $path . '.php';
        }
    }
}
